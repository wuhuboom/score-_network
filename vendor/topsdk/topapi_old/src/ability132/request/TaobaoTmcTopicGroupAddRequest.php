<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcTopicGroupAddRequest {

    /**
        消息分组名，如果不存在，会自动创建
     **/
    private $groupName;

    /**
        消息topic名称，多个以逗号(,)分割
     **/
    private $topics;


    public function getGroupName() : string{
        return $this->groupName;
    }

    public function setGroupName(string $groupName){
        $this->groupName = $groupName;
    }

    public function getTopics() : array{
        return $this->topics;
    }

    public function setTopics(array $topics){
        $this->topics = $topics;
    }


    public function getApiName() : string {
        return "taobao.tmc.topic.group.add";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->groupName)) {
            $requestParam["group_name"] = TopUtil::convertBasic($this->groupName);
        }

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

