<?php
namespace Topsdk\Topapi\Ability132\Domain;

class TaobaoTmcMessagesConsumeTmcMessage {

    /**
        消息所属的用户编号
     **/
    public $user_id;

    /**
        用户的昵称
     **/
    public $user_nick;

    /**
        消息详细内容，格式为JSON/XML
     **/
    public $content;

    /**
        消息ID
     **/
    public $id;

    /**
        消息发布时间
     **/
    public $pub_time;

    /**
        消息发布者的AppKey
     **/
    public $pub_app_key;

    /**
        消息所属主题
     **/
    public $topic;


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

    public function getContent() : string{
        return $this->content;
    }

    public function setContent(string $content){
        $this->content = $content;
    }

    public function getId() : int{
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getPubTime() : string{
        return $this->pub_time;
    }

    public function setPubTime(string $pubTime){
        $this->pub_time = $pubTime;
    }

    public function getPubAppKey() : string{
        return $this->pub_app_key;
    }

    public function setPubAppKey(string $pubAppKey){
        $this->pub_app_key = $pubAppKey;
    }

    public function getTopic() : string{
        return $this->topic;
    }

    public function setTopic(string $topic){
        $this->topic = $topic;
    }


}

