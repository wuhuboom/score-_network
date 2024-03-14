<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemStoreDetailGetStoreBusinessTime {

    /**
        营业时间文本化信息
     **/
    public $time_texts;


    public function getTimeTexts() : array{
        return $this->time_texts;
    }

    public function setTimeTexts(array $timeTexts){
        $this->time_texts = $timeTexts;
    }


}

