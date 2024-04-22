<?php

namespace App\HttpController\Api;


use App\HttpController\Common\CacheData;
use App\HttpController\Common\IpQuery;
use App\HttpController\Router;
use App\Log\LogHandler;
use App\Model\UserModel;
use App\Utility\MyQueue;
use EasySwoole\EasySwoole\Config;
use EasySwoole\FastCache\Cache;
use EasySwoole\Jwt\Jwt;
use EasySwoole\Queue\Job;
use EasySwoole\Tracker\Point;


/**
 * BaseController
 * Class Base
 * Create With Automatic Generator
 */
abstract class Base extends \EasySwoole\Http\AbstractInterface\Controller
{
    public $basicAction = [
        '/api/tasks/lists',
        '/api/tasks/details',
        '/api/wechat/jssdk',
        '/api/wechat/getAppletTemplates',
        '/api/common/getResellerCustomerService',
        '/api/common/getGeoDistance',
        '/api/common/reward',
        '/api/common/serviceUrl',
        '/api/common/getUserPlace',
        '/api/common/getIpPlace',
        '/api/common/tabsLists',
        '/api/common/orderTabsLists',
        '/api/common/testResponseTime',
        '/api/common/privacyAgreement',
        '/api/common/userAgreement',
        '/api/common/getImageHost',
        '/api/login/codeLogin',
        '/api/nav/index',
        '/api/nav/banner',
        '/api/nav/cpsBanner',
        '/api/nav/reward',
        '/api/nav/user',
        '/api/shop/category',
        '/api/shop/lists',
        '/api/shop/merge',
        '/api/shop/all',
        '/api/shop/details',
        '/api/login/getWechatCode',
        '/api/login/wechatLogin',
        '/api/login/wechatAppLogin',
        '/api/login/passwordLogin',
        '/api/login/imageCode',
        '/api/login/getLoginCode',
        '/api/login/getOfficialAccountInfo',
        '/api/login/appletPhoneNumberLogin',
        '/api/login/uniCloudPhoneNumberLogin',
        '/api/member/alipayNotify',
        '/api/member/wechatJsapiPayNotify',
        '/api/member/wechatAppPayNotify',
        '/api/member/wechatAppletPayNotify',
        '/api/movie/getMovie',
        '/api/movie/getLocalCity',
        '/api/movie/getCity',
        '/api/movie/getRegion',
        '/api/movie/getComing',
        '/api/movie/getCinema',
        '/api/movie/getMovieList',
        '/api/movie/getCinemaDetail',
        '/api/movie/getSearch',
        '/api/movie/getDays',
        '/api/movie/getShows',
        '/api/movie/getCinemaDetail',
        '/api/movie/getMovieCinemaDays',
        '/api/movie/getMovieCinema',
        '/api/common/serviceUrl',
        '/api/common/getIpPlace',
        '/api/common/about',
        '/api/elm/shop',
        '/api/common/wechatLoginSwitch',
        '/api/common/settleIn',
        '/api/common/cooperate',
        '/api/common/userAgreement',
        '/api/login/wechatAppletLogin',
        '/api/lottery/prizes',
        '/api/lottery/rules',
        '/api/lottery/rank',
        '/api/meituan/orderNotify',
    ];
    public $token;
    public $page=1;
    public $limit=20;
    public $uid=0;
    public $host;
    public $path;
    public $param;
    public $user;
    public $client;

