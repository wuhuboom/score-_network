<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetTextContent {

    /**
        标题
     **/
    public $title;

    /**
        描述
     **/
    public $desc;

    /**
        内容
     **/
    public $contents;


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

    public function getContents() : array{
        return $this->contents;
    }

    public function setContents(array $contents){
        $this->contents = $contents;
    }


}

