<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcMessagesConfirmRequest {

    /**
        分组名称，不传代表默认分组
     **/
    private $groupName;

    /**
        处理成功的消息ID列表 最大 200个ID
     **/
    private $sMessageIds;

    /**
        处理失败的消息ID列表--已废弃，无需传此字段
     **/
    private $fMessageIds;


    public function getGroupName() : string{
        return $this->groupName;
    }

    public function setGroupName(string $groupName){
        $this->groupName = $groupName;
    }

    public function getSMessageIds() : array{
        return $this->sMessageIds;
    }

    public function setSMessageIds(array $sMessageIds){
        $this->sMessageIds = $sMessageIds;
    }

    public function getFMessageIds() : array{
        return $this->fMessageIds;
    }

    public function setFMessageIds(array $fMessageIds){
        $this->fMessageIds = $fMessageIds;
    }


    public function getApiName() : string {
        return "taobao.tmc.messages.confirm";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->groupName)) {
            $requestParam["group_name"] = TopUtil::convertBasic($this->groupName);
        }

        if (!TopUtil::checkEmpty($this->sMessageIds)) {
            $requestParam["s_message_ids"] = TopUtil::convertBasicList($this->sMessageIds);
        }

        if (!TopUtil::checkEmpty($this->fMessageIds)) {
            $requestParam["f_message_ids"] = TopUtil::convertBasicList($this->fMessageIds);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

