<?php

namespace App\HttpController\Index;

use App\Model\ApiModel;
use App\Model\ApiGroupModel;
use App\Service\InplayService as Service;

class Api extends Base
{
    //正在进行的比赛
    public function getInplay()
    {
        $where = [];
        $field = '*';
        $data = Service::create()->getLists($where,$field,0,0,'id desc');
        $result = [
            'data'=>$data['list'],
            'code'=>0,
            'count'=>count($data['list']),
            'msg'=>'OK'
        ];
       $this->response()->write(json_encode($result,JSON_UNESCAPED_UNICODE));
        return true;
    }

	//api接口文档
	public function api(){

		$api = ApiModel::create()->where('id',$this->param['id']??0)->find();
		$group = ApiGroupModel::create()->where('type',1)->field('id,name,type')->order('sort','asc')->select();
		foreach ($group as $k=>$v){
			$group[$k]['lists'] = ApiModel::create()->where('group_id',$v['id'])->field('id,title,type')->order('sort','asc')->select();
		}
		$this->assign['group'] =$group;

		$this->assign['api'] =  $api;
		if(empty($api)){
			$this->view('/index/index/api_global',$this->assign);
		}else{
			$this->view('/index/index/api',$this->assign);
		}
	}

	//


}

