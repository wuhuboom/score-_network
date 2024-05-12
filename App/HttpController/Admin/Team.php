<?php
namespace App\HttpController\Admin;

use App\Service\TeamService;
use App\Service\TeamService as Service;
use App\Service\TeamSquadService;
use EasySwoole\HttpClient\HttpClient;

class Team extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['has_squad'])) {$where['has_squad'] = [$this->param['has_squad']==1?1:0, '='];}
        if(!empty($this->param['name'])) {$where['name'] = ["%{$this->param['name']}%", 'like'];}
	    if(!empty($this->param['start'])){$where['create_time']=[$this->param['start_time'],'>='];}
	    if(!empty($this->param['end_time'])){  $where['create_time']=[$this->param['end_time'],'<=']; }
        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = Service::create()->getLists($where,$field,$page,$limit,'id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }
	/**
	 * 更新联赛积分榜
	 */
	public function squad(){
		if(!empty($this->param['team_id'])){
			$team_id = $this->param['team_id'];
			$league = TeamService::create()->get($team_id);
			if(!$league['has_squad']){
				$this->AjaxJson(0,[],'此球队没有阵容！');return false;
			}
			$result = \App\HttpController\Common\BetsApi::getTeamSquad($team_id);
			if($result['success']==1&&$result['results']){
				try {
					foreach ($result['results'] as $k=>$v){
						$save_data = $v;

						foreach ($save_data as $field=>$value){
							$save_data[$field]  = $value??'';
						}
						$save_data['team_id'] = $team_id;
						$save_data['update_time'] =date('Y-m-d H:i:s');

						if($res = TeamSquadService::create()->get(['team_id'=>$team_id,'name'=>$save_data['name']])||$res=TeamSquadService::create()->get(['id'=>$save_data['id']])){
							$update_res = TeamSquadService::create()->update($res['id'],$save_data );
						}else{
							$save_data['create_time'] =date('Y-m-d H:i:s');
							$id = TeamSquadService::create()->save($save_data);
						}
					}
				}catch (\Throwable $e){
					$this->AjaxJson(0,[],'更新球队阵容插入失败'.$e->getMessage());return false;
				}

				$this->AjaxJson(1,[],'更新球队阵容成功');return false;
			}else{
				$this->AjaxJson(0,[],'未获取到阵容数据');return false;
			}
		}else{
			$this->AjaxJson(0,[],'球队ID必须');return false;
		}

	}
    /**
     * 新增
     */
    public function add(){
        try{
            $data = $this->param;
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = Service::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(Service::create()->getOne(['name'=>$data['name']])){
                $this->AjaxJson(0, [], '球队名称已存在');return false;
            }
           
            if($insert_id =  Service::create()->save($data)){
                $this->AjaxJson(1, ['insert_id'=>$insert_id], '新增成功');return false;
            }else{
                $this->AjaxJson(0, [], '新增失败');return false;
            }
        }catch (\Exception $e){
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }
    }

    /**
     * 更新
     */
    public function edit(){

        try {
            if (!empty($this->param['id'])) {
                $data                = $this->param;
                $data['update_time'] = date('Y-m-d H:i:s');
                $result              = Service::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                if (Service::create()->update($this->param['id'],$data )) {
                    $this->AjaxJson(1, ['id'   => $this->param['id'], 'data' => $data], '更新成功');
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '更新失败');
                    return false;
                }

            } else {
                $this->AjaxJson(0, ['status' => 0], 'ID不存在');
            }
        } catch (\Exception $e) {
            $this->AjaxJson(0, ['status' => 0], '更新出错：' . $e->getMessage());
        }
        return false;
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
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的球队');
        }
        return false;
    }
	/**
	 * 全部
	 */
	public function all(){
		$where = [];
		if(!empty($this->param['keyword'])){
			$where['name'] =["%{$this->param['keyword']}%",'like'];
		}
		$list = Service::create()->getLists($where,'id as value,name',1,300,'id asc');
		$this->AjaxJson(1, $list['list'], 'OK');
		return true;
	}

}