    public function index(){
        $this->actionNotFound('index');
    }
    public function onRequest(?string $action): ?bool
    {
        if (!parent::onRequest($action)) {
            return false;
        };
        $content_type = $this->request()->getHeader('content-type')[0]??'';
        if($content_type=='application/json'){
            $json_data = $this->request()->getBody()->__toString();
            $requestParam = json_decode($json_data,1);
        }else{
            $requestParam = $this->request()->getRequestParam();
        }
        $requestParam = $requestParam??[];
        $router_param = \EasySwoole\Component\Context\ContextManager::getInstance()->get(Router::PARSE_PARAMS_CONTEXT_KEY)??[];
        $this->param = array_merge($router_param,$requestParam);
        foreach ($this->param as $k=>$v){
            $this->param[$k] = is_string($v)?filter_var($v,FILTER_SANITIZE_STRING):$v;
        }
        if (!parent::onRequest($action)) {
            return false;
        };

        $http = $this->request()->getHeader('http')[0]??'http';
        $this->host = $http.'://'.$this->request()->getHeaders()['host'][0];
        $this->path = $this->request()->getUri()->getPath();
        $this->page = $this->param['page']??$this->page;
        $this->limit = $this->param['limit']??$this->limit;
        // basic列表里的不需要验证
        if (!in_array($this->path, $this->basicAction)){
            // 必须有token
            if (empty( $this->request()->getHeader('authorization')[0] )){
                $this->AjaxJson(0, [], "请先登录");
                return false;
            }
            
            $config    = Config::getInstance();
            $jwtConfig = $config->getConf('JWT');
            $jwtObject = Jwt::getInstance()->setSecretKey($jwtConfig['key'])->decode($this->request()->getHeader('authorization')[0]);
            $status = $jwtObject->getStatus();
            // 如果encode设置了秘钥,decode 的时候要指定
            switch ($status)
            {
                case  1:
                    $this->token = $jwtObject->getData();
                    $data = $jwtObject->getData();
                    $this->uid = $data['id'];
                    $this->username = $data['openid']??'';
                    $this->client = $data['client']??'';
                    break;
                case  -1:
                    $this->AjaxJson(-1, ['msg'=>'登录令牌Token无效'], "登录过期，请重新登录！");
                    return false;
                    break;
                case  -2:
                    $this->AjaxJson(-1, ['msg'=>'登录过期，请重新登录！'], "登录过期，请重新登录！");
                    return false;
                    break;
                default:
                    $this->AjaxJson(-1, [], "登录过期，请重新登录！");
                    return false;
            }

            if (!is_array($this->token) || empty($this->token)){
                $this->AjaxJson(-1, ['token'=>$this->token], "登录令牌解析失败！");
                return false;
            }

            //检测用户状态
            if($this->checkUserStatus()!==true){
                $this->AjaxJson(0,$this->checkUserStatus(),'系统异常！');  return false;
                return  false;
            }
        }else{
            $config    = Config::getInstance();
            $jwtConfig = $config->getConf('JWT');
            $token = $this->request()->getHeader('authorization')[0]??'';
            try {
                if($token){
                    $jwtObject = Jwt::getInstance()->setSecretKey($jwtConfig['key'])->decode($token);
                    $status = $jwtObject->getStatus();
                    // 如果encode设置了秘钥,decode 的时候要指定
                    switch ($status)
                    {
                        case  1:
                            $this->token = $jwtObject->getData();
                            $data = $jwtObject->getData();
                            $this->uid = $data['id'];
                            break;
                        case  -1:
                            $this->AjaxJson(-1, ['msg'=>'无效的token'], "登录过期，请重新登录！");
                            return false;
                            break;
                        case  -2:
                            $this->AjaxJson(-1, ['msg'=>'登录过期，请重新登录！'], "登录过期，请重新登录！");
                            return false;
                            break;
                    }
                }
            }catch (\Throwable $e){
                return true;
            }

        }
        return true;
    }

    protected function checkUserStatus(){
        $user = CacheData::userInfo($this->uid??0);

        if(empty($user)){
            return '系统异常！';
        }
        if($user['status']==0){
            return '系统异常！！';
        }
        if($user['is_black']==1){
            return '系统异常！！！';
        }
        $this->user = $user;
        return true;
    }

    //检测微信端
    public function isWeixin(){
        if (!empty($this->request()->getHeaders()['user-agent']) && strpos($this->request()->getHeaders()['user-agent'][0], 'MicroMessenger') !== false ) {
            return true;
        }
        return false;
    }
    //检测PC手机端
    public function isMobile() {
        if(empty($this->request()->getHeaders()['user-agent'][0])){
            $user_agent = '';
        }else{
            $user_agent = $this->request()->getHeaders()['user-agent'][0];
        }
        if ( empty($user_agent) ) {
            $is_mobile = false;
        } elseif ( strpos($user_agent, 'Mobile') !== false
            || strpos($user_agent, 'Android') !== false
            || strpos($user_agent, 'Silk/') !== false
            || strpos($user_agent, 'Kindle') !== false
            || strpos($user_agent, 'BlackBerry') !== false
            || strpos($user_agent, 'Opera Mini') !== false
            || strpos($user_agent, 'Opera Mobi') !== false ) {
            $is_mobile = true;
        } else {
            $is_mobile = false;
        }
        return $is_mobile;
    }

    //请求状态JSON返回
	public function writeJson($statusCode = 200, $result = NULL, $msg = NULL)
    {
        if (!$this->response()->isEndResponse()) {
            $data = Array(
                "code" => $statusCode,
                "data" => $result,
                "result" => $result,
                "msg" => $msg
            );
            $this->response()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            $this->response()->withStatus(200);
            return true;
        } else {
            return false;
        }
    }

    //AJAX请求JSON返回
    public function AjaxJson($status=0,$data=[],$msg='OK'){
        if (!$this->response()->isEndResponse()) {
            $data = Array(
                "code" => 200,
                "status"=>$status,
                "result" => $data,
                "msg" => $msg
            );
            $this->response()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            $this->response()->withStatus(200);
            $this->response()->end();
            return false;
        } else {
            return false;
        }
    }

    //获取真实IP
    public function getRealIp()
    {
        // 真实IP
        $ip = '';
        if (count($this->request()->getHeader('x-real-ip'))) {
            if (!empty($this->request()->getHeader('x-forwarded-for')[0])) {
                $ip = explode(',', $this->request()->getHeader('x-forwarded-for')[0])[0];
            }
            $ip = $ip ?? $this->request()->getHeader('x-real-ip')[0];
        } else {
            $params = $this->request()->getServerParams();
            foreach (['http_client_ip', 'http_x_forward_for', 'x_real_ip', 'remote_addr'] as $key) {
                if (isset($params[$key]) && !strcasecmp($params[$key], 'unknown')) {
                    $ip = $params[$key];
                    break;
                }
            }
        }
        $this->assign['ip'] = $ip;
        return $ip;
    }

