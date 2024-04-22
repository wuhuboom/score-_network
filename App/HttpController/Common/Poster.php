<?php
namespace App\HttpController\Common;

use App\Service\UserService;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use \Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Poster
{
    /**
     * H5推广二维码
     * @return void
     */
    public static function getH5Poster($user_id,$poster_id,$bg,$left,$top,$width,$height,$url=''){
        if(true){//!file_exists(EASYSWOOLE_ROOT .'/public/uploads/poster/h5/'.$user_id.'.png')
	        $system = Common::getSystem();

        	if(empty($url)){
                $host = $system['web_host']??'';
		        $user = UserService::create()->get($user_id);
		        $url = $host.'?invitation_code='.$user['invitation_code'];
	        }
            $writer  = new PngWriter(); //png格式
            // 创建二维码
            $qrCode = \Endroid\QrCode\QrCode::create($url)
                                            ->setEncoding(new Encoding('UTF-8'))
                                            ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
                                            ->setSize(300)
                                            ->setMargin(10)
                                            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                                            ->setForegroundColor(new Color(0, 0, 0))
                                            ->setBackgroundColor(new Color(255, 255, 255));
            // 加入logo
            $logo = Logo::create(EASYSWOOLE_ROOT .'/public/logo.png')->setResizeToHeight(80)->setResizeToWidth(80);
            if(!file_exists(EASYSWOOLE_ROOT . '/public/uploads/poster/h5')){
                mkdir(EASYSWOOLE_ROOT . '/public/uploads/poster/h5/');
            }
            $result = $writer->write($qrCode, $logo);
            $result->saveToFile(EASYSWOOLE_ROOT .'/public/uploads/poster/h5/'.$user_id.'.png'); //保存图片到本地edriver是什么
        }
        $user_qr_code = EASYSWOOLE_ROOT."/public/uploads/poster/h5/$user_id.png";
        $filename = EASYSWOOLE_ROOT .'/public/uploads/poster/h5/'.$user_id.'.png';
        $generalized_qr_code =Self::createPoster($user_id,$poster_id,$filename,$bg,'h5',$left,$top,$width,$height,1);
        return ['user_qr_code'=>$user_qr_code,'poster'=>$generalized_qr_code];
    }

    /**
     * 小程序推广海报二维码
     * @return void
     */
    public static function getUnlimitedPoster($user_id,$poster_id,$bg,$left,$top,$width,$height){
        $system          = Common::getSystem();
        $appid = $system['wechat_applet']['appid'];
        $secret = $system['wechat_applet']['secret'];
        $config = [
            'appId' => $appid,
            'appSecret' => $secret,
        ];
        // 小程序
        $miniProgram = \EasySwoole\WeChat\Factory::miniProgram($config);
        $response = $miniProgram->appCode->getUnlimit($user_id, [
            'page'  => '',
            'width' => 600,
        ]);
        // 保存二维码到本地
        if ($response instanceof \EasySwoole\WeChat\Kernel\Psr\StreamResponse) {
            $filename = $response->saveAs(EASYSWOOLE_ROOT.'/public/uploads/poster/applet', $user_id.'.png');
        }
        $user_qr_code = EASYSWOOLE_ROOT."/public/uploads/poster/applet/$user_id.png";
        $filename = EASYSWOOLE_ROOT .'/public/uploads/poster/applet/'.$user_id.'.png';
        $generalized_qr_code =Self::createPoster($user_id,$poster_id,$filename,$bg,'applet',$left,$top,$width,$height,1);
        return ['user_qr_code'=>$user_qr_code,'poster'=>$generalized_qr_code];
    }

    /**
     * 生成海报图
     */
    public static function createPoster($user_id,$poster_id,$qr_code,$bg,$dir,$left=230,$top=380,$width=300,$height=300,$is_new=0){
        $filename = EASYSWOOLE_ROOT .'/public/uploads/poster/'.$dir.'/poster_'.$user_id.'_'.$poster_id.'.jpg';
        if($is_new==1||!file_exists($filename)) {
            $config = array(
                'image'      => array(
                    array(
                        'url'     => $qr_code,
                        'left'    => $left,
                        'top'     => $top,
                        'right'   => 0,
                        'bottom'  => 0,
                        'width'   => $width,
                        'height'  =>$height,
                        'stream'  => 0,
                        //图片资源是否是字符串图像流
                        'opacity' => 100
                        //不透明度
                    ),
                ),
                'background' => $bg,
            );
            $Qrcode = new \App\HttpController\Common\Qrcode();
            $Qrcode->imgTextMerge($config, $filename);
        }
        $url = "/public/uploads/poster/{$dir}/poster_{$user_id}_{$poster_id}.jpg";;
        return $url;

    }
}
