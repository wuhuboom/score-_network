<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionStorepromotionQueryPageModel {

    /**
        会话ID（下次请求作为请求参数，用于标记分页会话自动翻页）
     **/
    public $session_id;

    /**
        分页记录
     **/
    public $records;

    /**
        每页数目
     **/
    public $page_size;


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

    public function getPageSize() : int{
        return $this->page_size;
    }

    public function setPageSize(int $pageSize){
        $this->page_size = $pageSize;
    }


}

