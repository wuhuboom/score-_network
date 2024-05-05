<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\LeagueToplistDao;
use App\HttpController\Common\BetsApi;
use App\Log\LogHandler;
use EasySwoole\FastCache\Cache;

class LeagueToplistService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     *
     * @param %sDao $dao
     */
    public function __construct(LeagueToplistDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 获取列表
     * @param string $name
     *
     * @return array
     */
    public function getLists(array $where = [], string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = [])
    {
        return $this->dao->selectList($where, $field , $page, $limit, $order, $with);
    }
	public function getLeagueToplistByLeagueId($league_id){
    	if(Cache::getInstance()->get('LeagueToplist'.$league_id)){
		    $log_contents = '缓存联赛ID：'.$league_id.'没有数据';
		    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
    		return [];
	    }
		$LeagueToplist = $this->dao->get(['league_id'=>$league_id]);

		//每日只更新一次
		if(empty($LeagueToplist)||($LeagueToplist&&strtotime($LeagueToplist['update_time'])<strtotime(date('Y-m-d 00:00:00')))){

			$result = BetsApi::getLeagueToplist($league_id);
			if($result['success']==1&&$result['results']){
				try {
					$save_data = $result['results'];
					$log_contents = json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
					foreach ($save_data as $field=>$value){
						$save_data[$field]  = $value??'';
					}
					$save_data['league_id'] = $league_id;
					$save_data['update_time'] =date('Y-m-d H:i:s');

					if($res = $this->dao->getOne(['league_id'=>$league_id])){
						$update_res = $this->dao->update($res['id'],$save_data );
						$log_contents = '更新球队阵容成功'.$update_res.$res['id'].json_encode($res,JSON_UNESCAPED_UNICODE);
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
					}else{
						$save_data['create_time'] =date('Y-m-d H:i:s');
						$id = $this->dao->save($save_data);
						$log_contents = '新增球队阵容成功'.$id;
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
					}
				}catch (\Throwable $e){
					$log_contents = '新增球队阵容插入失败'.$e->getMessage();
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
				}
				$LeagueToplist = $this->dao->get(['league_id'=>$league_id]);
			}else{
				Cache::getInstance()->set('LeagueToplist'.$league_id,1,24*3600);
				$log_contents = '联赛ID：'.$league_id.'没有数据';
				LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
			}
		}
		return $LeagueToplist??[];
	}

    /**
     * 根据主键查询
     * @param int $id
     * @return bool
     */
    public function idExists($id)
    {
        return $this->dao->get($id);
    }
}
