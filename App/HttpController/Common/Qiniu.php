<?php

namespace App\HttpController\Common;

use App\Model\SmsModel;


/**
 * @todo    七牛云OOS
 * @version    v1.0.0
 */
class Qiniu
{

    //获取上传token
    static public function getUploadToken()
    {
        $system = Common::getSystem();
        $bucket = $system['qiniu']['bucket'];
        $accessKey = $system['qiniu']['access_key'];
        $secretKey = $system['qiniu']['secret_key'];
        $auth = new \EasySwoole\Oss\QiNiu\Auth($accessKey, $secretKey);
        $key = 'None';//date('YmdHis').rand(10000,99999);
        $token = $auth->uploadToken($bucket,$key);
        return $token;
        $upManager = new \EasySwoole\Oss\QiNiu\Storage\UploadManager();
        list($ret, $error) = $upManager->putFile($token, $key, EASYSWOOLE_ROOT.'/404.html');
        return [$ret,$error,EASYSWOOLE_ROOT.'/404.html'];
    }

    //获取前端上传的配置信息
    static public function getConfig(){
        $system = Common::getSystem();
        $bucket = $system['qiniu']['bucket'];
        $accessKey = $system['qiniu']['access_key'];
        $secretKey = $system['qiniu']['secret_key'];
        $auth = new \EasySwoole\Oss\QiNiu\Auth($accessKey, $secretKey);
        $key =date('YmdHis').rand(10000,99999);
        $token = $auth->uploadToken($bucket,$key);
        return ['token'=>$token,'host'=>$system['qiniu']['host'],'upload_host'=>$system['qiniu']['upload_host'],'key'=>$key];
    }

    //上传文件到七牛云空间
    static public function putFile($filePath,$dir='',$filename=''){
        try {
            $system = Common::getSystem();
            $bucket = $system['qiniu']['bucket'];
            $accessKey = $system['qiniu']['access_key'];
            $secretKey = $system['qiniu']['secret_key'];
            $auth = new \EasySwoole\Oss\QiNiu\Auth($accessKey, $secretKey);
            $key = $filename;
            if(empty($filename)){
                $key = date('YmdHis').rand(100000,999999).'.'.pathinfo($filePath, PATHINFO_EXTENSION);
            }
            if($dir){
                $key = $dir.'/'.$key;
            }
            $token = $auth->uploadToken($bucket,$key);
            $upManager = new \EasySwoole\Oss\QiNiu\Storage\UploadManager();
            list($ret, $error) = $upManager->putFile($token, $key, $filePath, null, 'text/plain', null);
            if($error){

            }
            return $ret;
        }catch (\Throwable $e){
            return $e->getMessage();
        }

    }

    //获取远程资源到七牛云空间
    static public function fetch($url,$key=null){
        $system = Common::getSystem();
        $bucket = $system['qiniu']['bucket'];
        $accessKey = $system['qiniu']['access_key'];
        $secretKey = $system['qiniu']['secret_key'];
        $auth = new \EasySwoole\Oss\QiNiu\Auth($accessKey, $secretKey);
        $BucketManager = new \EasySwoole\Oss\QiNiu\Storage\BucketManager($auth);
        list($ret, $error) = $BucketManager->fetch($url,$bucket,$key);
        if($error){
            return  $error->message;
        }
        return $ret;
        //
    }

    //删除文件
    static public function delete($key){
        try {
            $system = Common::getSystem();
            $bucket = $system['qiniu']['bucket'];
            $accessKey = $system['qiniu']['access_key'];
            $secretKey = $system['qiniu']['secret_key'];
            $auth = new \EasySwoole\Oss\QiNiu\Auth($accessKey, $secretKey);

            $BucketManager = new \EasySwoole\Oss\QiNiu\Storage\BucketManager($auth);
            $ret = $BucketManager->delete($bucket,ltrim($key,'/'));
            return $ret;
        }catch (\Throwable $e){
            return $e->getMessage();
        }

    }
}

