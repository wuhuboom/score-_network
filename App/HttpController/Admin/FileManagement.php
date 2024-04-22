<?php

namespace App\HttpController\Admin;


use App\HttpController\Common\Common;
use App\HttpController\Common\FileManager;
use App\HttpController\Common\Qiniu;
use App\Log\LogHandler;
use App\Model\FileManagementModel;
use EasySwoole\FastCache\Cache;

/**
 * Class Users
 * Create With Automatic Generator
 */
class FileManagement extends Base
{
    /**
     * 图片列表
     */
    public function lists(){

        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??20);

        $FileManagementModel = new FileManagementModel();
        if(!empty($this->param['file_type'])){
            $FileManagementModel->where('file_type',$this->param['file_type'],'=');
        }
        if(!empty($this->param['category'])){
            $FileManagementModel->where('category',$this->param['category'],'=');
        }
        if(!empty($this->param['is_oss'])){
            $FileManagementModel->where('is_oss',$this->param['is_oss']==1?1:0);
        }
        if(!empty($this->param['file_path'])){
            $FileManagementModel->where('file_path','%'.$this->param['file_path'].'%','like');
        }
        if(!empty($this->param['file_name'])){
            $FileManagementModel->where('file_name','%'.$this->param['file_name'].'%','like');
        }
        $field = '*';
        $list = $FileManagementModel->withTotalCount()->field($field)->order('id', 'desc')->page($page,$limit)->select();
        $data['total'] = $FileManagementModel->lastQueryResult()->getTotalCount();
        $system = Common::getSystem();
        foreach ($list as $k=>$v){
            $list[$k]['url'] = $v['is_oss']==1?$system['qiniu']['host'].$v['file_url']:$system['host'].$v['file_url'];
        }
        $data['list'] = $list;
        $this->AjaxJson(1, $data, 'success');
        return true;
    }
    /**
     * 新增图片
     */
    public function add(){
        $data = $this->param;
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = date('Y-m-d H:i:s');
        $result = FileManagementModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = FileManagementModel::create()->data($data)->save()){
                $this->AjaxJson(1, ['status'=>1], '新增成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '新增失败');return false;
            }
        }catch (\Exception $e){
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }

    }
    /**
     * 编辑图片
     */
    public function edit(){
        try {
            if (!empty($this->param['id'])) {
                $data = $this->param;
                $data['update_time'] = date('Y-m-d H:i:s');
                $FileManagementModel = FileManagementModel::create();
                $result = $FileManagementModel->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                if ($FileManagementModel->where('id',$this->param['id'])->update($data)) {
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
     * 删除图片
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            $list = FileManagementModel::create()->where('id',$ids,'in')->select();
            foreach ($list as $k=>$v){
                @unlink(EASYSWOOLE_ROOT.$v['file_url']);
                $res = Qiniu::delete($v['file_url']);
                LogHandler::getInstance()->log('删除文件'.$v['file_url'].$res, LogHandler::getInstance()::LOG_LEVEL_INFO, 'localhost_file_delete');
            }

            if( FileManagementModel::create()->where('id',$ids,'in')->destroy()){
                $this->AjaxJson(1, ['status'=>1], '删除图片成功');return false;
            }
            else{
                $this->AjaxJson(0, ['status'=>0], '删除图片失败');return false;
            }
        }else{
            $this->AjaxJson(0, $this->param, '请选择要删除的图片');
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
     * 本地图片写入文件资源管理表
     */
    public function localhostFileWrite(){
        $is_execute = Cache::getInstance()->get('localhost_file_write');
        if($is_execute){
            $this->AjaxJson(0,[],'任务已执行，请勿重复提交！');return false;
        }
        go(function (){
            LogHandler::getInstance()->log('开始将本地文件写入文件资源管理表', LogHandler::getInstance()::LOG_LEVEL_INFO, 'localhost_file_write');
            Cache::getInstance()->set('localhost_file_write',1,600);//六分钟
            try {
                $folder_path = EASYSWOOLE_ROOT . '/public/uploads/';        //订单截图存储目录
                $folder = FileManager::getFolderList($folder_path); //获取指定目录下的所有文件夹
                $dirs = [
                    'shop',
                    'h5',
                    'wechat_group_qr_code',
                    'customer_service',
                    'banner',
                    'auto_reply',
                    'honour',
                    'cash_out',
                    'avatar',
                    'poster',
                    'notice',
                    'recharge',
                    'lottery_prizes',
                    'lottery_rules',
                    'coupon',
                    'category',
                    'user',
                    'activity',
                    'tabbar',
                ];
                $num = 0;
                foreach ($folder as $v){
                    if(in_array($v['name'],$dirs)){
                        $files =FileManager::getFileList($folder_path.$v['name']);
                        foreach ($files as $k=>$file){
                            $file_path = $file['name'];
                            if(file_exists($file_path)){
                                $fileInfo = pathinfo($file_path);
                                $data = [];
                                $data['category'] = $v['name']; //所属模块
                                $data['file_type'] = 'image'; //文件类型
                                $data['file_name'] = $fileInfo['basename']; //文件名称
                                $data['file_path'] = str_replace(EASYSWOOLE_ROOT,'',$fileInfo['dirname']);  //存储路径
                                $data['file_url']  = str_replace(EASYSWOOLE_ROOT,'',$file_path);//访问地址
                                $data['file_extension']  = $fileInfo['extension']??'';//文件后缀
                                $data['file_size']  = filesize($file_path);//文件大小
                                $data['update_time']  = date('Y-m-d H:i:s');//写入时间
                                if( $find = FileManagementModel::create()->where('file_url',$data['file_url'])->find()){
                                    if (round($data['file_size']/1024,2) != $find['file_size']) {
                                        $data['is_oss']  = 0;//文件大小不一样，说明文件发生改变，需要重新上传七牛云
                                    }
                                    FileManagementModel::create()->where('file_url',$data['file_url'])->update($data);
                                }else{
                                    $data['create_time']  = date('Y-m-d H:i:s');//写入时间
                                    FileManagementModel::create()->data($data)->save();
                                }
                                $num++;
                            }
                        }
                    }
                }

                //前端H5子目录
                $folder_path = EASYSWOOLE_ROOT . '/public/uploads/h5/';
                $folder = FileManager::getFolderList($folder_path); //获取指定目录下的所有文件夹
                foreach ($folder as $v){
                    $files =FileManager::getFileList($folder_path.$v['name']);
                    foreach ($files as $k=>$file){
                        $file_path = $file['name'];
                        if(file_exists($file_path)){
                            $fileInfo = pathinfo($file_path);
                            $data = [];
                            $data['category'] = $v['name']; //所属模块
                            $data['file_type'] = 'image'; //文件类型
                            $data['file_name'] = $fileInfo['basename']; //文件名称
                            $data['file_path'] = str_replace(EASYSWOOLE_ROOT,'',$fileInfo['dirname']);  //存储路径
                            $data['file_url']  = str_replace(EASYSWOOLE_ROOT,'',$file_path);//访问地址
                            $data['file_extension']  = $fileInfo['extension']??'';//文件后缀
                            $data['file_size']  = filesize($file_path);//文件大小
                            $data['update_time']  = date('Y-m-d H:i:s');//写入时间
                            if( $find = FileManagementModel::create()->where('file_url',$data['file_url'])->find()){
                                if (round($data['file_size']/1024,2) != $find['file_size']) {
                                    $data['is_oss']  = 0;//文件大小不一样，说明文件发生改变，需要重新上传七牛云
                                }
                                FileManagementModel::create()->where('file_url',$data['file_url'])->update($data);
                            }else{
                                $data['create_time']  = date('Y-m-d H:i:s');//写入时间
                                FileManagementModel::create()->data($data)->save();
                            }
                            $num++;
                        }
                    }
                }

                //推广海报子目录
                $folder_path = EASYSWOOLE_ROOT . '/public/uploads/poster/';
                $folder = FileManager::getFolderList($folder_path); //获取指定目录下的所有文件夹
                foreach ($folder as $v){
                    $files =FileManager::getFileList($folder_path.$v['name']);
                    foreach ($files as $k=>$file){
                        $file_path = $file['name'];
                        if(file_exists($file_path)){
                            $fileInfo = pathinfo($file_path);
                            $data = [];
                            $data['category'] = $v['name']; //所属模块
                            $data['file_type'] = 'image'; //文件类型
                            $data['file_name'] = $fileInfo['basename']; //文件名称
                            $data['file_path'] = str_replace(EASYSWOOLE_ROOT,'',$fileInfo['dirname']);  //存储路径
                            $data['file_url']  = str_replace(EASYSWOOLE_ROOT,'',$file_path);//访问地址
                            $data['file_extension']  = $fileInfo['extension']??'';//文件后缀
                            $data['file_size']  = filesize($file_path);//文件大小
                            $data['update_time']  = date('Y-m-d H:i:s');//写入时间
                            if( $find = FileManagementModel::create()->where('file_url',$data['file_url'])->find()){
                                if (round($data['file_size']/1024,2) != $find['file_size']) {
                                    $data['is_oss']  = 0;//文件大小不一样，说明文件发生改变，需要重新上传七牛云
                                }
                                FileManagementModel::create()->where('file_url',$data['file_url'])->update($data);
                            }else{
                                $data['create_time']  = date('Y-m-d H:i:s');//写入时间
                                FileManagementModel::create()->data($data)->save();
                            }
                            $num++;
                        }
                    }
                }
                Cache::getInstance()->unset('localhost_file_write');//删除正在执行标志key
                LogHandler::getInstance()->log('成功更新'.$num.'文件', LogHandler::getInstance()::LOG_LEVEL_INFO, 'localhost_file_write');

            }catch (\Throwable $e){
                Cache::getInstance()->unset('localhost_file_write');//删除正在执行标志key
                LogHandler::getInstance()->log($e->getMessage(), LogHandler::getInstance()::LOG_LEVEL_INFO, 'localhost_file_write');
            }
        });
        $this->AjaxJson(1,[],'任务提交至后台执行，请稍后几分钟后再查看结果！');return false;
    }

    /**
     * 文件同步至七牛云
     */
    public function syncToQiniu(){
        $is_execute = Cache::getInstance()->get('sync_to_qiniu');
        if($is_execute){
            $this->AjaxJson(0,[],'任务已执行，请勿重复提交！');return false;
        }
        go(function (){
            try {
                Cache::getInstance()->unset('sync_to_qiniu');//删除正在执行标志key
                LogHandler::getInstance()->log('开始同步文件至七牛云', LogHandler::getInstance()::LOG_LEVEL_INFO, 'file_management');
                $list = FileManagementModel::create()->where('is_oss',0)->field('id,file_name,file_url,file_path')->select();
                foreach ($list as $v){
                    $res = Qiniu::putFile(EASYSWOOLE_ROOT.$v['file_url'],ltrim($v['file_path'], '/'),$v['file_name']);
                    if($res&&!empty($res['key'])){
                        FileManagementModel::create()->where('id',$v['id'])->update(['is_oss'=>1,'hash'=>$res['hash'],'update_time'=>date('Y-m-d H:i:s')]);
                        LogHandler::getInstance()->log($v['file_url'].'同步至七牛云成功', LogHandler::getInstance()::LOG_LEVEL_INFO, 'file_management');
                    }else{
                        LogHandler::getInstance()->log($v['file_url'].'同步至七牛云失败'.json_encode($res,JSON_UNESCAPED_UNICODE), LogHandler::getInstance()::LOG_LEVEL_INFO, 'file_management');
                    }
                    \co::sleep(0.1);
                }
                Cache::getInstance()->unset('sync_to_qiniu');//删除正在执行标志key
            }catch (\Throwable $e){
                Cache::getInstance()->unset('sync_to_qiniu');//删除正在执行标志key
                LogHandler::getInstance()->log($e->getMessage(), LogHandler::getInstance()::LOG_LEVEL_INFO, 'file_management');
            }

        });
        $this->AjaxJson(1,[],'任务提交至后台执行，请稍后几分钟后再查看结果！');return false;
    }

}

