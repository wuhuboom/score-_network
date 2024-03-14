<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcAuthGetRequest {

    /**
        tmc组名
     **/
    private $group;


    public function getGroup() : string{
        return $this->group;
    }

    public function setGroup(string $group){
        $this->group = $group;
    }


    public function getApiName() : string {
        return "taobao.tmc.auth.get";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->group)) {
            $requestParam["group"] = TopUtil::convertBasic($this->group);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

