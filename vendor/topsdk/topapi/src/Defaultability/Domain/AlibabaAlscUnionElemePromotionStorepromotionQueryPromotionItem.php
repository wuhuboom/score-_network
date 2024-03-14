<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionStorepromotionQueryPromotionItem {

    /**
        标题
     **/
    public $title;

    /**
        原价
     **/
    public $origin_price;

    /**
        现价
     **/
    public $price;

    /**
        图片
     **/
    public $picture;


    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getOriginPrice() : string{
        return $this->origin_price;
    }

    public function setOriginPrice(string $originPrice){
        $this->origin_price = $originPrice;
    }

    public function getPrice() : string{
        return $this->price;
    }

    public function setPrice(string $price){
        $this->price = $price;
    }

    public function getPicture() : string{
        return $this->picture;
    }

    public function setPicture(string $picture){
        $this->picture = $picture;
    }


}

