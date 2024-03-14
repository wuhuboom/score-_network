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






}

