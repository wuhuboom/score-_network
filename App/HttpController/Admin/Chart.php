<?php

namespace App\HttpController\Admin;


use App\HttpController\Common\Common;
use App\Model\ApiRequestRecordModel;
use App\Model\EndedModel;
use App\Model\InplayModel;
use App\Model\LeagueModel;
use App\Model\LeagueTableModel;
use App\Model\TeamModel;
use App\Model\TrackerPointModel;
use App\Model\UpcomingModel;
use App\Model\ViewModel;
use App\Service\ApiRequestRecordService;
use App\Service\ViewService;


class Chart extends Base
{
    /**
     * 顶部数据
     */
    public function getTopData(){
        try {
            //今日PV（次）
            //
            //298
            //
            //
            //今日UV（个）
            $today_date = [date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')];
            $today_time = [strtotime(date('Y-m-d 00:00:00')),strtotime(date('Y-m-d 23:59:59'))];
            $where['create_date']=[$today_date,'between'];
            $uv = TrackerPointModel::create()->where($where)->field('count(DISTINCT(`ip`)) as num')->find()['num']??0;
            $pv = TrackerPointModel::create()->where($where)->count()??1;
            $data[] = [
                'header_left'=>'UV',
                'header_right'=>'今日',
                'value'=>$uv,
                'footer_left'=>'PV',
                'footer_right'=>$pv,
                'date_time'=>date('Y-m-d H:i:s'),
            ];
            $today_request_num  = ApiRequestRecordModel::create()->where(['create_time'=>[$today_date,'between']])->count()??0;
            $total_request_num  = ApiRequestRecordModel::create()->count()??0;
            $data[] = [
                'header_left'=>'API请求次数',
                'header_right'=>'今日',
                'value'=>$today_request_num,
                'footer_left'=>'总请求次数',
                'footer_right'=>$total_request_num,
                'date_time'=>date('Y-m-d H:i:s'),
            ];
            $inplay_num = InplayModel::create()->count()??0;
            $result_num = EndedModel::create()->count()??0;
            $data[] = [
                'header_left'=>'正在进行的比赛',
                'header_right'=>'今日',
                'value'=>$inplay_num,
                'footer_left'=>'比赛结果数',
                'footer_right'=>$result_num,
                'date_time'=>date('Y-m-d H:i:s'),
            ];
            $today_upcoming_num = UpcomingModel::create()->where(['time'=>[$today_time,'between']])->count()??0;
            $total_upcoming_num = UpcomingModel::create()->where(['time'=>[$today_time[0],'>=']])->count()??0;
            $data[] = [
                'header_left'=>'今日赛程',
                'header_right'=>'今日',
                'value'=>$today_upcoming_num,
                'footer_left'=>'总赛程数',
                'footer_right'=>$total_upcoming_num,
                'date_time'=>date('Y-m-d H:i:s'),
            ];

            $view_num = ViewModel::create()->count()??0;
            $data[] = [
                'header_left'=>'比赛详情数',
                'header_right'=>'',
                'value'=>$view_num,
                'footer_left'=>'',
                'footer_right'=>'',
                'date_time'=>date('Y-m-d H:i:s'),
            ];
            $league_num = LeagueModel::create()->count()??0;

            $data[] = [
                'header_left'=>'联赛数',
                'header_right'=>'',
                'value'=>$league_num,
                'footer_left'=>'',
                'footer_right'=>'',
                'date_time'=>date('Y-m-d H:i:s'),
            ];

            $team_num =TeamModel::create()->count()??0;
            $data[] = [
                'header_left'=>'球队数',
                'header_right'=>'',
                'value'=>$team_num,
                'footer_left'=>'',
                'footer_right'=>'',
                'date_time'=>date('Y-m-d H:i:s'),
            ];
            $this->AjaxJson(1,$data,'');return false;
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }


    /**
     * 订单数据统计
     */
    public function getRequestData(){
        try {
            $dateTime = $this->getParamDateTime();
            $x = $this->periodDate($dateTime['start_time'],$dateTime['end_time']);
            $y_one=$y_two=array_pad([0], count($x), 0);

            $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $list = ApiRequestRecordModel::create()->where($where)->field("DATE_FORMAT(create_time, '%Y-%m-%d') AS time, COUNT(*) AS num")->group('time')->order('time','desc')->select();
            $data1 = array_column($list,'num','time');
            foreach ($x as $k=>$v){
                $y_one[$k] = isset($data1[$v])?$data1[$v]:0;
            }
            $this->AjaxJson(1,['x'=>array_values($x),'y_one'=>array_values($y_one),'y_two'=>array_values($y_two)],'OK');return false;
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }

    /**
     * 获取查询的开始日期和结束日期
     */
    protected function getParamDateTime($type='month'){
        $start_time = $end_time = '';
        switch ($type){
            case '7':
                $start_time = date('Y-m-d 00:00:00',time()-6*3600*24);
                $end_time = date('Y-m-d 23:59:59');
                break;
            case '30':
                $start_time = date('Y-m-d 00:00:00',time()-29*3600*24);
                $end_time = date('Y-m-d 23:59:59');
                break;
            case 'last_month':
                $start_time =date('Y-m-01 00:00:01',strtotime("-1 months",time()));
                $day = date('t',strtotime("-1 months",time()));
                $end_time = date("Y-m-{$day} 23:59:59", strtotime("-1 months", time()));
                break;
            case 'month':
                $start_time = date('Y-m-01 00:00:00',time());
                $end_time = date('Y-m-d 23:59:59');
                break;
            default:
                $start_time = date('Y-m-d 00:00:00',time()-6*3600*24);
                $end_time = date('Y-m-d 23:59:59');
        }
        return compact('start_time','end_time');
    }
    /**
     * 两个时间段的所有日期数组
     * @param $startDate
     * @param $endDate
     *
     * @return array
     */
    protected function periodDate($startDate,$endDate){
        $startTime = strtotime($startDate);
        $endTime   = strtotime($endDate);
        $arr       = array();
        while ($startTime<=$endTime){
            $arr[] = date('Y-m-d', $startTime);
            $startTime = $startTime+3600*24;
        }
        return $arr;
    }
}

