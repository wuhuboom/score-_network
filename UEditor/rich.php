<?php


require 'vendor/autoload.php';
use Dompdf\Dompdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Writer\HTML\Style\Image as ImageStyleWriter;
class rich
{
    public function word2html($file_url=""){
       // $file_url = $_SERVER['DOCUMENT_ROOT']."/static/upload/img.docx";
        $phpWord = IOFactory::load($file_url);
        $html = '';
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $ele1) {
                $paragraphStyle = $ele1->getParagraphStyle();

                if ($paragraphStyle) {
                    $html .= '<p style="text-align:'. $paragraphStyle->getAlignment() .';text-indent:20px;">';
                } else {
                    $html .= '<p>';
                }
                if ($ele1 instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($ele1->getElements() as $ele2) {
                        if ($ele2 instanceof \PhpOffice\PhpWord\Element\Text) {
                            $style = $ele2->getFontStyle();
                            $styleString = '';
                            $fontFamily = mb_convert_encoding($style->getName(), 'GBK', 'UTF-8');  //字体集
                            $fontFamily && $styleString .= "font-family:{$fontFamily};";
                            $fontSize = $style->getSize(); //字体大小
                            $fontSize && $styleString .= "font-size:{$fontSize}px;";
                            $isBold = $style->isBold();//是否加粗
                            $isBold && $styleString .= "font-weight:bold;";
                            $color = $style->getColor(); //字体颜色
                            $color && $styleString .= "color:#{$color};";
                            $fgColor = $style->getFgColor(); //背景色
                            $fgColor && $styleString .= "background-color:{$fgColor};";
                            $bottom_line = $style->getUnderline(); //下划线
                            if($bottom_line!="none"){
                                $bottom_line_color = $color?$color:'#000000';
                                if($bottom_line=='single')
                                    $styleString .= "text-decoration: underline #{$bottom_line_color}";
                                else if($bottom_line == 'double')
                                    $styleString .= "border-bottom:3px double #{$bottom_line_color}";
                            }
                            $html .= sprintf('<span style="%s">%s</span>',
                                $styleString,
                                mb_convert_encoding($ele2->getText(), 'GBK', 'UTF-8')
                            );
                        } elseif ($ele2 instanceof \PhpOffice\PhpWord\Element\Image) {

                            $style = $ele2->getStyle();
                            $styleWriter = new ImageStyleWriter($style);
                            $style_str = $styleWriter->write();
                            $img_name = md5($ele2->getSource()) . '.' . $ele2->getImageExtension();
                            $imageSrc = $_SERVER['DOCUMENT_ROOT']."/static/upload/images/". $img_name;
                            $imgUrl = "http://".$_SERVER['HTTP_HOST']."/static/upload/images/".$img_name;
                            $imageData = $ele2->getImageStringData(true);
                            // $imageData = 'data:' . $ele2->getImageType() . ';base64,' . $imageData;
                            file_put_contents($imageSrc, base64_decode($imageData));
                            $html .= '<img src="'. $imgUrl .'" style="'.$style_str.'">';
                        }
                    }
                }
                elseif ($ele1 instanceof \PhpOffice\PhpWord\Element\TextBreak){
                    //换行
                    $html .= '<p><br /></p>';
                }
                $html .= '</p>';
            }
        }
        //return $html;
        return mb_convert_encoding($html, 'UTF-8', 'GBK');
    }


    /**
     * 内容审核
     * @param string $type
     * @param string $text
     * @param string $url
     */
    public function violation_check($type='text',$text="",$url=""){
        include_once("baidu_content_check/AipImageCensor.php");
        $config = include("config.php");
        $baidu_config=$config['baidu']; //百度Api配置项
        //$url = "http://imgeditor.cnkjnb.cn/static/upload/images/test1.jpg";
        //$text = "曹尼玛";
        $client = new AipImageCensor($baidu_config['app_id'],$baidu_config['api_key'],$baidu_config['app_secret']);
        $result=[];
        if($type=="text" && !empty($text)){
            $result = $client->textCensorUserDefined($text);
        }
        else if(!empty($url)){
            $result = $client->imageCensorUserDefined($url);
        }
        if(isset($result['error_code'])){
            //接口调用发生错误
            return ["code"=>$result['error_code'],"msg"=>$result['error_msg']];
        }
        else if(isset($result['conclusionType']) && $result['conclusionType']!=1){
            return ["code"=>0,"msg"=>$result['conclusion'],"data"=>$result['data']];
        }
        else
            return ["code"=>1,"msg"=>"合规"];

    }

}
?>