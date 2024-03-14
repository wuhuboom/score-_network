<?php
namespace Topsdk\Topapi\Ability132\Request;
use Topsdk\Topapi\TopUtil;

class TaobaoTmcGroupsGetRequest {

    /**
        要查询分组的名称，多个分组用半角逗号分隔，不传代表查询所有分组信息，但不会返回组下面的用户信息。如果应用没有设置分组则返回空。组名不能以default开头，default开头是系统默认的组。
     **/
    private $groupNames;

    /**
        页码
     **/
    private $pageNo;

    /**
        每页返回多少个分组
     **/
    private $pageSize;


    public function getGroupNames() : array{
        return $this->groupNames;
    }

    public function setGroupNames(array $groupNames){
        $this->groupNames = $groupNames;
    }

    public function getPageNo() : int{
        return $this->pageNo;
    }

    public function setPageNo(int $pageNo){
        $this->pageNo = $pageNo;
    }

    public function getPageSize() : int{
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize){
        $this->pageSize = $pageSize;
    }


    public function getApiName() : string {
        return "taobao.tmc.groups.get";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->groupNames)) {
            $requestParam["group_names"] = TopUtil::convertBasicList($this->groupNames);
        }

        if (!TopUtil::checkEmpty($this->pageNo)) {
            $requestParam["page_no"] = TopUtil::convertBasic($this->pageNo);
        }

        if (!TopUtil::checkEmpty($this->pageSize)) {
            $requestParam["page_size"] = TopUtil::convertBasic($this->pageSize);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

