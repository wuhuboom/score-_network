<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemeStorepromotionReviewbwcStockLockReviewBwcStockLockResult {

    /**
        库存锁定ID
     **/
    public $lock_id;

    /**
        库存锁定时时间戳（毫秒）
     **/
    public $lock_time;


    public function getLockId() : int{
        return $this->lock_id;
    }

    public function setLockId(int $lockId){
        $this->lock_id = $lockId;
    }

    public function getLockTime() : int{
        return $this->lock_time;
    }

    public function setLockTime(int $lockTime){
        $this->lock_time = $lockTime;
    }


}

