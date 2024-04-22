<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\IpQuery;
use App\HttpController\Router;
use App\Log\LogHandler;
use App\Model\AdminsHandleLogModel;
use App\Model\AdminsHandleLogResultModel;
use App\Model\AdminsModel;
use App\Model\AuthRuleModel;
use App\Model\ResellerModel;
use App\Model\TrackerPoint\TrackerPointModel;
use EasySwoole\Component\Di;
use EasySwoole\EasySwoole\Config;
use EasySwoole\FastCache\Cache;
use EasySwoole\Jwt\Jwt;
use EasySwoole\Tracker\Point;
use EasySwoole\Tracker\PointContext;
use EasySwoole\Validate\Validate;

/**
 * BaseController
 * Class Base
 * Create With Automatic Generator
 */
abstract class Base extends \EasySwoole\Http\AbstractInterface\Controller
{
    public $basicAction = [

        'admin/admins/getBindOpenidUrl',
        'admin/admins/info',
        'admin/admins/bindOpenid',
        'admin/admins/getBindTemplateOpenidUrl',
        'admin/auths/get_menu',
        'admin/auths/getApiList',
        'admin/category/upload',
        'admin/system/getSystem',
        'admin/system/getSystemName',
        'admin/system/upload',
        'admin/login/wechatLogin',
        'admin/login/LoginWechatLoginUrl',
        'admin/login/wechatScanLogin',
        'admin/login/login',
        'admin/login/verifyCode',
        'admin/login/updatePassword',
        'admin/officialAccount/getServerIP',
        'admin/officialAccount/getCustomerIP',
        //数据统计
        'admin/chart/getTopData',
        'admin/chart/getCategoryShopData',
        'admin/chart/getUserTypeData',
        'admin/chart/getUserPlatformData',
        'admin/chart/getShopOrderRank',
        'admin/chart/getSalesShopRank',
        'admin/chart/getOrderCheckRank',
        'admin/chart/getPromotionRank',
        'admin/chart/getUserDistribution',
        'admin/chart/getUserData',
        'admin/chart/getOrderData',
        'admin/UserBalanceDetails/expUser',
        'admin/area/all',

    ];
    protected $token;
    protected $page=1;
    protected $limit=20;
    protected $reseller_id=0;
    protected $agent_id=0;
    protected $employee_id=0;
    protected $is_primary=0;
    protected $uid=0;
    protected $username;
    protected $host;
    protected $param;
    protected $token_data;

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
        $http = $this->request()->getHeader('http')[0]??'http';
        $this->host = $http.'://'.$this->request()->getHeaders()['host'][0];
        $path = $this->request()->getUri()->getPath();
        $this->page = $this->param['page']??$this->page;
        $this->limit = $this->param['limit']??$this->limit;
        // basic列表里的不需要验证
        if (!in_array(strtolower(str_replace('/admin/','admin/',$path)),array_map('strtolower',$this->basicAction))){ //in_array($path, $this->basicAction)
            // 必须有token
            if (empty( $this->request()->getHeader('token')[0] )){
                $this->writeJson(\EasySwoole\Http\Message\Status::CODE_UNAUTHORIZED, [$path,$this->basicAction], "登录token不可为空");
                return false;
            }

            $config    = Config::getInstance();
            $jwtConfig = $config->getConf('JWT');
            $jwtObject = Jwt::getInstance()->setSecretKey($jwtConfig['key'])->decode($this->request()->getHeader('token')[0]);
            $status = $jwtObject->getStatus();
            // 如果encode设置了秘钥,decode 的时候要指定
            switch ($status)
            {
                case  1:
                    $this->token = $jwtObject->getData();
                    $data = $jwtObject->getData();
                    $this->uid = $data['uid'];
                    $this->username = $data['name'];
                    $this->employee_id = $data['employee_id']??0;
                    $this->agent_id = $data['agent_id']??0;
                    $this->reseller_id = $data['reseller_id']??0;
                    $this->is_primary = $data['uid']==1||$data['is_primary']==1?1:0;
                    if(empty($data['client_ip'])||$data['client_ip']!=$this->getRealIp()){
                        $this->writeJson(\EasySwoole\Http\Message\Status::CODE_UNAUTHORIZED, new \stdClass(), "登录过期，请重新登录！");
                        return false;
                        break;
                    }
                    //检测是否是非法token
                    $check_result = $this->checkAdmin($data);
                    if($check_result!==true){
                        $this->writeJson(\EasySwoole\Http\Message\Status::CODE_UNAUTHORIZED, [], "登录过期，请重新登录！");
                        return false;
                    }
//                    $this->autoLimiter = Di::getInstance()->get('auto_limiter');
//                    $access_token = $this->getRealIp().$path.$this->uid;
//                    if (!$this->autoLimiter->access($access_token, 1)){
//                        $this->writeJson(400, [$this->autoLimiter->qps($access_token),$path], "当前操作太过频繁!");
//                        return false;
//                    }
                    break;
                case  -1:
                    $this->writeJson(\EasySwoole\Http\Message\Status::CODE_UNAUTHORIZED, new \stdClass(), "登录令牌无效");
                    return false;
                    break;
                case  -2:
                    $this->writeJson(\EasySwoole\Http\Message\Status::CODE_UNAUTHORIZED, new \stdClass(), "登录过期，请重新登录！");
                    return false;
                    break;
            }

            if (!is_array($this->token) || empty($this->token)){
                $this->writeJson(\EasySwoole\Http\Message\Status::CODE_UNAUTHORIZED, new \stdClass(), "登录令牌解析失败:".$this->token);
                return false;
            }
            if($this->uid!=1&&!$this->authorization()){
                $this->writeJson(400, \App\HttpController\Common\Auth::getAdminRules($this->uid), "对不起，您没有访问权限:".$this->request()->getUri()->getPath());
                return false;
            }
        }else{
            $config    = Config::getInstance();
            $jwtConfig = $config->getConf('JWT');
            $token = $this->request()->getHeader('token')[0]??'';
            if($token){
                $jwtObject = Jwt::getInstance()->setSecretKey($jwtConfig['key'])->decode($token);
                $status = $jwtObject->getStatus();
                // 如果encode设置了秘钥,decode 的时候要指定
                switch ($status)
                {
                    case  1:
                        $this->token = $jwtObject->getData();
                        $data = $jwtObject->getData();
                        $this->uid = $data['uid'];
                        $this->username = $data['name'];
                        $this->reseller_id = $data['reseller_id'];
	                    $this->employee_id = $data['employee_id']??0;
	                    $this->agent_id = $data['agent_id']??0;
                        $this->is_primary = $data['uid']==1||$data['is_primary']==1?1:0;
                        break;
                    case  -1:
                        $this->writeJson(\EasySwoole\Http\Message\Status::CODE_UNAUTHORIZED, [], "登录令牌无效");
                        return false;
                        break;
                    case  -2:
                        if(strtolower('admin/login/login')!==strtolower($path)){
                            $this->writeJson(\EasySwoole\Http\Message\Status::CODE_UNAUTHORIZED, [], "登录过期，请重新登录！");
                            return false;
                        }
                        break;
                }
            }
        }

