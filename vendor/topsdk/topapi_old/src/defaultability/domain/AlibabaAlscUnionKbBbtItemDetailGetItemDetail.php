<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemDetailGetItemDetail {

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


    public function getItemContent() : AlibabaAlscUnionKbBbtItemDetailGetItemContent{
        return $this->item_content;
    }

    public function setItemContent(AlibabaAlscUnionKbBbtItemDetailGetItemContent $itemContent){
        $this->item_content = $itemContent;
    }

    public function getItemBuyNote() : AlibabaAlscUnionKbBbtItemDetailGetItemBuyNote{
        return $this->item_buy_note;
    }

    public function setItemBuyNote(AlibabaAlscUnionKbBbtItemDetailGetItemBuyNote $itemBuyNote){
        $this->item_buy_note = $itemBuyNote;
    }

    public function getItemTicket() : AlibabaAlscUnionKbBbtItemDetailGetItemTicket{
        return $this->item_ticket;
    }

    public function setItemTicket(AlibabaAlscUnionKbBbtItemDetailGetItemTicket $itemTicket){
        $this->item_ticket = $itemTicket;
    }


}

