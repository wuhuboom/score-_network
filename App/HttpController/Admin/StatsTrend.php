<?php
namespace App\HttpController\Admin;

use App\Service\StatsTrendService as Service;
use EasySwoole\HttpClient\HttpClient;

class StatsTrend extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        

        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = Service::create()->getLists($where,$field,$page,$limit,'id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 请求联赛数据
     */
    public function getDataByApi(){
        try {
            $page = 1;
            $data = \App\HttpController\Common\BetsApi::getLeague(1,$page);
            if($data['results']){
                foreach ($data['results'] as $k=>$v){
                    $save_data = $v;
                    foreach ($save_data as $k=>$v){
                        $save_data[$k]  = $v??'';
                    }
                    $save_data['create_time'] =date('Y-m-d H:i:s');
                    $save_data['update_time'] =date('Y-m-d H:i:s');

                    if($res = Service::create()->getOne(['cc'=>$save_data['cc']??'','name'=>$save_data['name']])){
                        Service::create()->update($res['id'],$save_data );
                    }else{
 