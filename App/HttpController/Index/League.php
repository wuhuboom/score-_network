<?php

namespace App\HttpController\Index;



use App\HttpController\Common\BetsApi;
use App\HttpController\Common\GetData;
use App\Service\EndedService;
use App\Service\LeagueService;
use App\Service\TeamService;
use App\Service\UpcomingService;

/**
 * Class Users
 * Create With Automatic Generator
 */
class League extends Base
{
    //球队
    public function index()
    {
    	$id  = $this->param['id']??0;
	    $league = LeagueService::create()->get($id);
	    $this->assign['league'] = $league;
	    $league_table = BetsApi::getLeagueTable($id);
	    $this->AjaxJson(1,$league_table,'ok');return false;
	    $teams = TeamService::create()->getLists([],'*',1,20);
	    $this->assign['team'] = $teams['list'];
	    $this->assign['upcoming'] = GetData::getUpcoming($id);
	    $this->assign['leagueTable'] = GetData::getLeagueTable($id);
	    $this->assign['leagueToplist'] = GetData::getLeagueToplist($id);

	    $this->assign['title'] = $this->lang=='En'?'League':'联赛';
        $this->view('/index/league/index',$this->assign);
        return false;
    }

}

