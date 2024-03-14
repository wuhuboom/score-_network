<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetImageDto {

    /**
        图片名
     **/
    public $name;

    /**
        图片地址
     **/
    public $url;


    public function getName() : string{
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getUrl() : string{
        return $this->url;
    }

    public function setUrl(string $url){
        $this->url = $url;
    }


}

