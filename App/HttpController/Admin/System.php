<?php

namespace App\HttpController\Admin;


use App\Model\SystemModel;
use App\Service\SystemService;
use EasySwoole\EasySwoole\Config;
use EasySwoole\FastCache\Cache;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;


/**
 * Class Users
 * Create With Automatic Generator
 */
class System extends Base
{
    /**
     * 系统配置
     */
    public function getSystem(){
        $system = SystemService::create()->find(1);
        $this->AjaxJson(1, $system, 'OK');
        return true;
    }
    //更新系统配置信息
    public function saveSystem(){
        $data = $this->param;
        $data['update_time'] = time();
        $SystemModel = SystemModel::create();
        $result = $SystemModel->validateData($data, 'edit');
        if ($result !== true) {
            $this->AjaxJson(0, $data, $result);
            return false;
        }

        if($SystemModel->update($data,['id'=>1])){
            $system = SystemModel::create()->where('id',1)->find();
            Cache::getInstance()->set('system',$system);
            $this->AjaxJson(1,$data,'更新配置成功');return false;
        }else{
            $this->AjaxJson(0,$data,'更新配置失败');return false;
        }

    }

    //更新任务奖励配置信息
    public function saveTasksConfig(){
        $data = $this->param;
        $data['tasks_config'] = json_encode($data,JSON_UNESCAPED_UNICODE);
        $data['update_time'] = time();

        if(SystemService::create()->update(1,$data)){
            $system = SystemModel::create()->where('id',1)->find();
            Cache::getInstance()->set('system',$system);
            $this->AjaxJson(1,$data,'更新配置成功');return false;
        }else{
            $this->AjaxJson(0,$data,'更新配置失败');return false;
        }

    }

}

