<?php

namespace App\HttpController\Index;

use App\HttpController\Common\BetsApi;
use App\HttpController\Common\CacheData;
use App\HttpController\Common\Common;
use App\HttpController\Common\Distribution;
use App\HttpController\Common\IpQuery;
use App\HttpController\Common\Pay;
use App\HttpController\Common\Regex;
use App\Languages\Dictionary;
use App\Log\LogHandler;
use App\Model\OrderModel;
use App\Model\OrderSettlementModel;
use App\Model\ShopModel;
use App\Model\UserMemberModel;
use App\Model\UserModel;
use App\Model\WechatGroupQrCodeModel;
use App\Service\CountryService;
use App\Service\HistoryService;
use App\Service\InplayService;
use App\Service\LeagueService;
use App\Service\ProductService;
use App\Service\StatsTrendService;
use App\Service\TeamService;
use App\Service\ViewService;
use App\Utility\MyQueue;
use App\Model\ApiGroupModel;
use App\Model\ApiModel;
use EasySwoole\Component\Di;
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
        $this->view('/index/index/index',$this->assign);
        return false;
    }
	//联赛
	public function league()
	{
		$id  = $this->param['id']??0;
		$league = LeagueService::create()->get($id);
		$this->assign['league'] = $league;
		$teams = TeamService::create()->getLists([],'*',1,20);
		$this->assign['team'] = $teams['list'];
		$upcoming = BetsApi::getUpcoming(1,1,$id);
		$this->assign['upcoming'] = $upcoming['results'];
		$this->view('/index/index/league',$this->assign);
	}
    //比赛
    public function competition(){
        $event_id  = $this->param['event_id']??8009046;
        $competition = InplayService::create()->getOne(['id'=>$event_id]);
        $this->assign['competition'] = $competition;
        $this->assign['view'] = ViewService::create()->findByEventId($event_id);
        $this->assign['history'] = HistoryService::create()->findByEventId($event_id);
        $this->view('/index/index/competition',$this->assign);
    }

    public function soccer(){

    	$country = CountryService::create()->getLists([],'*',0,0,'cc asc');
    	$this->assign['country'] = $country['list'];
//		foreach ($country['list'] as $k=>$v){
//			$league_num = LeagueService::create()->getOne(['cc'=>$v['cc']],'count(*) as num')['num']??0;
//			CountryService::create()->update($v['id'],['league_num'=>$league_num]);
//		}
	    $this->view('/index/index/soccer',$this->assign);
    }
	//api接口文档
	public function api(){

		$api = ApiModel::create()->where('id',$this->param['id']??0)->find();
		$group = ApiGroupModel::create()->where('type',1)->field('id,name,type')->order('sort','asc')->select();
		foreach ($group as $k=>$v){
			$group[$k]['lists'] = ApiModel::create()->where('group_id',$v['id'])->field('id,title,type')->order('sort','asc')->select();
		}
		$this->assign['group'] =$group;

		$this->assign['api'] =  $api;
		if(empty($api)){
			$this->view('/index/index/api_global',$this->assign);
		}else{
			$this->view('/index/index/api',$this->assign);
		}
	}

	//限流测试
	public function limiter(){
		$system = Common::getSystem();
		$qps_time = (int)$system['qps_time'];
		$qps_num = (int)$system['qps_num'];
		//限流器
		$this->autoLimiter = Di::getInstance()->get('auto_limiter');

		$this->autoLimiter->setLimitQps($qps_time);
		$path              = $this->request()->getUri()->getPath();//控制器路径 /xxxx/xxxx/xxxx
		$client_ip         = $this->getRealIp();                   //客户端真实IP

		//为方便测试，设置1s只能访问1次
		if (!$this->autoLimiter->access($path.$client_ip, $qps_num)){
			$qps = $this->autoLimiter->qps($path.$client_ip);
			$this->writeJson(200, ['qps'=>$qps,'path'=>$path], '当前限流'.$qps_time.'s内只能访问'.$qps_num.'次，当前IP【'.$this->getRealIp().'】访问【'.$path.'】太过频繁,当前QPS('.$system['qps_time'].'s内请求次数):'.$qps);
			return false;
		}else{
			$this->writeJson(200, ['path'=>$path], '正常访问');
		}
	}


    //json
   public function jsonSave(){

   }

  







}

