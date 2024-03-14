<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemQueryPageModel {

    /**
        会话ID
     **/
    public $session_id;

    /**
        分页记录
     **/
    public $records;

    /**
        页码
     **/
    public $page_number;

    /**
        每页数目
     **/
    public $page_size;

    /**
        总数
     **/
    public $total;


    public function getSessionId() : string{
        return $this->session_id;
    }

    public function setSessionId(string $sessionId){
        $this->session_id = $sessionId;
    }

    public function getRecords() : array{
        return $this->records;
    }

    public function setRecords(array $records){
        $this->records = $records;
    }

    public function getPageNumber() : int{
        return $this->page_number;
    }

    public function setPageNumber(int $pageNumber){
        $this->page_number = $pageNumber;
    }

    public function getPageSize() : int{
        return $this->page_size;
    }

    public function setPageSize(int $pageSize){
        $this->page_size = $pageSize;
    }

    public function getTotal() : int{
        return $this->total;
    }

    public function setTotal(int $total){
        $this->total = $total;
    }


}

