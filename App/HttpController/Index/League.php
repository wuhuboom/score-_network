<?php

namespace App\HttpController\Index;



use App\HttpController\Common\BetsApi;
use App\HttpController\Common\GetData;
use App\Service\EndedService;
use App\Service\LeagueService;
use App\Service\LeagueTableService;
use App\Service\LeagueToplistService;
use App\Service\TeamService;
use App\Service\UpcomingService;
use App\Service\ViewService;

/**
 * Class Users
 * Create With Automatic Generator
 */
class League extends Base
{
    //球队
    public function index()
    {
	    $page = 1;
	    $limit = 15;
    	$league_id  = $this->param['id']??0;
	    $league = LeagueService::create()->get($league_id);
	    $this->assign['league'] = $league;
	    $this->assign['leagueToplist'] = LeagueToplistService::create()->getLeagueToplistByLeagueId($league_id);
	    $this->assign['leagueTable'] = LeagueTableService::create()->getLeagueTableByLeagueId($league_id);
	    $this->assign['title'] = $this->lang=='En'?'League':'联赛';
        //$this->AjaxJson(1,$this->assign,'ok');return false;
        $this->view('/index/league/index',$this->assign);
        return false;
    }

}

