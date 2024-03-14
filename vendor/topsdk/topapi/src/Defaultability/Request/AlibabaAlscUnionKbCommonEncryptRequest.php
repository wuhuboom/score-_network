<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionKbCommonEncryptBlowfishModel;

class AlibabaAlscUnionKbCommonEncryptRequest {

    /**
        待加密对象
     **/
    private $encryptModel;


    public function getEncryptModel() : AlibabaAlscUnionKbCommonEncryptBlowfishModel{
        return $this->encryptModel;
    }

    public function setEncryptModel(AlibabaAlscUnionKbCommonEncryptBlowfishModel $encryptModel){
        $this->encryptModel = $encryptModel;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.common.encrypt";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->encryptModel)) {
            $requestParam["encrypt_model"] = TopUtil::convertStruct($this->encryptModel);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

