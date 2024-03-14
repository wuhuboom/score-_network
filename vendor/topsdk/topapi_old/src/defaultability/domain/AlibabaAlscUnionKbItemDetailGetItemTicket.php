<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetItemTicket {

    /**
        有效期
     **/
    public $ticket_period;

    /**
        时间规则
     **/
    public $ticket_time_rules;


    public function getTicketPeriod() : AlibabaAlscUnionKbItemDetailGetTicketPeriod{
        return $this->ticket_period;
    }

    public function setTicketPeriod(AlibabaAlscUnionKbItemDetailGetTicketPeriod $ticketPeriod){
        $this->ticket_period = $ticketPeriod;
    }

    public function getTicketTimeRules() : array{
        return $this->ticket_time_rules;
    }

    public function setTicketTimeRules(array $ticketTimeRules){
        $this->ticket_time_rules = $ticketTimeRules;
    }


}

