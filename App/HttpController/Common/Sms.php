<?php

namespace App\HttpController\Common;

use App\Log\LogHandler;
use App\Model\SmsModel;
use App\Model\SmsTemplateModel;
use App\Model\SystemModel;
use EasySwoole\EasySwoole\Config;
use EasySwoole\FastCache\Cache;
use phpDocumentor\Reflection\Types\Self_;

/**
 * @todo    短信类
 * @version    v1.0.0
 */
class Sms
{
    /**
     * 发送登录验证码
     * @param $tel
     * @param $code
     * @param $ip
     * @param $type
     *
     * return bool || string
     */
    static public function sendLoginCode($tel, $code, $ip ,$minute=0)
    {
        try {
            $minute = $minute > 0 ? $minute : 15;
            if (!Regex::is_mobile($tel)) {
                return '请输入正确的手机号！';
            }
            $type    = 'login_code';
            $history = SmsModel::create()->where('tel', $tel)->where('status', 1)->where('type', $type)->order('id', 'DESC')->find();
            if ($history) {
                $create_time = strtotime($history['create_time']);
                if ($create_time + 60 > time() && $history['is_check'] == 0) {//60*15
                    return "验证码已发送，{$minute}分钟内有效，请勿重复获取！";
                }
            }
            //单个IP限制每天可发送次数
            if (SmsModel::create()->where('ip', $ip)->where('status', 1)->where('create_time', date('Y-m-d') . ' 00:00:00', '>=')->count() > 10) {
                return '今日获取验证码次数已超上限！';
            }
            return true;
            $time   = time() + $minute * 60;
            $result = Self::sendSms($type, $tel, [$code, $minute], $time, $ip);
            return $result;
        } catch (\Exception $e) {
            return '短信服务异常'.$e->getMessage();
        }
    }

    /**
     * 发送注册验证码
     * @param $tel
     * @param $code
     * @param $ip
     * @param $type
     *
     * return bool || string
     */
    static public function sendRegisterCode($tel, $code, $ip ,$minute=0)
    {
        try {
            $minute = $minute > 0 ? $minute : 15;
            if (!Regex::is_mobile($tel)) {
                return '请输入正确的手机号！';
            }
            $type    = 'register_code';
            $history = SmsModel::create()->where('tel', $tel)->where('status', 1)->where('type', $type)->order('id', 'DESC')->find();
            if ($history) {
                $create_time = strtotime($history['create_time']);
                if ($create_time + 60 > time() && $history['is_check'] == 0) {//60*15
                    return "验证码已发送，{$minute}分钟内有效，请勿重复获取！";
                }
            }
            //单个IP限制每天可发送次数
            if (SmsModel::create()->where('ip', $ip)->where('status', 1)->where('create_time', date('Y-m-d') . ' 00:00:00', '>=')->count() > 10) {
                return '今日获取验证码次数已超上限！';
            }
            $time   = time() + $minute * 60;
            $result = Self::sendSms($type, $tel, [$code, $minute], $time, $ip);
            return $result;
        } catch (\Exception $e) {
            return '短信服务异常';
        }
    }

    /**
     * 发送操作验证码
     * @param $tel
     * @param $code
     * @param $ip
     * @param $type
     *
     * return bool || string
     */
    static public function sendHandleCode($tel, $code, $ip, $minute = 0)
    {
        try {
            $minute = $minute > 0 ? $minute : 15;
            if (!Regex::is_mobile($tel)) {
                return '请输入正确的手机号！';
            }
            $type    = 'handle_code';
            $history = SmsModel::create()->where('tel', $tel)->where('status', 1)->where('type', $type)->order('id', 'DESC')->find();
            if ($history) {
                $create_time = strtotime($history['create_time']);
                if ($create_time + 60 > time() && $history['is_check'] == 0) {//60*15
                    return "验证码已发送，{$minute}分钟内有效，请勿重复获取！";
                }
            }
            //单个IP限制每天可发送次数
            if (SmsModel::create()->where('ip', $ip)->where('status', 1)->where('create_time', date('Y-m-d') . ' 00:00:00', '>=')->count() > 10) {
                return '今日获取验证码次数已超上限！';
            }
            $time   = time() + $minute * 60;
            $result = Self::sendSms($type, $tel, [$code, $minute], $time, $ip);
            return $result;
        } catch (\Exception $e) {
            return '短信服务异常';
        }
    }


    //检测验证码是否有效
    static public function checkSmsCode($tel, $code,$type)
    {
        //测试验证码88888888 无需验证
        if ($code == '88888888') {
            return true;
        }
        if (empty($code)) {
            return '验证码必须';
        }
        $sms = SmsModel::create()->where('tel', $tel)->where('type', $type)->order('id', 'desc')->find();
        if (empty($sms)) {
            return '请先获取验证码！';
        }
        if ($sms['is_check'] == 1) {
            return '验证码已失效，请重新获取';
        }
        $expire_time = strtotime($sms['expire_time']);
        if ($expire_time < time()) {
            return '验证码已过期';
        }
        if ($sms['code'] != $code) {
            return '验证码不正确';
        }
        SmsModel::create()->where('id', $sms['id'])->update(['is_check' => 1]);
        return true;
    }
    //发送短信
    static public function sendSms($type,$tel,$param,$time,$ip){
        try {
            $config = Self::getTemplateConfig($type);
            if (empty($config)) {
                $log_contents = date('Y-m-d H:i:s').'：'."未配置短信模板：{$type}";
                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'sms_send');
                return '短信服务异常';
            }
            $smsSender = new \Qcloud\Sms\SmsSingleSender($config['appid'], $config['appkey']);
            // 签名参数未提供或者为空时，会使用默认签名发送短信
            $result     = $smsSender->sendWithParam("86", $tel, $config['template_id'], $param, $config['sign'], "", "");
            $rsp        = json_decode($result, true);

            //获取IP信息
            $IpQuery    = new IpQuery();
            $ip_address = $IpQuery->query($ip);
            $address    = $IpQuery->getAddress($ip_address['pos'], $ip_address['isp']);

            //发送记录保存
            $data['type']        = $type;
            $data['tel']         = $tel;
            $data['code']        = $param[0];
            $data['ip']          = $ip;
            $data['province']    = $address['province'] ?? '';
            $data['city']        = $address['city'] ?? '';
            $data['expire_time'] = date('Y-m-d H:i:s', $time); //15分钟失效
            $data['create_time'] = date('Y-m-d H:i:s', time());//15分钟失效
            $data['error_msg']   = $rsp['errmsg'] ?? '';
            $data['status']      = $rsp['result'] === 0 && $rsp['errmsg'] === 'OK' ? 1 : 0;

            //生成短信内容
            $contents            = $config['contents'] ?? '';
            foreach ($param as $k=>$v){
                $number = $k+1;
                $contents = str_replace('{'.$number.'}',$v,$contents);
            }
            $data['contents']    = $contents;
            SmsModel::create()->data($data)->save();
            $log_contents = date('Y-m-d H:i:s').'：'."短信发送成功：".json_encode($data,JSON_UNESCAPED_UNICODE);
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'sms_send');
            return $data['status']==1?true:$data['error_msg'];
        }catch (\Throwable $e){
            $log_contents = date('Y-m-d H:i:s').'：'."短信发送失败：{$e->getMessage()}";
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'sms_send');
            return '短信服务异常';
        }

    }
    //获取对应的信息模板配置
    static public function getTemplateConfig($type){
        $config = SmsTemplateModel::create()->where('type',$type)->where('status',1)->find();
        return $config??[];
    }

}

