<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionStorepromotionQueryPromotionQueryRequest {

    /**
        会话ID（分页场景首次请求结果返回，后续请求必须携带，服务根据session_id相同请求次数自动翻页返回）
     **/
    public $session_id;

    /**
        渠道PID
     **/
    public $pid;

    /**
        经度
     **/
    public $longitude;

    /**
        纬度
     **/
    public $latitude;

    /**
        城市编码（只用于经纬度覆盖多个城市时过滤）
     **/
    public $city_id;

    /**
        排序类型，默认normal，排序规则包括:{"normal":"商品创建时间倒序","distance":"距离由近到远","commission":"佣金倒序","monthlySale":"月销量","couponAmount":"叠加券金额倒序","activityReward":"奖励金金额倒序","commissionRate":"佣金比例倒序"}
     **/
    public $sort_type;

    /**
        是否参与奖励金活动（默认false不做过滤）
     **/
    public $in_activity;

    /**
        否当前有c端奖励金活动库存（默认false不做过滤）
     **/
    public $has_bonus_stock;

    /**
        店铺佣金比例下限，代表筛选店铺全店佣金大于等于0.01的店铺
     **/
    public $min_commission_rate;

    /**
        每页数量（1~20，默认20）
     **/
    public $page_size;

    /**
        三方扩展id
     **/
    public $sid;

    /**
        指定召回供给枚举
     **/
    public $biz_type;

    /**
        in_activity=false的条件下，召回的非奖励金活动cps商家是否需要带出叠加券
     **/
    public $recall_overlay_coupon;

    /**
        filter_has_overlay_coupon=true的条件下，限定只召回带叠加券的cps商户
     **/
    public $filter_has_overlay_coupon;

    /**
        filter_has_overlay_coupon=true的情况下，限定的最小叠加券券金额，单位元
     **/
    public $min_overlay_coupon_amount;

    /**
        以一级类目进行类目限定，以,或者|进行类目分隔
     **/
    public $filter_first_categories;

    /**
        1.5级类目查询，以"|"分隔
     **/
    public $filter_one_point_five_categories;

    /**
        媒体出资活动ID
     **/
    public $media_activity_id;


    public function getSessionId() : string{
        return $this->session_id;
    }

    public function setSessionId(string $sessionId){
        $this->session_id = $sessionId;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getLongitude() : string{
        return $this->longitude;
    }

    public function setLongitude(string $longitude){
        $this->longitude = $longitude;
    }

    public function getLatitude() : string{
        return $this->latitude;
    }

    public function setLatitude(string $latitude){
        $this->latitude = $latitude;
    }

    public function getCityId() : string{
        return $this->city_id;
    }

    public function setCityId(string $cityId){
        $this->city_id = $cityId;
    }

    public function getSortType() : string{
        return $this->sort_type;
    }

    public function setSortType(string $sortType){
        $this->sort_type = $sortType;
    }

    public function getInActivity() : bool{
        return $this->in_activity;
    }

    public function setInActivity(bool $inActivity){
        $this->in_activity = $inActivity;
    }

    public function getHasBonusStock() : bool{
        return $this->has_bonus_stock;
    }

    public function setHasBonusStock(bool $hasBonusStock){
        $this->has_bonus_stock = $hasBonusStock;
    }

    public function getMinCommissionRate() : string{
        return $this->min_commission_rate;
    }

    public function setMinCommissionRate(string $minCommissionRate){
        $this->min_commission_rate = $minCommissionRate;
    }

    public function getPageSize() : int{
        return $this->page_size;
    }

    public function setPageSize(int $pageSize){
        $this->page_size = $pageSize;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getBizType() : string{
        return $this->biz_type;
    }

    public function setBizType(string $bizType){
        $this->biz_type = $bizType;
    }

    public function getRecallOverlayCoupon() : bool{
        return $this->recall_overlay_coupon;
    }

    public function setRecallOverlayCoupon(bool $recallOverlayCoupon){
        $this->recall_overlay_coupon = $recallOverlayCoupon;
    }

    public function getFilterHasOverlayCoupon() : bool{
        return $this->filter_has_overlay_coupon;
    }

    public function setFilterHasOverlayCoupon(bool $filterHasOverlayCoupon){
        $this->filter_has_overlay_coupon = $filterHasOverlayCoupon;
    }

    public function getMinOverlayCouponAmount() : string{
        return $this->min_overlay_coupon_amount;
    }

    public function setMinOverlayCouponAmount(string $minOverlayCouponAmount){
        $this->min_overlay_coupon_amount = $minOverlayCouponAmount;
    }

    public function getFilterFirstCategories() : string{
        return $this->filter_first_categories;
    }

    public function setFilterFirstCategories(string $filterFirstCategories){
        $this->filter_first_categories = $filterFirstCategories;
    }

    public function getFilterOnePointFiveCategories() : string{
        return $this->filter_one_point_five_categories;
    }

    public function setFilterOnePointFiveCategories(string $filterOnePointFiveCategories){
        $this->filter_one_point_five_categories = $filterOnePointFiveCategories;
    }

    public function getMediaActivityId() : string{
        return $this->media_activity_id;
    }

    public function setMediaActivityId(string $mediaActivityId){
        $this->media_activity_id = $mediaActivityId;
    }


}

