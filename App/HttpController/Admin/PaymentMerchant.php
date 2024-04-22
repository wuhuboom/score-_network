<?php

namespace App\HttpController\Admin;


use App\Model\PaymentMerchantModel;
/**
 * Class Users
 * Create With Automatic Generator
 */
class PaymentMerchant extends \App\HttpController\Admin\Base
{
    /**
     * 支付商户号列表
     */
    public function lists(){
        try {
            $param = $this->request()->getRequestParam();
            $page = (int)($param['page']??1);
            $limit = (int)($param['limit']??20);
            $model = PaymentMerchantModel::create();
            if(!empty($this->param['type'])){ $model->where('type',$this->param['type']); }
            if(!empty($this->param['name'])){ $model->where('name like "%'.$this->param['name'].'%"'); }

            $field = '*';
            $list = $model->withTotalCount()->order('id', 'DESC')->field($field)->page($page,$limit)->select();
            $total = $model->lastQueryResult()->getTotalCount();;
            $this->AjaxJson(1, ['total'=>$total,'list'=>$list], 'success');
            return true;
        }catch (\Throwable $e){
            $this->AjaxJson(0, [], $e->getMessage());
            return true;
        }

    }
    /**
     * 新增
     */
    public function add(){
        $data = $this->param;
        $data['info'] = json_encode($data['info'], JSON_UNESCAPED_UNICODE);
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = date('Y-m-d H:i:s');
        $result = PaymentMerchantModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = PaymentMerchantModel::create()->data($data)->save()){
                $this->AjaxJson(1, ['status'=>1], '新增成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '新增失败');return false;
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
                $data = $this->param;
                $data['info'] = json_encode($data['info'], JSON_UNESCAPED_UNICODE);
                $data['update_time'] = date('Y-m-d H:i:s');
                $PaymentMerchantModel = PaymentMerchantModel::create();
                $result = $PaymentMerchantModel->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                if ($PaymentMerchantModel->where('id',$this->param['id'])->update($data)) {
                    $this->AjaxJson(1, ['status' => 1,'data'=>$data], '更新成功');
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
     * 更新
     */
    public function isOpen(){

        try {
            if (!empty($this->param['id'])) {
                $data['is_open'] = $this->param['value']??0;
                $data['update_time'] = date('Y-m-d H:i:s');
                $PaymentMerchantModel = PaymentMerchantModel::create();
                $PaymentMerchantModel->where('id',$this->param['id'])->update($data);

                if ($PaymentMerchantModel->lastQueryResult()->getAffectedRows()) {
                    $info = PaymentMerchantModel::create()->where('id',$this->param['id'])->find();
                    if($info['is_open']==1){
                        PaymentMerchantModel::create()->where('type',$info['type'])->where('id',$info['id'],'<>')->update(['is_open'=>0]);
                    }
                    $this->AjaxJson(1, ['status' => 1,'data'=>$data], '操作成功');
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '操作失败');
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
            if( PaymentMerchantModel::create()->where('id',$ids,'in')->destroy()){
                $this->AjaxJson(1, ['status'=>1], '删除标签成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除标签失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的标签');
        }
        return false;
    }

    //上传证书
    public function uploadCert(){
        $request=  $this->request();
        $img_file = $request->getUploadedFile('file');//获取一个上传文件,返回的是一个\EasySwoole\Http\Message\UploadFile的对象
        $fileSize = $img_file->getSize();
        //上传图片不能大于5M (1048576*5)
        if($fileSize>1048576*5){
            $this->AjaxJson(0,['size'=>$fileSize], '文件最大不能超过5MB'); return false;
        }
        $clientFileName = $img_file->getClientFilename();
        $fileName = '_'.MD5(time()).'.'.pathinfo($clientFileName, PATHINFO_EXTENSION);;
        $res = $img_file->moveTo(EASYSWOOLE_ROOT.'/public/uploads/cert/'.$fileName);
        if(file_exists(EASYSWOOLE_ROOT.'/public/uploads/cert/'.$fileName)){
            $data['src'] = '/public/uploads/cert/'.$fileName;
            $this->AjaxJson(1,$data,'上传成功');
            return true;
        }else{
            $this->AjaxJson(0,[],'上传失败');
            return true;
        }
    }

}

