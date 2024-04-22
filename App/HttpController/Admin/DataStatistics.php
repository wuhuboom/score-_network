<?php

namespace App\HttpController\Admin;

use App\Service\DataStatisticsService;
class DataStatistics extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if (!empty($this->param['start_date'])) {
            $where['date'] = [$this->param['start_date'], '>='];
        }
        if (!empty($this->param['end_date'])) {
            $where['date'] = [$this->param['end_date'], '<='];
        }
     
        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = DataStatisticsService::create()->getLists($where,$field,$page,$limit,'date desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }


}

