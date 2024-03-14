<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionMediaZoneAddZoneInfoDTO {

    /**
        推广位名称
     **/
    public $name;

    /**
        推广位pid
     **/
    public $pid;


    public function getName() : string{
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }


}

