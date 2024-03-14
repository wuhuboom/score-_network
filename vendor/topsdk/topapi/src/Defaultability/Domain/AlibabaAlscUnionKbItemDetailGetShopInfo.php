<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetShopInfo {

    /**
        免费wifi
     **/
    public $free_wifi;

    /**
        免费停车
     **/
    public $free_park;

    /**
        免费停车小时数
     **/
    public $free_park_hours;

    /**
        停车收费金额
     **/
    public $park_fee_per_hour;

    /**
        每段时间的封顶金额  例如 24小时封顶xx元
     **/
    public $park_fee_upper_bound_per_day;

    /**
        提供发票
     **/
    public $supply_invoice;

    /**
        发票类型:电子发票或纸质发票
     **/
    public $invoice_types;


    public function getFreeWifi() : bool{
        return $this->free_wifi;
    }

    public function setFreeWifi(bool $freeWifi){
        $this->free_wifi = $freeWifi;
    }

    public function getFreePark() : bool{
        return $this->free_park;
    }

    public function setFreePark(bool $freePark){
        $this->free_park = $freePark;
    }

    public function getFreeParkHours() : int{
        return $this->free_park_hours;
    }

    public function setFreeParkHours(int $freeParkHours){
        $this->free_park_hours = $freeParkHours;
    }

    public function getParkFeePerHour() : string{
        return $this->park_fee_per_hour;
    }

    public function setParkFeePerHour(string $parkFeePerHour){
        $this->park_fee_per_hour = $parkFeePerHour;
    }

    public function getParkFeeUpperBoundPerDay() : string{
        return $this->park_fee_upper_bound_per_day;
    }

    public function setParkFeeUpperBoundPerDay(string $parkFeeUpperBoundPerDay){
        $this->park_fee_upper_bound_per_day = $parkFeeUpperBoundPerDay;
    }

    public function getSupplyInvoice() : bool{
        return $this->supply_invoice;
    }

    public function setSupplyInvoice(bool $supplyInvoice){
        $this->supply_invoice = $supplyInvoice;
    }

    public function getInvoiceTypes() : array{
        return $this->invoice_types;
    }

    public function setInvoiceTypes(array $invoiceTypes){
        $this->invoice_types = $invoiceTypes;
    }


}

