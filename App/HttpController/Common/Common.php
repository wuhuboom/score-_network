<?php

namespace App\HttpController\Common;

use App\Model\AreaModel;
use App\Model\CategoryModel;
use App\Model\FileManagementModel;
use App\Model\ResellerModel;
use App\Model\SmsModel;
use App\Model\SystemModel;
use EasySwoole\EasySwoole\Config;
use EasySwoole\FastCache\Cache;

/**
 * @todo    公共类
 * @version    v1.0.0
 */
class Common
{

    static public function getSystem(){
        $system = Cache::getInstance()->get('system');
        if(empty($system)){
            $system = SystemModel::create()->where('id',1)->find();
        }
        return $system;
    }


    //密码加密
    static public function hashPassword($password){
        $psw_str = Config::getInstance()->getConf('PSW_STR');
        return password_hash($password.$psw_str, PASSWORD_DEFAULT);
    }
    //验证密码
    static public function passwordVerify($password,$hash){
        $psw_str = Config::getInstance()->getConf('PSW_STR');
        if (password_verify($password.$psw_str, $hash)) {
           return true;
        } else {
           return false;
        }
    }

    /**
     * 获取图片路径
     */
    static public function getImageUrl($image){
        if(empty($image)){
            return '';
        }
        $system = Common::getSystem();
        if($system['qiniu']['is_open']!=1){
            return '';
        }
        $host = rtrim($system['qiniu']['host'],'/');
        $file = pathinfo($image);
        $url = Cache::getInstance()->get($file['filename']);
        if (empty($url)){
            $file_url = FileManagementModel::create()->where('file_url',$image)->where('is_oss',1)->val('file_url');
            if(empty($file_url)){
                return '';
            }
            Cache::getInstance()->set($file['filename'],$host.$image);
        }

        return $host.$image;
    }
    /**
     * 获取图片域名
     * 开启七牛云则显示七牛云域名 不开启则显示后端域名
     */
    static public function getimagehost(){
        $system = Common::getSystem();
        if($system['qiniu']['is_open']==1){
            return $system['qiniu']['host'];
        }
        return $system['host'];
    }

    //图片路径自动补域名
    static public function autocompleteimage($image, $host = '')
    {
        //图片为空不处理
        if (empty($image)) {
            return $image;
        }

        //如果图片路径已加域名 则原样返回
        if (strpos($image, 'http') !== false) {
            return $image;
        }

        //判断七牛云是否已开启且图片已同步至七牛云，是则自动添加七牛云域名
        $imageUrl = self::getImageUrl($image);
        if ($imageUrl) {
            return $imageUrl;
        }

        //自定义域名
        if (!empty($host)) {
            return $host . $image;
        }

        //获取系统配置后端域名
        $system = self::getSystem();
        $host   = $system['host'];
        return $host . $image;
    }

