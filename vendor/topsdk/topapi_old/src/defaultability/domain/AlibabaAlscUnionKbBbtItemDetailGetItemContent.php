<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemDetailGetItemContent {

    /**
        商品内容详情组
     **/
    public $content_groups;

    /**
        图文详情
     **/
    public $image_contents;

    /**
        商品说明
     **/
    public $text_contents;

    /**
        补充说明
     **/
    public $remarks;

    /**
        商家公告
     **/
    public $announcement;


    public function getContentGroups() : array{
        return $this->content_groups;
    }

    public function setContentGroups(array $contentGroups){
        $this->content_groups = $contentGroups;
    }

    public function getImageContents() : array{
        return $this->image_contents;
    }

    public function setImageContents(array $imageContents){
        $this->image_contents = $imageContents;
    }

    public function getTextContents() : array{
        return $this->text_contents;
    }

    public function setTextContents(array $textContents){
        $this->text_contents = $textContents;
    }

    public function getRemarks() : array{
        return $this->remarks;
    }

    public function setRemarks(array $remarks){
        $this->remarks = $remarks;
    }

    public function getAnnouncement() : string{
        return $this->announcement;
    }

    public function setAnnouncement(string $announcement){
        $this->announcement = $announcement;
    }


}

