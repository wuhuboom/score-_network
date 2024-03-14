<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionOfficialactivityGetActivityPromotionDto {

    /**
        活动ID
     **/
    public $id;

    /**
        标题
     **/
    public $title;

    /**
        描述
     **/
    public $description;

    /**
        活动创意图片
     **/
    public $picture;

    /**
        起始时间（秒）
     **/
    public $start_time;

    /**
        结束时间（秒）
     **/
    public $end_time;

    /**
        推广链接
     **/
    public $link;


    public function getId() : string{
        return $this->id;
    }

    public function setId(string $id){
        $this->id = $id;
    }

    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getDescription() : string{
        return $this->description;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function getPicture() : string{
        return $this->picture;
    }

    public function setPicture(string $picture){
        $this->picture = $picture;
    }

    public function getStartTime() : int{
        return $this->start_time;
    }

    public function setStartTime(int $startTime){
        $this->start_time = $startTime;
    }

    public function getEndTime() : int{
        return $this->end_time;
    }

    public function setEndTime(int $endTime){
        $this->end_time = $endTime;
    }

    public function getLink() : AlibabaAlscUnionElemePromotionOfficialactivityGetPromotionLink{
        return $this->link;
    }

    public function setLink(AlibabaAlscUnionElemePromotionOfficialactivityGetPromotionLink $link){
        $this->link = $link;
    }


}

