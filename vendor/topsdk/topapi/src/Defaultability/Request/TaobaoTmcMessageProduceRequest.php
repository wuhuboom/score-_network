<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcMessageProduceRequest {

    /**
        消息内容的JSON表述，必须按照topic的定义来填充
     **/
    private $content;

    /**
        消息的扩增属性，用json格式表示
     **/
    private $exContent;

    /**
        直发消息需要传入目标appkey
     **/
    private $targetAppkey;

    /**
        目标分组，一般为default
     **/
    private $targetGroup;

    /**
        消息类型
     **/
    private $topic;

    /**
        回传的文件内容，目前仅支持jpg,png,bmp,gif,pdf类型的文件，文件最大1M。只有消息中有byte[]类型的数据时，才需要传此字段; 否则不需要传此字段。
     **/
    private $mediaContent;

    /**
        回传的文件内容，目前仅支持jpg,png,bmp,gif,pdf类型的文件，文件最大1M。只有消息中有byte[]类型的数据时，才需要传此字段; 否则不需要传此字段。具体对应到沙体中的什么值，请参考消息字段说明。
     **/
    private $mediaContent2;

    /**
        回传的文件内容，目前仅支持jpg,png,bmp,gif,pdf类型的文件，文件最大1M。只有消息中有byte[]类型的数据时，才需要传此字段; 否则不需要传此字段。具体对应到沙体中的什么值，请参考消息字段说明。
     **/
    private $mediaContent3;

    /**
        回传的文件内容，目前仅支持jpg,png,bmp,gif,pdf类型的文件，文件最大1M。只有消息中有byte[]类型的数据时，才需要传此字段; 否则不需要传此字段。具体对应到沙体中的什么值，请参考消息字段说明。
     **/
    private $mediaContent5;

    /**
        回传的文件内容，目前仅支持jpg,png,bmp,gif,pdf类型的文件，文件最大1M。只有消息中有byte[]类型的数据时，才需要传此字段; 否则不需要传此字段。具体对应到沙体中的什么值，请参考消息字段说明。
     **/
    private $mediaContent4;

    /**
        延时参数 时间戳 预期发送时间
     **/
    private $delayMillis;

    /**
        提前过期 相对时间差 毫秒
     **/
    private $expiresMillis;


    public function getContent() : string{
        return $this->content;
    }

    public function setContent(string $content){
        $this->content = $content;
    }

    public function getExContent() : string{
        return $this->exContent;
    }

    public function setExContent(string $exContent){
        $this->exContent = $exContent;
    }

    public function getTargetAppkey() : string{
        return $this->targetAppkey;
    }

    public function setTargetAppkey(string $targetAppkey){
        $this->targetAppkey = $targetAppkey;
    }

    public function getTargetGroup() : string{
        return $this->targetGroup;
    }

    public function setTargetGroup(string $targetGroup){
        $this->targetGroup = $targetGroup;
    }

    public function getTopic() : string{
        return $this->topic;
    }

    public function setTopic(string $topic){
        $this->topic = $topic;
    }

    public function getMediaContent() : string{
        return $this->mediaContent;
    }

    public function setMediaContent(string $mediaContent){
        $this->mediaContent = $mediaContent;
    }

    public function getMediaContent2() : string{
        return $this->mediaContent2;
    }

    public function setMediaContent2(string $mediaContent2){
        $this->mediaContent2 = $mediaContent2;
    }

    public function getMediaContent3() : string{
        return $this->mediaContent3;
    }

    public function setMediaContent3(string $mediaContent3){
        $this->mediaContent3 = $mediaContent3;
    }

    public function getMediaContent5() : string{
        return $this->mediaContent5;
    }

    public function setMediaContent5(string $mediaContent5){
        $this->mediaContent5 = $mediaContent5;
    }

    public function getMediaContent4() : string{
        return $this->mediaContent4;
    }

    public function setMediaContent4(string $mediaContent4){
        $this->mediaContent4 = $mediaContent4;
    }

    public function getDelayMillis() : int{
        return $this->delayMillis;
    }

    public function setDelayMillis(int $delayMillis){
        $this->delayMillis = $delayMillis;
    }

    public function getExpiresMillis() : int{
        return $this->expiresMillis;
    }

    public function setExpiresMillis(int $expiresMillis){
        $this->expiresMillis = $expiresMillis;
    }


    public function getApiName() : string {
        return "taobao.tmc.message.produce";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->content)) {
            $requestParam["content"] = TopUtil::convertBasic($this->content);
        }

        if (!TopUtil::checkEmpty($this->exContent)) {
            $requestParam["ex_content"] = TopUtil::convertBasic($this->exContent);
        }

        if (!TopUtil::checkEmpty($this->targetAppkey)) {
            $requestParam["target_appkey"] = TopUtil::convertBasic($this->targetAppkey);
        }

        if (!TopUtil::checkEmpty($this->targetGroup)) {
            $requestParam["target_group"] = TopUtil::convertBasic($this->targetGroup);
        }

        if (!TopUtil::checkEmpty($this->topic)) {
            $requestParam["topic"] = TopUtil::convertBasic($this->topic);
        }

        if (!TopUtil::checkEmpty($this->delayMillis)) {
            $requestParam["delay_millis"] = TopUtil::convertBasic($this->delayMillis);
        }

        if (!TopUtil::checkEmpty($this->expiresMillis)) {
            $requestParam["expires_millis"] = TopUtil::convertBasic($this->expiresMillis);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        if (!TopUtil::checkEmpty($this->mediaContent)){
            $fileParam["media_content"] = TopUtil::convertBasic($this->mediaContent);
        }
        if (!TopUtil::checkEmpty($this->mediaContent2)){
            $fileParam["media_content2"] = TopUtil::convertBasic($this->mediaContent2);
        }
        if (!TopUtil::checkEmpty($this->mediaContent3)){
            $fileParam["media_content3"] = TopUtil::convertBasic($this->mediaContent3);
        }
        if (!TopUtil::checkEmpty($this->mediaContent5)){
            $fileParam["media_content5"] = TopUtil::convertBasic($this->mediaContent5);
        }
        if (!TopUtil::checkEmpty($this->mediaContent4)){
            $fileParam["media_content4"] = TopUtil::convertBasic($this->mediaContent4);
        }
        return $fileParam;
    }

}

