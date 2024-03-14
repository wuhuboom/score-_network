<?php
namespace Topsdk\Topapi;
class TopUtil {

    /**
     * 校验$value是否非空
     *  if not set ,return true;
     *	if is null , return true;
     **/
    public static function checkEmpty($value) : bool {
        if(!isset($value))
            return true ;
        if($value === null )
            return true;
        if(is_array($value) && count($value) == 0)
            return true;
        if(is_string($value) &&trim($value) === "")
            return true;

        return false;
    }

    /**
     * 获取签名
     **/
    public static function generateSign(array $params,string $appSecret) : string
    {
        ksort($params);

        $stringToBeSigned = $appSecret;
        foreach ($params as $k => $v)
        {
            if(!is_array($v) && "@" != substr($v, 0, 1))
            {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $appSecret;

        return strtoupper(md5($stringToBeSigned));
    }

    public static function convertStructList($param) {
        if(is_string($param)){
            return $param;
        }
        return json_encode($param);
    }

    public static function convertBasicList($param) {
        if(is_string($param)){
            return $param;
        }
        return implode(",",$param);
    }

    public static function convertStruct($param) {
        if(is_string($param)){
            return $param;
        }
        return json_encode($param);
    }

    public static function convertBasic($param) {
        if(is_string($param)){
            return $param;
        }
        return $param;
    }


}
