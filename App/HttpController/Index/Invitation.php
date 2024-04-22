<?php

namespace App\HttpController\Index;

use App\HttpController\Common\Poster;
use App\Model\PosterModel;
use App\Service\UserRewardService;
use App\Service\UserService;

class Invitation extends Base
{
    //首页
    public function index()
    {
        $poster = PosterModel::create()->where('is_show',1)->select();
        $posters   = [];
	    $user_id = $this->session()->get('user')['id'];
	    $user = UserService::create()->get($user_id);
	    $promotion_link = $this->host.'?invitation_code='.$user['invitation_code'];;
        foreach ($poster as $k => $v) {
            $bg     = EASYSWOOLE_ROOT . $v['image'];
            $res    = Poster::getH5Poster($user_id, $v['id'], $bg, $v['left'], $v['top'], $v['width'], $v['height'],$promotion_link);  //h5推广二维码
            $posters[] =
                [
                    "alt" => 'Qrcode',
                    "pid" => $k + 1,
                    "src" => \App\HttpController\Common\Common::autocompleteimage($res['poster'],$this->host)
                ];
        }

        $this->assign['posters'] = $posters;
        $this->assign['promotion_link'] = $promotion_link;
        $this->assign['page_path'] = 'invitation';
        $this->assign['commission_money'] = UserRewardService::create()->where(['user_id'=>$user_id])->sum('balance')??0.00;

	    $invitation_num_1 = $activate_num_1 = $invitation_num_2 = $activate_num_2 = $invitation_num_3 = $activate_num_3 = 0;
	    $invitation_num_1 = UserService::create()->where(['parent_id' => $user_id])->count();
	    $activate_num_1 = UserService::create()->where(['parent_id' => $user_id, 'is_active' => 1])->count();
	    $child_user_ids = UserService::create()->where(['parent_id'=>$user_id])->column('id');

		if($child_user_ids){
			$invitation_num_2 = UserService::create()->where(['parent_id' => [$child_user_ids,'in']])->count()??0;
			$activate_num_2 = UserService::create()->where(['parent_id' => [$child_user_ids,'in'], 'is_active' => 1])->count()??0;
			$child_child_user_ids = UserService::create()->where(['parent_id'=>[$child_user_ids,'in']])->column('id');
			if($child_child_user_ids){
				$invitation_num_3 = UserService::create()->where(['parent_id' => [$child_child_user_ids,'in']])->count()??0;
				$activate_num_3 = UserService::create()->where(['parent_id' => [$child_child_user_ids,'in'], 'is_active' => 1])->count()??0;
			}

		}
        $this->assign['invitation_num_1'] = $invitation_num_1;
	    $this->assign['activate_num_1'] = $activate_num_1;
	    $this->assign['invitation_num_2'] = $invitation_num_2;
	    $this->assign['activate_num_2'] = $activate_num_2;
	    $this->assign['invitation_num_3'] = $invitation_num_3;
	    $this->assign['activate_num_3'] = $activate_num_3;
        $this->assign['invitation_num'] = $invitation_num_1+$invitation_num_2+$invitation_num_3;
        $this->assign['activate_num'] = $activate_num_1+$activate_num_2+$activate_num_3;
        $this->assign['title'] = $this->lang=='Cn'?'邀请':'Invite';
        $this->view('index/invitation/index',$this->assign);
    }


}

