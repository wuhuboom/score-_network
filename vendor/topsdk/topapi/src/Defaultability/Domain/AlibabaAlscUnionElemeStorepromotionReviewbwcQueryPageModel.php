<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemeStorepromotionReviewbwcQueryPageModel {

    /**
        会话ID（下次请求作为请求参数，用于标记分页会话自动翻页）
     **/
    public $session_id;

    /**
        分页记录
     **/
    public $records;


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


}

