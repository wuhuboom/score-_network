<?php

/**
 * 微信公众号文章爬取类
 */
class WxCrawler
{

    //微信内容div正则
    private $wxContentDiv = '/<div class="rich_media_content " id="js_content" (.*?)>(.*?)<\/div>/s';
    //微信图片样式
    private $imageStyle = 'style="max-width: 100% !important;height: auto !important;visibility: visible !important;box-sizing:border-box"';

    /**
     * 爬取内容
     * @param  $url
     * @return false|string
     * @author bignerd
     * @since  2016-08-16T10:13:58+0800
     */
    private function _get($url)
    {
        return file_get_contents($url);
    }

    public function crawByUrl($url)
    {
        $content = $this->_get($url);

        $basicInfo = $this->articleBasicInfo($content);
        list($content_html, $content_text) = $this->contentHandle($content);
        return array_merge($basicInfo,['content_html' => $content_html,'content_text' => $content_text]);
    }
    /**
     * 处理微信文章源码，提取文章主体，处理图片链接
     * @author bignerd
     * @since  2016-08-16T15:59:27+0800
     * @param  $content 抓取的微信文章源码
     * @return [带图html文本，无图html文本]
     */
    private function contentHandle($content)
    {
        $content_html_pattern = $this->wxContentDiv;
        preg_match_all($content_html_pattern, $content, $html_matchs);
        if(empty(array_filter($html_matchs))) {
            return ['文章不存在','文章不存在'];
//            echo '文章不存在';
//            exit();
        }
        $content_html = $html_matchs[0][0];
        //去除掉hidden隐藏
        $content_html = str_replace('style="visibility: hidden;"','',$content_html);
        //过滤掉iframe
        $content_html = preg_replace('/<iframe(.*?)<\/iframe>/','',$content_html);
        $path = '/static/weChat/';
        /** @var  带图片html文本 */
        $content_html = preg_replace_callback('/data-src="(.*?)"/', function($matches) use ($path){
            return 'src="' . $path . $this->getImg($matches[1]).'" '.$this->imageStyle;
        }, $content_html);

        //添加微信样式
        $content_html = '<div style="max-width: 677px;margin-left: auto;margin-right: auto;">'.$content_html. '</div>';
        /** @var  无图html文本 */
        $content_text = preg_replace('/<img.*?>/s','',$content_html);
        return [$content_html,$content_text];
    }
    /**
     * 获取文章的基本信息
     * @author bignerd
     * @since  2016-08-16T17:16:32+0800
     * @param  $content 文章详情源码
     * @return $basicInfo
     */
    private function articleBasicInfo($content)
    {
        //待获取item
        $item = [
            'ct' => 'date',//发布时间
            'msg_title' => 'title',//标题
            'msg_desc' => 'digest',//描述
            'msg_link' => 'content_url',//文章链接
            'msg_cdn_url' => 'cover',//封面图片链接
            'nickname' => 'wechatname',//公众号名称
        ];
        $basicInfo = [
            'author' => '',
            'copyright_stat' => '',
        ];
        foreach ($item as $k => $v) {
            if($k == 'msg_title')
                $pattern = '/ var '.$k.' = (.*?)\.html\(false\);/s';
            else
                $pattern = '/ var '.$k.' = "(.*?)";/s';

            preg_match_all($pattern,$content,$matches);
            if(array_key_exists(1, $matches) && !empty($matches[1][0])){
                $basicInfo[$v] = $this->htmlTransform($matches[1][0]);
            }else{
                $basicInfo[$v] = '';
            }
        }
        //2020/4/3获取作者已失效
//		/** 获取作者 */
//		preg_match('/<em class="rich_media_meta rich_media_meta_text">(.*?)<\/em>/s', $content, $matchAuthor);
//		if(!empty($matchAuthor[1])) $basicInfo['author'] = $matchAuthor[1];
//		/** 文章类型 */
//		preg_match('/<span id="copyright_logo" class="rich_media_meta meta_original_tag">(.*?)<\/span>/s', $content, $matchType);
//		if(!empty($matchType[1])) $basicInfo['copyright_stat'] = $matchType[1];

        return $basicInfo;
    }
    /**
     * 特殊字符转换
     * @author bignerd
     * @since  2016-08-16T17:30:52+0800
     * @param  $string
     * @return $string
     */
    private function htmlTransform($string)
    {
        $string = str_replace('&quot;','"',$string);
        $string = str_replace('&amp;','&',$string);
        $string = str_replace('amp;','',$string);
        $string = str_replace('&lt;','<',$string);
        $string = str_replace('&gt;','>',$string);
        $string = str_replace('&nbsp;',' ',$string);
        $string = str_replace("\\", '',$string);
        return $string;
    }

    /**
     * @param $url
     * @return string
     */
    private function getImg($url){
        $refer = "http://www.qq.com/";
        $opt = [
            'http'=>[
                'header'=>"Referer: " . $refer
            ]
        ];
        $context = stream_context_create($opt);
        //接受数据流
        $file_contents = file_get_contents($url,false, $context);
        $imageSteam =  Imagecreatefromstring($file_contents);
        $path = 'static/weChat/';
        if(!file_exists($path))
            mkdir($path,0777,true);
        $fileName = time().rand(0,99999) . '.jpg';
        //生成新图片
        imagejpeg($imageSteam, $path . $fileName);
        return $fileName;
    }
}

//$url = 'https://mp.weixin.qq.com/s/-7qomGtv9WMNRXVoWgs1xA';
//$crawler = new WxCrawler();
//$content = $crawler->crawByUrl($url);
//echo mb_convert_encoding($content['content_html'], 'UTF-8', 'UTF-8');