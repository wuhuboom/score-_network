<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcUserPermitRequest {

    /**
        消息主题列表，用半角逗号分隔。当用户订阅的topic是应用订阅的子集时才需要设置，不设置表示继承应用所订阅的所有topic，一般情况建议不要设置。
     **/
    private $topics;


    public function getTopics() : array{
        return $this->topics;
    }

    public function setTopics(array $topics){
        $this->topics = $topics;
    }


    public function getApiName() : string {
        return "taobao.tmc.user.permit";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->topics)) {
            $requestParam["topics"] = TopUtil::convertBasicList($this->topics);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

