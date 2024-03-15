<?php

namespace App\HttpController\Index;

use App\HttpController\Common\Common;
use App\HttpController\Common\IpQuery;
use App\HttpController\Router;
use App\Model\SystemModel;
use EasySwoole\Component\Di;
use EasySwoole\Session\Context;
use EasySwoole\Template\Render;
use EasySwoole\Tracker\Point;



/**
 * BaseController
 * Class Base
 * Create With Automatic Generator
 */
abstract class Base extends \EasySwoole\Http\AbstractInterface\Controller
{
	public $public_action = [
        '/index',
        '/index/index',
        '/index/login/login',
        '/index/login/doLogin',
        '/index/login/getCode',
        '/index/api/getBastApi',
    ];
    public $param;  //请求参数
	public $ip;     //客户端IP
	public $system; //系统配置
	public $path;   //当前请求路径
	public $assign; //模板变量渲染
	public $pc;  //判断当前是手机端还是PC端
	public $host;  //获取当前域名
	public $host_name;  //获取当前域名
    public $autoLimiter;

    public function onRequest(?string $action): ?bool
	{
        if (!parent::onRequest($action)) {return false;}


       
        //合并请求参数
        $router_param = \EasySwoole\Component\Context\ContextManager::getInstance()->get(Router::PARSE_PARAMS_CONTEXT_KEY)??[];
        $this->param = array_merge($router_param,$this->request()->getRequestParam());
        foreach ($this->param as $k=>$v){
            $this->param[$k] = is_string($v)?filter_var($v,FILTER_SANITIZE_STRING):$v;
        }
        $http = $this->request()->getHeader('http')[0] ?? 'http';
        $host = $this->request()->getHeaders()['host'][0];
        $this->pc = $this->isMobile()?false:true;
        $this->host_name = $host;
        $this->host = $http . '://' . $host;
        $template = $this->isMobile()?'wap/':'';
        $path = $this->request()->getUri()->getPath()=='/index/index'?'index/index/index':$this->request()->getUri()->getPath();
        $this->path = $template.$path;
        $this->assign['host'] =$this->host;
        //初始化系统基本配置信息
        $this->assign = [
            'pc'=>$this->pc,
            'ip'=>$this->getRealIp(),
            'host'=>$this->host,
            'system'=>Common::getSystem(),
        ];

		return true;
	}
    public function actionNotFound(?string $action){
        $this->response()->redirect('/index');
        $this->error('你请求的页面不存在','/index');
        return true;
    }
    public function getWeek(){
        $weekarray=array("日","一","二","三","四","五","六");
        return "星期".$weekarray[date("w")];
    }
    //检测微信端
    public function isWeixin(){
        if (!empty($this->request()->getHeaders()['user-agent']) && strpos($this->request()->getHeaders()['user-agent'][0], 'MicroMessenger') !== false ) {
            return true;
        }
        return false;
    }
    /**
     * 检测PC手机端
     */
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
    //session配置
    protected function session(): ?Context
    {
        $sessionId = $this->request()->getAttribute('system_session');
        // 封装一个方法，方便我们快速获取 session context
        return \App\Tools\Session::getInstance()->create( $sessionId);
    }
    //获取系统配置信息
    protected function getSystem(){
        $system = Cache::getInstance()->get('system');
        if(empty($system)){
            $system = SystemModel::create()->where('id',1)->find();
            Cache::getInstance()->set('system',$system);
        }
        return $system;
    }

    /**
     * 校验验证码
     */
    protected function checkVerifyCode()
    {
        $image_code = $this->session()->get('image_code');
        if($image_code!=$this->param['code']){
            return false;
        }
        $this->session()->del('image_code');
        return true;
    }
    /**
     * 渲染模板
     */
	public function view($tpl,$data,$is_reload=0){
        if($is_reload){
            Render::getInstance()->restartWorker();
        }
        $this->response()->write(Render::getInstance()->render($tpl, $data));
        return true;
    }
    /**
     * 异常界面 error
     */
    public function error($message,$url=''){
        $this->response()->write('您访问的页面不存在');
        $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
        return false;
        $this->assign['msg'] = $message;
        $this->assign['url'] = $url;
        $this->response()->write(Render::getInstance()->render('/index/index/error', $this->assign));
        return false;
    }
    /**
     * 请求状态JSON返回
     */
	public function writeJson($statusCode = 200, $result = NULL, $msg = NULL)
    {
        if (!$this->response()->isEndResponse()) {
            $data = Array(
                "code" => $statusCode,
                "result" => $result,
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

    /**
     * AJAX请求JSON返回
     */
    public function AjaxJson($status=0,$data=[],$msg='success'){
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

    /**
     * 获取真实IP
     * @return string
     */
    public function getRealIp()
    {
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

    /**
     * 获取客户端浏览器类型
     * @return string
     */
    public function getClientBroswer(){
        $user_agent=   $this->request()->getHeader('user-agent')[0]??'';
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

    /**
     * 异常抛出
     **/
    public function onException(\Throwable $throwable): void
    {
        $path = $this->request()->getUri()->getPath();
        \EasySwoole\EasySwoole\Trigger::getInstance()->error("API异常：{$path}".$throwable->getMessage());
        if($this->request()->getServerParams()['request_method']=='GET'){
            $this->response()->write('<h1>'.$throwable->getMessage().'</h1>');
            $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
            $this->response()->withStatus(200);
            return ;
        }else{
            $this->writeJson(400,[],'请求异常');return;
        }
    }
    public function afterAction(?string $actionName): void
    {
        // 查看每次请求记录
        $point = \EasySwoole\Tracker\PointContext::getInstance()->startPoint();
        $point->end();
        $array = Point::toArray($point);
        $rsp = $this->response()->getBody();
        $params = $this->param;

        foreach ($array as $k=>$v){
            $data['ip'] = $this->getRealIp();
            $ip = new IpQuery();
            $ip_address = $ip->query($this->getRealIp());
            $address = $ip->getAddress($ip_address['pos']??'',$ip_address['isp']??'');
            $data['province'] =$address['province']??'';
            $data['city'] = $address['city']??'';
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
            $data['result'] = json_encode($params,JSON_UNESCAPED_UNICODE);
            $data['data'] =strpos($rsp->__tostring(),'</html>')?'渲染HTML页面':$rsp->__tostring();
            $data['uri'] = $v['startArg']['uri'];
            $data['create_date'] = date('Y-m-d H:i:s',time());
//            TrackerPointModel::create()->data($data, false)->save();
            $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
            // 投递异步任务
            $task->async(new \App\Task\Tracker($data));
        }
        parent::afterAction($actionName); // TODO: Change the autogenerated stub
    }
}

