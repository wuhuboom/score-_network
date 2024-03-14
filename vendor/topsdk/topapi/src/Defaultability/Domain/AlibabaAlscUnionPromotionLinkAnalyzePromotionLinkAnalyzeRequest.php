<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionPromotionLinkAnalyzePromotionLinkAnalyzeRequest {

    /**
        链接类型（1-h5；2-h5短链；3-微信小程序；4-饿了么APP）
     **/
    public $type;

    /**
        推广链接
     **/
    public $link;


    public function getType() : int{
        return $this->type;
    }

    public function setType(int $type){
        $this->type = $type;
    }

    public function getLink() : string{
        return $this->link;
    }

    public function setLink(string $link){
        $this->link = $link;
    }


}

