<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetContentDetail {

    /**
        名称
     **/
    public $name;

    /**
        单价（元）
     **/
    public $price;

    /**
        数量
     **/
    public $quantity;

    /**
        小计金额=数量*单价
     **/
    public $sum_price;

    /**
        单位
     **/
    public $unit;

    /**
        规格
     **/
    public $spec;


    public function getName() : string{
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getPrice() : string{
        return $this->price;
    }

    public function setPrice(string $price){
        $this->price = $price;
    }

    public function getQuantity() : int{
        return $this->quantity;
    }

    public function setQuantity(int $quantity){
        $this->quantity = $quantity;
    }

    public function getSumPrice() : string{
        return $this->sum_price;
    }

    public function setSumPrice(string $sumPrice){
        $this->sum_price = $sumPrice;
    }

    public function getUnit() : string{
        return $this->unit;
    }

    public function setUnit(string $unit){
        $this->unit = $unit;
    }

    public function getSpec() : string{
        return $this->spec;
    }

    public function setSpec(string $spec){
        $this->spec = $spec;
    }


}

