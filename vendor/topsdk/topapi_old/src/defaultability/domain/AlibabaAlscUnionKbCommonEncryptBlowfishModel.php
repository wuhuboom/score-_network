<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbCommonEncryptBlowfishModel {

    /**
        待加密字符串
     **/
    public $text;


    public function getText() : string{
        return $this->text;
    }

    public function setText(string $text){
        $this->text = $text;
    }


}

