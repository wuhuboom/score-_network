<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetImageContent {

    /**
        标题
     **/
    public $title;

    /**
        描述
     **/
    public $desc;

    /**
        图片列表
     **/
    public $urls;


    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getDesc() : string{
        return $this->desc;
    }

    public function setDesc(string $desc){
        $this->desc = $desc;
    }

    public function getUrls() : array{
        return $this->urls;
    }

    public function setUrls(array $urls){
        $this->urls = $urls;
    }


}

