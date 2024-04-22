<?php

namespace App\HttpController\Admin;


use App\Model\BannerModel;

/**
 * Class Users
 * Create With Automatic Generator
 */
class Banner extends Base
{
    /**
     * 轮播图列表
     */
    public function lists(){

        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??20);

        $BannerModel = new BannerModel();
        if(!empty($this->param['platform_type'])){
            $BannerModel->where('platform_type',$this->param['platform_type'],'=');
        }
        if(!empty($this->param['type'])){
            $BannerModel->where('type',$this->param['type'],'=');
        }
        if(!empty($this->param['title'])){
            $BannerModel->where('title','%'.$this->param['title'].'%','like');
        }
        $field = '*';
        $list = $BannerModel->withTotalCount()->field($field)->order('id', 'desc')->page($page,$limit)->select();
        $data['total'] = $BannerModel->lastQueryResult()->getTotalCount();
        $data['list'] = $list;
        $this->AjaxJson(1, $data, 'success');
        return true;
    }
    /**
     * 新增轮播图
     */
    public function add(){
        $data = $this->param;
        $data['banner'] = $data['banner']??'';
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = date('Y-m-d H:i:s');
        $result = BannerModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = BannerModel::create()->data($data)->save()){
                $this->AjaxJson(1, ['status'=>1], '新增成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '新增失败');return false;
            }
        }catch (\Exception $e){
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }

    }
    /**
     * 编辑轮播图
     */
    public function edit(){
        try {
            if (!empty($this->param['id'])) {
                $data = $this->param;
                $data['banner'] = $data['banner']??'';
                $data['top_color'] = $data['top_color']??'#ccccdd';
                $data['left_color'] = $data['left_color']??'##666666';
                $data['update_time'] = date('Y-m-d H:i:s');
                $BannerModel = BannerModel::create();
                $result = $BannerModel->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                if ($BannerModel->where('id',$this->param['id'])->update($data)) {
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
     * 删除轮播图
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( BannerModel::create()->where('id',$ids,'in')->destroy()){
                $this->AjaxJson(1, ['status'=>1], '删除轮播图成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除轮播图失败');return false;
            }
        }else{
            $this->AjaxJson(0, $this->param, '请选择要删除的轮播图');
        }
        return false;
    }
    /**
     * 上传图片
     * @return bool
     */
    public function upload(){
        $request=  $this->request();
        $img_file = $request->getUploadedFile('file');//获取一个上传文件,返回的是一个\EasySwoole\Http\Message\UploadFile的对象
        $fileSize = $img_file->getSize();
        //上传图片不能大于5M (1048576*5)
        if($fileSize>1048576*10){
            $this->AjaxJson(0,['size'=>$fileSize], '文件最大不能超过1MB'); return false;
        }
        $clientFileName = $img_file->getClientFilename();
        $fileName = '_'.MD5(time()).'.'.pathinfo($clientFileName, PATHINFO_EXTENSION);;
        $res = $img_file->moveTo(EASYSWOOLE_ROOT.'/public/uploads/banner/'.$fileName);
        if(file_exists(EASYSWOOLE_ROOT.'/public/uploads/banner/'.$fileName)){
            $data['image'] = '/public/uploads/banner/'.$fileName;
            $this->AjaxJson(1, $data, 'success');
        }else{
            $this->AjaxJson(0,EASYSWOOLE_ROOT.'/public/uploads/banner/'.$fileName, '文件上传失败');
        }
        return true;
    }
    /**
     * 排序
     */
    public function sort(){
        try {
            if (!empty($this->param['id'])) {
                $data[$this->param['field']] = $this->param['value'];
                $data['update_time'] = date('Y-m-d H:i:s');

                if (BannerModel::create()->update($data, ['id' => $this->param['id']])) {
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
     * 排序
     */
    public function doStatus(){
        try {
            if (!empty($this->param['id'])) {
                $data[$this->param['field']] = $this->param['value'];
                $data['update_time'] = date('Y-m-d H:i:s');

                if (BannerModel::create()->update($data, ['id' => $this->param['id']])) {
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


}

