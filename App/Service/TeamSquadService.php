<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\TeamSquadDao;
use App\HttpController\Common\BetsApi;
use App\Log\LogHandler;


class TeamSquadService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     *
     * @param %sDao $dao
     */
    public function __construct(TeamSquadDao $dao)
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

    public function getListsByTeamId($team_id){
        $list = $this->dao->selectList(['team_id'=>$team_id]);
        if(empty($list['list'])){
            $result = BetsApi::getTeamSquad($team_id);
            if($result['success']==1&&$result['results']){
                foreach ($result['results'] as $k=>$v){
                    try {
                        $save_data = $v;
                        $log_contents = json_encode($save_data,JSON_UNESCAPED_UNICODE);
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TeamSquad');
                        foreach ($save_data as $field=>$value){
                            $save_data[$field]  = $value??'';
                        }
                        $save_data['team_id'] = $team_id;
                        $save_data['update_time'] =date('Y-m-d H:i:s');

	                    if ($res = $this->dao->getOne(['team_id' => $team_id, 'name' => $save_data['name']]) || $res = $this->dao->getOne(['id' => $save_data['id']])) {
		                    $update_res = $this->dao->update($res['id'], $save_data);
		                    $log_contents = '更新球队阵容成功' . $update_res . $res['id'] . json_encode($res, JSON_UNESCAPED_UNICODE);
		                    LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'TeamSquad');
	                    } else {
		                    $save_data['create_time'] = date('Y-m-d H:i:s');
		                    $id = $this->dao->save($save_data);
		                    $log_contents = '新增球队阵容成功' . $id;
		                    LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'TeamSquad');
	                    }
                    }catch (\Throwable $e){
                        $log_contents = '新增球队阵容插入失败'.$e->getMessage();
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TeamSquad');
                    }

                }
                $list = $this->dao->selectList(['team_id'=>$team_id]);
            }


        }
        return $list['list']??[];
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
