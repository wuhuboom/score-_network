<?php
namespace App\Process;

use App\Log\LogHandler;
use App\Service\EndedService;
use App\Service\InplayService;
use App\Service\OddsService;
use EasySwoole\Component\Process\AbstractProcess;

//自动更新赛程赔率
class Odds extends AbstractProcess
{

    protected function run($arg)
    {
        $pid = $this->getPid();
        // TODO: Implement run() method.
        go(function ()use ($pid){

	        while (1){
		        try {
		        	$inplay = InplayService::create()->joinOddsList(['i.id'=>[0,'>'],'i.is_generate'=>0,'o.event_id'=>['ISNULL(o.event_id)','special']],'i.id',1,1,'i.id desc')['list'][0]??[];
		        	if($inplay){

				        $event_id = $inplay['id'];
				        $log_contents = '开始获取赛事赔率：' . $event_id;
				        LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'Odds');
				        if(empty($odds)){
					        $data = \App\HttpController\Common\BetsApi::getOdds($event_id);

					        if (!empty($data['results'])) {
						        $save_data = $data['results'];
						        foreach ($save_data as $field => $value) {
							        $save_data[$field] = $value ?? '';
						        }
						        $save_data['event_id'] = $event_id;
						        $save_data['create_time'] = date('Y-m-d H:i:s');
						        $save_data['update_time'] = date('Y-m-d H:i:s');
						        $log_contents = '更新赛事赔率数据：' . json_encode($save_data, JSON_UNESCAPED_UNICODE);
						        LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'Odds');
						        if ($res = \App\Service\OddsService::create()->getOne(['event_id' => $event_id])) {
							        \App\Service\OddsService::create()->update($res['id'], $save_data);
						        } else {
							        \App\Service\OddsService::create()->save($save_data);
						        }

					        }else{
						        $log_contents = '获取赔率数据失败：' . json_encode($data,JSON_UNESCAPED_UNICODE);
						        LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'Odds');
					        }
				        }else{
					        $log_contents = '赔率数据已存在：' . $event_id;
					        LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'Odds');
					        continue;
				        }
			        }else{
				        $log_contents = '没有需要更新的赛事赔率' ;
				        LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'Odds');
			        }
			        \co::sleep(3);     	//每3秒获取一次
		        }catch (\Throwable $e){
			        $log_contents = "赛事赔率自定义进程错误：{$e->getMessage()}_{$e->getLine()}_{$e->getCode()}";
			        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Odds');
			        if (strrpos(strtoupper($e->getMessage()),'SQLSTATE') !== false){
				        $log_contents = date('Y-m-d H:i:s').'：'."数据库连接异常：{$e->getMessage()}";
				        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Odds');
				        \co::sleep(1);
				        $path = EASYSWOOLE_ROOT;
				        $cmd = "cd {$path};php easyswoole process kill --pid={$pid} -f";
				        $log_contents = date('Y-m-d H:i:s').'：'."自定义进程重启：{$cmd}";
				        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Odds');
				        shell_exec($cmd);
			        }
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