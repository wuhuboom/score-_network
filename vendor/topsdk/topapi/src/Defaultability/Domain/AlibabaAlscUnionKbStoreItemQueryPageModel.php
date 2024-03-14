<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbStoreItemQueryPageModel {

    /**
        总数
     **/
    public $total;

    /**
        分页记录
     **/
    public $records;


    public function getTotal() : int{
        return $this->total;
    }

    public function setTotal(int $total){
        $this->total = $total;
    }

    public function getRecords() : array{
        return $this->records;
    }

    public function setRecords(array $records){
        $this->records = $records;
    }


}

