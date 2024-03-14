<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcMessagesProduceRequest {

    /**
        tmc消息列表, 最多50条，元素结构与taobao.tmc.message.produce一致，用json表示的消息列表。例如：[{"content": "{\"tid\":1234554321,\"status\":\"X_LOGISTICS_PRINTED\",\"action_time\":\"2014-08-08 18:24:00\",\"seller_nick\": \"向阳aa\",\"operator\":\"小张\"}","topic": "taobao_jds_TradeTrace"},{"content": "{\"tid\":1234554321,\"status\":\"X_LOGISTICS_PRINTED\",\"action_time\":\"2014-08-08 18:24:00\",\"seller_nick\": \"向阳aa\",\"operator\":\"小张\"}","topic": "taobao_jds_TradeTrace"}]
     **/
    private $messages;


    public function getMessages() : array{
        return $this->messages;
    }

    public function setMessages(array $messages){
        $this->messages = $messages;
    }


    public function getApiName() : string {
        return "taobao.tmc.messages.produce";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->messages)) {
            $requestParam["messages"] = TopUtil::convertStructList($this->messages);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

