<?php

namespace App\HttpController\Common;



use App\Log\LogHandler;
use App\Service\ApiRequestRecordService;
use App\Service\BetsApiService;
use EasySwoole\HttpClient\HttpClient;

/**
 * @todo    BetsApi请求
 * @version    v1.0.0
 */
class BetsApi
{

    /**
     * 获取联赛
     *
     * @param int    $sport_id
     * @param string $page
     * @param string $cc
     * @return mixed|string
     */
    static public function getLeague($sport_id,$page='',$cc=''){
        $system = Common::getSystem();
        $api = "https://api.b365api.com/v1/league?token={$system['apikey']}&sport_id={$sport_id}&page={$page}&cc={$cc}";
        $result = BetsApi::request($api);
        return $result;
    }
    /**
     * 获取联赛表
     *
     * @param int    $league_id
     * @return mixed|string
     */
    static public function getLeagueTable($league_id){
        $system = Common::getSystem();
        $api = "https://api.b365api.com/v3/league/table?token={$system['apikey']}&league_id=$league_id";
        $result = BetsApi::request($api);
        return $result;
    }
    /**
     * 获取联赛排行
     *
     * @param int    $league_id
     * @return mixed|string
     */
    static public function getLeagueToplist($league_id){
        $system = Common::getSystem();
        $api = "https://api.b365api.com/v1/league/toplist?token={$system['apikey']}&league_id=$league_id";
        $result = BetsApi::request($api);
        return $result;
    }

    /**
     * 获取团队
     *
     * @param int    $sport_id
     * @param string $page
     * @param string $cc
     * @return mixed|string
     */
    static public function getTeam($sport_id,$page='',$cc=''){
        $system = Common::getSystem();
        $api = "https://api.b365api.com/v1/team?token={$system['apikey']}&sport_id={$sport_id}&page={$page}&cc={$cc}";
        $result = BetsApi::request($api);
        return $result;
    }

	/**
	 * 获取球队成员表
	 *
	 * @param int    $league_id
	 * @return mixed|string
	 */
	static public function getTeamMembers($team_id){
		$system = Common::getSystem();
		$api = "https://api.b365api.com/v1/team/members?token={$system['apikey']}&team_id=$team_id";
		$result = BetsApi::request($api);
		return $result;
	}
	/**
	 * 获取球队成员表
	 *
	 * @param int    $league_id
	 * @return mixed|string
	 */
	static public function getTeamSquad($team_id){
		$system = Common::getSystem();
		$api = "https://api.b365api.com/v1/team/squad?token={$system['apikey']}&team_id=$team_id";
		$result = BetsApi::request($api);
		return $result;
	}
    /**
	 * 获取正在进行的比赛
	 *
	 * @param int    $sport_id
	 * @return mixed|string
	 */
	static public function getInplay($sport_id){
		$system = Common::getSystem();
		$api = "https://api.b365api.com/v3/events/inplay?token={$system['apikey']}&sport_id=$sport_id";
		$result = BetsApi::request($api);
		return $result;
	}

    /**
     * 获取正在进行的比赛
     *
     * @param int    $sport_id
     * @return mixed|string
     */
    static public function getUpcoming($sport_id,$page,$league_id='',$team_id='',$cc='',$day='',$skip_esports=''){
        $system = Common::getSystem();
        $api = "https://api.b365api.com/v3/events/upcoming?token={$system['apikey']}&sport_id=$sport_id&league_id=$league_id&team_id=$team_id&cc=$cc&day=$day&skip_esports=$skip_esports&page=$page";
        $result = BetsApi::request($api);
        return $result;
    }
	/**
	 * 获取正在进行的比赛
	 *
	 * @param int    $sport_id
	 * @return mixed|string
	 */
	static public function getEnded($sport_id,$page,$league_id='',$team_id='',$cc='',$day='',$skip_esports=''){
		$system = Common::getSystem();
		$api = "https://api.b365api.com/v3/events/ended?token={$system['apikey']}&sport_id=$sport_id&league_id=$league_id&team_id=$team_id&cc=$cc&day=$day&skip_esports=$skip_esports&page=$page";
		$result = BetsApi::request($api);
		return $result;
	}
    /**
     * 获取比赛事件
     *
     * @param int    $event_id
     * @return mixed|string
     */
    static public function getView($event_id){
        $system = Common::getSystem();
        $api = "https://api.b365api.com/v1/event/view?token={$system['apikey']}&event_id={$event_id}";
        $result = BetsApi::request($api);
        return $result;
    }
    /**
     * 获取两队历史
     *
     * @param int    $event_id
     * @return mixed|string
     */
    static public function getHistory($event_id){
        $system = Common::getSystem();
        $api = "https://api.b365api.com/v1/event/history?token={$system['apikey']}&event_id={$event_id}";
        $result = BetsApi::request($api);
        return $result;
    }
    /**
     * 获取数据统计
     *
     * @param int    $event_id
     * @return mixed|string
     */
    static public function getStatsTrend($event_id){
        $system = Common::getSystem();
        $api = "https://api.b365api.com/v1/event/stats_trend?token={$system['apikey']}&event_id={$event_id}";
        $result = BetsApi::request($api);
        return $result;
    }
	/**
	 * 获取赛事赔率
	 *
	 * @param int    $event_id
	 * @return mixed|string
	 */
	static public function getOdds($event_id){
		$system = Common::getSystem();
		$api = "https://api.b365api.com/v2/event/odds?token={$system['apikey']}&event_id={$event_id}";
		$result = BetsApi::request($api);
		return $result;
	}
	/**
	 * 获取数据统计
	 *
	 * @param int    $event_id
	 * @return mixed|string
	 */
	static public function getLineup($event_id){
		$system = Common::getSystem();
		$api = "https://api.b365api.com/v1/event/lineup?token={$system['apikey']}&event_id={$event_id}";
		$result = BetsApi::request($api);
		return $result;
	}
	/**
	 * 获取球员信息
	 *
	 * @param int    $event_id
	 * @return mixed|string
	 */
	static public function getPlayer($player_id){
		$system = Common::getSystem();
		$api = "https://api.b365api.com/v1/player?token={$system['apikey']}&player_id={$player_id}";
		$result = BetsApi::request($api);
		return $result;
	}
	//发起请求
	static public function request($api){
		try {
            $start_time = microtime(true);
			$client = new HttpClient($api);
			$body = $client->get()->getBody();
            $end_time = microtime(true);
            $spend_time = $end_time - $start_time;
			$parse_url = parse_url($api);
            $bets_api = BetsApiService::create()->where(['api_url'=>["{$parse_url['scheme']}://{$parse_url['host']}{$parse_url['path']}%",'like']])->get();
			$save_data = [
				'bets_api_id'=>$bets_api['id']??0,
				'name'=>$bets_api['name']??'',
				'api'=>$api,
				'result'=>$body,
				'spend_time'=>$spend_time,
				'create_time'=>date('Y-m-d H:i:s'),
			];
			ApiRequestRecordService::create()->save($save_data);
			$res = json_decode($body,1);
            $log_contents = $api.':'.$body;
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'BetsApi');
			return $res;
		}catch (\Throwable $e){
			return $e->getMessage();
		}


	}








}

