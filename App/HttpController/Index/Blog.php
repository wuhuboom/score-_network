<?php

namespace App\HttpController\Index;

use App\Service\BlogService;
use App\Service\UserCashOutService;
use App\Service\UserService;

class Blog extends Base
{
    //首页
    public function index()
    {
        $where['b.status'] = [4,'='];
        $field = 'b.*,u.username,u.nickname,u.avatar';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
//        $data = BlogService::create()->joinSelectList($where,$field,$page,$limit,'b.id desc');

        $this->assign['blog'] = [];
        //发帖时间
        $customer_config = \App\HttpController\Common\Common::getSystem()['customer_config'];
        $blog_start_time = strtotime(date('Y-m-d '.$customer_config['blog_start_time']));
        $blog_end_time = strtotime(date('Y-m-d '.$customer_config['blog_end_time']));
        if ($customer_config['blog_enable'] && $blog_start_time < time() && $blog_end_time > time()) {
            $this->assign['blog_enable'] = 1;
        } else {
            $this->assign['blog_enable'] = 0;
        }

        $this->assign['title'] = $this->lang=='Cn'?'博客':'Blog';
        $this->assign['page_path'] = 'blog';
        $this->view('index/blog/index',$this->assign);
    }

    public function post(){
        if($this->request()->getMethod()=='POST'){
            try {
                $customer_config = \App\HttpController\Common\Common::getSystem()['customer_config'];
                $blog_start_time = strtotime(date('Y-m-d '.$customer_config['blog_start_time']));
                $blog_end_time = strtotime(date('Y-m-d '.$customer_config['blog_end_time']));
                if (!$customer_config['blog_enable']) {
                    $this->AjaxJson(0,[],'The blog feature is turned off');return false;
                }
                if (!($blog_start_time < time() && $blog_end_time > time())) {
                    $this->AjaxJson(0,[],'Not in the Posting time frame');return false;
                }
                $cash_out = UserCashOutService::create()->where(['user_id'=>$this->user_id,'status'=>1,'create_time'=>[[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')],'between']])->get();
                if(empty($cash_out)){
                    $this->AjaxJson(0,[],'Only after successful withdrawal today can it be published');return false;
                }
                $session_user = $this->session()->get('user');
                $data['user_id'] = $session_user['id'];
                $data['contents'] = $this->param['contents']??'';
                $data['image'] = $this->param['image']??'';
                $system  = \App\HttpController\Common\Common::getSystem();
                $data['reward_amount'] = rand($system['customer_config']['blog_post_min_amount'],$system['customer_config']['blog_post_max_amount']);
                $data['status'] = 1;
                $data['is_img'] = empty($data['image']) ? 0 : 1;
                $data['create_time'] = date('Y-m-d H:i:s');
                $data['update_time'] = date('Y-m-d H:i:s');
                $result = BlogService::create()->validateData($data,'add');
                if($result!==true) {
                    $this->AjaxJson(0,$data,$result);return false;
                }
                if(BlogService::create()->save($data)){
                    $this->AjaxJson(1, [], 'Publish Success');return false;
                }else{
                    $this->AjaxJson(0, [], 'Publish Fail');return false;
                }
            }catch (\Throwable $e){
                $this->AjaxJson(0, [$e->getMessage()], 'Publish Fail');return false;
            }

        }else{
            $this->assign['title'] = 'Post Blog';
            $this->view('index/blog/post',$this->assign);
        }

    }
}

