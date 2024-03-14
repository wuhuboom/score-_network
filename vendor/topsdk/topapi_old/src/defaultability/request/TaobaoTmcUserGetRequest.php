<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcUserGetRequest {

    /**
        需返回的字段列表，多个字段以半角逗号分隔。可选值：TmcUser结构体中的所有字段，一定要返回topic。
     **/
    private $fields;

    /**
        用户昵称
     **/
    private $nick;

    /**
        用户所属的平台类型，tbUIC:淘宝用户; icbu: icbu用户;ae:ae用户
     **/
    private $userPlatform;


    public function getFields() : array{
        return $this->fields;
    }

    public function setFields(array $fields){
        $this->fields = $fields;
    }

    public function getNick() : string{
        return $this->nick;
    }

    public function setNick(string $nick){
        $this->nick = $nick;
    }

    public function getUserPlatform() : string{
        return $this->userPlatform;
    }

    public function setUserPlatform(string $userPlatform){
        $this->userPlatform = $userPlatform;
    }


    public function getApiName() : string {
        return "taobao.tmc.user.get";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->fields)) {
            $requestParam["fields"] = TopUtil::convertBasicList($this->fields);
        }

        if (!TopUtil::checkEmpty($this->nick)) {
            $requestParam["nick"] = TopUtil::convertBasic($this->nick);
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

