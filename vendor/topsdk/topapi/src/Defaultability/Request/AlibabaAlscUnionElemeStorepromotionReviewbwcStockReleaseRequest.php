<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionElemeStorepromotionReviewbwcStockReleaseRequest {

    /**
        库存锁ID
     **/
    private $lockId;


    public function getLockId() : int{
        return $this->lockId;
    }

    public function setLockId(int $lockId){
        $this->lockId = $lockId;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.eleme.storepromotion.reviewbwc.stock.release";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->lockId)) {
            $requestParam["lock_id"] = TopUtil::convertBasic($this->lockId);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

