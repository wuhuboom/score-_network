<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionMediaZoneGetZoneInfoDTO {

    /**
        资源位名称
     **/
    public $name;

    /**
        资源位pid
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

