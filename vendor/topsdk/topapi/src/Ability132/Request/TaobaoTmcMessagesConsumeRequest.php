<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcMessagesConsumeRequest {

    /**
        用户分组名称，不传表示消费默认分组，如果应用没有设置用户分组，传入分组名称将会返回错误
     **/
    private $groupName;

    /**
        每次批量消费消息的条数，最小值：10；最大值：200
     **/
    private $quantity;


    public function getGroupName() : string{
        return $this->groupName;
    }

    public function setGroupName(string $groupName){
        $this->groupName = $groupName;
    }

    public function getQuantity() : int{
        return $this->quantity;
    }

    public function setQuantity(int $quantity){
        $this->quantity = $quantity;
    }


    public function getApiName() : string {
        return "taobao.tmc.messages.consume";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->groupName)) {
            $requestParam["group_name"] = TopUtil::convertBasic($this->groupName);
        }

        if (!TopUtil::checkEmpty($this->quantity)) {
            $requestParam["quantity"] = TopUtil::convertBasic($this->quantity);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

