<?php

namespace App\HttpController\Index;


use App\Service\BlogService;
use App\Service\OrderService;
use App\Service\UserBalanceDetailsService;
use EasySwoole\Component\Di;
use EasySwoole\FastCache\Cache;
use EasySwoole\HttpAnnotation\Utility\AnnotationDoc;
use EasySwoole\HttpClient\HttpClient;


/**
 * 用于开发调式的控制器
 * Create With Automatic Generator
 */
class Api extends Base
{
    //我的余额明细列表
    public function getBalanceDetails(){
        if(!empty($this->param['type'])){
            $where['type'] = [$this->param['type'],'='];
        }
        $where['user_id'] = [$this->user_id,'='];
        $page = $this->param['page']??1;
        $limit= $this->param['limit']??20;
        $data = UserBalanceDetailsService::create()->getLists($where,'*',$page,$limit,'id desc');
        $system = \App\HttpController\Common\Common::getSystem();
        $cn_type = [
            1=>'充值',
            2=>'提现',
            3=>'提现退回',
            4=>'购买产品',
            5=>'产品佣金',
            6=>'任务奖励',
            7=>'推广佣金',
            8=>'系统奖励',
            9=>'系统扣除',
        ];
        $en_type = [
            1=>'Recharge',
            2=>'Withdrawal',
            3=>'Withdrawal return',
            4=>'Buy Product',
            5=>'Product Commission',
            6=>'Task rewards',
            7=>'Promotion commission',
            8=>'System rewards',
            9=>'System deduction',
        ];
        foreach ($data['list'] as $k=>$v){
            if( $this->lang=='Cn'){
                $data['list'][$k]['type'] = $cn_type[$v['type']]??'其他';
            }else{
                $data['list'][$k]['type'] = $en_type[$v['type']]??'Other';
            }
            $data['list'][$k]['balance'] = $v['balance']>0?'+'.$system['currency'].$v['balance']:'-'.$system['currency'].abs($v['balance']);
            if($v['balance_type']==1){
                $data['list'][$k]['balance_type'] = $this->lang=='Cn'?'充值余额':'Recharge balance';
            }else{
                $data['list'][$k]['balance_type'] = $this->lang=='Cn'?'提现余额':'Withdrawal balance';
            }
        }
        $data['page'] = ceil($data['total']/$limit);
        $this->AjaxJson(1,$data,'ok');
    }
    //我的订单列表
	public function getOrders(){
		$where['o.is_del'] = [0,'='];
		$where['o.user_id'] = [$this->user_id,'='];
		if(!empty($this->param['status'])){
			$where['o.status'] = [$this->param['status']==1?1:0,'='];
		}
		$page = $this->param['page']??1;
		$limit= $this->param['limit']??10;
		$orders = OrderService::create()->joinSelectList($where,'o.*,p.name,p.image,v.level',$page,$limit,'o.id desc');
		$orders['page'] = ceil($orders['total']/$limit);
		$this->AjaxJson(1,$orders,'ok');
	}
    //动态获取博客
    public function getBlog(){
        $where = [];
	    $where['b.status'] = [4,'='];
        if(!empty($this->param['username'])) {
            $where['u.username'] = ["%{$this->param['username']}%", 'like'];
        }
        $field = 'b.*,u.username,u.nickname,u.avatar';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = BlogService::create()->joinSelectList($where,$field,$page,$limit,'b.id desc');
        foreach ($data['list'] as $k=>$v){
            if(count($v['image'])>=3){
                $data['list'][$k]['col'] = 4;
            }else if(count($v['image'])>=2){
                $data['list'][$k]['col'] = 6;
            }else{
                $data['list'][$k]['col'] =4;
            }
            $length = strlen($v['username'])-4;
            $data['list'][$k]['username'] = substr_replace($v['username'],'****',2,$length);
        }
        $data['page'] = ceil($data['total']/$limit);
        $this->AjaxJson(1, $data, 'OK');
    }

    public function apidoc()
    {
        $doc = new AnnotationDoc();
        $string = $doc->scan2Html(EASYSWOOLE_ROOT.'/App/HttpController/Index');
        $this->response()->withAddedHeader('Content-type',"text/html;charset=utf-8");
        $this->response()->write($string);
    }

    //单个方法限流对某个用户进行限流 1s中只能访问1次
    public function atomicLimit(){

        $this->autoLimiter = Di::getInstance()->get('auto_limiter');
        $path              = $this->request()->getUri()->getPath();     //控制器路径 /xxxx/xxxx/xxxx
        $client_ip         = $this->getRealIp();                        //客户端真实IP
        $user_id     = 1;                                         //用户ID
        //为方便测试，设置1s只能访问1次
        if (!$this->autoLimiter->access($user_id.$path.$client_ip, 1)){
            $qps = $this->autoLimiter->qps($user_id.$path.$client_ip);
            $this->writeJson(200, ['qps'=>$qps,'path'=>$path], '当前用户ID【'.$user_id.'】_用户IP【'.$this->getRealIp().'】访问【'.$path.'】太过频繁,当前QPS(1s内请求次数):'.$qps);
            return false;
        }
        $this->AjaxJson(1,[$this->request()->getServerParams()['request_uri']],'OK');return false;
        $is_cash_out = Cache::getInstance()->get('is_cash_out_1');
        if($is_cash_out){
            $this->AjaxJson(0,[],'请求失败,10s只能请1次！');return false;
        }
        Cache::getInstance()->set('is_cash_out_1',true,10);
        $this->AjaxJson(1,[],'请求成功，10s才能再次请求成功');return false;
    }


    public function getBastApi(){
        $apikey = '181183-3qfYgaBuFhHFCS';
        $url = "https://api.b365api.com/v3/events/inplay?token={$apikey}&sport_id=1";
        $client = new HttpClient($url);
        $client->setTimeout(30);
        $client->setConnectTimeout(30);
        $response = $client->get();
        $data = json_decode($response->getBody(),1);
        $this->AjaxJson(1,$data,'ok');
    }






}

