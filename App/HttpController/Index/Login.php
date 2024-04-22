<?php

namespace App\HttpController\Index;


use App\HttpController\Common\Common;
use App\HttpController\Common\Invite;
use App\HttpController\Common\IpQuery;
use App\HttpController\Common\Regex;
use App\HttpController\Common\Sms;
use App\Service\UserLogService;
use App\Service\UserService;
use EasySwoole\FastCache\Cache;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

/**
 * Class Users
 * Create With Automatic Generator
 */
class Login extends Base
{
    //退出
    public function logout()
    {
        $this->session()->set('user',null);
        $this->response()->redirect('/login');
    }

    //登录
    public function login()
    {
        $this->view('index/login/login',$this->assign);
    }

    //用户登录
    public function doLogin(){
        $data['username'] = $this->param['username']??'';
        $data['password'] = $this->param['password']??'';
        $result = UserService::create()->validateData($data,'login');
        if($result!==true) {
            $this->AjaxJson(0,$this->param,$result);return false;
        }
        $user  = UserService::create()->usernameByUser($data['username']);
        if(empty($user)){
	        $msg = $this->lang=='Cn'?'此手机号暂未注册':'Mobile number not yet registered';
	        $this->AjaxJson(0, [], $msg);return false;
        }
	    if($user['status']!=1){
		    $msg = $this->lang=='Cn'?'您的账号异常，禁止登录！':'Your account is abnormal, login prohibited!';
		    $this->AjaxJson(0, [], $msg);return false;
	    }
        if(Common::passwordVerify($data['password'], $user['password'])!==true){
	        $msg = $this->lang=='Cn'?'对不起，你的密码不正确！':'Sorry, your password is incorrect';
	        $this->AjaxJson(0, [], $msg);return false;
        }
        $data = [
            'last_login_ip'   => $this->getRealIp(),
            'last_login_time' => date('Y-m-d H:i:s'),
        ];
        $user_res = UserService::create()->update($user['id'], $data);
        $user['last_login_ip']   = $data['last_login_ip'];
        $user['last_login_time'] = $data['last_login_time'];
        $user['login_time'] = time();
        $this->session()->set('user',$user);
	    $ip = new IpQuery();
	    $ip_address = $ip->query($this->getRealIp());
	    $address = $ip->getAddress($ip_address['pos']??'',$ip_address['isp']??'');
	    $user_log['ip'] = $this->getRealIp();
	    $user_log['address'] = $ip_address['pos']??'';
	    $user_log['province'] =$address['province']??'';
	    $user_log['city'] = $address['city']??'';
	    $user_log['user_id'] = $user['id'];
	    $user_log['create_time'] = date('Y-m-d H:i:s');
	    UserLogService::create()->save($user_log);
	    $msg = $this->lang=='Cn'?'登录成功！':'Login successful';
        $this->AjaxJson(1,[$user_res],$msg);
    }

