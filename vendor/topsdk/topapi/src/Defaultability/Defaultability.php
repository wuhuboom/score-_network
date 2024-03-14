<?php
namespace Topsdk\Topapi\Defaultability;

use Topsdk\Topapi\TopApiClient;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbBbtItemPromotionFilterListRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbItemPromotionFilterListRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionMediaZoneGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbItemPromotionRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbCommonEncryptRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionMediaZoneAddRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbcpaPunishOrderGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemeMediaActivityCouponSendRequest;
use Topsdk\Topapi\Defaultability\Request\TaobaoTmcUserGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemePromotionStorepromotionQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemePromotionStorepromotionGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemePromotionOfficialactivityGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbcpaRefundOrderGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbStoreQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbStoreItemQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbBbtItemQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemePromotionItempromotionGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemePromotionItempromotionQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbcpaOrderDetailsGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbItemDetailGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbItemStoreRelationQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbcpxPositiveOrderGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbItemStoreDetailGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbcpxRefundOrderGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbcpxPunishOrderGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbBbtItemDetailGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbBbtItemStoreRelationQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbBbtItemStoreDetailGetRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbItemQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbOrderPayRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemeStorepromotionReviewbwcStockLockRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemeStorepromotionReviewbwcStockReleaseRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemeStorepromotionReviewbwcQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionElemeStorepromotionReviewbwcDetailGetRequest;
use Topsdk\Topapi\Defaultability\Request\TaobaoTmcMessageProduceRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbItemPromotionShareCreateRequest;
use Topsdk\Topapi\Defaultability\Request\TaobaoTmcUserCancelRequest;
use Topsdk\Topapi\Defaultability\Request\TaobaoTmcUserPermitRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbOrderCreateRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbOrderQueryRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionKbOrderRefundRequest;
use Topsdk\Topapi\Defaultability\Request\AlibabaAlscUnionPromotionLinkAnalyzeRequest;

class Defaultability {

    public $client;

    function __construct(TopApiClient $client) {
        $this->client = $client;
    }


