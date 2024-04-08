<?php
use EasySwoole\I18N\I18N;

if (!function_exists('displayTime')) {
	function displayTime($time){

	}
}

//语言切换
if (!function_exists('l')) {
	function l($const,$lang='En'){
		if(!in_array($lang,['En','Cn'])){
			$lang = 'En';
		}
		if($lang == 'En'){
			I18N::getInstance()->addLanguage(new \App\Languages\English(),'En');
		}else{
			I18N::getInstance()->addLanguage(new \App\Languages\Chinese(),'Cn');
		}
		try {
			$value = I18N::getInstance()->setLanguage($lang)->translate($const);
			return $value??'';
		}catch (\Throwable $e){
			return $const.'_'.$lang;
		}

	}
}
if (!function_exists('language')) {
	function language($lang){
		$language = [
			'En'=>'English',
			'Cn'=>'简体中文',
		];
		return $language[$lang]??$language['Cn'];
	}
}
// 生成指定后缀的URL
if (!function_exists('url')) {
    function url($path,$suffix='.html'){
        if($path=='index'||$path=='/index'){
            return '/';
        }else{
            return $path.$suffix;
        }
    }
}
//网站标题
if (!function_exists('showTitle')) {
    function showTitle($title){
       $system = \App\HttpController\Common\Common::getSystem();
       if($title==$system['title']||empty($title)){
           return $system['title'];
       }else{
           return $title.'_'.$system['title'];
       }
    }
}
// 显示指定的时间格式
if (!function_exists('showDate')) {
    function showDate($date,$type='date'){
        switch ($type) {
            case 'date':
                $str = date('Y-m-d', strtotime($date));
                break;
            case 'year':
                $str = date('Y', strtotime($date));
                break;
            case 'month':
                $str = date('m', strtotime($date));
                break;
            case 'day':
                $str = date('d', strtotime($date));
                break;
            case 'hour':
                $str = date('H', strtotime($date));
                break;
            case 'minute':
                $str = date('i', strtotime($date));
                break;
            case 'second':
                $str = date('s', strtotime($date));
                break;
            default :
                $str = $date;
        }
       return $str;
    }
}
//图片路径自动补域名
if (!function_exists('autoCompleteImage')) {
     function autoCompleteImage($image,$host=''){
        if(strpos($image,'http')!==false){
            echo $image;
        }
        if(empty($image)){
            echo  $image;
        }
        if(empty($host)){
            $system = \App\HttpController\Common\Common::getSystem();
            $host = $system['host']??'';
        }
        echo  $host.$image;
    }
}

if (!function_exists('getAddress')) {
    function getAddress($address){
        preg_match('/(.*?(省|自治区|北京市|天津市|上海市|重庆市|澳门特别行政区|香港特别行政区))/', $address, $matches);
        if (count($matches) > 1) {
            $province = $matches[count($matches) - 2];
            $address = preg_replace('/(.*?(省|自治区|北京市|天津市|上海市|重庆市|澳门特别行政区|香港特别行政区))/','', $address, 1);
        }
        preg_match('/(.*?(市|自治州|地区|区划|县))/', $address, $matches);
        if (count($matches) > 1) {
            $city = $matches[count($matches) - 2];
            $address = str_replace($city, '', $address);
        }
        $city_list = ['北京市','天津市','上海市','重庆市'];
        if(in_array($province,$city_list)&&empty($city)){
            $city = $province;
        }
        preg_match('/(.*?(区|县|镇|乡|街道))/', $address, $matches);
        if (count($matches) > 1) {
            $area = $matches[count($matches) - 2];
            $address = str_replace($area, '', $address);
        }
        return [
            'province' => isset($province) ? $province : '',
            'city' => isset($city) ? $city : '',
            'district' => isset($area) ? $area : '',
            "address" => $address
        ];
    }
}

//多语言关键词
if (!function_exists('getI18NLanguage')){
    function getI18NLanguage(){
        $reflect = new \ReflectionClass(\App\Languages\Dictionary::class);
        $constants = $reflect->getConstants();
        return $constants;
    }

}