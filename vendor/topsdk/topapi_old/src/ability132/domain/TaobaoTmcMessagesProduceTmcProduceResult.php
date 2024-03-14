<?php
namespace Topsdk\Topapi\Ability132\Domain;

class TaobaoTmcMessagesProduceTmcProduceResult {

    /**
        错误码
     **/
    public $error_code;

    /**
        错误信息
     **/
    public $error_message;

    /**
        是否成功
     **/
    public $is_success;


    public function getErrorCode() : string{
        return $this->error_code;
    }

    public function setErrorCode(string $errorCode){
        $this->error_code = $errorCode;
    }

    public function getErrorMessage() : string{
        return $this->error_message;
    }

    public function setErrorMessage(string $errorMessage){
        $this->error_message = $errorMessage;
    }

    public function getIsSuccess() : bool{
        return $this->is_success;
    }

    public function setIsSuccess(bool $isSuccess){
        $this->is_success = $isSuccess;
    }


}

