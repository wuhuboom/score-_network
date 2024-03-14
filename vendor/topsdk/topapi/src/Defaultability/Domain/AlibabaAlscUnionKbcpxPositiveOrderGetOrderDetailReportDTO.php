<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbcpxPositiveOrderGetOrderDetailReportDTO {

    /**
        商品标题
     **/
    public $title;

    /**
        商品图片下载url
     **/
    public $pic_url;

    /**
        店铺名称
     **/
    public $shop_name;

    /**
        付款金额
     **/
    public $pay_amount;

    /**
        结算金额，针对CPS订单
     **/
    public $settle_amount;

    /**
        点击时间
     **/
    public $trace_time;

    /**
        创建时间
     **/
    public $tk_create_time;

    /**
        付款时间
     **/
    public $pay_time;

    /**
        收货时间
     **/
    public $receive_time;

    /**
        结算时间
     **/
    public $settle_time;

    /**
        预估收入。预估到手的佣金，包含技术服务费。付款之后有值。没结算之前只有income有值
     **/
    public $income;

    /**
        结算预估收入。最终到手的佣金，没有扣除技术服务；结算之后有值
     **/
    public $settle;

    /**
        商品ID
     **/
    public $item_id;

    /**
        商品数量
     **/
    public $product_num;

    /**
        商品单价
     **/
    public $unit_price;

    /**
        商品类目
     **/
    public $category_name;

    /**
        淘宝子单号。biz_order_id+biz_unit是联合主键
     **/
    public $biz_order_id;

    /**
        淘宝主单号
     **/
    public $parent_order_id;

    /**
        主商品ID，针对CPS订单
     **/
    public $main_item_id;

    /**
        主商品名称，针对CPS订单
     **/
    public $main_item_title;

    /**
        订单状态，0-已失效 1-已下单 2-已付款 4-已收货
     **/
    public $order_state;

    /**
        订单补充状态，针对CPS订单，考虑到存在已付款的cps订单发生售中退款，不参与结算的情况需要渠道知晓
     **/
    public $order_item_status_name;

    /**
        结算状态，1-已结算 2-未结算
     **/
    public $settle_state;

    /**
        结算基数，针对CPS订单，等于付款金额+平台补贴
     **/
    public $full_settle_amount;

    /**
        佣金比率，针对CPS订单
     **/
    public $commission_rate;

    /**
        佣金金额，针对CPS订单
     **/
    public $commission_fee;

    /**
        补贴比率，针对CPS订单
     **/
    public $subsidy_rate;

    /**
        补贴金额
     **/
    public $subsidy_fee;

    /**
        收入比率，针对CPS订单，等于佣金比率+补贴比率
     **/
    public $income_rate;

    /**
        分成比率，针对CPS订单
     **/
    public $stratify_rate;

    /**
        提成，针对CPS订单，等于收入比率*分成比率
     **/
    public $deduct_rate;

    /**
        技术服务费率
     **/
    public $platform_commission_rate;

    /**
        技术服务费
     **/
    public $platform_commission_fee;

    /**
        淘宝直播费率，针对CPS订单
     **/
    public $channel_rate;

    /**
        淘宝直播费，针对CPS订单
     **/
    public $channel_fee;

    /**
        媒体ID
     **/
    public $media_id;

    /**
        媒体名称
     **/
    public $media_name;

    /**
        推广位ID
     **/
    public $ad_zone_id;

    /**
        推广位名称
     **/
    public $ad_zone_name;

    /**
        招商服务费
     **/
    public $activity_fee;

    /**
        招商服务费中的技术服务费
     **/
    public $activity_service_fee;

    /**
        招商服务费中的技术服务率
     **/
    public $activity_service_rate;

    /**
        更新时间
     **/
    public $gmt_modified;

    /**
        售中退 或 售后退
     **/
    public $tag;

    /**
        特定标识。长度限制50字符以内（开通SID权限后下单返回）
     **/
    public $sid;

    /**
        1口碑，2饿了么
     **/
    public $platform_type;

    /**
        活动ID
     **/
    public $activity_id;

    /**
        核销门店（已加密）
     **/
    public $used_store_id;

    /**
        pid
     **/
    public $pid;

    /**
        卡券订单号
     **/
    public $relation_order_id;

    /**
        场景值，7卡券订单，8卡券核销订单。16/17囤券券订单，18囤券券外卖订单；19赏金红包
     **/
    public $flow_type;

    /**
        0已失效，1已下单，2已付款，3售中退，4已收货，5售后退
     **/
    public $order_item_status;

    /**
        活动信息明细
     **/
    public $activity_info_remark_list;

    /**
        权益ID（flow_type=10或11时为媒体出资活动ID）
     **/
    public $channel_right_id;

    /**
        扩展信息。tpOrderId：卡券场景下用来找C端用户看到的卡券订单号，无需理解，只要匹配上就行；alscOrderId：卡券场景下用来找C端用户看到的卡券核销订单号，无需理解，只要匹配上就行；isSelfPurchase：是否字段，true/false ；cityName：城市，示例：上海 ；platformActivityType：活动类型，BRAND、CONSUMPTION，对应品牌日和消费日 ；attrOrderDesc：是否归因订单，是/否
     **/
    public $ext_info;


    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getPicUrl() : string{
        return $this->pic_url;
    }

    public function setPicUrl(string $picUrl){
        $this->pic_url = $picUrl;
    }

    public function getShopName() : string{
        return $this->shop_name;
    }

    public function setShopName(string $shopName){
        $this->shop_name = $shopName;
    }

    public function getPayAmount() : string{
        return $this->pay_amount;
    }

    public function setPayAmount(string $payAmount){
        $this->pay_amount = $payAmount;
    }

    public function getSettleAmount() : string{
        return $this->settle_amount;
    }

    public function setSettleAmount(string $settleAmount){
        $this->settle_amount = $settleAmount;
    }

    public function getTraceTime() : string{
        return $this->trace_time;
    }

    public function setTraceTime(string $traceTime){
        $this->trace_time = $traceTime;
    }

    public function getTkCreateTime() : string{
        return $this->tk_create_time;
    }

    public function setTkCreateTime(string $tkCreateTime){
        $this->tk_create_time = $tkCreateTime;
    }

    public function getPayTime() : string{
        return $this->pay_time;
    }

    public function setPayTime(string $payTime){
        $this->pay_time = $payTime;
    }

    public function getReceiveTime() : string{
        return $this->receive_time;
    }

    public function setReceiveTime(string $receiveTime){
        $this->receive_time = $receiveTime;
    }

    public function getSettleTime() : string{
        return $this->settle_time;
    }

    public function setSettleTime(string $settleTime){
        $this->settle_time = $settleTime;
    }

    public function getIncome() : string{
        return $this->income;
    }

    public function setIncome(string $income){
        $this->income = $income;
    }

    public function getSettle() : string{
        return $this->settle;
    }

    public function setSettle(string $settle){
        $this->settle = $settle;
    }

    public function getItemId() : string{
        return $this->item_id;
    }

    public function setItemId(string $itemId){
        $this->item_id = $itemId;
    }

    public function getProductNum() : int{
        return $this->product_num;
    }

    public function setProductNum(int $productNum){
        $this->product_num = $productNum;
    }

    public function getUnitPrice() : string{
        return $this->unit_price;
    }

    public function setUnitPrice(string $unitPrice){
        $this->unit_price = $unitPrice;
    }

    public function getCategoryName() : string{
        return $this->category_name;
    }

    public function setCategoryName(string $categoryName){
        $this->category_name = $categoryName;
    }

    public function getBizOrderId() : int{
        return $this->biz_order_id;
    }

    public function setBizOrderId(int $bizOrderId){
        $this->biz_order_id = $bizOrderId;
    }

    public function getParentOrderId() : int{
        return $this->parent_order_id;
    }

    public function setParentOrderId(int $parentOrderId){
        $this->parent_order_id = $parentOrderId;
    }

    public function getMainItemId() : string{
        return $this->main_item_id;
    }

    public function setMainItemId(string $mainItemId){
        $this->main_item_id = $mainItemId;
    }

    public function getMainItemTitle() : string{
        return $this->main_item_title;
    }

    public function setMainItemTitle(string $mainItemTitle){
        $this->main_item_title = $mainItemTitle;
    }

    public function getOrderState() : int{
        return $this->order_state;
    }

    public function setOrderState(int $orderState){
        $this->order_state = $orderState;
    }

    public function getOrderItemStatusName() : string{
        return $this->order_item_status_name;
    }

    public function setOrderItemStatusName(string $orderItemStatusName){
        $this->order_item_status_name = $orderItemStatusName;
    }

    public function getSettleState() : int{
        return $this->settle_state;
    }

    public function setSettleState(int $settleState){
        $this->settle_state = $settleState;
    }

    public function getFullSettleAmount() : string{
        return $this->full_settle_amount;
    }

    public function setFullSettleAmount(string $fullSettleAmount){
        $this->full_settle_amount = $fullSettleAmount;
    }

    public function getCommissionRate() : string{
        return $this->commission_rate;
    }

    public function setCommissionRate(string $commissionRate){
        $this->commission_rate = $commissionRate;
    }

    public function getCommissionFee() : string{
        return $this->commission_fee;
    }

    public function setCommissionFee(string $commissionFee){
        $this->commission_fee = $commissionFee;
    }

    public function getSubsidyRate() : string{
        return $this->subsidy_rate;
    }

    public function setSubsidyRate(string $subsidyRate){
        $this->subsidy_rate = $subsidyRate;
    }

    public function getSubsidyFee() : string{
        return $this->subsidy_fee;
    }

    public function setSubsidyFee(string $subsidyFee){
        $this->subsidy_fee = $subsidyFee;
    }

    public function getIncomeRate() : string{
        return $this->income_rate;
    }

    public function setIncomeRate(string $incomeRate){
        $this->income_rate = $incomeRate;
    }

    public function getStratifyRate() : string{
        return $this->stratify_rate;
    }

    public function setStratifyRate(string $stratifyRate){
        $this->stratify_rate = $stratifyRate;
    }

    public function getDeductRate() : string{
        return $this->deduct_rate;
    }

    public function setDeductRate(string $deductRate){
        $this->deduct_rate = $deductRate;
    }

    public function getPlatformCommissionRate() : string{
        return $this->platform_commission_rate;
    }

    public function setPlatformCommissionRate(string $platformCommissionRate){
        $this->platform_commission_rate = $platformCommissionRate;
    }

    public function getPlatformCommissionFee() : string{
        return $this->platform_commission_fee;
    }

    public function setPlatformCommissionFee(string $platformCommissionFee){
        $this->platform_commission_fee = $platformCommissionFee;
    }

    public function getChannelRate() : string{
        return $this->channel_rate;
    }

    public function setChannelRate(string $channelRate){
        $this->channel_rate = $channelRate;
    }

    public function getChannelFee() : string{
        return $this->channel_fee;
    }

    public function setChannelFee(string $channelFee){
        $this->channel_fee = $channelFee;
    }

    public function getMediaId() : string{
        return $this->media_id;
    }

    public function setMediaId(string $mediaId){
        $this->media_id = $mediaId;
    }

    public function getMediaName() : string{
        return $this->media_name;
    }

    public function setMediaName(string $mediaName){
        $this->media_name = $mediaName;
    }

    public function getAdZoneId() : string{
        return $this->ad_zone_id;
    }

    public function setAdZoneId(string $adZoneId){
        $this->ad_zone_id = $adZoneId;
    }

    public function getAdZoneName() : string{
        return $this->ad_zone_name;
    }

    public function setAdZoneName(string $adZoneName){
        $this->ad_zone_name = $adZoneName;
    }

    public function getActivityFee() : string{
        return $this->activity_fee;
    }

    public function setActivityFee(string $activityFee){
        $this->activity_fee = $activityFee;
    }

    public function getActivityServiceFee() : string{
        return $this->activity_service_fee;
    }

    public function setActivityServiceFee(string $activityServiceFee){
        $this->activity_service_fee = $activityServiceFee;
    }

    public function getActivityServiceRate() : string{
        return $this->activity_service_rate;
    }

    public function setActivityServiceRate(string $activityServiceRate){
        $this->activity_service_rate = $activityServiceRate;
    }

    public function getGmtModified() : string{
        return $this->gmt_modified;
    }

    public function setGmtModified(string $gmtModified){
        $this->gmt_modified = $gmtModified;
    }

    public function getTag() : string{
        return $this->tag;
    }

    public function setTag(string $tag){
        $this->tag = $tag;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getPlatformType() : int{
        return $this->platform_type;
    }

    public function setPlatformType(int $platformType){
        $this->platform_type = $platformType;
    }

    public function getActivityId() : int{
        return $this->activity_id;
    }

    public function setActivityId(int $activityId){
        $this->activity_id = $activityId;
    }

    public function getUsedStoreId() : string{
        return $this->used_store_id;
    }

    public function setUsedStoreId(string $usedStoreId){
        $this->used_store_id = $usedStoreId;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getRelationOrderId() : int{
        return $this->relation_order_id;
    }

    public function setRelationOrderId(int $relationOrderId){
        $this->relation_order_id = $relationOrderId;
    }

    public function getFlowType() : int{
        return $this->flow_type;
    }

    public function setFlowType(int $flowType){
        $this->flow_type = $flowType;
    }

    public function getOrderItemStatus() : int{
        return $this->order_item_status;
    }

    public function setOrderItemStatus(int $orderItemStatus){
        $this->order_item_status = $orderItemStatus;
    }

    public function getActivityInfoRemarkList() : string{
        return $this->activity_info_remark_list;
    }

    public function setActivityInfoRemarkList(string $activityInfoRemarkList){
        $this->activity_info_remark_list = $activityInfoRemarkList;
    }

    public function getChannelRightId() : string{
        return $this->channel_right_id;
    }

    public function setChannelRightId(string $channelRightId){
        $this->channel_right_id = $channelRightId;
    }

    public function getExtInfo() : string{
        return $this->ext_info;
    }

    public function setExtInfo(string $extInfo){
        $this->ext_info = $extInfo;
    }


}