    //注册 register
    public function register(){
        if($this->request()->getMethod()=='POST'){
	        try {
		        $data = [];
		        $data['username'] = $this->param['username']??'';
		        $data['code'] = $this->param['code']??'';
		        $data['password'] = $this->param['password']??'';
		        $data['invitation_code'] = $this->param['invitation_code']?$this->param['invitation_code']:$this->session()->get('invitation_code')??'';

		        $result = UserService::create()->validateData($data,'register');
		        if($result!==true) {
			        $this->AjaxJson(0,$data,$result);return false;
		        }
                if($data['code'] !=Cache::getInstance()->get('otp_'.$data['username'])){
                    $msg = $this->lang=='Cn'?'对不起，您输入验证码不正确！':'Sorry, you entered the verification code incorrectly!';
                    $this->AjaxJson(0, [], $msg);return false;
                }
//		        $res = Sms::checkSmsCode($data['username'],$data['code'],'register');
//		        if($res!==true){
//		        	$msg = $this->lang=='Cn'?'对不起，您输入验证码不正确！':'Sorry, you entered the verification code incorrectly!';
//			        $this->AjaxJson(0, [], $msg);return false;
//		        }
		        $parent = UserService::create()->getOne(['invitation_code'=>$data['invitation_code']??'']);
		        $data['parent_id'] = $parent['id']??0;
		        $data['parent_parent_id'] = $parent['parent_id']??0;
		        $data['parent_parent_parent_id'] = $parent['parent_parent_id']??0;
		        $data['avatar'] = '/public/uploads/user/avatar.png';

		        $data['agent_id'] = $parent['agent_id']??0;

		        $data['employee_id'] = $parent['employee_id']??0;
		        $data['invitation_code'] = Common::getRandomStr(5);
		        while (UserService::create()->getOne(['invitation_code'=>$data['invitation_code']])){
			        $data['invitation_code'] = Common::getRandomStr(5);
		        }

		        if(UserService::create()->getOne(['username'=>$data['username']])){
			        $msg = $this->lang=='Cn'?'此手机号已经注册':'This phone number has already been registered';
			        $this->AjaxJson(0, [], $msg);return false;
		        }
		        if(strlen($data['username'])!=10){
			        $msg = $this->lang=='Cn'?'请输入正确的10位手机号':'Please enter the correct 10 digit phone number';
			        $this->AjaxJson(0, [], $msg);return false;
		        }
		        if(strlen($data['password'])>12||strlen($data['password'])<6){
			        $msg = $this->lang=='Cn'?'请输入6-12位的密码':'Please enter a password of 6-12 digits';
			        $this->AjaxJson(0, [], $msg);return false;
		        }

		        $data['password'] = Common::hashPassword($data['password']);
		        $data['create_time'] = date('Y-m-d H:i:s');
		        $data['update_time'] = date('Y-m-d H:i:s');
		        if($insert_id = UserService::create()->save($data)){
		        	//注册奖励
		        	\App\HttpController\Common\User::registerGive($insert_id);
			        //邀请注册奖励
			        Invite::registerReward($insert_id);
			        $msg = $this->lang=='Cn'?'恭喜你，注册账号成功！':'Congratulations, registration successful';
			        //Congratulations, registration successful
			        $this->AjaxJson(1, ['status'=>1,$parent['agent_id'],$parent['employee_id']], $msg);return false;
		        }else{
		        	//
			        $msg = $this->lang=='Cn'?'对不起，注册失败请重试！':'Sorry, registration failed. Please try again!';
			        $this->AjaxJson(0, ['status'=>0], $msg);return false;
		        }
	        }catch (\Throwable $e){
		        $msg = $this->lang=='Cn'?'对不起，注册失败请重试！':'Sorry, registration failed. Please try again!';
		        $this->AjaxJson(0, [$e->getTrace(),$e->getMessage()], $msg);return false;
	        }

        }else{
            $this->view('index/login/register',$this->assign);
        }

    }