    /**
        本地生活爆爆团选品筛选集合
    **/
    public function alibabaAlscUnionKbBbtItemPromotionFilterList(AlibabaAlscUnionKbBbtItemPromotionFilterListRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.bbt.item.promotion.filter.list", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体平台口碑选品筛选项集合
    **/
    public function alibabaAlscUnionKbItemPromotionFilterList(AlibabaAlscUnionKbItemPromotionFilterListRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.item.promotion.filter.list", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体推广位查询
    **/
    public function alibabaAlscUnionMediaZoneGet(AlibabaAlscUnionMediaZoneGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.media.zone.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体平台口碑选品
    **/
    public function alibabaAlscUnionKbItemPromotion(AlibabaAlscUnionKbItemPromotionRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.item.promotion", $request->toMap(), $request->toFileParamMap());
    }
    /**
        加密方法
    **/
    public function alibabaAlscUnionKbCommonEncrypt(AlibabaAlscUnionKbCommonEncryptRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.common.encrypt", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体推广位创建
    **/
    public function alibabaAlscUnionMediaZoneAdd(AlibabaAlscUnionMediaZoneAddRequest $request) {
        return $this->client->execute("alibaba.alsc.union.media.zone.add", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体推广口碑CPA用户反作弊订单数据报表
    **/
    public function alibabaAlscUnionKbcpaPunishOrderGet(AlibabaAlscUnionKbcpaPunishOrderGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kbcpa.punish.order.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟媒体出资活动红包发放
    **/
    public function alibabaAlscUnionElemeMediaActivityCouponSend(AlibabaAlscUnionElemeMediaActivityCouponSendRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.media.activity.coupon.send", $request->toMap(), $request->toFileParamMap());
    }
    /**
        获取商家所在分组及其已授权(广播)消息topics
    **/
    public function taobaoTmcUserGet(TaobaoTmcUserGetRequest $request) {
        return $this->client->execute("taobao.tmc.user.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么单店推广店铺列表
    **/
    public function alibabaAlscUnionElemePromotionStorepromotionQuery(AlibabaAlscUnionElemePromotionStorepromotionQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.promotion.storepromotion.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么单店推广单店铺查询
    **/
    public function alibabaAlscUnionElemePromotionStorepromotionGet(AlibabaAlscUnionElemePromotionStorepromotionGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.promotion.storepromotion.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么推广官方活动查询
    **/
    public function alibabaAlscUnionElemePromotionOfficialactivityGet(AlibabaAlscUnionElemePromotionOfficialactivityGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.promotion.officialactivity.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体推广口碑CPA用户维权订单数据报表
    **/
    public function alibabaAlscUnionKbcpaRefundOrderGet(AlibabaAlscUnionKbcpaRefundOrderGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kbcpa.refund.order.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟口碑商户列表
    **/
    public function alibabaAlscUnionKbStoreQuery(AlibabaAlscUnionKbStoreQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.store.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟口碑门店商品列表
    **/
    public function alibabaAlscUnionKbStoreItemQuery(AlibabaAlscUnionKbStoreItemQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.store.item.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟爆爆团商品列表
    **/
    public function alibabaAlscUnionKbBbtItemQuery(AlibabaAlscUnionKbBbtItemQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.bbt.item.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么单品推广详情
    **/
    public function alibabaAlscUnionElemePromotionItempromotionGet(AlibabaAlscUnionElemePromotionItempromotionGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.promotion.itempromotion.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么单品推广列表
    **/
    public function alibabaAlscUnionElemePromotionItempromotionQuery(AlibabaAlscUnionElemePromotionItempromotionQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.promotion.itempromotion.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体推广订单明细查询
    **/
    public function alibabaAlscUnionKbcpaOrderDetailsGet(AlibabaAlscUnionKbcpaOrderDetailsGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kbcpa.order.details.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟口碑商品详情
    **/
    public function alibabaAlscUnionKbItemDetailGet(AlibabaAlscUnionKbItemDetailGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.item.detail.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟口碑商品门店关系
    **/
    public function alibabaAlscUnionKbItemStoreRelationQuery(AlibabaAlscUnionKbItemStoreRelationQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.item.store.relation.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体推广订单明细报表查询
    **/
    public function alibabaAlscUnionKbcpxPositiveOrderGet(AlibabaAlscUnionKbcpxPositiveOrderGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kbcpx.positive.order.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟口碑门店详情
    **/
    public function alibabaAlscUnionKbItemStoreDetailGet(AlibabaAlscUnionKbItemStoreDetailGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.item.store.detail.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体推广用户维权订单数据报表
    **/
    public function alibabaAlscUnionKbcpxRefundOrderGet(AlibabaAlscUnionKbcpxRefundOrderGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kbcpx.refund.order.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体推广用户反作弊订单数据报表
    **/
    public function alibabaAlscUnionKbcpxPunishOrderGet(AlibabaAlscUnionKbcpxPunishOrderGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kbcpx.punish.order.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟爆爆团商品详情
    **/
    public function alibabaAlscUnionKbBbtItemDetailGet(AlibabaAlscUnionKbBbtItemDetailGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.bbt.item.detail.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟爆爆团商品门店关系
    **/
    public function alibabaAlscUnionKbBbtItemStoreRelationQuery(AlibabaAlscUnionKbBbtItemStoreRelationQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.bbt.item.store.relation.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟爆爆团门店详情
    **/
    public function alibabaAlscUnionKbBbtItemStoreDetailGet(AlibabaAlscUnionKbBbtItemStoreDetailGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.bbt.item.store.detail.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟口碑商品列表
    **/
    public function alibabaAlscUnionKbItemQuery(AlibabaAlscUnionKbItemQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.item.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        openapi预下单订单支付
    **/
    public function alibabaAlscUnionKbOrderPay(AlibabaAlscUnionKbOrderPayRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.order.pay", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么评价有礼库存锁定
    **/
    public function alibabaAlscUnionElemeStorepromotionReviewbwcStockLock(AlibabaAlscUnionElemeStorepromotionReviewbwcStockLockRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.storepromotion.reviewbwc.stock.lock", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么评价有礼锁定库存释放
    **/
    public function alibabaAlscUnionElemeStorepromotionReviewbwcStockRelease(AlibabaAlscUnionElemeStorepromotionReviewbwcStockReleaseRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.storepromotion.reviewbwc.stock.release", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么评价有礼店铺列表
    **/
    public function alibabaAlscUnionElemeStorepromotionReviewbwcQuery(AlibabaAlscUnionElemeStorepromotionReviewbwcQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.storepromotion.reviewbwc.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟饿了么评价有礼店铺详情
    **/
    public function alibabaAlscUnionElemeStorepromotionReviewbwcDetailGet(AlibabaAlscUnionElemeStorepromotionReviewbwcDetailGetRequest $request) {
        return $this->client->execute("alibaba.alsc.union.eleme.storepromotion.reviewbwc.detail.get", $request->toMap(), $request->toFileParamMap());
    }
    /**
        发布单条消息
    **/
    public function taobaoTmcMessageProduce(TaobaoTmcMessageProduceRequest $request) {
        return $this->client->execute("taobao.tmc.message.produce", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地生活媒体创建商品推广链接
    **/
    public function alibabaAlscUnionKbItemPromotionShareCreate(AlibabaAlscUnionKbItemPromotionShareCreateRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.item.promotion.share.create", $request->toMap(), $request->toFileParamMap());
    }
    /**
        取消用户的消息服务
    **/
    public function taobaoTmcUserCancel(TaobaoTmcUserCancelRequest $request) {
        return $this->client->execute("taobao.tmc.user.cancel", $request->toMap(), $request->toFileParamMap());
    }
    /**
        为已授权的用户开通消息服务
    **/
    public function taobaoTmcUserPermit(TaobaoTmcUserPermitRequest $request,string $session) {
        return $this->client->executeWithSession("taobao.tmc.user.permit", $request->toMap(), $request->toFileParamMap(), $session);
    }
    /**
        openapi订单创建
    **/
    public function alibabaAlscUnionKbOrderCreate(AlibabaAlscUnionKbOrderCreateRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.order.create", $request->toMap(), $request->toFileParamMap());
    }
    /**
        openapi订单查询
    **/
    public function alibabaAlscUnionKbOrderQuery(AlibabaAlscUnionKbOrderQueryRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.order.query", $request->toMap(), $request->toFileParamMap());
    }
    /**
        openapi订单售中退
    **/
    public function alibabaAlscUnionKbOrderRefund(AlibabaAlscUnionKbOrderRefundRequest $request) {
        return $this->client->execute("alibaba.alsc.union.kb.order.refund", $request->toMap(), $request->toFileParamMap());
    }
    /**
        本地联盟推广链接推广对象解析
    **/
    public function alibabaAlscUnionPromotionLinkAnalyze(AlibabaAlscUnionPromotionLinkAnalyzeRequest $request) {
        return $this->client->execute("alibaba.alsc.union.promotion.link.analyze", $request->toMap(), $request->toFileParamMap());
    }
}