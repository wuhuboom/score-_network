<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\PlayerDao;
use App\HttpController\Common\BetsApi;
use App\Log\LogHandler;

class PlayerService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     *
     * @param %sDao $dao
     */
    public function __construct(PlayerDao $dao)
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

	/**
	 * 获取列表
	 * @param string $name
	 *
	 * @return array
	 */
	public function getPlayerById($player_id)
	{
		$player = $this->dao->get(['player_id'=>$player_id]);
		if(empty($player)){
			$result = BetsApi::getPlayer($player_id);
			if($result['success']==1&&$result['results']){
				try {
					$save_data = $result['results'];
					$log_contents = json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Player');
					foreach ($save_data as $field=>$value){
						$save_data[$field]  = $value??'';
					}
					$save_data['player_id'] = $player_id;
					$save_data['update_time'] =date('Y-m-d H:i:s');

					if($res = $this->dao->getOne(['player_id'=>$player_id])){
						$update_res = $this->dao->update($res['id'],$save_data );
						$log_contents = '更新球员信息成功'.$update_res.$res['id'].json_encode($res,JSON_UNESCAPED_UNICODE);
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Player');
					}else{
						$save_data['create_time'] =date('Y-m-d H:i:s');
						$id = $this->dao->save($save_data);
						$log_contents = '新增球员信息成功'.$id;
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Player');
					}
				}catch (\Throwable $e){
					$log_contents = '新增球员信息插入失败'.$e->getMessage();
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Player');
				}
				$player = $this->dao->get(['player_id'=>$player_id]);
			}


		}
		return $player??[];
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
