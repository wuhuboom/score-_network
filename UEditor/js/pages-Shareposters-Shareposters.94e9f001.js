(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-Shareposters-Shareposters"],{"2aea":function(e,t,n){"use strict";var i=n("66a2"),a=n.n(i);a.a},"66a2":function(e,t,n){var i=n("8a0c");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var a=n("4f06").default;a("34a60c9e",i,!0,{sourceMap:!1,shadowMode:!1})},"6a8f":function(e,t,n){"use strict";n.r(t);var i=n("7f3d"),a=n.n(i);for(var o in i)["default"].indexOf(o)<0&&function(e){n.d(t,e,(function(){return i[e]}))}(o);t["default"]=a.a},"7f3d":function(e,t,n){"use strict";(function(e){n("7a82");var i=n("4ea4").default;Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,n("e9c4");var a=i(n("cf7b")),o=(getApp(),{data:function(){return{Shareposters:[],cardListidx:0,defoImg:"",ServiceAnimate:!1}},onLoad:function(){this.getShareposters()},onReady:function(){this.getConfig();var e=document.createElement("script");e.src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js",document.head.appendChild(e),e.onload=function(){}},methods:{getShareposters:function(){var e=this;e.$api.GetShareposters({}).then((function(t){e.Shareposters=t.data.result,e.defoImg=t.data.result[0]})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))},selectCard:function(e,t){this.cardListidx=t,this.defoImg=e},H5savePic:function(e){var t=this;t.ServiceAnimate=!0,setTimeout((function(){t.ServiceAnimate=!1}),2500)},sharewxapp:function(){uni.share({provider:"weixin",scene:"WXSceneSession",type:2,imageUrl:this.defoImg,success:function(t){e("log","success:"+JSON.stringify(t)," at pages/Shareposters/Shareposters.vue:165")},fail:function(t){e("log","fail:"+JSON.stringify(t)," at pages/Shareposters/Shareposters.vue:168")}})},shareWXSceneTimeline:function(){uni.share({provider:"weixin",scene:"WXSceneTimeline",type:2,imageUrl:this.defoImg,success:function(t){e("log","success:"+JSON.stringify(t)," at pages/Shareposters/Shareposters.vue:181")},fail:function(t){e("log","fail:"+JSON.stringify(t)," at pages/Shareposters/Shareposters.vue:184")}})},getConfig:function(){var t=uni.getStorageSync("userinfo").id;this.$api.GetwxJSk({url:encodeURIComponent(window.location.href.split("#")[0])}).then((function(e){a.default.config({debug:!1,appId:e.data.result.appId,timestamp:e.data.result.timestamp,nonceStr:e.data.result.nonceStr,signature:e.data.result.signature,jsApiList:e.data.result.jsApiList,openTagList:["wx-open-launch-weapp"]})})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})})),a.default.ready((function(e){a.default.updateAppMessageShareData({title:"呵味惠",desc:"呵味惠,多快好省新生活",link:"https://"+document.domain+"/#/pages/logon/logon?parent_id="+t,imgUrl:"https://"+document.domain+"/public/uploads/shop/shop_logo.png",success:function(){}}),a.default.updateTimelineShareData({title:"呵味惠,多快好省新生活",link:"https://"+document.domain+"/#/pages/logon/logon?parent_id="+t,imgUrl:"https://"+document.domain+"/public/uploads/shop/shop_logo.png",success:function(){}})})),a.default.error((function(t){e("log","config信息验证失败会执行error函数",t," at pages/Shareposters/Shareposters.vue:238")}))}}});t.default=o}).call(this,n("0de9")["log"])},"7fa5":function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"c",(function(){return a})),n.d(t,"a",(function(){}));var i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-uni-view",[n("v-uni-view",{staticClass:"haibao"},[n("v-uni-view",{staticClass:"haibao_wrap"},[e.ServiceAnimate?n("v-uni-view",{staticClass:"ca_tishi",class:{arrow_box:e.ServiceAnimate}},[n("v-uni-view",[e._v("长按图片保存")])],1):e._e(),n("v-uni-image",{staticClass:"haibaotu",class:{arrow_box:e.ServiceAnimate},attrs:{src:e.defoImg,mode:"aspectFill"}})],1),n("v-uni-view",{staticClass:"hb_gongju_bar"},[n("v-uni-view",{staticClass:"Share-popup-info"},[n("v-uni-view",{staticClass:"fenxiang-btn"},[n("v-uni-view",{staticClass:"btn-1"},[n("v-uni-image",{staticClass:"wxicon",attrs:{src:"/static/images/wx_icon.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.sharewxapp()}}}),n("v-uni-view",[e._v("微信好友")])],1),n("v-uni-view",{staticClass:"btn-2"},[n("v-uni-image",{staticClass:"baocunicon",attrs:{src:"/static/images/pyq_icon.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.shareWXSceneTimeline()}}}),n("v-uni-view",[e._v("朋友圈")])],1),n("v-uni-view",{staticClass:"btn-2"},[n("v-uni-image",{staticClass:"baocunicon",attrs:{src:"/static/images/qq_icon.png"}}),n("v-uni-view",[e._v("QQ")])],1),n("v-uni-view",{staticClass:"btn-2",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.H5savePic()}}},[n("v-uni-image",{staticClass:"baocunicon",attrs:{src:"/static/images/baocun_icon.png"}}),n("v-uni-view",[e._v("保存图片")])],1)],1)],1)],1)],1),n("v-uni-view",{staticClass:"xuanzwe_img"},[n("v-uni-scroll-view",{staticClass:"uni-swiper-tab",attrs:{"scroll-x":!0}},e._l(e.Shareposters,(function(t,i){return n("v-uni-view",{key:i,staticClass:"card_list_item scrollx_items",on:{click:function(n){arguments[0]=n=e.$handleEvent(n),e.selectCard(t,i)}}},[n("v-uni-image",{staticClass:"card_icon",class:[e.cardListidx==i?"selectA":""],attrs:{src:t,mode:"aspectFill"}}),e.cardListidx==i?n("v-uni-view",{staticClass:"duihao"},[n("v-uni-image",{attrs:{src:"/static/images/member/m_5.png",mode:"widthFix"}})],1):e._e()],1)})),1)],1)],1)},a=[]},"8a0c":function(e,t,n){var i=n("24fb");t=i(!1),t.push([e.i,".haibao[data-v-0dba52fe]{padding:%?40?%;text-align:center;position:relative}.haibao .haibao_wrap[data-v-0dba52fe]{position:relative}.haibao .haibao_wrap .ca_tishi[data-v-0dba52fe]{text-align:center;background-color:rgba(0,0,0,.65);width:100%;padding:%?20?%;position:absolute;bottom:0;left:0;right:0;z-index:4;color:#fff;border-radius:0 0 %?20?% %?20?%}.haibao .haibao_wrap .haibaotu[data-v-0dba52fe]{width:100%;height:%?960?%;background-color:#f7f7f7;border-radius:%?20?%;vertical-align:bottom}.haibao .haibao_wrap .arrow_box[data-v-0dba52fe]{-webkit-animation:shake-data-v-0dba52fe .82s cubic-bezier(.36,.07,.19,.97) both;animation:shake-data-v-0dba52fe .82s cubic-bezier(.36,.07,.19,.97) both}.haibao .hb_gongju_bar .Share-popup-info[data-v-0dba52fe]{background-color:#fff;padding:0 %?30?%;border-radius:%?30?% %?30?% 0 0}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn[data-v-0dba52fe]{display:flex;align-items:center;width:96%;margin:%?40?% auto;justify-content:space-between}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn .btn-1[data-v-0dba52fe]{text-align:center;color:#999;position:relative}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn .btn-1 .wxicon[data-v-0dba52fe]{width:%?90?%;height:%?90?%;border-radius:%?200?%}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn .btn-2[data-v-0dba52fe]{text-align:center;color:#999}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn .btn-2 .baocunicon[data-v-0dba52fe]{width:%?90?%;height:%?90?%;border-radius:%?10?%}.haibao .hb_gongju_bar .Share-popup-info .quxiao-btn[data-v-0dba52fe]{border-radius:%?15?%;background-color:#f7f8fa;color:#666;padding:%?30?% %?50?%;text-align:center}.xuanzwe_img[data-v-0dba52fe]{position:fixed;bottom:0;left:0;right:0;margin:0 auto;width:100%;background-color:#f7f7f7;padding:%?20?%}.xuanzwe_img .uni-swiper-tab[data-v-0dba52fe]{white-space:nowrap}.xuanzwe_img .scrollx_items[data-v-0dba52fe]{text-align:left;display:inline-block;width:%?100?%;box-sizing:border-box;margin:%?20?% %?14?% %?40?% 0}.xuanzwe_img .card_list_item[data-v-0dba52fe]{text-align:center;background-color:#f7f7f7;height:%?100?%;width:%?100?%;border-radius:%?20?%;padding:0 0;flex:1;margin:0 %?12?%;position:relative}.xuanzwe_img .card_list_item .duihao[data-v-0dba52fe]{right:-4px;bottom:%?-16?%;position:absolute}.xuanzwe_img .card_list_item .duihao uni-image[data-v-0dba52fe]{width:%?40?%;border-bottom-right-radius:10px}.xuanzwe_img .card_list_item .card_icon[data-v-0dba52fe]{width:%?100?%;height:%?100?%;border-radius:%?20?%;border:3px solid #f7f7f7}.xuanzwe_img .card_list_item .selectA[data-v-0dba52fe]{border:3px solid #ff9a44!important;background-color:#fdf2e3!important}@-webkit-keyframes shake-data-v-0dba52fe{10%,\n  90%{-webkit-transform:translate3d(-1px,0 0);transform:translate3d(-1px,0 0)}20%,\n  80%{-webkit-transform:translate3d(2px,0,0);transform:translate3d(2px,0,0)}30%,\n  50%,\n  70%{-webkit-transform:translate3d(-4px,0,0);transform:translate3d(-4px,0,0)}40%,\n  60%{-webkit-transform:translate3d(4px,0,0);transform:translate3d(4px,0,0)}}@keyframes shake-data-v-0dba52fe{10%,\n  90%{-webkit-transform:translate3d(-1px,0 0);transform:translate3d(-1px,0 0)}20%,\n  80%{-webkit-transform:translate3d(2px,0,0);transform:translate3d(2px,0,0)}30%,\n  50%,\n  70%{-webkit-transform:translate3d(-4px,0,0);transform:translate3d(-4px,0,0)}40%,\n  60%{-webkit-transform:translate3d(4px,0,0);transform:translate3d(4px,0,0)}}@-webkit-keyframes glow-data-v-0dba52fe{0%{border-color:#f7f7f7;box-shadow:0 0 0 2px #ff9a44,inset 0 0 0 2px #ff9a44,0 0 0 #ff9a44}100%{border-color:#f7f7f7;box-shadow:0 0 0 5px #ff9a44,inset 0 0 0 5px #ff9a44,0 0 0 #ff9a44}}@keyframes glow-data-v-0dba52fe{0%{border-color:#f7f7f7;box-shadow:0 0 0 2px #ff9a44,inset 0 0 0 2px #ff9a44,0 0 0 #ff9a44}100%{border-color:#f7f7f7;box-shadow:0 0 0 5px #ff9a44,inset 0 0 0 5px #ff9a44,0 0 0 #ff9a44}}",""]),e.exports=t},9523:function(e,t,n){n("7a82");var i=n("a395");e.exports=function(e,t,n){return t=i(t),t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e},e.exports.__esModule=!0,e.exports["default"]=e.exports},a395:function(e,t,n){var i=n("7037")["default"],a=n("e50d");e.exports=function(e){var t=a(e,"string");return"symbol"===i(t)?t:String(t)},e.exports.__esModule=!0,e.exports["default"]=e.exports},c26a:function(e,t,n){"use strict";n.r(t);var i=n("7fa5"),a=n("6a8f");for(var o in a)["default"].indexOf(o)<0&&function(e){n.d(t,e,(function(){return a[e]}))}(o);n("2aea");var r=n("f0c5"),s=Object(r["a"])(a["default"],i["b"],i["c"],!1,null,"0dba52fe",null,!1,i["a"],void 0);t["default"]=s.exports},cf7b:function(e,t,n){(function(t){var i=n("9523").default;n("ac1f"),n("466d"),n("c975"),n("14d9"),n("5319"),n("e9c4"),function(n,a){e.exports=function(e,n){if(!e.jWeixin){var a,o,r={config:"preVerifyJSAPI",onMenuShareTimeline:"menu:share:timeline",onMenuShareAppMessage:"menu:share:appmessage",onMenuShareQQ:"menu:share:qq",onMenuShareWeibo:"menu:share:weiboApp",onMenuShareQZone:"menu:share:QZone",previewImage:"imagePreview",getLocation:"geoLocation",openProductSpecificView:"openProductViewWithPid",addCard:"batchAddCard",openCard:"batchViewCard",chooseWXPay:"getBrandWCPayRequest",openEnterpriseRedPacket:"getRecevieBizHongBaoRequest",startSearchBeacons:"startMonitoringBeacons",stopSearchBeacons:"stopMonitoringBeacons",onSearchBeacons:"onBeaconsInRange",consumeAndShareCard:"consumedShareCard",openAddress:"editAddress"},s=function(){var e={};for(var t in r)e[r[t]]=t;return e}(),c=e.document,d=c.title,u=navigator.userAgent.toLowerCase(),l=navigator.platform.toLowerCase(),f=!(!l.match("mac")&&!l.match("win")),p=-1!=u.indexOf("wxdebugger"),g=-1!=u.indexOf("micromessenger"),m=-1!=u.indexOf("android"),h=-1!=u.indexOf("iphone")||-1!=u.indexOf("ipad"),v=(o=u.match(/micromessenger\/(\d+\.\d+\.\d+)/)||u.match(/micromessenger\/(\d+\.\d+)/))?o[1]:"",b={initStartTime:E(),initEndTime:0,preVerifyStartTime:0,preVerifyEndTime:0},w={version:1,appId:"",initTime:0,preVerifyTime:0,networkType:"",isPreVerifyOk:1,systemType:h?1:m?2:-1,clientVersion:v,url:encodeURIComponent(location.href)},_={},x={_completes:[]},S={state:0,data:{}};N((function(){b.initEndTime=E()}));var y=!1,k=[],I=(a={config:function(t){B("config",_=t);var n=!1!==_.check;N((function(){if(n)M(r.config,{verifyJsApiList:O(_.jsApiList),verifyOpenTagList:O(_.openTagList)},function(){x._complete=function(e){b.preVerifyEndTime=E(),S.state=1,S.data=e},x.success=function(e){w.isPreVerifyOk=0},x.fail=function(e){x._fail?x._fail(e):S.state=-1};var e=x._completes;return e.push((function(){!function(){if(!(f||p||_.debug||v<"6.0.2"||w.systemType<0)){var e=new Image;w.appId=_.appId,w.initTime=b.initEndTime-b.initStartTime,w.preVerifyTime=b.preVerifyEndTime-b.preVerifyStartTime,I.getNetworkType({isInnerInvoke:!0,success:function(t){w.networkType=t.networkType;var n="https://open.weixin.qq.com/sdk/report?v="+w.version+"&o="+w.isPreVerifyOk+"&s="+w.systemType+"&c="+w.clientVersion+"&a="+w.appId+"&n="+w.networkType+"&i="+w.initTime+"&p="+w.preVerifyTime+"&u="+w.url;e.src=n}})}}()})),x.complete=function(t){for(var n=0,i=e.length;n<i;++n)e[n]();x._completes=[]},x}()),b.preVerifyStartTime=E();else{S.state=1;for(var e=x._completes,t=0,i=e.length;t<i;++t)e[t]();x._completes=[]}})),I.invoke||(I.invoke=function(t,n,i){e.WeixinJSBridge&&WeixinJSBridge.invoke(t,P(n),i)},I.on=function(t,n){e.WeixinJSBridge&&WeixinJSBridge.on(t,n)})},ready:function(e){0!=S.state?e():(x._completes.push(e),!g&&_.debug&&e())},error:function(e){v<"6.0.2"||(-1==S.state?e(S.data):x._fail=e)},checkJsApi:function(e){M("checkJsApi",{jsApiList:O(e.jsApiList)},(e._complete=function(e){if(m){var t=e.checkResult;t&&(e.checkResult=JSON.parse(t))}e=function(e){var t=e.checkResult;for(var n in t){var i=s[n];i&&(t[i]=t[n],delete t[n])}return e}(e)},e))},onMenuShareTimeline:function(e){A(r.onMenuShareTimeline,{complete:function(){M("shareTimeline",{title:e.title||d,desc:e.title||d,img_url:e.imgUrl||"",link:e.link||location.href,type:e.type||"link",data_url:e.dataUrl||""},e)}},e)},onMenuShareAppMessage:function(e){A(r.onMenuShareAppMessage,{complete:function(t){"favorite"===t.scene?M("sendAppMessage",{title:e.title||d,desc:e.desc||"",link:e.link||location.href,img_url:e.imgUrl||"",type:e.type||"link",data_url:e.dataUrl||""}):M("sendAppMessage",{title:e.title||d,desc:e.desc||"",link:e.link||location.href,img_url:e.imgUrl||"",type:e.type||"link",data_url:e.dataUrl||""},e)}},e)},onMenuShareQQ:function(e){A(r.onMenuShareQQ,{complete:function(){M("shareQQ",{title:e.title||d,desc:e.desc||"",img_url:e.imgUrl||"",link:e.link||location.href},e)}},e)},onMenuShareWeibo:function(e){A(r.onMenuShareWeibo,{complete:function(){M("shareWeiboApp",{title:e.title||d,desc:e.desc||"",img_url:e.imgUrl||"",link:e.link||location.href},e)}},e)},onMenuShareQZone:function(e){A(r.onMenuShareQZone,{complete:function(){M("shareQZone",{title:e.title||d,desc:e.desc||"",img_url:e.imgUrl||"",link:e.link||location.href},e)}},e)},updateTimelineShareData:function(e){M("updateTimelineShareData",{title:e.title,link:e.link,imgUrl:e.imgUrl},e)},updateAppMessageShareData:function(e){M("updateAppMessageShareData",{title:e.title,desc:e.desc,link:e.link,imgUrl:e.imgUrl},e)},startRecord:function(e){M("startRecord",{},e)},stopRecord:function(e){M("stopRecord",{},e)},onVoiceRecordEnd:function(e){A("onVoiceRecordEnd",e)},playVoice:function(e){M("playVoice",{localId:e.localId},e)},pauseVoice:function(e){M("pauseVoice",{localId:e.localId},e)},stopVoice:function(e){M("stopVoice",{localId:e.localId},e)},onVoicePlayEnd:function(e){A("onVoicePlayEnd",e)},uploadVoice:function(e){M("uploadVoice",{localId:e.localId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},downloadVoice:function(e){M("downloadVoice",{serverId:e.serverId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},translateVoice:function(e){M("translateVoice",{localId:e.localId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},chooseImage:function(e){M("chooseImage",{scene:"1|2",count:e.count||9,sizeType:e.sizeType||["original","compressed"],sourceType:e.sourceType||["album","camera"]},(e._complete=function(e){if(m){var t=e.localIds;try{t&&(e.localIds=JSON.parse(t))}catch(e){}}},e))},getLocation:function(e){},previewImage:function(e){M(r.previewImage,{current:e.current,urls:e.urls},e)},uploadImage:function(e){M("uploadImage",{localId:e.localId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},downloadImage:function(e){M("downloadImage",{serverId:e.serverId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},getLocalImgData:function(e){!1===y?(y=!0,M("getLocalImgData",{localId:e.localId},(e._complete=function(e){if(y=!1,0<k.length){var t=k.shift();wx.getLocalImgData(t)}},e))):k.push(e)},getNetworkType:function(e){M("getNetworkType",{},(e._complete=function(e){e=function(e){var t=e.errMsg;e.errMsg="getNetworkType:ok";var n=e.subtype;if(delete e.subtype,n)e.networkType=n;else{var i=t.indexOf(":"),a=t.substring(i+1);switch(a){case"wifi":case"edge":case"wwan":e.networkType=a;break;default:e.errMsg="getNetworkType:fail"}}return e}(e)},e))},openLocation:function(e){M("openLocation",{latitude:e.latitude,longitude:e.longitude,name:e.name||"",address:e.address||"",scale:e.scale||28,infoUrl:e.infoUrl||""},e)}},i(a,"getLocation",(function(e){M(r.getLocation,{type:(e=e||{}).type||"wgs84"},(e._complete=function(e){delete e.type},e))})),i(a,"hideOptionMenu",(function(e){M("hideOptionMenu",{},e)})),i(a,"showOptionMenu",(function(e){M("showOptionMenu",{},e)})),i(a,"closeWindow",(function(e){M("closeWindow",{},e=e||{})})),i(a,"hideMenuItems",(function(e){M("hideMenuItems",{menuList:e.menuList},e)})),i(a,"showMenuItems",(function(e){M("showMenuItems",{menuList:e.menuList},e)})),i(a,"hideAllNonBaseMenuItem",(function(e){M("hideAllNonBaseMenuItem",{},e)})),i(a,"showAllNonBaseMenuItem",(function(e){M("showAllNonBaseMenuItem",{},e)})),i(a,"scanQRCode",(function(e){M("scanQRCode",{needResult:(e=e||{}).needResult||0,scanType:e.scanType||["qrCode","barCode"]},(e._complete=function(e){if(h){var t=e.resultStr;if(t){var n=JSON.parse(t);e.resultStr=n&&n.scan_code&&n.scan_code.scan_result}}},e))})),i(a,"openAddress",(function(e){M(r.openAddress,{},(e._complete=function(e){e=function(e){return e.postalCode=e.addressPostalCode,delete e.addressPostalCode,e.provinceName=e.proviceFirstStageName,delete e.proviceFirstStageName,e.cityName=e.addressCitySecondStageName,delete e.addressCitySecondStageName,e.countryName=e.addressCountiesThirdStageName,delete e.addressCountiesThirdStageName,e.detailInfo=e.addressDetailInfo,delete e.addressDetailInfo,e}(e)},e))})),i(a,"openProductSpecificView",(function(e){M(r.openProductSpecificView,{pid:e.productId,view_type:e.viewType||0,ext_info:e.extInfo},e)})),i(a,"addCard",(function(e){for(var t=e.cardList,n=[],i=0,a=t.length;i<a;++i){var o=t[i],s={card_id:o.cardId,card_ext:o.cardExt};n.push(s)}M(r.addCard,{card_list:n},(e._complete=function(e){var t=e.card_list;if(t){for(var n=0,i=(t=JSON.parse(t)).length;n<i;++n){var a=t[n];a.cardId=a.card_id,a.cardExt=a.card_ext,a.isSuccess=!!a.is_succ,delete a.card_id,delete a.card_ext,delete a.is_succ}e.cardList=t,delete e.card_list}},e))})),i(a,"chooseCard",(function(e){M("chooseCard",{app_id:_.appId,location_id:e.shopId||"",sign_type:e.signType||"SHA1",card_id:e.cardId||"",card_type:e.cardType||"",card_sign:e.cardSign,time_stamp:e.timestamp+"",nonce_str:e.nonceStr},(e._complete=function(e){e.cardList=e.choose_card_info,delete e.choose_card_info},e))})),i(a,"openCard",(function(e){for(var t=e.cardList,n=[],i=0,a=t.length;i<a;++i){var o=t[i],s={card_id:o.cardId,code:o.code};n.push(s)}M(r.openCard,{card_list:n},e)})),i(a,"consumeAndShareCard",(function(e){M(r.consumeAndShareCard,{consumedCardId:e.cardId,consumedCode:e.code},e)})),i(a,"chooseWXPay",(function(e){M(r.chooseWXPay,V(e),e)})),i(a,"openEnterpriseRedPacket",(function(e){M(r.openEnterpriseRedPacket,V(e),e)})),i(a,"startSearchBeacons",(function(e){M(r.startSearchBeacons,{ticket:e.ticket},e)})),i(a,"stopSearchBeacons",(function(e){M(r.stopSearchBeacons,{},e)})),i(a,"onSearchBeacons",(function(e){A(r.onSearchBeacons,e)})),i(a,"openEnterpriseChat",(function(e){M("openEnterpriseChat",{useridlist:e.userIds,chatname:e.groupName},e)})),i(a,"launchMiniProgram",(function(e){M("launchMiniProgram",{targetAppId:e.targetAppId,path:function(e){if("string"==typeof e&&0<e.length){var t=e.split("?")[0],n=e.split("?")[1];return t+=".html",void 0!==n?t+"?"+n:t}}(e.path),envVersion:e.envVersion},e)})),i(a,"openBusinessView",(function(e){M("openBusinessView",{businessType:e.businessType,queryString:e.queryString||"",envVersion:e.envVersion},(e._complete=function(e){if(m){var t=e.extraData;if(t)try{e.extraData=JSON.parse(t)}catch(t){e.extraData={}}}},e))})),i(a,"miniProgram",{navigateBack:function(e){e=e||{},N((function(){M("invokeMiniProgramAPI",{name:"navigateBack",arg:{delta:e.delta||1}},e)}))},navigateTo:function(e){N((function(){M("invokeMiniProgramAPI",{name:"navigateTo",arg:{url:e.url}},e)}))},redirectTo:function(e){N((function(){M("invokeMiniProgramAPI",{name:"redirectTo",arg:{url:e.url}},e)}))},switchTab:function(e){N((function(){M("invokeMiniProgramAPI",{name:"switchTab",arg:{url:e.url}},e)}))},reLaunch:function(e){N((function(){M("invokeMiniProgramAPI",{name:"reLaunch",arg:{url:e.url}},e)}))},postMessage:function(e){N((function(){M("invokeMiniProgramAPI",{name:"postMessage",arg:e.data||{}},e)}))},getEnv:function(t){N((function(){t({miniprogram:"miniprogram"===e.__wxjs_environment})}))}}),a),T=1,C={};return c.addEventListener("error",(function(e){if(!m){var t=e.target,n=t.tagName,i=t.src;if(("IMG"==n||"VIDEO"==n||"AUDIO"==n||"SOURCE"==n)&&-1!=i.indexOf("wxlocalresource://")){e.preventDefault(),e.stopPropagation();var a=t["wx-id"];if(a||(a=T++,t["wx-id"]=a),C[a])return;C[a]=!0,wx.ready((function(){wx.getLocalImgData({localId:i,success:function(e){t.src=e.localData}})}))}}}),!0),c.addEventListener("load",(function(e){if(!m){var t=e.target,n=t.tagName;if(t.src,"IMG"==n||"VIDEO"==n||"AUDIO"==n||"SOURCE"==n){var i=t["wx-id"];i&&(C[i]=!1)}}}),!0),n&&(e.wx=e.jWeixin=I),I}function M(t,n,i){e.WeixinJSBridge?WeixinJSBridge.invoke(t,P(n),(function(e){L(t,e,i)})):B(t,i)}function A(t,n,i){e.WeixinJSBridge?WeixinJSBridge.on(t,(function(e){i&&i.trigger&&i.trigger(e),L(t,e,n)})):B(t,i||n)}function P(e){return(e=e||{}).appId=_.appId,e.verifyAppId=_.appId,e.verifySignType="sha1",e.verifyTimestamp=_.timestamp+"",e.verifyNonceStr=_.nonceStr,e.verifySignature=_.signature,e}function V(e){return{timeStamp:e.timestamp+"",nonceStr:e.nonceStr,package:e.package,paySign:e.paySign,signType:e.signType||"SHA1"}}function L(e,t,n){"openEnterpriseChat"!=e&&"openBusinessView"!==e||(t.errCode=t.err_code),delete t.err_code,delete t.err_desc,delete t.err_detail;var i=t.errMsg;i||(i=t.err_msg,delete t.err_msg,i=function(e,t){var n=e,i=s[n];i&&(n=i);var a="ok";if(t){var o=t.indexOf(":");"confirm"==(a=t.substring(o+1))&&(a="ok"),"failed"==a&&(a="fail"),-1!=a.indexOf("failed_")&&(a=a.substring(7)),-1!=a.indexOf("fail_")&&(a=a.substring(5)),"access denied"!=(a=(a=a.replace(/_/g," ")).toLowerCase())&&"no permission to execute"!=a||(a="permission denied"),"config"==n&&"function not exist"==a&&(a="ok"),""==a&&(a="fail")}return n+":"+a}(e,i),t.errMsg=i),(n=n||{})._complete&&(n._complete(t),delete n._complete),i=t.errMsg||"",_.debug&&!n.isInnerInvoke&&alert(JSON.stringify(t));var a=i.indexOf(":");switch(i.substring(a+1)){case"ok":n.success&&n.success(t);break;case"cancel":n.cancel&&n.cancel(t);break;default:n.fail&&n.fail(t)}n.complete&&n.complete(t)}function O(e){if(e){for(var t=0,n=e.length;t<n;++t){var i=e[t],a=r[i];a&&(e[t]=a)}return e}}function B(e,n){if(!(!_.debug||n&&n.isInnerInvoke)){var i=s[e];i&&(e=i),n&&n._complete&&delete n._complete,t("log",'"'+e+'",',n||""," at node_modules/weixin-js-sdk/index.js:885")}}function E(){return(new Date).getTime()}function N(t){g&&(e.WeixinJSBridge?t():c.addEventListener&&c.addEventListener("WeixinJSBridgeReady",t,!1))}}(n)}(window)}).call(this,n("0de9")["log"])},e50d:function(e,t,n){n("8172"),n("efec"),n("a4d3"),n("e01a"),n("d3b7"),n("d9e2"),n("d401"),n("a9e3");var i=n("7037")["default"];e.exports=function(e,t){if("object"!==i(e)||null===e)return e;var n=e[Symbol.toPrimitive];if(void 0!==n){var a=n.call(e,t||"default");if("object"!==i(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)},e.exports.__esModule=!0,e.exports["default"]=e.exports}}]);