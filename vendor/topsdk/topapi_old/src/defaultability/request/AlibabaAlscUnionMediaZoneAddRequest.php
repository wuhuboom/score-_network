<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionMediaZoneAddRequest {

    /**
        推广位名称
     **/
    private $zoneName;

    /**
        媒体id，工具商渠道必填
     **/
    private $mediaId;


    public function getZoneName() : string{
        return $this->zoneName;
    }

    public function setZoneName(string $zoneName){
        $this->zoneName = $zoneName;
    }

    public function getMediaId() : string{
        return $this->mediaId;
    }

    public function setMediaId(string $mediaId){
        $this->mediaId = $mediaId;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.media.zone.add";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->zoneName)) {
            $requestParam["zone_name"] = TopUtil::convertBasic($this->zoneName);
        }

        if (!TopUtil::checkEmpty($this->mediaId)) {
            $requestParam["media_id"] = TopUtil::convertBasic($this->mediaId);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

