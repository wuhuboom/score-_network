<?php

namespace App\HttpController\Admin;


use App\HttpController\Common\Common;
use App\Model\AdminsModel;
use App\Model\AuthGroupAccessModel;
use App\Model\AuthGroupModel;
use App\Model\RepresentModel;
use App\Model\ResellerModel;
use EasySwoole\FastCache\Cache;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\WeChat\Factory;

/**
 * Class Users
 * Create With Automatic Generator
 */
class Admins extends \App\HttpController\Admin\Base
{
    /**
     * 文章列表
     */
    public function lists(){
        $param = $this->request()->getRequestParam();
        $page = (int)($param['page']??1);
        $limit = (int)($param['limit']??20);
        $model = AdminsModel::create();

        $model->where('uid',1,'<>');
        if(!empty($this->param['username'])){ $model->where('username','%'.$this->param['username'].'%','like'); }
        if(!empty($this->param['realname'])){ $model->where('realname','%'.$this->param['realname'].'%','like'); }
        if(!empty($this->param['tel'])){ $model->where('tel','%'.$this->param['tel'].'%','like'); }

        $field = "uid,username,realname,id_card,tel,status,avatar,reseller_id,reseller_ids,is_primary,create_time,update_time";
        $list = $model->withTotalCount()->order('uid', 'DESC')->field($field)->limit($limit * ($page - 1), $limit)->all();
        $total = $model->lastQueryResult()->getTotalCount();;

        foreach ($list as $k=>$v){
            $list[$k]['identity'] = AuthGroupModel::create()->alias('g')
                                                  ->join('td_auth_group_access c','c.group_id=.g.id','LEFT')
                                                  ->where('c.uid',$v['uid'])
                                                  ->column('g.name');
            $list[$k]['identity'] = $list[$k]['identity']?implode('、',$list[$k]['identity']):'';
            $list[$k]['auth'] = \App\HttpController\Common\Auth::getAdminRules($v['uid']);
            $list[$k]['reseller_name'] = ResellerModel::create()->where('id',$v['reseller_id'])->val('name');
        }
        $this->AjaxJson(1, ['total'=>$total,'list'=>$list], 'success');
        return true;
    }
    /**
     * 新增
     */
    public function add(){

        $data = $this->param;

        $data['create_time'] = !empty($data['create_time'])?strtotime($data['create_time']):time();
        $data['update_time'] = time();
        if(AdminsModel::create()->where('username',$data['username'])->get()){
            $this->AjaxJson(0, ['status'=>0], '账号已存在');return false;
        }
        $data['reseller_ids'] = is_array($data['reseller_ids'])?implode(',',$data['reseller_ids']):$data['reseller_ids'];
        $result = AdminsModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            $data['password'] = md5($data['password'].'pswstr');
            if($last_id = AdminsModel::create()->data($data)->save()){
                $this->AjaxJson(1, ['status'=>1], '新增成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '新增失败');return false;
            }
        }catch (\Exception $e){
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }

        return false;
    }
    //个人信息
    public function info(){
        if($this->request()->getMethod()=='GET'){
            $info = AdminsModel::create()->where('uid',$this->uid)->find();
            $this->AjaxJson(1,$info,'ok');return false;
        }else{
            try {
                $data = $this->param;
                $data['uid'] = $this->uid;
                $data['update_time'] = time();
                $AdminsModel = AdminsModel::create();
                if ($AdminsModel->where('username', $data['username'])->where('uid', $data['uid'], '<>')->get()) {
                    $this->AjaxJson(0, ['status' => 0], '名称已存在');
                    return false;
                }
                $result = $AdminsModel->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(!empty($data['password'])){
                    $data['password'] = md5($data['password'].'pswstr');
                }else{
                    unset($data['password']);
                }

                if ($AdminsModel->where('uid',$this->param['uid'])->update($data)) {
                    $this->AjaxJson(1, $data, '更新资料成功');
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '更新资料失败');
                    return false;
                }

            } catch (\Exception $e) {
                $this->AjaxJson(0, ['status' => 0], '更新出错：' . $e->getMessage());
            }
            return false;
        }

    }
    /**
     * 更新账号状态
     * param id
     * param status
     * return bool
     */
    public function doStatus(){
        $id = $this->param['id'];
        if(empty($id)){ $this->AjaxJson(0,['status'=>0], '账号ID必须'); return false;}
        $value = (int)$this->param['value']??0;
        $msg = $value==1?'恢复账号':'禁用账号';
        if(AdminsModel::create()->update(['status'=>$value,'update_time'=>time()],['uid'=>$id])){
            $this->AjaxJson(1,['status'=>1], $msg.'成功');
        }else{
            $this->AjaxJson(0,['status'=>0], $msg.'失败');
        }
        return true;
    }
    /**
     * 设置为主账号
     */
    public function isPrimary(){
        $id = $this->param['id'];
        if(empty($id)){ $this->AjaxJson(0,['status'=>0], '账号ID必须'); return false;}
        $value = (int)$this->param['value']??0;
        $msg = $value==1?'设置为主账号':'取消主账号';
        if(AdminsModel::create()->update(['is_primary'=>$value,'update_time'=>time()],['uid'=>$id])){
            $this->AjaxJson(1,['status'=>1], $msg.'成功');
        }else{
            $this->AjaxJson(0,['status'=>0], $msg.'失败');
        }
        return true;
    }
    /**
     * 更新
     */
    public function edit(){
        try {
            if (!empty($this->param['uid'])) {
                $data = $this->param;
                $data['create_time'] = !empty($data['create_time'])?strtotime($data['create_time']):time();
                $data['update_time'] = time();

                $AdminsModel = AdminsModel::create();
                if ($AdminsModel->where('username', $data['username'])->where('uid', $data['uid'], '<>')->get()) {
                    $this->AjaxJson(0, ['status' => 0], '名称已存在');
                    return false;
                }
                $result = $AdminsModel->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(!empty($data['password'])){
                    $data['password'] = md5($data['password'].'pswstr');
                }else{
                    unset($data['password']);
                }
                $data['reseller_ids'] = is_array($data['reseller_ids'])?implode(',',$data['reseller_ids']):$data['reseller_ids'];
                if ($AdminsModel->where('uid',$this->param['uid'])->update($data)) {
                    $this->AjaxJson(1, ['status' => 1,'data'=>$data], '更新成功');
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '更新失败');
                    return false;
                }

            } else {
                $this->AjaxJson(0, ['status' => 0], 'ID不存在');
            }
        } catch (\Exception $e) {
            $this->AjaxJson(0, ['status' => 0], '更新出错：' . $e->getMessage());
        }
        return false;
    }
    /**
     * 删除品牌
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if(array_intersect([1],$ids)){
                $this->AjaxJson(0, $ids, '包含不可删除文章');return false;
            }
            if( AdminsModel::create()->where('uid',$ids,'in')->destroy()){
                $this->AjaxJson(1, ['status'=>1], '删除文章成功');return false;
            }else{
                $this->AjaxJson(1, ['status'=>0], '删除文章失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的文章');
        }
        return false;
    }
    /**
     * 全部
     */
    public function all(){
        $model  = AdminsModel::create();
        if($this->uid!=1){
            if($this->is_primary!=1){
                $model->where('uid='.$this->uid);
            }
            $model->where('reseller_id='.$this->reseller_id);
        }
        if(!empty($this->param['reseller_id'])){
            $model->where('reseller_id='.$this->param['reseller_id']);
        }
        if(empty($this->param['is_agent'])){
            $model->where('uid>1');
        }
        $list = $model->where('status=1')->field('uid as value, realname as name')->order('uid', 'asc')->select();
        $this->AjaxJson(1, $list, 'OK');
        return true;
    }


    //管理绑定权限分组
    public function bindAuthGroup(){
        if(!empty($this->param['uid'])){
            $auth_group_ids = !empty($this->param['auth_group_ids'])?explode(',',$this->param['auth_group_ids']):[];
            if($auth_group_ids){
                foreach ($auth_group_ids as $v){
                    if(!AuthGroupAccessModel::create()->where('uid',$this->param['uid'])->where('group_id',$v)->get()){
                        AuthGroupAccessModel::create()->data(['uid'=>$this->param['uid'],'group_id'=>$v])->save();
                    }
                }
                AuthGroupAccessModel::create()->where('uid',$this->param['uid'])->where('group_id',$auth_group_ids,'not in')->destroy();
            }else{
                AuthGroupAccessModel::create()->where('uid',$this->param['uid'])->destroy();
            }

            $this->AjaxJson(1,$this->param, '管理绑定权限成功');

        }else{
            $this->AjaxJson(0,$this->param, '必须指定管理员');
        }
    }


    //获取绑定OPENID链接
    public function getBindOpenidUrl(){
        $key = md5($this->getRealIp().time());
        Cache::getInstance()->set($key,$this->uid,600);
        $url = $this->host.'/admin/admins/bindOpenid?key='.$key;
        $this->AjaxJson(1,['url'=>$url], 'OK');return false;
    }
    //微信授权登录获取用户Openid
    public function bindOpenid(){
        $system          = Common::getSystem();
        $key = $this->param['key']??'';
        $uid = Cache::getInstance()->get($key);
        if(empty($uid)){
            $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
            $this->response()->write("<h1>管理员绑定微信账号二维码已过期{$key}</h1>");
            $this->response()->end();
            return  false;
        }
        $config = [
            'appId' => $system['wechat_official_account']['appid'],// 微信公众平台后台的 appid
            'appSecret' => $system['wechat_official_account']['secret'],// 微信公众平台后台配置的 秘钥
        ];
        $officialAccount = Factory::officialAccount($config);
        if(empty($this->param['code'])){
            $redirectUrl = $officialAccount->oauth->scopes(['snsapi_userinfo'])->redirect($this->request()->getUri());
            $this->response()->redirect($redirectUrl);
            return false;
        }else{
            $user                = $officialAccount->oauth->userFromCode($this->param['code']);
            $data['openid'] = $user->getId();
            $data['nickname'] = $user->getNickname();
            $data['avatar'] = $user->getAvatar();
            if(AdminsModel::create()->where('uid',$uid,'<>')->where('openid',$data['openid'])->find()){
                $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
                $this->response()->write("<h1>此微信号已经绑定其他管理员账号了！</h1>");
                $this->response()->end();
                return  false;
            }
            if(AdminsModel::create()->where('uid',$uid)->update($data)){
                Cache::getInstance()->set($key,null);
                $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
                $this->response()->write("<h1>管理员绑定微信【{$data['nickname']}】成功！</h1>");
            }else{
                $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
                $this->response()->write("<h1>管理员绑定微信失败！</h1>");
            }
        }
        return false;


    }
}

