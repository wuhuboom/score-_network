<?php
namespace Topsdk\Topapi;

use Exception;
use topsdk\topapi\TopUtil;

class TopApiClient
{
    public $appkey;

    public $secretKey;

    public $gatewayUrl = "";

    public $format = "json";

    public $connectTimeout;

    public $readTimeout;

    public $simplify = true;

    public $verifySsl = false;

    protected $signMethod = "md5";

    protected $apiVersion = "2.0";

    protected $sdkVersion = "new_php_sdk";

    public function getAppkey():string
    {
        return $this->appkey;
    }

    public function __construct(string $appkey, string $secretKey, string $gatewayUrl,int $connectTimeout = 30000,int $readTimeout = 30000){
        $this->appkey = $appkey;
        $this->secretKey = $secretKey;
        $this->gatewayUrl = $gatewayUrl;
        $this->connectTimeout = $connectTimeout;
        $this->readTimeout = $readTimeout;
    }

    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt ( $ch, CURLOPT_USERAGENT, "new_php_sdk" );
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verifySsl);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->verifySsl);
        }

        if (is_array($postFields) && 0 < count($postFields))
        {
            $postBodyString = "";
            foreach ($postFields as $k => $v)
            {
                $postBodyString .= "$k=" . urlencode($v) . "&";
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
        }
        $reponse = curl_exec($ch);

        if (curl_errno($ch))
        {
            throw new Exception(curl_error($ch),0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }
    public function curlWithMemoryFile($url, $postFields = null, $fileFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt ( $ch, CURLOPT_USERAGENT, "top-sdk-php" );
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //生成分隔符
        $delimiter = '-------------' . uniqid();
        //先将post的普通数据生成主体字符串
        $data = '';
        if($postFields != null){
            foreach ($postFields as $name => $content) {
                $data .= "--" . $delimiter . "\r\n";
                $data .= 'Content-Disposition: form-data; name="' . $name . '"';
                //multipart/form-data 不需要urlencode，参见 http:stackoverflow.com/questions/6603928/should-i-url-encode-post-data
                $data .= "\r\n\r\n" . $content . "\r\n";
            }
            unset($name,$content);
        }

        //将上传的文件生成主体字符串
        if($fileFields != null){
            foreach ($fileFields as $name => $file) {
                $data .= "--" . $delimiter . "\r\n";
                $data .= 'Content-Disposition: form-data; name="' . $name . '"; filename="' . "topfile" . "\" \r\n";
                $data .= 'Content-Type: application/octet-stream' . "\r\n\r\n";

                $data .= $file . "\r\n";
            }
            unset($name,$file);
        }
        //主体结束的分隔符
        $data .= "--" . $delimiter . "--";

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER , array(
                'Content-Type: multipart/form-data; boundary=' . $delimiter,
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $reponse = curl_exec($ch);
        unset($data);

        if (curl_errno($ch))
        {
            throw new Exception(curl_error($ch),0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }

    protected function logCommunicationError($apiName, $requestUrl, $errorCode, $responseTxt)
    {
        $localIp = isset($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_ADDR"] : "CLI";
        $logger = new TopLogger;
        $logger->conf["log_file"] = rtrim(TOP_SDK_WORK_DIR, '\\/') . '/' . "logs/top_comm_err_" . $this->appkey . "_" . date("Y-m-d") . ".log";
        $logger->conf["separator"] = "^_^";
        $logData = array(
            date("Y-m-d H:i:s"),
            $apiName,
            $this->appkey,
            $localIp,
            PHP_OS,
            $this->sdkVersion,
            $requestUrl,
            $errorCode,
            str_replace("\n","",$responseTxt)
        );
        $logger->log($logData);
    }

    public function execute(string $apiCode, array $paramMap, array $fileParamMap) {
        return $this->executeWithSession($apiCode,$paramMap,$fileParamMap,"");
    }

    public function executeWithSession(string $apiCode, array $paramMap, array $fileParamMap, string $session) {
        $sysParams = array();
        //组装系统参数
        $sysParams["app_key"] = $this->appkey;
        $sysParams["v"] = $this->apiVersion;
        $sysParams["format"] = $this->format;
        $sysParams["sign_method"] = $this->signMethod;
        $sysParams["method"] = $apiCode;
        $sysParams["timestamp"] = date("Y-m-d H:i:s");
        $sysParams["simplify"] = $this->simplify;
        $sysParams["partner_id"] = $this->sdkVersion;
		if (!empty($session))
        {
            $sysParams["session"] = $session;
        }
		//获取业务参数
		$apiParams = $paramMap;


		//签名
		$sysParams["sign"] = TopUtil::generateSign(array_merge($apiParams, $sysParams),$this->secretKey);

        $requestUrl = $this->gatewayUrl."?";
		foreach ($sysParams as $sysParamKey => $sysParamValue)
        {
            $requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
        }
        $requestUrl = substr($requestUrl, 0, -1);

		//发起HTTP请求
        $result = new TopResult();
		try
        {
            if(count($fileParamMap) > 0){
                $resp = $this->curlWithMemoryFile($requestUrl, $paramMap, $fileParamMap);
            }else{
                $resp = $this->curl($requestUrl, $paramMap);
            }
        }
        catch (Exception $e)
        {
            $result->code = $e->getCode();
            $result->msg = $e->getMessage();
            return $result;
        }

		unset($apiParams);
		unset($fileParamMap);
		//解析TOP返回结果
		$respWellFormed = false;
		if ("json" == $this->format)
        {
            $respObject = json_decode($resp);
            if (null !== $respObject)
            {
                $respWellFormed = true;
                foreach ($respObject as $propKey => $propValue)
                {
                    $respObject = $propValue;
                }
            }
        }
        else if("xml" == $this->format)
        {
            $respObject = @simplexml_load_string($resp);
            if (false !== $respObject)
            {
                $respWellFormed = true;
            }
        }

		//返回的HTTP文本不是标准JSON或者XML，记下错误日志
		if (false === $respWellFormed)
        {
            $result->code = 0;
            $result->msg = "HTTP_RESPONSE_NOT_WELL_FORMED";
            return $result;
        }

		return $respObject;
	}

}
