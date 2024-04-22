<?php

namespace App\HttpController\Admin;
use App\Model\AdminsHandleLogModel;
use App\Model\TrackerPointModel;
use EasySwoole\Http\Message\Status;


/**
 * Class Users
 * Create With Automatic Generator
 */
class Handle extends \App\HttpController\Admin\Base
{
    /**
     * 获取链路记录列表
     */

    public function lists(){
        try {
            $model =  AdminsHandleLogModel::create();
            $param = $this->request()->getRequestParam();
            if(!empty($param['uid']) ){$model->where('uid',$param['uid']);}
            if(!empty($param['spend_time']) ){$model->where('spend_time',$param['spend_time'],'>=');}
            if(!empty($param['action_name']) ){$model->where('action_name',"%{$param['action_name']}%",'like');}
            if(!empty($param['action_path']) ){$model->where('action_path',"%{$param['action_path']}%",'like');}
            if(!empty($param['username']) ){$model->where('username',"%{$param['username']}%",'like');}
            if(!empty($param['province']) ){$model->where('province',"%{$param['province']}%",'like');}
            if(!empty($param['city']) ){$model->where('city',"%{$param['city']}%",'like');}
            if(!empty($param['ip']) ){$model->where('ip',"%{$param['ip']}%",'like');}
            if(empty($this->param['start'])){
                $start_id = AdminsHandleLogModel::create()->where('create_time',date('Y-m-d 00:00:00',time()-1*3600*24),'>=')->min('id');
                $model->where('h.id',$start_id,'>=');
                $model->where('r.tracker_id',$start_id,'>=');
            }else{
                $start_id = AdminsHandleLogModel::create()->where('create_time',$this->param['start'],'>=')->min('id');
                $model->where('h.id',$start_id,'>=');
                $model->where('r.tracker_id',$start_id,'>=');
            }

            if(!empty($this->param['end'])){ $model->where('h.create_time',$this->param['end'],'<='); }
            $limit =$param['limit']??10;
            $page =$param['page']??1;
            $list = $model->withTotalCount()->alias('h')
                          ->join('td_admins_handle_log_result r','r.tracker_id=h.id','LEFT')
                          ->page($page, $limit)->field('h.*,r.response_data')->order('h.id','desc')->select();
            $total = $model->lastQueryResult()->getTotalCount();
            $this->writeJson(200, ['total'=>$total,'list'=>$list,'sql'=>$model->lastQuery()->getLastPrepareQuery()], 'success');
            return true;
        }catch (\Throwable $e){
            $this->AjaxJson(0, $e->getTrace(), $e->getMessage());
        }


    }


}

