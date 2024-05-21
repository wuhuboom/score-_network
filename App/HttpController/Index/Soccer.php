<?php

namespace App\HttpController\Index;

use App\Service\InplayService;
use App\Service\UpcomingService;

class Soccer extends Base
{

    //球队
    public function inplay()
    {

	    $data = InplayService::create()->joinOddsList(['time'=>[time()-7200,'>'],'time_status'=>[3,'<']],'i.*,o.odds',0,0,'i.id desc');

	    foreach ($data['list'] as $k=>$v){

		    if($v['is_generate']){
			    $event_id  = $v['id']??0;
			    $upcoming = UpcomingService::create()->get($event_id);
			    $scores = $this->getScores(strtotime($upcoming['time']),$upcoming['extra']['length']??90,$upcoming['events'],$upcoming['ss']);
			    $length = round((time()-strtotime($v['time']))/60);
			    $length = $length>$upcoming['extra']['length']?$upcoming['extra']['length']:$length;
			    $data['list'][$k]['timer']['tm'] = $length;
			    $data['list'][$k]['ss'] = $scores['home'].'-'.$scores['away'];
			    $data['list'][$k]['odds'] = $upcoming['odds'];
		    }else{
			    $data['list'][$k]['odds'] = json_decode($v['odds'],1);
		    }

	    }

	    $this->assign['inplay'] = $data['list'];

	    $this->assign['cate'] ='soccer';
	    $this->view('/index/soccer/inplay',$this->assign);
	    return false;
    }


}