    //图片路径自动补域名
    static public function autoCompleteImageLists($images,$host=''){
        $images = is_array($images)?$images:explode(',',$images);
        if(empty($images)){
            return [];
        }

        if(empty($host)){
            $system = self::getSystem();
            $host = $system['host'];
        }
        foreach ($images as $k=>$v){
            if(strpos($v,'http')!==false){
                $images[$k] =  $v;
            }else{
                if(empty($v)){
                    return '';
                }
                $imageUrl = self::getImageUrl($v);
                if($imageUrl){
                    $images[$k] =  $imageUrl;
                }else{
                    $images[$k] =  $host.$v;
                }

            }
        }
        return  $images;
    }
    //发送短信
    static public function sendSmsCode($tel, $code, $ip, $type)
    {
        try {
            $IpQuery = new IpQuery();
            $ip_address = $IpQuery->query($ip);
            $address = $IpQuery->getAddress($ip_address['pos'],$ip_address['isp']);
            $history = SmsModel::create()->where('tel', $tel)->where('status',1)->where('type',$type)->order('id','DESC')->find();
            if($history){
                $create_time = strtotime($history['create_time']);
                if($create_time+60>time()&&$history['is_check']==0){//60*15
                    return '验证码已发送，15分钟内有效，请勿重复获取！';
                }
            }
            //单个IP限制每天可发送次数
            if (SmsModel::create()->where('ip', $ip)->where('status',1)->where('create_time', date('Y-m-d') . ' 00:00:00', '>=')->count() > 10) {
                return '今日获取验证码次数已超上限！';
            }
            $system = self::getSystem();
            switch ($type){
                case 'login':
                    $templateId = $system['qcloudsms']['login_template_id']??'';// 短信通知模板 ID，需要在短信控制台中申请
                    $contents ="【{$system['qcloudsms']['sign']}】您正在申请手机绑定，验证码为：{$code}，15分钟内有效！";
                    break;
                case 'register':
                    $templateId = $system['qcloudsms']['register_template_id']??'';// 短信通知模板 ID，需要在短信控制台中申请
                    $contents ="【{$system['qcloudsms']['sign']}】您的注册验证码：{$code}，如非本人操作，请忽略本短信！";
                    break;
                case 'password':
                    $templateId = $system['qcloudsms']['password_template_id']??'';// 短信通知模板 ID，需要在短信控制台中申请
                    $contents ="【{$system['qcloudsms']['sign']}】您的动态验证码为：{$code}，您正在进行密码重置操作，如非本人操作，请忽略本短信！";
                    break;
            }
            $appid      = $system['qcloudsms']['appid'] ?? '';                             // 短信应用 SDK AppID
            $appkey     = $system['qcloudsms']['appkey'] ?? '';                            // 短信应用 SDK AppKey
            $smsSign    = $system['qcloudsms']['sign'] ?? '';                              // NOTE: 签名参数使用的是`签名内容`，而不是`签名ID`。这里的签名"腾讯云"只是示例，真实的签名需要在短信控制台申请
            $ssender    = new \Qcloud\Sms\SmsSingleSender($appid, $appkey);
            $result     = $ssender->sendWithParam("86", $tel, $templateId, [$code,15], $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
            $rsp        = json_decode($result, true);
            $data['type'] = $type;
            $data['tel'] = $tel;
            $data['code'] = $code;
            $data['contents'] = $contents;
            $data['ip'] = $ip;

            $data['province'] =$address['province']??'';
            $data['city'] = $address['city']??'';
            $data['expire_time'] = date('Y-m-d H:i:s', time() + 60 * 15); //15分钟失效
            $data['create_time'] = date('Y-m-d H:i:s', time());           //15分钟失效
            $data['error_msg']      = $rsp['errmsg']??'';
            if ($rsp['result'] === 0 && $rsp['errmsg'] === 'OK') {
                $data['status']      = 1;
                SmsModel::create()->data($data)->save();
                return true;
            } else {
                $data['status']      = 0;
                SmsModel::create()->data($data)->save();
                return $rsp;
            }

        } catch (\Exception $e) {
            return $e;
        }
    }

    //检测验证码是否有效
    static public function checkSmsCode($tel, $code,$type)
    {
        //测试验证码88888888 无需验证
        if ($code == '88888888') {
            return true;
        }
        if (empty($code)) {
            return '验证码必须';
        }
        $sms = SmsModel::create()->where('tel', $tel)->where('type', $type)->order('id', 'desc')->find();
        if (empty($sms)) {
            return '请先获取验证码！';
        }
        if ($sms['is_check'] == 1) {
            return '验证码已失效，请重新获取';
        }
        $expire_time = strtotime($sms['expire_time']);
        if ($expire_time < time()) {
            return '验证码已过期';
        }
        if ($sms['code'] != $code) {
            return '验证码不正确';
        }
        SmsModel::create()->where('id', $sms['id'])->update(['is_check' => 1]);
        return true;
    }

    //获取树形菜单
    public static function getAllCateTreeList()
    {
        $list = CategoryModel::create()->field('id,id as value,name,parent_id')->order('parent_id', 'asc')->select();
        $data = self::getChildren($list, 0);
        return $data;
    }

    static public function getRandomStr($length = 5)
    {
        // 生成指定长度的随机字节序列
        $randomBytes = random_bytes($length);
        // 将字节序列转换为十六进制表示形式
        $hexString = bin2hex($randomBytes);
        // 获取前五位作为最终结果
        $str = strtoupper(substr($hexString, 0, 5));
        return $str;
    }
    /**
     * 递归 树节点算法
     *
     * @param array  $array
     * @param number $pid
     */
    public static function getChild($array, $parent_id = 0)
    {
        $data = array();
        foreach ($array as $k => $v) {        //PID符合条件的
            if ($v['parent_id'] == $parent_id) {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           //寻找子集
                $child      = self::getChild($array, $v['id']);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 //加入数组
                $v['child'] = $child ?? [];
                $data[]     = $v;//加入数组中
            }
        }
        return $data;
    }

    /**
     * 递归 树节点算法
     *
     * @param array  $array
     * @param number $pid
     */
    public static function getChildren($array, $parent_id = 0)
    {
        $data = array();
        foreach ($array as $k => $v) {        //PID符合条件的
            if ($v['parent_id'] == $parent_id) {                         //寻找子集
                $child         = self::getChildren($array, $v['id']);            //加入数组
                $v['children'] = $child ?? [];
                $data[]        = $v;//加入数组中
            }
        }
        return $data;
    }

	public static function getTimeZone(){
    	$list = ["Asia/Shanghai","UTC","Africa/Abidjan","Africa/Accra","Africa/Addis_Ababa","Africa/Algiers","Africa/Asmara","Africa/Asmera","Africa/Bamako","Africa/Bangui","Africa/Banjul","Africa/Bissau","Africa/Blantyre","Africa/Brazzaville","Africa/Bujumbura","Africa/Cairo","Africa/Casablanca","Africa/Ceuta","Africa/Conakry","Africa/Dakar","Africa/Dar_es_Salaam","Africa/Djibouti","Africa/Douala","Africa/El_Aaiun","Africa/Freetown","Africa/Gaborone","Africa/Harare","Africa/Johannesburg","Africa/Juba","Africa/Kampala","Africa/Khartoum","Africa/Kigali","Africa/Kinshasa","Africa/Lagos","Africa/Libreville","Africa/Lome","Africa/Luanda","Africa/Lubumbashi","Africa/Lusaka","Africa/Malabo","Africa/Maputo","Africa/Maseru","Africa/Mbabane","Africa/Mogadishu","Africa/Monrovia","Africa/Nairobi","Africa/Ndjamena","Africa/Niamey","Africa/Nouakchott","Africa/Ouagadougou","Africa/Porto-Novo","Africa/Sao_Tome","Africa/Timbuktu","Africa/Tripoli","Africa/Tunis","Africa/Windhoek","America/Adak","America/Anchorage","America/Anguilla","America/Antigua","America/Araguaina","America/Argentina/Buenos_Aires","America/Argentina/Catamarca","America/Argentina/ComodRivadavia","America/Argentina/Cordoba","America/Argentina/Jujuy","America/Argentina/La_Rioja","America/Argentina/Mendoza","America/Argentina/Rio_Gallegos","America/Argentina/Salta","America/Argentina/San_Juan","America/Argentina/San_Luis","America/Argentina/Tucuman","America/Argentina/Ushuaia","America/Aruba","America/Asuncion","America/Atikokan","America/Atka","America/Bahia","America/Bahia_Banderas","America/Barbados","America/Belem","America/Belize","America/Blanc-Sablon","America/Boa_Vista","America/Bogota","America/Boise","America/Buenos_Aires","America/Cambridge_Bay","America/Campo_Grande","America/Cancun","America/Caracas","America/Catamarca","America/Cayenne","America/Cayman","America/Chicago","America/Chihuahua","America/Coral_Harbour","America/Cordoba","America/Costa_Rica","America/Creston","America/Cuiaba","America/Curacao","America/Danmarkshavn","America/Dawson","America/Dawson_Creek","America/Denver","America/Detroit","America/Dominica","America/Edmonton","America/Eirunepe","America/El_Salvador","America/Ensenada","America/Fort_Nelson","America/Fort_Wayne","America/Fortaleza","America/Glace_Bay","America/Godthab","America/Goose_Bay","America/Grand_Turk","America/Grenada","America/Guadeloupe","America/Guatemala","America/Guayaquil","America/Guyana","America/Halifax","America/Havana","America/Hermosillo","America/Indiana/Indianapolis","America/Indiana/Knox","America/Indiana/Marengo","America/Indiana/Petersburg","America/Indiana/Tell_City","America/Indiana/Vevay","America/Indiana/Vincennes","America/Indiana/Winamac","America/Indianapolis","America/Inuvik","America/Iqaluit","America/Jamaica","America/Jujuy","America/Juneau","America/Kentucky/Louisville","America/Kentucky/Monticello","America/Knox_IN","America/Kralendijk","America/La_Paz","America/Lima","America/Los_Angeles","America/Louisville","America/Lower_Princes","America/Maceio","America/Managua","America/Manaus","America/Marigot","America/Martinique","America/Matamoros","America/Mazatlan","America/Mendoza","America/Menominee","America/Merida","America/Metlakatla","America/Mexico_City","America/Miquelon","America/Moncton","America/Monterrey","America/Montevideo","America/Montreal","America/Montserrat","America/Nassau","America/New_York","America/Nipigon","America/Nome","America/Noronha","America/North_Dakota/Beulah","America/North_Dakota/Center","America/North_Dakota/New_Salem","America/Ojinaga","America/Panama","America/Pangnirtung","America/Paramaribo","America/Phoenix","America/Port-au-Prince","America/Port_of_Spain","America/Porto_Acre","America/Porto_Velho","America/Puerto_Rico","America/Punta_Arenas","America/Rainy_River","America/Rankin_Inlet","America/Recife","America/Regina","America/Resolute","America/Rio_Branco","America/Rosario","America/Santa_Isabel","America/Santarem","America/Santiago","America/Santo_Domingo","America/Sao_Paulo","America/Scoresbysund","America/Shiprock","America/Sitka","America/St_Barthelemy","America/St_Johns","America/St_Kitts","America/St_Lucia","America/St_Thomas","America/St_Vincent","America/Swift_Current","America/Tegucigalpa","America/Thule","America/Thunder_Bay","America/Tijuana","America/Toronto","America/Tortola","America/Vancouver","America/Virgin","America/Whitehorse","America/Winnipeg","America/Yakutat","America/Yellowknife","Antarctica/Casey","Antarctica/Davis","Antarctica/DumontDUrville","Antarctica/Macquarie","Antarctica/Mawson","Antarctica/McMurdo","Antarctica/Palmer","Antarctica/Rothera","Antarctica/South_Pole","Antarctica/Syowa","Antarctica/Troll","Antarctica/Vostok","Arctic/Longyearbyen","Asia/Aden","Asia/Almaty","Asia/Amman","Asia/Anadyr","Asia/Aqtau","Asia/Aqtobe","Asia/Ashgabat","Asia/Ashkhabad","Asia/Atyrau","Asia/Baghdad","Asia/Bahrain","Asia/Baku","Asia/Bangkok","Asia/Barnaul","Asia/Beirut","Asia/Bishkek","Asia/Brunei","Asia/Calcutta","Asia/Chita","Asia/Choibalsan","Asia/Chongqing","Asia/Chungking","Asia/Colombo","Asia/Dacca","Asia/Damascus","Asia/Dhaka","Asia/Dili","Asia/Dubai","Asia/Dushanbe","Asia/Famagusta","Asia/Gaza","Asia/Harbin","Asia/Hebron","Asia/Ho_Chi_Minh","Asia/Hong_Kong","Asia/Hovd","Asia/Irkutsk","Asia/Istanbul","Asia/Jakarta","Asia/Jayapura","Asia/Jerusalem","Asia/Kabul","Asia/Kamchatka","Asia/Karachi","Asia/Kashgar","Asia/Kathmandu","Asia/Katmandu","Asia/Khandyga","Asia/Kolkata","Asia/Krasnoyarsk","Asia/Kuala_Lumpur","Asia/Kuching","Asia/Kuwait","Asia/Macao","Asia/Macau","Asia/Magadan","Asia/Makassar","Asia/Manila","Asia/Muscat","Asia/Nicosia","Asia/Novokuznetsk","Asia/Novosibirsk","Asia/Omsk","Asia/Oral","Asia/Phnom_Penh","Asia/Pontianak","Asia/Pyongyang","Asia/Qatar","Asia/Qyzylorda","Asia/Rangoon","Asia/Riyadh","Asia/Saigon","Asia/Sakhalin","Asia/Samarkand","Asia/Seoul","Asia/Shanghai","Asia/Singapore","Asia/Srednekolymsk","Asia/Taipei","Asia/Tashkent","Asia/Tbilisi","Asia/Tehran","Asia/Tel_Aviv","Asia/Thimbu","Asia/Thimphu","Asia/Tokyo","Asia/Tomsk","Asia/Ujung_Pandang","Asia/Ulaanbaatar","Asia/Ulan_Bator","Asia/Urumqi","Asia/Ust-Nera","Asia/Vientiane","Asia/Vladivostok","Asia/Yakutsk","Asia/Yangon","Asia/Yekaterinburg","Asia/Yerevan","Atlantic/Azores","Atlantic/Bermuda","Atlantic/Canary","Atlantic/Cape_Verde","Atlantic/Faeroe","Atlantic/Faroe","Atlantic/Jan_Mayen","Atlantic/Madeira","Atlantic/Reykjavik","Atlantic/South_Georgia","Atlantic/St_Helena","Atlantic/Stanley","Australia/ACT","Australia/Adelaide","Australia/Brisbane","Australia/Broken_Hill","Australia/Canberra","Australia/Currie","Australia/Darwin","Australia/Eucla","Australia/Hobart","Australia/LHI","Australia/Lindeman","Australia/Lord_Howe","Australia/Melbourne","Australia/NSW","Australia/North","Australia/Perth","Australia/Queensland","Australia/South","Australia/Sydney","Australia/Tasmania","Australia/Victoria","Australia/West","Australia/Yancowinna","Brazil/Acre","Brazil/DeNoronha","Brazil/East","Brazil/West","CET","CST6CDT","Canada/Atlantic","Canada/Central","Canada/Eastern","Canada/Mountain","Canada/Newfoundland","Canada/Pacific","Canada/Saskatchewan","Canada/Yukon","Chile/Continental","Chile/EasterIsland","Cuba","EET","EST","EST5EDT","Egypt","Eire","Etc/GMT","Etc/GMT+0","Etc/GMT+1","Etc/GMT+10","Etc/GMT+11","Etc/GMT+12","Etc/GMT+2","Etc/GMT+3","Etc/GMT+4","Etc/GMT+5","Etc/GMT+6","Etc/GMT+7","Etc/GMT+8","Etc/GMT+9","Etc/GMT-0","Etc/GMT-1","Etc/GMT-10","Etc/GMT-11","Etc/GMT-12","Etc/GMT-13","Etc/GMT-14","Etc/GMT-2","Etc/GMT-3","Etc/GMT-4","Etc/GMT-5","Etc/GMT-6","Etc/GMT-7","Etc/GMT-8","Etc/GMT-9","Etc/GMT0","Etc/Greenwich","Etc/UCT","Etc/UTC","Etc/Universal","Etc/Zulu","Europe/Amsterdam","Europe/Andorra","Europe/Astrakhan","Europe/Athens","Europe/Belfast","Europe/Belgrade","Europe/Berlin","Europe/Bratislava","Europe/Brussels","Europe/Bucharest","Europe/Budapest","Europe/Busingen","Europe/Chisinau","Europe/Copenhagen","Europe/Dublin","Europe/Gibraltar","Europe/Guernsey","Europe/Helsinki","Europe/Isle_of_Man","Europe/Istanbul","Europe/Jersey","Europe/Kaliningrad","Europe/Kiev","Europe/Kirov","Europe/Lisbon","Europe/Ljubljana","Europe/London","Europe/Luxembourg","Europe/Madrid","Europe/Malta","Europe/Mariehamn","Europe/Minsk","Europe/Monaco","Europe/Moscow","Europe/Nicosia","Europe/Oslo","Europe/Paris","Europe/Podgorica","Europe/Prague","Europe/Riga","Europe/Rome","Europe/Samara","Europe/San_Marino","Europe/Sarajevo","Europe/Saratov","Europe/Simferopol","Europe/Skopje","Europe/Sofia","Europe/Stockholm","Europe/Tallinn","Europe/Tirane","Europe/Tiraspol","Europe/Ulyanovsk","Europe/Uzhgorod","Europe/Vaduz","Europe/Vatican","Europe/Vienna","Europe/Vilnius","Europe/Volgograd","Europe/Warsaw","Europe/Zagreb","Europe/Zaporozhye","Europe/Zurich","GB","GB-Eire","GMT","GMT+0","GMT-0","GMT0","Greenwich","HST","Hongkong","Iceland","Indian/Antananarivo","Indian/Chagos","Indian/Christmas","Indian/Cocos","Indian/Comoro","Indian/Kerguelen","Indian/Mahe","Indian/Maldives","Indian/Mauritius","Indian/Mayotte","Indian/Reunion","Iran","Israel","Jamaica","Japan","Kwajalein","Libya","MET","MST","MST7MDT","Mexico/BajaNorte","Mexico/BajaSur","Mexico/General","NZ","NZ-CHAT","Navajo","PRC","PST8PDT","Pacific/Apia","Pacific/Auckland","Pacific/Bougainville","Pacific/Chatham","Pacific/Chuuk","Pacific/Easter","Pacific/Efate","Pacific/Enderbury","Pacific/Fakaofo","Pacific/Fiji","Pacific/Funafuti","Pacific/Galapagos","Pacific/Gambier","Pacific/Guadalcanal","Pacific/Guam","Pacific/Honolulu","Pacific/Johnston","Pacific/Kiritimati","Pacific/Kosrae","Pacific/Kwajalein","Pacific/Majuro","Pacific/Marquesas","Pacific/Midway","Pacific/Nauru","Pacific/Niue","Pacific/Norfolk","Pacific/Noumea","Pacific/Pago_Pago","Pacific/Palau","Pacific/Pitcairn","Pacific/Pohnpei","Pacific/Ponape","Pacific/Port_Moresby","Pacific/Rarotonga","Pacific/Saipan","Pacific/Samoa","Pacific/Tahiti","Pacific/Tarawa","Pacific/Tongatapu","Pacific/Truk","Pacific/Wake","Pacific/Wallis","Pacific/Yap","Poland","Portugal","ROC","ROK","Singapore","Turkey","UCT","US/Alaska","US/Aleutian","US/Arizona","US/Central","US/East-Indiana","US/Eastern","US/Hawaii","US/Indiana-Starke","US/Michigan","US/Mountain","US/Pacific","US/Pacific-New","US/Samoa","UTC","Universal","W-SU","WET","Zulu"];
    	return $list;
	}




}

