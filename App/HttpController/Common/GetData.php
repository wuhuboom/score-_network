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
	 * @param     $league_id 联赛ID
	 * @param int $is_new  1获取最新数据 0获取缓存，如果缓存没有就获取最新
	 */
	public static function getLeagueToplist($league_id,$is_new = 0){
		if($is_new){
			$LeagueToplist = BetsApi::getLeagueToplist($league_id);
			if($LeagueToplist['results']){
				$save_data = $LeagueToplist['results'];
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
				$save_data = self::getLeagueToplist($league_id,1);
			}
			return $save_data;
		}
	}


	/**
	 * 获取联赛赛程
	 * @param     $league_id 联赛ID
	 * @param int $is_new  1获取最新数据 0获取缓存，如果缓存没有就获取最新
	 */
	public static function getUpcoming($league_id,$is_new = 0){
		if($is_new){
			$result = BetsApi::getUpcoming(1,1,$league_id);
			if($result['results']){
				foreach ($result['results'] as $k=>$v){
					$save_data = $v;
					$save_data['league_id'] = $league_id;
					foreach ($save_data as $field=>$value){
						$save_data[$field]  = $value??'';
					}
					$save_data['create_time'] =date('Y-m-d H:i:s');
					$save_data['update_time'] =date('Y-m-d H:i:s');

					if($res = UpcomingService::create()->getOne(['id'=>$save_data['id']])){
						UpcomingService::create()->update($res['id'],$save_data );
						$log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Upcoming');
					}else{
						UpcomingService::create()->save($save_data);
						$log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Upcoming');
					}
				}
				return $result['results'];

			}else{
				return [];
			}

		}else{
			$list = UpcomingService::create()->getLists(['league_id'=>$league_id,'time'=>[time(),'>']],'*',0,0,'time asc');
			if(empty($list['list'])){
				return self::getUpcoming($league_id,1);
			}
			return $list['list'];
		}
	}



}

