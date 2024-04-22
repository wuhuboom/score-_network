<?php

namespace App\Crontab;

use App\HttpController\Common\FileManager;
use App\Log\LogHandler;
use App\Model\FileManagementModel;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;
use EasySwoole\FastCache\Cache;


class ScanUploadFiles extends AbstractCronTask
{
    //每9分钟扫描上传图片目录
    public static function getRule(): string
    {
        return '*/9 * * * *';
    }

    public static function getTaskName(): string
    {
        return  'ScanUploadFiles';
    }

    function run(int $taskId, int $workerIndex)
    {

        go(function (){
            LogHandler::getInstance()->log('开始扫描上传文件并写入文件资源管理表', LogHandler::getInstance()::LOG_LEVEL_INFO, 'scan_upload_files');
            try {
                $folder_path = EASYSWOOLE_ROOT . '/public/uploads/';        //订单截图存储目录
                $folder = FileManager::getFolderList($folder_path); //获取指定目录下的所有文件夹
                //需要扫描的文件目录
                $dirs = ['shop', 'h5', 'wechat_group_qr_code', 'customer_service', 'banner', 'auto_reply', 'honour', 'cash_out', 'avatar', 'poster', 'notice', 'recharge', 'lottery_prizes', 'lottery_rules', 'coupon', 'category', 'user', 'activity', 'tabbar',];
                $num = 0;
                foreach ($folder as $v){
                    if(in_array($v['name'],$dirs)){
                        $files =FileManager::getFileList($folder_path.$v['name']);
                        foreach ($files as $k=>$file){
                            $file_path = $file['name'];
                            if(file_exists($file_path)){
                                $fileInfo = pathinfo($file_path);
                                $data = [];
                                $data['category'] = $v['name'];                                               //所属模块
                                $data['file_type'] = 'image';                                                 //文件类型
                                $data['file_name'] = $fileInfo['basename'];                                   //文件名称
                                $data['file_path'] = str_replace(EASYSWOOLE_ROOT, '', $fileInfo['dirname']);  //存储路径
                                $data['file_url'] = str_replace(EASYSWOOLE_ROOT, '', $file_path);             //访问地址
                                $data['file_extension'] = $fileInfo['extension'] ?? '';                       //文件后缀
                                $data['file_size'] = filesize($file_path);                                    //文件大小
                                $data['update_time'] = date('Y-m-d H:i:s');                                   //更新时间
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
                LogHandler::getInstance()->log('扫描结束，成功更新'.$num.'文件', LogHandler::getInstance()::LOG_LEVEL_INFO, 'scan_upload_files');

            }catch (\Throwable $e){
                Cache::getInstance()->unset('localhost_file_write');//删除正在执行标志key
                LogHandler::getInstance()->log($e->getMessage(), LogHandler::getInstance()::LOG_LEVEL_INFO, 'scan_upload_files');
            }
        });


    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        $log_contents =date('Y-m-d H:i:s').$throwable->getMessage();
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'scan_upload_files');
    }
}