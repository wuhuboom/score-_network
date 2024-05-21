<?php

namespace App\HttpController\Common;



use App\Log\LogHandler;
use App\Service\LeagueTableService;
use App\Service\UpcomingService;

/**
 * @todo    BetsApi请求
 * @version    v1.0.0
 */
class GetData
{
	/**
	 * 获取联赛积分表
	 * @param     $league_id 联赛ID
	 * @param int $is_new  1获取最新数据 0获取缓存，如果缓存没有就获取最新
	 */
	public static function getLeagueTable($league_id,$is_new = 0){
		if($is_new){
			$LeagueTable = BetsApi::getLeagueTable($league_id);
			if($LeagueTable['results']){

				$save_data = $LeagueTable['results'][0];
				return $save_data;
				$save_data['league_id']  = $league_id ;
				$save_data['update_time']  = date('Y-m-d H:i:s') ;
				if($data = LeagueTableService::create()->getOne(['league_id'=>$league_id])){
					LeagueTableService::create()->update($data['id'],$save_data);
				}else{
					$save_data['create_time']  = date('Y-m-d H:i:s') ;
					LeagueTableService::create()->save($save_data);
				}
				return $save_data;
			}else{
				return [];
			}

		}else{
			$save_data = LeagueTableService::create()->getOne(['league_id'=>$league_id,'update_time'=>[date('Y-m-d 00:00:00',time()),'<']]);
			if(empty($save_data)){
				$save_data = self::getLeagueTable($league_id,1);
			}
			return $save_data;
		}
	}

	/**
	 * 获取联赛排行榜
	 * @param     $league