<?php

namespace App\HttpController\Index;

use App\HttpController\Common\CacheData;
use App\HttpController\Common\Common;
use App\HttpController\Common\Distribution;
use App\HttpController\Common\IpQuery;
use App\HttpController\Common\Pay;
use App\HttpController\Common\Regex;
use App\Languages\Dictionary;
use App\Log\LogHandler;
use App\Model\NoticeReadModel;
use App\Model\OrderModel;
use App\Model\OrderSettlementModel;
use App\Model\ShopModel;
use App\Model\UserMemberModel;
use App\Model\UserModel;
use App\Model\WechatGroupQrCodeModel;
use App\Service\NoticeReadService;
use App\Service\NoticeService;
use App\Service\ProductService;
use App\Service\UserService;
use App\Utility\MyQueue;
use App\Model\ApiGroupModel;
use App\Model\ApiModel;
use EasySwoole\FastCache\Cache;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\I18N\I18N;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;
use EasySwoole\Queue\Driver\RedisQueue;
use EasySwoole\Queue\Job;
use EasySwoole\Queue\Queue;
use EasySwoole\Redis\Config\RedisConfig;

/**
 * Class Users
 * Create With Automatic Generator
 */
class Index extends Base
{
    //首页
    public function index()
    {
	    if(!empty($this->param['lang'])){
	    	if(in_array($this->param['lang'],['En','Cn'])){
	    		Cache::getInstance()->set(md5($this->getRealIp()),$this->param['lang']??'');
		    }
		    $this->assign['lang'] = $this->param['lang'];
	    }else{
		    $this->assign['lang'] = $this->lang;
	    }

        $this->assign['page_path'] = 'index';
        $product =ProductService::create()->joinSelectList(['status'=>[[2,3],'in'],'is_del'=>0],'p.*,v.name  as vip_name,v.level',0,0,'sort asc');
        $user = UserService::create()->get($this->user_id);
        $this->assign['user'] = $user;
        $this->assign['product'] = $product['list'];
        $this->assign['title'] = 'Home';

        $read_ids = NoticeReadService::create()->where(['user_id'=>$this->user_id??0])->column('notice_id')??[0];
        $notice = NoticeService::create()->where(['is_publish'=>1,'id'=>[$read_ids,'not in']])->get();
        if($this->user_id&&$notice){
            if(NoticeReadService::create()->where(['user_id'=>$this->user_id,'notice_id'=>$notice['id']])->get()){
                $notice = [];
            }else{
                NoticeReadService::create()->save(['is_read'=>1,'user_id'=>$this->user_id,'notice_id'=>$notice['id'],'create_time'=>date('Y-m-d H:i:s')]);
            }
        }
        $this->assign['notice'] = $notice;
        $this->view('index/index/index',$this->assign);
    }
    //首页
    public function home()
    {
        $product =ProductService::create()->joinSelectList(['status'=>[[2,3],'in']],'p.*,v.name  as vip_name,v.level');
        $this->assign['product'] = $product['list'];
        $this->assign['page_path'] = 'index';
        $this->view('index/index/home',$this->assign);
    }

    public function about(){
        $this->assign['about'] = Common::getSystem()['about']??'';
        $this->view('index/index/about',$this->assign);
    }
    //首页
    public function language()
    {
        $rets = [];
        $lan =  ucwords($this->param['lan'])??'Cn';
        $keywords = getI18NLanguage();
        foreach ($keywords as $name=>$value){
            if($name=='WELCOME11'){
                $rets[$name] = I18N::getInstance()->setLanguage($lan)->sprintf($value, '你好', '主页');
            }else{
                $rets[$name] = I18N::getInstance()->setLanguage($lan)->translate($value);
            }

        }
        $this->writeJson(200, $rets, 'success!');return false;

    }
    //短信发送测试
    public function sendSms(){
        $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
        $task->async(new \App\Task\UserVipLevel(['user_id'=>4]));     // 投递异步任务
        $this->AjaxJson(1,[],'ok');return false;
        $apiKey = "ay3gTSbI";
        $apiSecret = "EL7YIdqe";
        $appId = "J087z5ky";

        $url = "https://api.onbuka.com/v3/sendSms";

        $timeStamp = time();
        $sign = md5($apiKey.$apiSecret.$timeStamp);

        $dataArr['appId'] = $appId;
        $dataArr['numbers'] = '0917-8888-123';
        $dataArr['content'] = 'hello world';
        $dataArr['senderId'] = '';


        $data = json_encode($dataArr);
        $client = new HttpClient($url);
        $client->setHeader('Content-Type','application/json;charset=UTF-8',false);
        $client->setHeader('Sign',$sign,false);
        $client->setHeader('Timestamp',$timeStamp,false);
        $client->setHeader('Api-Key',$apiKey,false);
        $response = $client->postJson($data);
        $res = $response->getBody();
        $this->AjaxJson(1,$res,$response->getStatusCode());

    }





}

