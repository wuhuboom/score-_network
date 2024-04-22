<?php

namespace App\HttpController\Admin;

use App\Model\SmsModel;
use App\Service\SmsService;

/**
 * Class Users
 * Create With Automatic Generator
 */
class Sms extends \App\HttpController\Admin\Base
{
    /**
     * 获取短信发送记录列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['sign'])) {
            $where['sign'] = ["%{$this->param['sign']}%", 'like'];
        }
        if(!empty($this->param['type'])) {
            $where['type'] = [$this->param['type'], '='];
        }
        if (!empty($this->param['type'])) {
            $where['type'] = [$this->param['type'], '='];
        }
        if (!empty($this->param['status'])) {
            $where['status'] = [$this->param['status'] == 1 ? 1 : 0, '='];
        }
        if (!empty($this->param['is_check'])) {
            $where['is_check'] = [$this->param['is_check'] == 1 ? 1 : 0, '='];
        }
        if (!empty($this->param['tel'])) {
            $where['tel'] = ["%{$this->param['tel']}%", 'like'];
        }
        if (!empty($this->param['start'])) {
            $where['create_time'] = [$this->param['start'],  '>='];
        }
        if (!empty($this->param['end'])) {
            $where['create_time'] = [$this->param['end'],  '<='];
        }

        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = SmsService::create()->getLists($where,$field,$page,$limit,'id desc');
        $this->writeJson(200, $data, 'success');
        return true;
    }

}

