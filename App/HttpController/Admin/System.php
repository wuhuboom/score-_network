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
    //更新充值配置信息
    public function saveRechargeConfig(){
        $data = $this->param;
        $data['recharge_config'] = json_encode($data,JSON_UNESCAPED_UNICODE);
        $data['update_time'] = time();

        if(SystemService::create()->update(1,$data)){
            $system = SystemModel::create()->where('id',1)->find();
            Cache::getInstance()->set('system',$system);
            $this->AjaxJson(1,$data,'更新配置成功');return false;
        }else{
            $this->AjaxJson(0,$data,'更新配置失败');return false;
        }

    }
    //更新提现配置信息
    public function saveWithdrawalConfig(){
        $data = $this->param;
        $data['withdrawal_config'] = json_encode($data,JSON_UNESCAPED_UNICODE);
        $data['update_time'] = time();

        if(SystemService::create()->update(1,$data)){
            $system = SystemModel::create()->where('id',1)->find();
            Cache::getInstance()->set('system',$system);
            $this->AjaxJson(1,$data,'更新配置成功');return false;
        }else{
            $this->AjaxJson(0,$data,'更新配置失败');return false;
        }

    }
    //更新客户配置信息
    public function saveCustomerConfig(){
        $data = $this->param;
        $data['customer_config'] = json_encode($data,JSON_UNESCAPED_UNICODE);
        $data['update_time'] = time();

        if(SystemService::create()->update(1,$data)){
            $system = SystemModel::create()->where('id',1)->find();
            Cache::getInstance()->set('system',$system);
            $this->AjaxJson(1,$data,'更新配置成功');return false;
        }else{
            $this->AjaxJson(0,$data,'更新配置失败');return false;
        }

    }

    //更新产品购买配置信息
    public function saveProductConfig(){
        $data = $this->param;
        $data['product_config'] = json_encode($data,JSON_UNESCAPED_UNICODE);
        $data['update_time'] = time();

        if(SystemService::create()->update(1,$data)){
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

    //关于我们
    public function saveAbout(){
        if(empty($this->param['about'])){
            $this->AjaxJson(0, [], '关于我们必须填写');
            return false;
        }
        $data['about'] = $this->param['about'];
        $data['update_time']      = time();
        $SystemModel              = SystemModel::create();
        if ($SystemModel->update($data, ['id' => 1])) {
            $system = SystemModel::create()->where('id', 1)->find();
            Cache::getInstance()->set('system', $system);
            $this->AjaxJson(1, $data, '更新关于我们成功');
            return false;
        } else {
            $this->AjaxJson(0, $data, '更新签到关于我们失败');
            return false;
        }
    }

    /**
     * 上传图片
     * @return bool
     */
    public function upload(){
        $request=  $this->request();
        $img_file = $request->getUploadedFile('file');//获取一个上传文件,返回的是一个\EasySwoole\Http\Message\UploadFile的对象
        $fileSize = $img_file->getSize();
        $directory = $this->param['directory']??'common';
        if(is_dir(EASYSWOOLE_ROOT.'/public/uploads/'.$directory)){
            mkdir(EASYSWOOLE_ROOT.'/public/uploads/'.$directory,0755);
        }

        //上传图片不能大于5M (1048576*5)
        if($fileSize>1048576*5){
            $this->AjaxJson(0,['size'=>$fileSize], '图片大小不能超过5MB'); return false;
        }
        $clientFileName = $img_file->getClientFilename();
        $fileName = date('YmdHis').rand(100000,999999).'.'.pathinfo($clientFileName, PATHINFO_EXTENSION);;
        $res = $img_file->moveTo(EASYSWOOLE_ROOT."/public/uploads/{$directory}/".$fileName);
        if(file_exists(EASYSWOOLE_ROOT."/public/uploads/{$directory}/".$fileName)){
            $data['path'] = "/public/uploads/{$directory}/".$fileName;
            $data['image'] = "/public/uploads/{$directory}/".$fileName;
            $this->AjaxJson(1, $data, '上传成功');
        }else{
            $this->AjaxJson(0,[], '上传失败');
        }
        return true;
    }

}

