<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcGroupAddRequest {

    /**
        分组名称，同一个应用下需要保证唯一性，最长32个字符。添加分组后，消息通道会为用户的消息分配独立分组，但之前的消息还是存储于默认分组中。不能以default开头，default开头为系统默认组。
     **/
    private $groupName;

    /**
        用户昵称列表，以半角逗号分隔，支持子账号，支持增量添加用户
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
        return "taobao.tmc.group.add";
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

