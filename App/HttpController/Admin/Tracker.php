<?php

namespace App\HttpController\Admin;



use App\Model\TrackerPointModel;
use App\Model\TrackerPointResultModel;
use App\Model\WechatModel;
use EasySwoole\EasySwoole\Config;
use EasySwoole\FastCache\Cache;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class Users
 * Create With Automatic Generator
 */
class Tracker extends \App\HttpController\Admin\Base
{
    /**
     * 获取链路记录列表
     */

    public function lists(){
        try {
            $model = TrackerPointModel::create();
            $limit =$this->param['limit']??10;
            $page =$this->param['page']??1;
            if(!empty($this->param['ip'])){ $model->where('ip',$this->param['ip']); }
            if(!empty($this->param['username'])){ $model->where('u.username',$this->param['username']); }
            if(empty($this->param['start'])){
                $yesterday = date('Ymd',time()-24*3600);
                $start_id ='';Cache::getInstance()->get('tracker_start_id_'.$yesterday);
                if(empty($start_id)){
                    $start_id = TrackerPointModel::create()->where('create_date',date('Y-m-d 00:00:00',time()-3600*24),'>=')->min('id');
                    if($start_id){Cache::getInstance()->set('tracker_start_id_'.$yesterday,$start_id,3600*24);}

                }
                $model->where('t.id',$start_id,'>=');
//                $model->where('r.tracker_id',$start_id,'>=');
                $model->where('t.create_date',date('Y-m-d 00:00:00',time()-3600*24),'>=');
//                $model->where('t.create_date','2024-01-10 00:00:00','>=');

            }else{
                $start_id = TrackerPointModel::create()->where('create_date',$this->param['start'],'>=')->min('id');
                $model->where('t.id',$start_id,'>=');
//                $model->where('r.tracker_id',$start_id,'>=');
                $model->where('t.create_date',$this->param['start'],'>=');
            }

            if(!empty($this->param['end'])){ $model->where('t.create_date',$this->param['end'],'<='); }
            if(!empty($this->param['spend'])){ $model->where('t.spendTime',$this->param['spend'],'>='); }
            if(!empty($this->param['province']) ){$model->where('t.province',"{$this->param['province']}%",'like');}
            if(!empty($this->param['city']) ){$model->where('t.city',"{$this->param['city']}%",'like');}
            if(!empty($this->param['uri']) ){$model->where('t.uri',"%{$this->param['uri']}%",'like');}
            if(!empty($this->param['result']) ){$model->where('t.data',"%{$this->param['result']}%",'like');}

            $field = 't.*,r.data,u.username,u.nickname';
            $list = $model->withTotalCount()->field($field)->alias('t')
                          ->join('td_api_tracker_point_list_result r', 'r.tracker_id=t.id', 'LEFT')
                          ->join('td_user u', 'u.id=t.user_id', 'LEFT')
                          ->order('t.id', 'desc')->page($page, $limit)->select();
            $total = $model->lastQueryResult()->getTotalCount();
            $this->writeJson(Status::CODE_OK, ['total'=>$total,'list'=>$list,'page'=>$page,'sql'=>$model->lastQuery()->getLastPrepareQuery(),'start'=>date('Y-m-d 00:00:00',time()-3600*24)], 'OK'.$start_id);
            return true;
        }catch (\Throwable $e){
            $this->writeJson(Status::CODE_OK, [], $e->getMessage());
        }


    }
    /**
     * 删除品牌
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            $data['is_deleted'] = 1;
            if( WechatModel::create()->where('id',$ids,'in')->destroy()){
                $this->writeJson(Status::CODE_OK, ['status'=>1], '删除账户成功');return false;
            }else{
                $this->writeJson(Status::CODE_OK, ['status'=>0], '删除账户失败');return false;
            }
        }else{
            $this->writeJson(Status::CODE_BAD_REQUEST, ['status'=>0,'param'=>$this->param], '请选择要删除的账户');
        }
        return false;
    }

	/**
	 * IPV6 地址转换为整数
	 * @param $ipv6
	 * @return string
	 * */
	function ip2long6($ipv6)
	{
		$ip_n = inet_pton($ipv6);
		$bits = 15; // 16 x 8 bit = 128bit
		$ipv6long = '';
		while ($bits >= 0) {
			$bin = sprintf("%08b", (ord($ip_n[$bits])));
			$ipv6long = $bin . $ipv6long;
			$bits--;
		}
		return gmp_strval(gmp_init($ipv6long, 2), 10);
	}
	/**
	 * 数字转为IPv6地址
	 * 数字长度38位
	 */
	function long2ip_v6($dec)
	{
		if (function_exists('gmp_init')) {
			$bin = gmp_strval(gmp_init($dec, 10), 2); //10进制 -> 2进制
		} elseif (function_exists('bcadd')) {
			$bin = '';
			do {
				$bin = bcmod($dec, '2') . $bin; //10进制 -> 2进制，获取$dec/2的余数
				$dec = bcdiv($dec, '2', 0); // dec/2的值，0表示小数点后位数
			} while (bccomp($dec, '0'));
		} else {
			// trigger_error('GMP or BCMATH extension not installed!', E_USER_ERROR);
			return 'GMP or BCMATH extension not installed!';
		}

		$bin = str_pad($bin, 128, '0', STR_PAD_LEFT); // 给2进制值补0
		$ip = array();
		for ($bit = 0; $bit <= 7; $bit++) {
			$bin_part = substr($bin, $bit * 16, 16); // 每16位分隔
			$ip[] = dechex(bindec($bin_part)); // 2进制->10进制->16进制
		}
		$ip = implode(':', $ip);
		// inet_pton:将可读的IP地址转换为其压缩的in_addr表示形式
		// inet_ntop:将打包的Internet地址转换为可读的表示形式
		return inet_ntop(inet_pton($ip));
	}

}

