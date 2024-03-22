<?php

namespace App\HttpController\Admin;

use App\Service\BetsApiService;
use EasySwoole\DDL\Blueprint\Create\Table;
use EasySwoole\DDL\DDLBuilder;
use EasySwoole\DDL\Enum\Character;
use EasySwoole\DDL\Enum\Engine;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class BetsApi extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['BetsApi_name'])) {
            $where['name'] = ["%{$this->param['name']}%", 'like'];
        }
        if(!empty($this->param['cc'])) {
            $where['cc'] = ["%{$this->param['cc']}%", 'like'];
        }
     
        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = BetsApiService::create()->getLists($where,$field,$page,$limit,'sort asc,id asc');

        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 新增微信产品
     */
    public function add(){
        try{
            $data = $this->param;
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = BetsApiService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(BetsApiService::create()->getOne(['name'=>$data['name']])){
                $this->AjaxJson(0, [], '接口名称已存在');return false;
            }
           
            if($insert_id =  BetsApiService::create()->save($data)){
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
                $result              = BetsApiService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }


                if(BetsApiService::create()->getOne(['name'=>$data['name'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '接口名称已存在');return false;
                }
                if (BetsApiService::create()->update($this->param['id'],$data )) {
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

    //根据接口生成表格
	public function generate(){
		if (!empty($this->param['id'])) {

			$data = BetsApiService::create()->get($this->param['id']);
			if (empty($data)) {
				$this->AjaxJson(0, $data, '接口不存在');
				return false;
			}
			if(empty($data['json_url'])){
				$this->AjaxJson(0, $data, '结果JSON示例地址不存在');
				return false;
			}
			$client = new HttpClient($data['json_url']);
			$body = $client->get()->getBody();
			$body = str_replace("\r\n",'',$body);
			$result = json_decode(stripslashes($body),1); //去除转义并转为数组
			if(empty($result['results'])){
				$this->AjaxJson(0, [$data['json_url'],$body], '示例数据为空！');
				return false;
			}

			$sql = "SHOW TABLES LIKE 'td_{$data['table_name']}';";//
			$query = new QueryBuilder();
			$query->raw($sql);
			$res = DbManager::getInstance()->query($query)->getResult();
			if (!empty($res)) {
				$this->AjaxJson(0, $res, 'MYSQL表已存在，不能生成！');
				return false;
			}

			$tableDDL = new \EasySwoole\ORM\Utility\Schema\Table("td_{$data['table_name']}");
			$tableDDL->setTableComment($data['name']);
			$tableDDL->setTableCharset(Character::UTF8MB4_GENERAL_CI);     //设置表字符集
			$tableDDL->setTableEngine(Engine::INNODB);                     //设置表引擎
			$tableDDL->colInt('id', 11)->setIsPrimaryKey()->setIsAutoIncrement();

			//检测结果数组keys是字符串还是整型
			$keys = array_keys($result['results']);
			if(is_string($keys[0])){
				foreach ($result['results'] as $filed=>$v){
					if($filed!=='id'){
						if(is_array($v)){
							$tableDDL->colJson($filed);
						}else if(is_string($v)){
							$tableDDL->colVarChar($filed, 255);
						}else if(is_int($v)){
							$tableDDL->colInt($filed, 11);
						}else{
                            $tableDDL->colVarChar($filed, 255);
						}
					}
				}
			}else{
				foreach ($result['results'] as $k=>$item){
					foreach ($item as $filed=>$v){
						if($filed!=='id'){
							if(is_array($v)){
								$tableDDL->colJson($filed);
							}else if(is_string($v)){
								$tableDDL->colVarChar($filed, 255);
							}else if(is_int($v)){
								$tableDDL->colInt($filed, 11);
							}else{
                                $tableDDL->colVarChar($filed, 255);

							}


						}
					}
					break;
				}
			}
			$tableDDL->colDateTime('create_time');
			$tableDDL->colDateTime('update_time');
			$tableDDL->setIfNotExists();
			$sql = $tableDDL->__createDDL();
			$query = new QueryBuilder();
			$query->raw($sql);
			if($res = DbManager::getInstance()->query($query)->getResult()){
				$this->AjaxJson(1, [$sql,$keys], '创建MYSQL表成功');return false;
			}else{
				$this->AjaxJson(0, [$sql,$res], '创建MYSQL表失败');return false;
			}
		} else {
			$this->AjaxJson(0, ['status' => 0], '接口不存在');
		}
	}

    public function testCreateTable()
    {


        if (empty($data->getResult())) {
            $tableDDL = new Table('test_where');
            $tableDDL->colInt('id', 11)->setIsPrimaryKey()->setIsAutoIncrement();
            $tableDDL->colVarChar('content', 255);
            $tableDDL->setIfNotExists();
            $sql = $tableDDL->__createDDL();
            $query->raw($sql);
            $data = DbManager::getInstance()->query($query);
            $this->assertTrue($data->getResult());
        }

    }
    /**
     * 删除
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( BetsApiService::create()->delete(['id'=>[$ids,'in']])){
                $this->AjaxJson(1, ['status'=>1], '删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的接口');
        }
        return false;
    }



}

