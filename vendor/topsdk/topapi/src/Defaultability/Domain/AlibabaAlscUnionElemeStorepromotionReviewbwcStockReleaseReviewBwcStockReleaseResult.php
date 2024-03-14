<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemeStorepromotionReviewbwcStockReleaseReviewBwcStockReleaseResult {

    /**
        库存锁定ID
     **/
    public $lock_id;


    public function getLockId() : int{
        return $this->lock_id;
    }

    public function setLockId(int $lockId){
        $this->lock_id = $lockId;
    }


}

