<?php

namespace App\HttpController\Admin;


use App\HttpController\Common\Common;
use App\Model\TrackerPointModel;


class Chart extends Base
{
    /**
     * 顶部数据
     */
    public function getTopData(){
        try {
            //今日PV（次）
            //
            //298
            //
            //
            //今日UV（个）
            $where['create_date']=[[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')],'between'];
            $uv = TrackerPointModel::create()->where($where)->field('count(DISTINCT(`ip`)) as num')->find()['num']??0;
            $pv = TrackerPointModel::create()->where($where)->count()??1;
            $data[] = [
                'header_left'=>'UV',
                'header_right'=>'今日',
                'value'=>$uv,
                'footer_left'=>'PV',
                'footer_right'=>$pv,
                'date_time'=>date('Y-m-d H:i:s'),
            ];
            $this->AjaxJson(1,$data,'');return false;
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }





}

