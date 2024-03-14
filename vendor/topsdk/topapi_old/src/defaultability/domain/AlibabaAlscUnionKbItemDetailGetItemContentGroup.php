<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetItemContentGroup {

    /**
        组标题
     **/
    public $title;

    /**
        组内列表
     **/
    public $content_details;


    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getContentDetails() : array{
        return $this->content_details;
    }

    public function setContentDetails(array $contentDetails){
        $this->content_details = $contentDetails;
    }


}