    //找回密码
    public function forget(){
        if($this->request()->getMethod()=='POST'){
            $data = [];
            $data['username'] =   (string)$this->param['username']??'';
            $data['code'] = $this->param['code']??'';
            $data['password'] = $this->param['password']??'';
            if(empty($data['username'])){
                $msg = $this->lang=='Cn'?'请输入您的账号！':'Please enter your account!';
                $this->AjaxJson(0, [], $msg);return false;
            }
            if(empty($data['password'])){
                $msg = $this->lang=='Cn'?'请输入您的新密码！':'Please enter your new password!';
                $this->AjaxJson(0, [], $msg);return false;
            }
            if(empty($data['code'])){
                $msg = $this->lang=='Cn'?'请输入验证码！':'Please enter the verification code!';
                $this->AjaxJson(0, [], $msg);return false;
            }

            $otp_code = Cache::getInstance()->get('otp_'.$data['username']);
            if($data['code'] !=$otp_code){
                $msg = $this->lang=='Cn'?'对不起，您输入验证码不正确！':'Sorry, you entered the verification code incorrectly!';
                $this->AjaxJson(0, [], $msg);return false;
            }
//            $res = Sms::checkSmsCode($data['tel'],$data['code'],'forget');
//            if($res!==true){
//	            $msg = $this->lang=='Cn'?'对不起，您输入验证码不正确！':'Sorry, you entered the verification code incorrectly!';
//	            $this->AjaxJson(0, ['status'=>0], $msg);return false;
//
//            }
            if(strlen($data['username'])!=10){
	            $msg = $this->lang=='Cn'?'请输入正确的10位手机号':'Please enter the correct 10 digit phone number';
	            $this->AjaxJson(0, ['status'=>0], $msg);return false;
            }
            if(strlen($data['password'])>12||strlen($data['password'])<6){
	            $msg = $this->lang=='Cn'?'请输入6-12位的密码':'Please enter a password of 6-12 digits';
	            $this->AjaxJson(0, ['status'=>0], $msg);return false;
            }
            $user = UserService::create()->getOne(['username'=>$data['username']]);
            if(empty($user)){
	            $msg = $this->lang=='Cn'?'此手机号暂未注册':'This phone number has not been registered yet';
	            $this->AjaxJson(0, ['status'=>0], $msg);return false;
            }
            $data['password'] = Common::hashPassword($data['password']);
            $data['update_time'] = date('Y-m-d H:i:s');
            if(UserService::create()->update($user['id'],$data)){
	            $msg = $this->lang=='Cn'?'恭喜你，重设密码成功！':'Congratulations, password reset successful!';
	            $this->AjaxJson(1, ['status'=>0], $msg);return false;
            }else{
	            $msg = $this->lang=='Cn'?'对不起，重设密码失败！':'Sorry, resetting password failed';
	            $this->AjaxJson(0, ['status'=>0], $msg);return false;
            }
        }else{
            $this->view('index/login/forget',$this->assign);
        }

    }

    /**
     * 获取Otp验证码
     */
    public function sendSms(){
        if($this->request()->getMethod()=='POST'){

            if (empty($this->param['tel'])) {//||!Regex::is_mobile($this->param['tel'])
                $msg = $this->lang == 'Cn' ? '请输入正确的手机号！' : 'Please enter the correct phone number';
                $this->AjaxJson(0, ['status' => 0], $msg);
                return false;
            }
            $tel = (string) $this->param['tel']??'';
            $otp = rand(100000, 999999);
            Cache::getInstance()->set('otp_' . $tel, $otp); //, 1800
            $otp_code = Cache::getInstance()->get('otp_'.$tel);
            $this->AjaxJson(1, ['otp' => $otp], 'sms send successfully');
            return false;
        }else{
            $this->AjaxJson(0,[],'Access error');return  false;
        }

    }

    /**
     * 获取手机验证码
     */
    public function getCode(){
        if($this->request()->getMethod()=='POST'){
            if (empty($this->param['tel'])) {//||!Regex::is_mobile($this->param['tel'])
                $msg = $this->lang=='Cn'?'请输入正确的手机号！':'Please enter the correct phone number';
                $this->AjaxJson(0, ['status'=>0], $msg);return false;
            }
//            if (empty($this->param['image_code'])) {
//                $this->AjaxJson(0, [], '图片验证码必须填写');return false;
//            }
//            $image_code = Cache::getInstance()->get('image_code_'.$this->param['tel']);
//            if($image_code!=$this->param['image_code']){
//                $this->AjaxJson(0, [$image_code,$this->param['image_code']], '图片验证码不正确，请刷新后重新');return false;
//            }
            $this->AjaxJson(1,[],'验证码88888888已发送');return  false;
            $code   = rand(100000, 999999);
            $minute = 15;
            $res    = Sms::sendLoginCode($this->param['tel'], $code, $this->getRealIp(), $minute);
            if($res===true){
                $msg = $this->lang=='Cn'?'验证码已发送，10分钟内有效！':'The verification code has been sent and is valid for 10 minutes!';
                $this->AjaxJson(1, [], $msg);return false;

            }else{
                $msg = $this->lang=='Cn'?'验证码发送失败！':'Verification code sending failed!';
                $this->AjaxJson(0,[$res],$msg);return  false;
            }
        }else{
            $this->AjaxJson(0,[],'Access error');return  false;
        }

    }
}

