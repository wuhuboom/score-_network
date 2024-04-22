<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\LeagueTableDao;
use App\HttpController\Common\BetsApi;
use App\Log\LogHandler;

class LeagueTableService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     *
     * @param %sDao $dao
     */
    public function __construct(LeagueTableDao $dao)
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
	public function getLeagueTableByLeagueId($league_id){
		$LeagueTable = $this->dao->get(['league_id'=>$league_id]);
		//每日只更新一次
		if(empty($LeagueTable)||strtotime($LeagueTable['update_time'])<strtotime(date('Y-m-d 00:00:00'))){
			$result = BetsApi::getLeagueTable($league_id);
			if($result['success']==1&&$result['results']){
				try {
					$save_data = $result['results'];
					$log_contents = json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
					foreach ($save_data as $field=>$value){
						$save_data[$field]  = $value??'';
					}
					$save_data['league_id'] = $league_id;
					$save_data['update_time'] =date('Y-m-d H:i:s');

					if($res = $this->dao->getOne(['league_id'=>$league_id])){
						$update_res = $this->dao->update($res['id'],$save_data );
						$log_contents = '更新联赛积分表成功'.$update_res.$res['id'].json_encode($res,JSON_UNESCAPED_UNICODE);
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
					}else{
						$save_data['create_time'] =date('Y-m-d H:i:s');
						$id = $this->dao->save($save_data);
						$log_contents = '新增联赛积分表成功'.$id;
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
					}
				}catch (\Throwable $e){
					$log_contents = '新增联赛积分表插入失败'.$e->getMessage();
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
				}
				$LeagueTable = $this->dao->get(['league_id'=>$league_id]);
			}


		}
		return $LeagueTable??[];
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
