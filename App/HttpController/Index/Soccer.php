<?php

namespace App\HttpController\Index;

use App\Service\InplayService;

class Soccer extends Base
{

    //球队
    public function inplay()
    {
	    $data = InplayService::create()->joinOddsList(['time'=>[time()-7200,'>'],'time_status'=>[3,'<']],'i.*,o.odds',0,0,'i.id desc');
	    foreach ($data['list'] as $k=>$v){

		    $data['list'][$k]['odds'] = json_decode($v['odds'],1);
	    }

	    $this->assign['inplay'] = $data['list'];

	    $this->assign['cate'] ='soccer';
	    $this->view('/index/soccer/inplay',$this->assign);
	    return false;
    }


}

