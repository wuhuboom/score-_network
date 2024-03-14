<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemDetailGetItemBuyNote {

    /**
        商家须知
     **/
    public $shop_info;

    /**
        使用须知
     **/
    public $use_note;

    /**
        更多须知内容
     **/
    public $extra_notes;


    public function getShopInfo() : AlibabaAlscUnionKbBbtItemDetailGetShopInfo{
        return $this->shop_info;
    }

    public function setShopInfo(AlibabaAlscUnionKbBbtItemDetailGetShopInfo $shopInfo){
        $this->shop_info = $shopInfo;
    }

    public function getUseNote() : AlibabaAlscUnionKbBbtItemDetailGetUseNote{
        return $this->use_note;
    }

    public function setUseNote(AlibabaAlscUnionKbBbtItemDetailGetUseNote $useNote){
        $this->use_note = $useNote;
    }

    public function getExtraNotes() : array{
        return $this->extra_notes;
    }

    public function setExtraNotes(array $extraNotes){
        $this->extra_notes = $extraNotes;
    }


}

