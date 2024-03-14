<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetItemDetail {

    /**
        内容详情
     **/
    public $item_content;

    /**
        购买须知
     **/
    public $item_buy_note;

    /**
        凭证
     **/
    public $item_ticket;


    public function getItemContent() : AlibabaAlscUnionKbItemDetailGetItemContent{
        return $this->item_content;
    }

    public function setItemContent(AlibabaAlscUnionKbItemDetailGetItemContent $itemContent){
        $this->item_content = $itemContent;
    }

    public function getItemBuyNote() : AlibabaAlscUnionKbItemDetailGetItemBuyNote{
        return $this->item_buy_note;
    }

    public function setItemBuyNote(AlibabaAlscUnionKbItemDetailGetItemBuyNote $itemBuyNote){
        $this->item_buy_note = $itemBuyNote;
    }

    public function getItemTicket() : AlibabaAlscUnionKbItemDetailGetItemTicket{
        return $this->item_ticket;
    }

    public function setItemTicket(AlibabaAlscUnionKbItemDetailGetItemTicket $itemTicket){
        $this->item_ticket = $itemTicket;
    }


}