        return true;
    }

    //检测用户状态
    public function checkAdmin($data){
        $admin = Cache::getInstance()->get('admin_info_'.$this->uid);
        if(empty($admin)){
            $admin = AdminsModel::create()->where('uid',$this->uid)->find();
            if(!empty($admin)){
                Cache::getInstance()->set('admin_info_'.$this->uid,$admin,300);
            }
        }
        if(empty($admin)||$admin['username']!=$data['name']||$admin['password']!=$data['password']){
            return [$admin,$data];
        }
        return true;
    }

    //表格导出
    protected function excelExp($th,$data,$file_name='test.xlsx',$ext='xlsx'){
        $data = array_merge($th,$data);
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(16); //默认行高
        $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);   //默认列宽

        $spreadsheet->getActiveSheet()->fromArray($data);
        switch ($ext){
            case 'xlsx':  $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);break;
            case 'csv':  $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);break;
            case 'xls':  $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);break;
            default: $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        }
        $writer->setPreCalculateFormulas(false);
//        if(!file_exists(EASYSWOOLE_ROOT.'/public/uploads/excel/'.$file_name)){
//            $file = fopen(EASYSWOOLE_ROOT.'/public/uploads/excel/'.$file_name, "w");
//            fclose($file);
//        }
        //这里可以写绝对路径，其他框架到这步就结束了
        $writer->save(EASYSWOOLE_ROOT.'/public/uploads/excel/'.$file_name);
        //关闭连接，销毁变量
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        return true;
    }

    /**
     * 获取查询排序
     */
    public function getOrderBy()
    {
        $order = ['field' => 'id', 'sort' => 'desc'];
        if (!empty($this->param['table_order'])) {
            $exp = explode('|', $this->param['table_order']);
            $order = ['field' => $exp[0] ?? 'id', 'sort' => $exp[1] ?? 'desc'];
        }
        return $order;
    }
    /**
     * 获取当前账号的代理商
     */
    public function getAgentId(){
		if($this->uid ==1){
			return false;
		}else{
			if($this->agent_id){
				if($this->is_primary==1){
					return false;
				}else{
					return $this->agent_id;
				}
			}
			return false;
		}

    }
	/**
	 * 获取当前账号的员工ID
	 */
	public function getEmployeeId(){
		if($this->uid ==1){
			return false;
		}else{
			if($this->employee_id){
				if($this->is_primary==1){
					return false;
				}else{
					return $this->employee_id;
				}
			}
			return false;
		}

	}
    /**
     * 获取我的运营商ID
     */
    public function getMyResellerIds(){
        $reseller_ids = Cache::getInstance()->get('my_reseller_ids_'.$this->uid);
        if(!$reseller_ids){
            if($this->uid==1){
                $reseller_ids = ResellerModel::create()->column('id');
            }else{
                $reseller_ids = AdminsModel::create()->where('uid',$this->uid)->val('reseller_ids');
            }
            Cache::getInstance()->set('my_reseller_ids_'.$this->uid,$reseller_ids,300);
        }
        return $reseller_ids;
    }
    //请求状态JSON返回
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
            return true;
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
//                "data" => $data,
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

    public function getRealIp(){
        // 真实IP
        $ip = '';
        if (count($this->request()->getHeader('x-real-ip'))) {
            if(!empty($this->request()->getHeader('x-forwarded-for')[0])){
                $ip = explode(',',$this->request()->getHeader('x-forwarded-for')[0])[0];
            }
            $ip = $ip??$this->request()->getHeader('x-real-ip')[0];
        } else {
            $params = $this->request()->getServerParams();
            foreach (['http_client_ip', 'http_x_forward_for', 'x_real_ip', 'remote_addr'] as $key) {
                if (isset($params[$key]) && !strcasecmp($params[$key], 'unknown')) {
                    $ip = $params[$key];
                    break;
                }
            }
        }
        return $ip;
    }

    /**
     * 获取方法名称
     */
    protected function getPathName($path){
        $list = $this->getRules();
        $list = json_decode(json_encode($list),1);
        $search=$path;
        $r = array_filter($list, function($t) use ($search) { return strtolower('/'.$t['method']) == strtolower($search); });
        $name = $path;
        if(is_array($r)&&$r){
            $r = array_values($r);
            $name = $r[0]['name'];
        }
        return $name;
    }

    protected function getRules(){
        $list = Cache::getInstance()->get('rules');
        if(empty($list)){
            $list = AuthRuleModel::create()->field('id,name,method,is_validate')->select();
            Cache::getInstance()->set('rules',$list,3600);
        }
        return $list;
    }

    /**
     * 获取我的权限列表
     */
    protected function getMyRules(){
        $list = Cache::getInstance()->get('user_rules_'.$this->uid);
        if(empty($list)){
            $list = AuthRuleModel::create()->field('id,name,method,is_validate')->select();
            Cache::getInstance()->set('rules',$list,3600);
        }
        return $list;
    }

    /**
     * 权限验证码
     */
    protected function authorization($search = ''){
        $list =  \App\HttpController\Common\Auth::getAdminRules($this->uid);;
        $search=$search?$search:$this->request()->getUri()->getPath();
        if($list){
            $r = array_filter($list, function($t) use ($search) {
                return strtolower('/'.$t) == strtolower($search);
            });
            if(is_array($r)&&$r){
                return true;
            }
            return false;
        }

        return false;
    }
    /**
     * 操作记录
     * @param string $actionName
     */
    public function afterAction(?string $actionName): void
    {
        $path = $this->request()->getUri()->getPath();
        if (!in_array(strtolower($path),array_map('strtolower',$this->basicAction))){
            //查看每次请求记录
            $point = PointContext::getInstance()->startPoint();
            $point->end();
            $array = Point::toArray($point);
            $rsp = $this->response()->getBody();
            foreach ($array as $k=>$v){
                $data['ip'] = $this->getRealIp();
                $ip = new IpQuery();
                $ip_address = $ip->query($this->getRealIp());
                $address = $ip->getAddress($ip_address['pos'],$ip_address['isp']);
                $data['province'] =$address['province']??'';
                $data['city'] = $address['city']??'';
                $data['uid'] = $this->uid??0;
                $data['username'] = $this->username??'';
                $data['action_path'] = $this->request()->getUri()->getPath();
                $data['action_name'] = $this->getPathName($data['action_path']);
                $data['spend_time'] = $v['endTime']-$v['startTime'];
                $data['request_data'] = json_encode($this->param,JSON_UNESCAPED_UNICODE);
                $data['response_data'] = $rsp->__tostring();
                $data['create_time'] = date('Y-m-d H:i:s');
                $uri = $v['startArg']['uri'];
                if(strpos($uri,'chart')||strpos($uri,'tracker')||strpos($uri,'menu')||strpos($uri,'handle')||strpos($uri,'common')){
                    //过滤index/tracker和index/getTracker这两个方法
                }else{

                    go(function ()use($data){
                        $insert_id = AdminsHandleLogModel::create()->data($data, false)->save();
                        AdminsHandleLogResultModel::create()->data(['response_data'=>$data['response_data'],'tracker_id'=>$insert_id])->save();
                    });

                }
            }
        }

        //parent::afterAction($actionName); // TODO: Change the autogenerated stub
    }

    /**
     * 异常抛出
     **/
    public function onException(\Throwable $throwable): void
    {
        $path = $this->request()->getUri()->getPath();
        $this->writeJson(\EasySwoole\Http\Message\Status::CODE_INTERNAL_SERVER_ERROR,$this->param, "服务异常：操作". $path.' 提示'.$throwable->getMessage());
        //记录错误信息,等级为FatalError
        \EasySwoole\EasySwoole\Trigger::getInstance()->error("API异常：{$path}".$throwable->getMessage());
    }

//    abstract protected function getValidateRule(?string $action): ?Validate;
}

