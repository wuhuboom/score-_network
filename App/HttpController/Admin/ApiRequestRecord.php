<?php
namespace App\HttpController\Admin;


use App\Service\ApiRequestRecordService as Service;
use EasySwoole\HttpClient\HttpClient;

class ApiRequestRecord extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];

	    if(!empty($this->param['start_time'])&&!empty($this->param['end_time'])){
		    $where['a.create_time']=[[$this->param['start_time'],$this->param['end_time']],'between'];
	    }else{
            if(!empty($this->param['start_time'])){
                $where['a.create_time']=[$this->param['start_time'],'>='];
            }
            if(!empty($this->param['end_time'])){  $where['a.create_time']=[$this->param['end_time'],'<=']; }
            if(empty($this->param['start_time'])&&empty($this->param['end_time'])){
                $where['a.create_time']=[[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')],'between'];
            }
        }
        if(!empty($this->param['id'])) {$where['a.bets_api_id'] = [$this->param['id'], '='];}
        if(!empty($this->param['name'])) {$where['a.name'] = [$this->param['name'], '='];}
        $field = 'a.*,b.name as bets_api_name';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = Service::create()->joinSelectList($where,$field,$page,$limit,'a.id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }




    /**
     * 删除
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( Service::create()->delete(['id'=>[$ids,'in']])){
                $this->AjaxJson(1, ['status'=>1], '删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的联赛');
        }
        return false;
    }


}

