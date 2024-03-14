<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcGroupDeleteRequest {

    /**
        分组名称，分组删除后，用户的消息将会存储于默认分组中。警告：由于分组已经删除，用户之前未消费的消息将无法再获取。不能以default开头，default开头为系统默认组。
     **/
    private $groupName;

    /**
        用户列表，不传表示删除整个分组，如果用户全部删除后，也会自动删除整个分组
     **/
    private $nicks;

    /**
        用户所属于的平台类型，tbUIC:淘宝用户; icbu: icbu用户;ae:ae用户
     **/
    private $userPlatform;


    public function getGroupName() : string{
        return $this->groupName;
    }

    public function setGroupName(string $groupName){
        $this->groupName = $groupName;
    }

    public function getNicks() : array{
        return $this->nicks;
    }

    public function setNicks(array $nicks){
        $this->nicks = $nicks;
    }

    public function getUserPlatform() : string{
        return $this->userPlatform;
    }

    public function setUserPlatform(string $userPlatform){
        $this->userPlatform = $userPlatform;
    }


    public function getApiName() : string {
        return "taobao.tmc.group.delete";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->groupName)) {
            $requestParam["group_name"] = TopUtil::convertBasic($this->groupName);
        }

        if (!TopUtil::checkEmpty($this->nicks)) {
            $requestParam["nicks"] = TopUtil::convertBasicList($this->nicks);
        }

        if (!TopUtil::checkEmpty($this->userPlatform)) {
            $requestParam["user_platform"] = TopUtil::convertBasic($this->userPlatform);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

