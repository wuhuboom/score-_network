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
use App\Model\OrderModel;
use App\Model\OrderSettlementModel;
use App\Model\ShopModel;
use App\Model\UserMemberModel;
use App\Model\UserModel;
use App\Model\WechatGroupQrCodeModel;
use App\Service\ProductService;
use App\Utility\MyQueue;
use App\Model\ApiGroupModel;
use App\Model\ApiModel;
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
        $product =ProductService::create()->joinSelectList(['status'=>[[2,3],'in']],'p.*,v.name  as vip_name,v.level');
        $this->assign['product'] = $product['list'];
        $this->view('index/index/index',$this->assign);
    }
    //首页
    public function home()
    {
        $product =ProductService::create()->joinSelectList(['status'=>[[2,3],'in']],'p.*,v.name  as vip_name,v.level');
        $this->assign['product'] = $product['list'];
        $this->view('index/index/home',$this->assign);
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
  







}

