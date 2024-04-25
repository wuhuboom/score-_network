<?php
namespace App\Process;

use App\Log\LogHandler;
use App\Model\EndedModel;
use App\Service\EndedService;
use App\Service\EndedService as Service;
use EasySwoole\Component\Process\AbstractProcess;

//自动更新即将开始的比赛
class Ended extends AbstractProcess
{

    protected function run($arg)
    {
        $pid = $this->getPid();
        // TODO: Implement run() method.
        go(function ()use ($pid){

            try {
                //20160901
                // 两个日期字符串
                $date1 = "2016-09-01 00:00:00";
                //$date2 = date('Y-m-d');
                $date2 = '2024-04-23 00:00:00'; //EndedService::create()->order('time asc')->val('time')??date('Y-m-d 00:00:00');
                $list = EndedModel::create()->field("DATE_FORMAT(FROM_UNIXTIME(time), '%Y-%m-%d') as  date")->group('date')->order('date','DESC')->select();
                $date_list = array_column($list,'date');
                $day =round((strtotime($date2)-strtotime($date1))/3600/24);
                $time = strtotime($date2);
                $log_contents = "开始获取历史数据【{$date1}】至【{$date2}】共【{$day}】天";
                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                $log_contents = json_encode($date_list,JSON_UNESCAPED_UNICODE);
                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                for ($i=1;$i<=$day;$i++){

                    $date = date('Ymd',$time-24*3600*$i);
                    if(strtotime($date1)>($time-24*3600*$i)){
                        \co::sleep(5);
                        $log_contents = "无法获取【{$date1}】以后【{$date}】的比赛记录";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                        break;
                    }
                    //没有获取到的比赛记录，重新获取
                    if(!in_array(date('Y-m-d',$time-24*3600*$i),$date_list)){
                        $log_contents = "获取【{$date}】已结束的比赛记录开始";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                        $this->getEnded($date);//获取成功
                        $log_contents = "获取【{$date}】已结束的比赛记录结束";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                    }else{
                        $log_contents = "【{$date}】已有比赛记录";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                        continue;
                    }
                    \co::sleep(3);
                }
                $log_contents = "结束获取历史数据【{$date1}】至【{$date2}】";
                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
            }catch (\Throwable $e){
                $log_contents = "获取结束的比赛数据自定义进程错误：{$e->getMessage()}_{$e->getLine()}_{$e->getCode()}";
                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                if (strrpos(strtoupper($e->getMessage()),'SQLSTATE') !== false){
                    $log_contents = date('Y-m-d H:i:s').'：'."数据库连接异常：{$e->getMessage()}";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                    \co::sleep(1);
                    $path = EASYSWOOLE_ROOT;
                    $cmd = "cd {$path};php easyswoole process kill --pid={$pid} -f";
                    $log_contents = date('Y-m-d H:i:s').'：'."自定义进程重启：{$cmd}";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                    shell_exec($cmd);
                }
            }

        });
    }

    public function getEnded($day,$league_id='',$team_id='',$cc=''){
        $log_contents = "开始获取{$day}的记录";
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
        $page =1;
        $sport_id =1;
        $skip_esports = '';
        $data = \App\HttpController\Common\BetsApi::getEnded($sport_id,$page,$league_id,$team_id,$cc,$day,$skip_esports);
        if(!empty($data['results'])){
            foreach ($data['results'] as $k=>$v){
                $save_data = $v;
                foreach ($save_data as $field=>$value){
                    $save_data[$field]  = $value??'';
                }
                $save_data['create_time'] =date('Y-m-d H:i:s');
                $save_data['update_time'] =date('Y-m-d H:i:s');

                if($res = Service::create()->getOne(['id'=>$save_data['id']])){
                    Service::create()->update($res['id'],$save_data );
                    $log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                }else{
                    Service::create()->save($save_data);
                    $log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                }
            }
            if($data['pager']['total']>$data['pager']['per_page']){
                $page_num = ceil($data['pager']['total']/$data['pager']['per_page']);
                $page++;
                for($page;$page<=$page_num;$page++){
                    \co::sleep(3);
                    $data = \App\HttpController\Common\BetsApi::getEnded($sport_id,$page,$league_id,$team_id,$cc,$day,$skip_esports);
                    if(!empty($data['results'])){
                        foreach ($data['results'] as $k=>$v){
                            $save_data = $v;
                            foreach ($save_data as $field=>$value){
                                $save_data[$field]  = $value??'';
                            }
                            $save_data['create_time'] =date('Y-m-d H:i:s');
                            $save_data['update_time'] =date('Y-m-d H:i:s');

                            if($res = Service::create()->getOne(['id'=>$save_data['id']])){
                                Service::create()->update($res['id'],$save_data );
                                $log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                            }else{
                                Service::create()->save($save_data);
                                $log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                            }
                        }
                    }
                }
            }
        }else{
            $log_contents = "请求{$day}的记录无数据".json_encode($data,JSON_UNESCAPED_UNICODE);
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
        }
        $log_contents = "结束获取{$day}的记录";
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
    }
}