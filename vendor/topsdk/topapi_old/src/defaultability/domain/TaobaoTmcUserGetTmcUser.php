<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class TaobaoTmcUserGetTmcUser {

    /**
        用户首次开通时间
     **/
    public $created;

    /**
        接收用户消息的组名
     **/
    public $group_name;

    /**
        用户授权是否有效，true表示授权有效，false表示授权过期
     **/
    public $is_valid;

    /**
        用户最后开通时间
     **/
    public $modified;

    /**
        用户开通的消息类型列表。如果为空表示应用开通的所有类型
     **/
    public $topics;

    /**
        用户ID
     **/
    public $user_id;

    /**
        用户昵称
     **/
    public $user_nick;

    /**
        用户所属的平台类型，tbUIC:淘宝用户; icbu: icbu用户
     **/
    public $user_platform;


    public function getCreated() : string{
        return $this->created;
    }

    public function setCreated(string $created){
        $this->created = $created;
    }

    public function getGroupName() : string{
        return $this->group_name;
    }

    public function setGroupName(string $groupName){
        $this->group_name = $groupName;
    }

    public function getIsValid() : bool{
        return $this->is_valid;
    }

    public function setIsValid(bool $isValid){
        $this->is_valid = $isValid;
    }

    public function getModified() : string{
        return $this->modified;
    }

    public function setModified(string $modified){
        $this->modified = $modified;
    }

    public function getTopics() : array{
        return $this->topics;
    }

    public function setTopics(array $topics){
        $this->topics = $topics;
    }

    public function getUserId() : int{
        return $this->user_id;
    }

    public function setUserId(int $userId){
        $this->user_id = $userId;
    }

    public function getUserNick() : string{
        return $this->user_nick;
    }

    public function setUserNick(string $userNick){
        $this->user_nick = $userNick;
    }

    public function getUserPlatform() : string{
        return $this->user_platform;
    }

    public function setUserPlatform(string $userPlatform){
        $this->user_platform = $userPlatform;
    }


}