    //异常抛出
    public function onException(\Throwable $throwable): void
    {
        $path = $this->request()->getUri()->getPath();
        if($throwable->getMessage()=='Token format error!'){
            $this->AjaxJson(-1, [], "登录过期，请重新登录！");
        }else{
            $this->AjaxJson(0,['path'=>$path,'line'=>$throwable->getLine(),'file'=>$throwable->getFile()] ,'服务异常，请重试！');return;
        }

    }
    public function afterAction(?string $actionName): void
    {
        // 查看每次请求记录 http://host/index/tracker
        $point = \EasySwoole\Tracker\PointContext::getInstance()->startPoint();
        $point->end();
        $array = Point::toArray($point);
        $rsp = $this->response()->getBody();
        foreach ($array as $k=>$v){
            $data['ip'] = $this->getRealIp();
            $ip = new IpQuery();
            $ip_address = $ip->query($this->getRealIp());
            $address = $ip->getAddress($ip_address['pos']??'',$ip_address['isp']??'');
            $data['province'] =$address['province']??'';
            $data['city'] = $address['city']??'';
            $data['ip'] = $this->getRealIp();
            $data['user_id'] = $this->uid??1;
            $data['pointd'] = $v['pointId'];
            $data['pointName'] = $v['pointName']??'';
            $data['parentId'] = $v['parentId']??'';
            $data['broswer'] = $this->getClientBroswer()??'其他';
            $data['depth'] = $v['depth']??'';
            $data['isNext'] = $v['isNext']??'';
            $data['startTime'] = $v['startTime']??0;
            $data['endTime'] = $v['endTime']??0;
            $data['spendTime'] = $v['endTime']-$v['startTime'];
            $data['status'] = $v['status'];
            $data['result'] = json_encode($this->param,JSON_UNESCAPED_UNICODE);
            $data['data'] =$rsp->__tostring();
            $data['uri'] = $v['startArg']['uri'];
            $data['create_date'] = date('Y-m-d H:i:s',time());

//            $queue = MyQueue::getInstance();     // 获取队列
//            $job = new Job();      // 创建任务
//            $job->setJobData(json_encode($data,JSON_UNESCAPED_UNICODE));       // 设置任务数据
//            // 生产普通任务
//            $produceRes = $queue->producer()->push($job);
//            $log_contents = date('Y-m-d H:i:s').'：投递任务成功'.$produceRes;
//            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'tracker_process');
            $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
            // 投递异步任务
            $task->async(new \App\Task\Tracker($data));
        }
        parent::afterAction($actionName); // TODO: Change the autogenerated stub
    }
    /**
     * 获取客户端浏览器类型
     * @return string
     */
    public function getClientBroswer(){
        $user_agent=   $this->request()->getHeader('user-agent')[0];
        if (stripos($user_agent, "Firefox/") > 0) {
            return "Firefox";
        } elseif (stripos($user_agent, "Maxthon") > 0) {
            return "傲游";
        } elseif (stripos($user_agent, "MSIE") > 0) {
            return "IE";
        } elseif (stripos($user_agent, "OPR") > 0) {
            return "Opera";
        } elseif (stripos($user_agent, "Edg") > 0) {
            return "Edge";
        } elseif (stripos($user_agent, 'rv:') > 0 && stripos($user_agent, 'Gecko') > 0) {
            return "IE";
        } elseif (stripos($user_agent, 'MicroMessenger')>0) {
            return "微信";
        }else if(stripos($user_agent,'Safari')>0&&stripos($user_agent, "Chrome") == 0){
            return 'Safari';
        }else if(stripos($user_agent,'360')>0){
            return '360';
        }else if(stripos($user_agent,'QQBrowser')>0){
            return 'QQ';
        } elseif (stripos($user_agent, "Chrome") > 0) {
            return "Chrome";
        } else {
            return "其他";
        }

    }

    //获取用户客户端
    public function getUserClient($client = '')
    {
        if (empty($client)) {
            if ($this->client) {
                $client = $this->client;
            } else {
                $user_agent = strtolower($this->request()->getHeader('user-agent')[0] ?? '');
                //微信客户端
                if (!empty($user_agent) && strpos($user_agent, strtolower('MicroMessenger')) !== false) {
                    $referer = $this->request()->getHeaderLine('referer');
                    if (strpos($user_agent, "miniprogram") || strpos($referer, "servicewechat.com")) {
                        $client = '小程序';
                    } else {
                        $client = 'H5';
                    }
                } else if (strpos($user_agent, "uni-app") || strpos($user_agent, strtolower('Html5Plus'))) {          //判断是否为APP
                    if (strpos($user_agent, strtolower('Android')) !== false) {
                        $client = '安卓APP';
                    } else {
                        $client = '苹果APP';
                    }
                } else {
                    $client = 'H5';
                }
            }

        }
        return $client;
    }

}

