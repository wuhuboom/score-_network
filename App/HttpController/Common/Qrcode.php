<?php
namespace App\HttpController\Common;

class Qrcode
{
    /**
     * 生成宣传海报
     * @param array 参数,包括图片和文字
     * @param string $filename 生成海报文件名,不传此参数则不生成文件,直接输出图片
     * @return [type] [description]
     */
    function imgTextMerge($config=array(),$filename=""){
        $imageDefault = array(
            'left'=>0,
            'top'=>0,
            'right'=>0,
            'bottom'=>0,
            'width'=>100,
            'height'=>100,
            'opacity'=>100
        );
        $textDefault = array(
            'text'=>'',
            'left'=>0,
            'top'=>0,
            'fontSize'=>32, //字号
            'fontColor'=>'255,255,255', //字体颜色
            'angle'=>0,
        );
        $background = $config['background'];//海报最底层得背景
        //背景方法
        $backgroundInfo = getimagesize($background);
        $backgroundFun = 'imagecreatefrom'.image_type_to_extension($backgroundInfo[2], false);
        $background = $backgroundFun($background);
        $backgroundWidth = imagesx($background); //背景宽度
        $backgroundHeight = imagesy($background); //背景高度
        $imageRes = imageCreatetruecolor($backgroundWidth,$backgroundHeight);
        $color = imagecolorallocate($imageRes, 255, 255, 255);
        imagefill($imageRes, 0, 0, $color);
        // imageColorTransparent($imageRes, $color); //颜色透明
        imagecopyresampled($imageRes,$background,0,0,0,0,imagesx($background),imagesy($background),imagesx($background),imagesy($background));
        //处理了图片
        if(!empty($config['image'])){
            foreach ($config['image'] as $key => $val) {
                $val = array_merge($imageDefault,$val);
                $info = getimagesize($val['url']);
                $function = 'imagecreatefrom'.image_type_to_extension($info[2], false);
                if($val['stream']){ //如果传的是字符串图像流
                    $info = getimagesizefromstring($val['url']);
                    $function = 'imagecreatefromstring';
                }
                $res = $function($val['url']);
                $resWidth = $info[0];
                $resHeight = $info[1];
                //建立画板 ，缩放图片至指定尺寸
                $canvas=imagecreatetruecolor($val['width'], $val['height']);
                imagefill($canvas, 0, 0, $color);
                //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
                imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'],$resWidth,$resHeight);
                $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']) - $val['width']:$val['left'];
                $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']) - $val['height']:$val['top'];
                //放置图像
                imagecopymerge($imageRes,$canvas, $val['left'],$val['top'],$val['right'],$val['bottom'],$val['width'],$val['height'],$val['opacity']);//左，上，右，下，宽度，高度，透明度
            }
        }
        //处理文字
        if(!empty($config['text'])){
            foreach ($config['text'] as $key => $val) {
                $val = array_merge($textDefault,$val);
                list($R,$G,$B) = explode(',', $val['fontColor']);
                $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
                $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
                $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];

                $text = $val['text'];
                $fontSize = $val['fontSize'];
                $angle = $val['angle'];
                $fontPath = $val['fontPath'];
                $width = $val['width'];
                $outStyle = $val['outStyle'];
                $suffix = isset($val['suffix'])?$val['suffix']:'';
                $text = $this->textWidth($fontSize,$angle,$fontPath,$text,$width,$outStyle,$suffix);

                imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],$text);
            }
        }
        //生成图片
        if(!empty($filename)){
            $res = imagejpeg($imageRes,$filename,100); //保存到本地
            imagedestroy($imageRes);
            if(!$res) return false;
            return $filename;
        }else{
            imagejpeg($imageRes); //在浏览器上显示
            imagedestroy($imageRes);
        }
    }

    /**
     * 文字超出宽度
     * @param $fontsize //字体大小
     * @param $angle //角度
     * @param $fontface //字体名称
     * @param $string //字符串
     * @param $width //预设宽度
     * @param $outStyle //超出宽度操作类型（wrap：换行 hidden：隐藏 replace：替换）
     * @param $suffix //outStyle值为replace时，替换的内容
     * @return string
     */
    function textWidth($fontsize, $angle, $fontface, $string, $width, $outStyle = 'replace', $suffix = '...') {
        $content = "";

        // 将字符串拆分成一个个单字 保存到数组 letter 中
        for ($i=0;$i<mb_strlen($string);$i++) {
            $letter[] = mb_substr($string, $i, 1);
        }

        foreach ($letter as $l) {
            $teststr = $content.$l;
            $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
            // 判断拼接后的字符串是否超过预设的宽度
            $is_width = false;//是否超出宽度
            if (($testbox[2] > $width) && ($content !== "") && $width != 0) {
                $is_width = true;
            }
            if ($outStyle == 'wrap'){//超出换行
                if ($is_width) $content .= "\n";
            }elseif ($outStyle == 'hidden'){//超出隐藏
                if ($is_width) break;
            }elseif ($outStyle == 'replace'){//超出替换内容
                if ($is_width){$content .= $suffix; break;}
            }
            $content .= $l;
        }
        return $content;
    }

}
