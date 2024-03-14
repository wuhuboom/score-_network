<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetUseNote {

    /**
        需要预约
     **/
    public $need_reserve;

    /**
        预约说明
     **/
    public $reserve_desc;

    /**
        是否限制使用用户数
     **/
    public $limit_user_num;

    /**
        限制多少人使用
     **/
    public $user_num_limited;


    public function getNeedReserve() : bool{
        return $this->need_reserve;
    }

    public function setNeedReserve(bool $needReserve){
        $this->need_reserve = $needReserve;
    }

    public function getReserveDesc() : string{
        return $this->reserve_desc;
    }

    public function setReserveDesc(string $reserveDesc){
        $this->reserve_desc = $reserveDesc;
    }

    public function getLimitUserNum() : bool{
        return $this->limit_user_num;
    }

    public function setLimitUserNum(bool $limitUserNum){
        $this->limit_user_num = $limitUserNum;
    }

    public function getUserNumLimited() : int{
        return $this->user_num_limited;
    }

    public function setUserNumLimited(int $userNumLimited){
        $this->user_num_limited = $userNumLimited;
    }


}

