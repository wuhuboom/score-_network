<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcTopicGroupDeleteRequest {

    /**
        消息分组名
     **/
    private $groupName;

    /**
        消息分组Id，一般不用填写，如果分组已经被删除，则根据问题排查工具返回的ID删除路由关系
     **/
    private $groupId;

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

    public function getGroupId() : int{
        return $this->groupId;
    }

    public function setGroupId(int $groupId){
        $this->groupId = $groupId;
    }

    public function getTopics() : array{
        return $this->topics;
    }

    public function setTopics(array $topics){
        $this->topics = $topics;
    }


    public function getApiName() : string {
        return "taobao.tmc.topic.group.delete";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->groupName)) {
            $requestParam["group_name"] = TopUtil::convertBasic($this->groupName);
        }

        if (!TopUtil::checkEmpty($this->groupId)) {
            $requestParam["group_id"] = TopUtil::convertBasic($this->groupId);
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

