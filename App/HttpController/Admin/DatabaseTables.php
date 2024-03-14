<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\CacheData;
use App\HttpController\Common\Common;
use App\HttpController\Common\Regex;
use App\Log\LogHandler;
use App\Model\DistributionIncomeModel;
use App\Model\UserAddressModel;
use App\Model\UserBalanceDetailsModel;
use App\Model\DatabaseTablesModel;
use App\Model\UserRevisitRecordModel;
use EasySwoole\Http\Message\Status;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class DatabaseTables extends Base
{
    /**
     * 普通用户列表
     */
    public function lists(){
        try {
            $page = (int)($this->param['page']??1);
            $limit = (int)($this->param['limit']??20);
            $model = DatabaseTablesModel::create();
           
            if(!empty($this->param['create_time'])){
                $create_time   = explode(' - ',$this->param['create_time']);
                $model->where('create_time',[trim($create_time[0]).' 00:00:00',trim($create_time[1]).' 23:59:59'],'between');
            }
            if(!empty($this->param['table_name'])){ $model->where('( table_name like "%'.$this->param['table_name'].'%")'); }


            if(!empty($this->param['order'])){
                $order = explode(' ',$this->param['order']);
            }else{
                $order = ['id','desc'];
            }
            $field = "*";
            $list = $model->alias('u')->withTotalCount()->order($order[0], $order[1])->field($field)->page($page, $limit)->select();
            $total = $model->lastQueryResult()->getTotalCount();;
            $this->AjaxJson(1, ['total'=>$total,'list'=>$list,'sql'=>$model->lastQuery()->getLastPrepareQuery()], 'success');
            return true;
        }catch (\Throwable $e){
            $this->AjaxJson(0, [], $e->getMessage());
        }

    }

    /**
     * 更新当前所有数据库表信息
     */
    public function update(){
        $config = DbManager::getInstance()->getConnection()->getConfig();
        $sql  = "select * from information_schema.tables where table_schema='" . $config->getDatabase() . "' order by table_name asc;";
        $queryBuild = new QueryBuilder();
        $queryBuild->raw($sql);
        $result = DbManager::getInstance()->query($queryBuild, true, 'default')->getResult();
        foreach ($result as $row){
            $data = [];
            //组装表数据
            foreach ($row as $field =>$value){
                $data[strtolower($field)] = empty($value)?'':$value;
            }
            //获取创建表语句
            $queryBuild = new QueryBuilder();
            $queryBuild->raw("SHOW CREATE TABLE `{$data['table_name']}`");
            $res = DbManager::getInstance()->query($queryBuild, true, 'default')->getResult();
            $data['create_table_sql'] = $res[0]['Create Table']??'';
            //存在则更新，不存在则新增
            if(DatabaseTablesModel::create()->where('table_name',$data['table_name'])->find()){
                $data['update_time'] = date('Y-m-d H:i:s');
                DatabaseTablesModel::create()->where('table_name',$data['table_name'])->update($data);
            }else{
                DatabaseTablesModel::create()->data($data)->save();
            }
        }
        $this->AjaxJson(1,$result,'ok');
    }


}
