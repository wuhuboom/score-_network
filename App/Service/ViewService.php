<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\ViewDao;
use App\HttpController\Common\BetsApi;
use App\Log\LogHandler;

class ViewService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     *
     * @param %sDao $dao
     */
    public function __construct(ViewDao $dao)
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
        $view = $this->dao->getOne(['event_id'=>$event_id]);
        if(empty($view)||strtotime($view['update_time'])+60<time()){
            $result = BetsApi::getView($event_id);
            if($result['results'][0]){
                $save_data = [];
                foreach ($result['results'][0] as $field=>$value){
                    $save_data[$field]  = $value??'';
                }
                $save_data['event_id'] = $event_id;
                $save_data['update_time'] =date('Y-m-d H:i:s');
                if($res = $this->dao->getOne(['event_id'=>$save_data['event_id']])){
                    $id = $res['id'];
                    $this->dao->update($res['id'],$save_data );
                    $log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'View');
                }else{
                    $save_data['create_time'] =date('Y-m-d H:i:s');
                    $id = $this->dao->save($save_data);
                    $log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'View');
                }
                $view = $this->dao->getOne(['id'=>$id]);

            }else{
                $view = [];
            }

        }
        return $view;
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
