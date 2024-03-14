<?php
namespace Topsdk\Topapi\Ability132\Domain;

class TaobaoTmcMessagesProduceTmcPublishMessage {

    /**
        消息内容的JSON表述，必须按照topic的定义来填充
     **/
    public $content;

    /**
        消息的扩增属性，用json格式表示
     **/
    public $json_ex_content;

    /**
        直发消息需要传入目标appkey
     **/
    public $target_app_key;

    /**
        目标分组
     **/
    public $target_group;

    /**
        消息类型
     **/
    public $topic;


    public function getContent() : string{
        return $this->content;
    }

    public function setContent(string $content){
        $this->content = $content;
    }

    public function getJsonExContent() : string{
        return $this->json_ex_content;
    }

    public function setJsonExContent(string $jsonExContent){
        $this->json_ex_content = $jsonExContent;
    }

    public function getTargetAppKey() : string{
        return $this->target_app_key;
    }

    public function setTargetAppKey(string $targetAppKey){
        $this->target_app_key = $targetAppKey;
    }

    public function getTargetGroup() : string{
        return $this->target_group;
    }

    public function setTargetGroup(string $targetGroup){
        $this->target_group = $targetGroup;
    }

    public function getTopic() : string{
        return $this->topic;
    }

    public function setTopic(string $topic){
        $this->topic = $topic;
    }


}

