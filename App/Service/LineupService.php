<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\LineupDao;
use App\HttpController\Common\BetsApi;
use App\Log\LogHandler;

class LineupService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     *
     * @param %sDao $dao
     */
    public function __construct(LineupDao $dao)
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
	public function findByEventId($event_id){
		$history = $this->dao->getOne(['event_id'=>$event_id]);
		if(empty($history)){
			$result = BetsApi::getLineup($event_id);
			if($result['results']){
				$save_data = [];
				foreach ($result['results'] as $field=>$value){
					$save_data[$field]  = $value??'';
				}
				$save_data['event_id'] = $event_id;
				$save_data['update_time'] =date('Y-m-d H:i:s');
				if($res = $this->dao->getOne(['event_id'=>$save_data['event_id']])){
					$id = $res['id'];
					$this->dao->update($res['id'],$save_data );
					$log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Lineup');
				}else{
					$save_data['create_time'] =date('Y-m-d H:i:s');
					$id = $this->dao->save($save_data);
					$log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Lineup');
				}
				$history = $this->dao->getOne(['id'=>$id]);

			}else{
				$history = [];
			}

		}
		return $history;
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
