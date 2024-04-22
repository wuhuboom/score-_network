<?php

namespace App\HttpController\Index;

use App\Service\TasksService;
use App\Service\UserService;

class Tasks extends Base
{
    //首页
    public function index()
    {
	    $invitation_num = UserService::create()->selectModel(['parent_id'=>$this->user_id??0])->count();
	    $active_num = UserService::create()->selectModel(['parent_id'=>$this->user_id??0,'is_active'=>1])->count();
        $tasks =TasksService::create()->getLists(['status'=>1]);
		foreach ($tasks['list'] as $k=>$v){
			$tasks['list'][$k]['process'] = round($active_num/$v['active_number'],2)*100;

		}
        $this->assign['tasks'] = $tasks['list'];

        $this->assign['invitation_num'] = $invitation_num;
        $this->assign['active_num'] = $active_num;
        $this->assign['page_path'] = 'tasks';
        $this->assign['title'] = 'Tasks';
        $this->view('index/tasks/index',$this->assign);
    }


}

