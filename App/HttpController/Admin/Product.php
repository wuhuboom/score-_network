<?php
namespace App\HttpController\Admin;

use App\Service\ProductService;
use App\Service\VipService;

class Product extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['name'])) {
            $where['name'] = ["%{$this->param['name']}%", 'like'];
        }
        if(!empty($this->param['type'])) {
            $where['type'] = [$this->param['type'], '='];
        }
        if(!empty($this->param['vip_id'])) {
            $where['vip_id'] = [$this->param['vip_id'], '='];
        }
        if(!empty($this->param['is_del'])) {
            $where['is_del'] = [$this->param['is_del']==1?1:0, '='];
        }else{
	        $where['is_del'] = [0, '='];
        }
        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = ProductService::create()->getLists($where,$field,$page,$limit,'id desc');
        foreach ($data['list'] as $k=>$v){
            $vip  = VipService::create()->get($v['vip_id']);
            $data['list'][$k]['vip'] = $vip;
            $data['list'][$k]['vip_name'] = $vip['name']??'';
        }
        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 新增微信产品
     */
    public function add(){

        try{
            $data = $this->param;
            $data['daily_yield_s'] = $data['daily_yield']??0;
            $data['price_s'] = $data['price']??0;
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = ProductService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if($insert_id =  ProductService::create()->save($data)){
                $this->AjaxJson(1, ['insert_id'=>$insert_id], '新增成功');return false;
            }else{
                $this->AjaxJson(0, [], '新增失败');return false;
            }
        }catch (\Exception $e){
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }
    }

    /**
     * 更新产品
     */
    public function edit(){

        try {
            if (!empty($this->param['id'])) {
                $data                = $this->param;
                $data['daily_yield_s'] = $data['daily_yield']??0;
                $data['price_s'] = $data['price']??0;
                $data['update_time'] = date('Y-m-d H:i:s');
                $result              = ProductService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                if (ProductService::create()->update($this->param['id'],$data )) {
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
     * 排序
     */
    public function sort(){
        try {
            if (!empty($this->param['id'])) {
                $data[$this->param['field']] = $this->param['value'];
                $data['update_time'] = date('Y-m-d H:i:s');

                if (ProductService::create()->update($this->param['id'],$data )) {
                    $this->AjaxJson(1, ['status' => 1], '更新成功');
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
     * 删除品牌
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);

            if(ProductService::create()->update(['id'=>[$ids,'in']],['is_del'=>1])){
                $this->AjaxJson(1, ['status'=>1], '删除产品成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除产品失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的产品');
        }
        return false;
    }

	public function batchHandle(){
		if(!empty($this->param['ids'])){
			$ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
			if(ProductService::create()->update(['id'=>[$ids,'in']],['status'=>$this->param['status']])){
				$this->AjaxJson(1, ['status'=>1], '批量操作成功');return false;
			}else{
				$this->AjaxJson(0, ['status'=>0], '批量操作失败');return false;
			}

		}else{
			$this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要操作的产品');
		}
		return false;
	}

    /**
     * 全部
     */
    public function all(){
        $where = [];
        $where['status'] = 3;
        $where['is_del'] = 0;
        if(!empty($this->param['keyword'])){
            $where['name']  = ["%{$this->param['keyword']}%",'like'];
        }
        $list = ProductService::create()->getLists($where,"id as value,CONCAT('【',price,'】',name) as  name",1,100,'sort asc');
        $this->AjaxJson(1, $list['list'], $where['name']??'22');
        return true;

    }




}

