(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-Shareposters-Shareposters"],{"4b36":function(e,i,t){"use strict";t.r(i);var a=t("a178"),n=t("4ef3");for(var o in n)["default"].indexOf(o)<0&&function(e){t.d(i,e,(function(){return n[e]}))}(o);t("bfcc");var r=t("f0c5"),s=Object(r["a"])(n["default"],a["b"],a["c"],!1,null,"682a2d6c",null,!1,a["a"],void 0);i["default"]=s.exports},"4c3c":function(e,i,t){var a=t("e7a1");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var n=t("4f06").default;n("53a9c6de",a,!0,{sourceMap:!1,shadowMode:!1})},"4ef3":function(e,i,t){"use strict";t.r(i);var a=t("6989"),n=t.n(a);for(var o in a)["default"].indexOf(o)<0&&function(e){t.d(i,e,(function(){return a[e]}))}(o);i["default"]=n.a},6989:function(e,i,t){"use strict";t("7a82");var a=t("4ea4").default;Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,t("e9c4");var n=a(t("7ae7")),o=(getApp(),{data:function(){return{dijige:0,lbHeight:"",Shareposters:[],cardListidx:0,defoImg:"",ServiceAnimate:!1}},onLoad:function(){var e=this;uni.getSystemInfo({success:function(i){console.log("系统信息",i);var t=i.windowHeight-187;e.lbHeight=JSON.stringify(t),console.log("屏幕高度",t),e.getShareposters()}})},onReady:function(){this.getConfig();var e=document.createElement("script");e.src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js",document.head.appendChild(e),e.onload=function(){}},methods:{dianjile:function(e){this.defoImg=this.Shareposters[e]},qiehuanle:function(e){console.log(e);this.dijige=e.detail.current,this.defoImg=this.Shareposters[e.detail.current]},getShareposters:function(){var e=this;e.$api.GetShareposters({}).then((function(i){e.Shareposters=i.data.result,e.defoImg=i.data.result[0]})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))},selectCard:function(e,i){this.cardListidx=i,this.defoImg=e},H5savePic:function(e){console.log(this.dijige),this.defoImg=this.Shareposters[this.dijige],this.ServiceAnimate=!0},sharewxapp:function(){uni.share({provider:"weixin",scene:"WXSceneSession",type:2,imageUrl:this.defoImg,success:function(e){console.log("success:"+JSON.stringify(e))},fail:function(e){console.log("fail:"+JSON.stringify(e))}})},shareWXSceneTimeline:function(){uni.share({provider:"weixin",scene:"WXSceneTimeline",type:2,imageUrl:this.defoImg,success:function(e){console.log("success:"+JSON.stringify(e))},fail:function(e){console.log("fail:"+JSON.stringify(e))}})},getConfig:function(){var e=uni.getStorageSync("userinfo").id;this.$api.GetwxJSk({url:encodeURIComponent(window.location.href.split("#")[0])}).then((function(e){n.default.config({debug:!1,appId:e.data.result.appId,timestamp:e.data.result.timestamp,nonceStr:e.data.result.nonceStr,signature:e.data.result.signature,jsApiList:e.data.result.jsApiList,openTagList:["wx-open-launch-weapp"]})})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})})),n.default.ready((function(i){n.default.updateAppMessageShareData({title:"呵味惠",desc:"呵味惠,多快好省新生活",link:"https://"+document.domain+"/#/pages/logon/logon?parent_id="+e,imgUrl:"https://"+document.domain+"/public/uploads/shop/shop_logo.png",success:function(){}}),n.default.updateTimelineShareData({title:"呵味惠,多快好省新生活",link:"https://"+document.domain+"/#/pages/logon/logon?parent_id="+e,imgUrl:"https://"+document.domain+"/public/uploads/shop/shop_logo.png",success:function(){}})})),n.default.error((function(e){console.log("config信息验证失败会执行error函数",e)}))}}});i.default=o},"7ae7":function(e,i,t){var a=t("9523").default;t("ac1f"),t("466d"),t("c975"),t("14d9"),t("5319"),t("e9c4"),function(i,t){e.exports=function(e,i){if(!e.jWeixin){var t,n,o={config:"preVerifyJSAPI",onMenuShareTimeline:"menu:share:timeline",onMenuShareAppMessage:"menu:share:appmessage",onMenuShareQQ:"menu:share:qq",onMenuShareWeibo:"menu:share:weiboApp",onMenuShareQZone:"menu:share:QZone",previewImage:"imagePreview",getLocation:"geoLocation",openProductSpecificView:"openProductViewWithPid",addCard:"batchAddCard",openCard:"batchViewCard",chooseWXPay:"getBrandWCPayRequest",openEnterpriseRedPacket:"getRecevieBizHongBaoRequest",startSearchBeacons:"startMonitoringBeacons",stopSearchBeacons:"stopMonitoringBeacons",onSearchBeacons:"onBeaconsInRange",consumeAndShareCard:"consumedShareCard",openAddress:"editAddress"},r=function(){var e={};for(var i in o)e[o[i]]=i;return e}(),s=e.document,c=s.title,d=navigator.userAgent.toLowerCase(),u=navigator.platform.toLowerCase(),l=!(!u.match("mac")&&!u.match("win")),p=-1!=d.indexOf("wxdebugger"),f=-1!=d.indexOf("micromessenger"),g=-1!=d.indexOf("android"),h=-1!=d.indexOf("iphone")||-1!=d.indexOf("ipad"),m=(n=d.match(/micromessenger\/(\d+\.\d+\.\d+)/)||d.match(/micromessenger\/(\d+\.\d+)/))?n[1]:"",v={initStartTime:E(),initEndTime:0,preVerifyStartTime:0,preVerifyEndTime:0},b={version:1,appId:"",initTime:0,preVerifyTime:0,networkType:"",isPreVerifyOk:1,systemType:h?1:g?2:-1,clientVersion:m,url:encodeURIComponent(location.href)},w={},_={_completes:[]},x={state:0,data:{}};j((function(){v.initEndTime=E()}));var S=!1,y=[],k=(t={config:function(i){L("config",w=i);var t=!1!==w.check;j((function(){if(t)C(o.config,{verifyJsApiList:O(w.jsApiList),verifyOpenTagList:O(w.openTagList)},function(){_._complete=function(e){v.preVerifyEndTime=E(),x.state=1,x.data=e},_.success=function(e){b.isPreVerifyOk=0},_.fail=function(e){_._fail?_._fail(e):x.state=-1};var e=_._completes;return e.push((function(){!function(){if(!(l||p||w.debug||m<"6.0.2"||b.systemType<0)){var e=new Image;b.appId=w.appId,b.initTime=v.initEndTime-v.initStartTime,b.preVerifyTime=v.preVerifyEndTime-v.preVerifyStartTime,k.getNetworkType({isInnerInvoke:!0,success:function(i){b.networkType=i.networkType;var t="https://open.weixin.qq.com/sdk/report?v="+b.version+"&o="+b.isPreVerifyOk+"&s="+b.systemType+"&c="+b.clientVersion+"&a="+b.appId+"&n="+b.networkType+"&i="+b.initTime+"&p="+b.preVerifyTime+"&u="+b.url;e.src=t}})}}()})),_.complete=function(i){for(var t=0,a=e.length;t<a;++t)e[t]();_._completes=[]},_}()),v.preVerifyStartTime=E();else{x.state=1;for(var e=_._completes,i=0,a=e.length;i<a;++i)e[i]();_._completes=[]}})),k.invoke||(k.invoke=function(i,t,a){e.WeixinJSBridge&&WeixinJSBridge.invoke(i,A(t),a)},k.on=function(i,t){e.WeixinJSBridge&&WeixinJSBridge.on(i,t)})},ready:function(e){0!=x.state?e():(_._completes.push(e),!f&&w.debug&&e())},error:function(e){m<"6.0.2"||(-1==x.state?e(x.data):_._fail=e)},checkJsApi:function(e){C("checkJsApi",{jsApiList:O(e.jsApiList)},(e._complete=function(e){if(g){var i=e.checkResult;i&&(e.checkResult=JSON.parse(i))}e=function(e){var i=e.checkResult;for(var t in i){var a=r[t];a&&(i[a]=i[t],delete i[t])}return e}(e)},e))},onMenuShareTimeline:function(e){M(o.onMenuShareTimeline,{complete:function(){C("shareTimeline",{title:e.title||c,desc:e.title||c,img_url:e.imgUrl||"",link:e.link||location.href,type:e.type||"link",data_url:e.dataUrl||""},e)}},e)},onMenuShareAppMessage:function(e){M(o.onMenuShareAppMessage,{complete:function(i){"favorite"===i.scene?C("sendAppMessage",{title:e.title||c,desc:e.desc||"",link:e.link||location.href,img_url:e.imgUrl||"",type:e.type||"link",data_url:e.dataUrl||""}):C("sendAppMessage",{title:e.title||c,desc:e.desc||"",link:e.link||location.href,img_url:e.imgUrl||"",type:e.type||"link",data_url:e.dataUrl||""},e)}},e)},onMenuShareQQ:function(e){M(o.onMenuShareQQ,{complete:function(){C("shareQQ",{title:e.title||c,desc:e.desc||"",img_url:e.imgUrl||"",link:e.link||location.href},e)}},e)},onMenuShareWeibo:function(e){M(o.onMenuShareWeibo,{complete:function(){C("shareWeiboApp",{title:e.title||c,desc:e.desc||"",img_url:e.imgUrl||"",link:e.link||location.href},e)}},e)},onMenuShareQZone:function(e){M(o.onMenuShareQZone,{complete:function(){C("shareQZone",{title:e.title||c,desc:e.desc||"",img_url:e.imgUrl||"",link:e.link||location.href},e)}},e)},updateTimelineShareData:function(e){C("updateTimelineShareData",{title:e.title,link:e.link,imgUrl:e.imgUrl},e)},updateAppMessageShareData:function(e){C("updateAppMessageShareData",{title:e.title,desc:e.desc,link:e.link,imgUrl:e.imgUrl},e)},startRecord:function(e){C("startRecord",{},e)},stopRecord:function(e){C("stopRecord",{},e)},onVoiceRecordEnd:function(e){M("onVoiceRecordEnd",e)},playVoice:function(e){C("playVoice",{localId:e.localId},e)},pauseVoice:function(e){C("pauseVoice",{localId:e.localId},e)},stopVoice:function(e){C("stopVoice",{localId:e.localId},e)},onVoicePlayEnd:function(e){M("onVoicePlayEnd",e)},uploadVoice:function(e){C("uploadVoice",{localId:e.localId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},downloadVoice:function(e){C("downloadVoice",{serverId:e.serverId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},translateVoice:function(e){C("translateVoice",{localId:e.localId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},chooseImage:function(e){C("chooseImage",{scene:"1|2",count:e.count||9,sizeType:e.sizeType||["original","compressed"],sourceType:e.sourceType||["album","camera"]},(e._complete=function(e){if(g){var i=e.localIds;try{i&&(e.localIds=JSON.parse(i))}catch(e){}}},e))},getLocation:function(e){},previewImage:function(e){C(o.previewImage,{current:e.current,urls:e.urls},e)},uploadImage:function(e){C("uploadImage",{localId:e.localId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},downloadImage:function(e){C("downloadImage",{serverId:e.serverId,isShowProgressTips:0==e.isShowProgressTips?0:1},e)},getLocalImgData:function(e){!1===S?(S=!0,C("getLocalImgData",{localId:e.localId},(e._complete=function(e){if(S=!1,0<y.length){var i=y.shift();wx.getLocalImgData(i)}},e))):y.push(e)},getNetworkType:function(e){C("getNetworkType",{},(e._complete=function(e){e=function(e){var i=e.errMsg;e.errMsg="getNetworkType:ok";var t=e.subtype;if(delete e.subtype,t)e.networkType=t;else{var a=i.indexOf(":"),n=i.substring(a+1);switch(n){case"wifi":case"edge":case"wwan":e.networkType=n;break;default:e.errMsg="getNetworkType:fail"}}return e}(e)},e))},openLocation:function(e){C("openLocation",{latitude:e.latitude,longitude:e.longitude,name:e.name||"",address:e.address||"",scale:e.scale||28,infoUrl:e.infoUrl||""},e)}},a(t,"getLocation",(function(e){C(o.getLocation,{type:(e=e||{}).type||"wgs84"},(e._complete=function(e){delete e.type},e))})),a(t,"hideOptionMenu",(function(e){C("hideOptionMenu",{},e)})),a(t,"showOptionMenu",(function(e){C("showOptionMenu",{},e)})),a(t,"closeWindow",(function(e){C("closeWindow",{},e=e||{})})),a(t,"hideMenuItems",(function(e){C("hideMenuItems",{menuList:e.menuList},e)})),a(t,"showMenuItems",(function(e){C("showMenuItems",{menuList:e.menuList},e)})),a(t,"hideAllNonBaseMenuItem",(function(e){C("hideAllNonBaseMenuItem",{},e)})),a(t,"showAllNonBaseMenuItem",(function(e){C("showAllNonBaseMenuItem",{},e)})),a(t,"scanQRCode",(function(e){C("scanQRCode",{needResult:(e=e||{}).needResult||0,scanType:e.scanType||["qrCode","barCode"]},(e._complete=function(e){if(h){var i=e.resultStr;if(i){var t=JSON.parse(i);e.resultStr=t&&t.scan_code&&t.scan_code.scan_result}}},e))})),a(t,"openAddress",(function(e){C(o.openAddress,{},(e._complete=function(e){e=function(e){return e.postalCode=e.addressPostalCode,delete e.addressPostalCode,e.provinceName=e.proviceFirstStageName,delete e.proviceFirstStageName,e.cityName=e.addressCitySecondStageName,delete e.addressCitySecondStageName,e.countryName=e.addressCountiesThirdStageName,delete e.addressCountiesThirdStageName,e.detailInfo=e.addressDetailInfo,delete e.addressDetailInfo,e}(e)},e))})),a(t,"openProductSpecificView",(function(e){C(o.openProductSpecificView,{pid:e.productId,view_type:e.viewType||0,ext_info:e.extInfo},e)})),a(t,"addCard",(function(e){for(var i=e.cardList,t=[],a=0,n=i.length;a<n;++a){var r=i[a],s={card_id:r.cardId,card_ext:r.cardExt};t.push(s)}C(o.addCard,{card_list:t},(e._complete=function(e){var i=e.card_list;if(i){for(var t=0,a=(i=JSON.parse(i)).length;t<a;++t){var n=i[t];n.cardId=n.card_id,n.cardExt=n.card_ext,n.isSuccess=!!n.is_succ,delete n.card_id,delete n.card_ext,delete n.is_succ}e.cardList=i,delete e.card_list}},e))})),a(t,"chooseCard",(function(e){C("chooseCard",{app_id:w.appId,location_id:e.shopId||"",sign_type:e.signType||"SHA1",card_id:e.cardId||"",card_type:e.cardType||"",card_sign:e.cardSign,time_stamp:e.timestamp+"",nonce_str:e.nonceStr},(e._complete=function(e){e.cardList=e.choose_card_info,delete e.choose_card_info},e))})),a(t,"openCard",(function(e){for(var i=e.cardList,t=[],a=0,n=i.length;a<n;++a){var r=i[a],s={card_id:r.cardId,code:r.code};t.push(s)}C(o.openCard,{card_list:t},e)})),a(t,"consumeAndShareCard",(function(e){C(o.consumeAndShareCard,{consumedCardId:e.cardId,consumedCode:e.code},e)})),a(t,"chooseWXPay",(function(e){C(o.chooseWXPay,P(e),e)})),a(t,"openEnterpriseRedPacket",(function(e){C(o.openEnterpriseRedPacket,P(e),e)})),a(t,"startSearchBeacons",(function(e){C(o.startSearchBeacons,{ticket:e.ticket},e)})),a(t,"stopSearchBeacons",(function(e){C(o.stopSearchBeacons,{},e)})),a(t,"onSearchBeacons",(function(e){M(o.onSearchBeacons,e)})),a(t,"openEnterpriseChat",(function(e){C("openEnterpriseChat",{useridlist:e.userIds,chatname:e.groupName},e)})),a(t,"launchMiniProgram",(function(e){C("launchMiniProgram",{targetAppId:e.targetAppId,path:function(e){if("string"==typeof e&&0<e.length){var i=e.split("?")[0],t=e.split("?")[1];return i+=".html",void 0!==t?i+"?"+t:i}}(e.path),envVersion:e.envVersion},e)})),a(t,"openBusinessView",(function(e){C("openBusinessView",{businessType:e.businessType,queryString:e.queryString||"",envVersion:e.envVersion},(e._complete=function(e){if(g){var i=e.extraData;if(i)try{e.extraData=JSON.parse(i)}catch(i){e.extraData={}}}},e))})),a(t,"miniProgram",{navigateBack:function(e){e=e||{},j((function(){C("invokeMiniProgramAPI",{name:"navigateBack",arg:{delta:e.delta||1}},e)}))},navigateTo:function(e){j((function(){C("invokeMiniProgramAPI",{name:"navigateTo",arg:{url:e.url}},e)}))},redirectTo:function(e){j((function(){C("invokeMiniProgramAPI",{name:"redirectTo",arg:{url:e.url}},e)}))},switchTab:function(e){j((function(){C("invokeMiniProgramAPI",{name:"switchTab",arg:{url:e.url}},e)}))},reLaunch:function(e){j((function(){C("invokeMiniProgramAPI",{name:"reLaunch",arg:{url:e.url}},e)}))},postMessage:function(e){j((function(){C("invokeMiniProgramAPI",{name:"postMessage",arg:e.data||{}},e)}))},getEnv:function(i){j((function(){i({miniprogram:"miniprogram"===e.__wxjs_environment})}))}}),t),I=1,T={};return s.addEventListener("error",(function(e){if(!g){var i=e.target,t=i.tagName,a=i.src;if(("IMG"==t||"VIDEO"==t||"AUDIO"==t||"SOURCE"==t)&&-1!=a.indexOf("wxlocalresource://")){e.preventDefault(),e.stopPropagation();var n=i["wx-id"];if(n||(n=I++,i["wx-id"]=n),T[n])return;T[n]=!0,wx.ready((function(){wx.getLocalImgData({localId:a,success:function(e){i.src=e.localData}})}))}}}),!0),s.addEventListener("load",(function(e){if(!g){var i=e.target,t=i.tagName;if(i.src,"IMG"==t||"VIDEO"==t||"AUDIO"==t||"SOURCE"==t){var a=i["wx-id"];a&&(T[a]=!1)}}}),!0),i&&(e.wx=e.jWeixin=k),k}function C(i,t,a){e.WeixinJSBridge?WeixinJSBridge.invoke(i,A(t),(function(e){V(i,e,a)})):L(i,a)}function M(i,t,a){e.WeixinJSBridge?WeixinJSBridge.on(i,(function(e){a&&a.trigger&&a.trigger(e),V(i,e,t)})):L(i,a||t)}function A(e){return(e=e||{}).appId=w.appId,e.verifyAppId=w.appId,e.verifySignType="sha1",e.verifyTimestamp=w.timestamp+"",e.verifyNonceStr=w.nonceStr,e.verifySignature=w.signature,e}function P(e){return{timeStamp:e.timestamp+"",nonceStr:e.nonceStr,package:e.package,paySign:e.paySign,signType:e.signType||"SHA1"}}function V(e,i,t){"openEnterpriseChat"!=e&&"openBusinessView"!==e||(i.errCode=i.err_code),delete i.err_code,delete i.err_desc,delete i.err_detail;var a=i.errMsg;a||(a=i.err_msg,delete i.err_msg,a=function(e,i){var t=e,a=r[t];a&&(t=a);var n="ok";if(i){var o=i.indexOf(":");"confirm"==(n=i.substring(o+1))&&(n="ok"),"failed"==n&&(n="fail"),-1!=n.indexOf("failed_")&&(n=n.substring(7)),-1!=n.indexOf("fail_")&&(n=n.substring(5)),"access denied"!=(n=(n=n.replace(/_/g," ")).toLowerCase())&&"no permission to execute"!=n||(n="permission denied"),"config"==t&&"function not exist"==n&&(n="ok"),""==n&&(n="fail")}return t+":"+n}(e,a),i.errMsg=a),(t=t||{})._complete&&(t._complete(i),delete t._complete),a=i.errMsg||"",w.debug&&!t.isInnerInvoke&&alert(JSON.stringify(i));var n=a.indexOf(":");switch(a.substring(n+1)){case"ok":t.success&&t.success(i);break;case"cancel":t.cancel&&t.cancel(i);break;default:t.fail&&t.fail(i)}t.complete&&t.complete(i)}function O(e){if(e){for(var i=0,t=e.length;i<t;++i){var a=e[i],n=o[a];n&&(e[i]=n)}return e}}function L(e,i){if(!(!w.debug||i&&i.isInnerInvoke)){var t=r[e];t&&(e=t),i&&i._complete&&delete i._complete,console.log('"'+e+'",',i||"")}}function E(){return(new Date).getTime()}function j(i){f&&(e.WeixinJSBridge?i():s.addEventListener&&s.addEventListener("WeixinJSBridgeReady",i,!1))}}(i)}(window)},9523:function(e,i,t){t("7a82");var a=t("a395");e.exports=function(e,i,t){return i=a(i),i in e?Object.defineProperty(e,i,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[i]=t,e},e.exports.__esModule=!0,e.exports["default"]=e.exports},a178:function(e,i,t){"use strict";t.d(i,"b",(function(){return a})),t.d(i,"c",(function(){return n})),t.d(i,"a",(function(){}));var a=function(){var e=this,i=e.$createElement,t=e._self._c||i;return t("v-uni-view",[e.ServiceAnimate?t("v-uni-view",{staticClass:"haibao_wrap11",on:{click:function(i){arguments[0]=i=e.$handleEvent(i),e.ServiceAnimate=!1}}},[t("v-uni-view",{staticClass:"ca_tishi11",class:{arrow_box:e.ServiceAnimate}},[t("v-uni-view",[e._v("请长按图片保存")])],1),t("v-uni-image",{staticClass:"haibaotu",class:{arrow_box:e.ServiceAnimate},attrs:{src:e.defoImg,mode:"widthFix"}})],1):e._e(),t("v-uni-view",{staticClass:"haibao"},[t("v-uni-view",{staticClass:"haibao_swiper"},[t("v-uni-view",{staticClass:"uni-margin-wrap"},[t("v-uni-swiper",{staticClass:"swiper",style:{height:e.lbHeight+"px"},attrs:{circular:!0,"indicator-dots":!1,autoplay:!1},on:{change:function(i){arguments[0]=i=e.$handleEvent(i),e.qiehuanle.apply(void 0,arguments)}}},e._l(e.Shareposters,(function(i,a){return t("v-uni-swiper-item",{key:a},[t("v-uni-view",{staticClass:"swiper-item uni-bg-red"},[t("v-uni-image",{style:{height:e.lbHeight+"px"},attrs:{src:i,mode:"aspectFill"}})],1)],1)})),1)],1),t("v-uni-view",{staticClass:"zhishiqi"},e._l(e.Shareposters.length,(function(i,a){return t("v-uni-view",{key:a},[t("span",{class:[e.dijige==a?"xuanzhong":""]})])})),1)],1),t("v-uni-view",{staticClass:"hb_gongju_bar"},[t("v-uni-view",{staticStyle:{height:"15px"}}),t("v-uni-view",{staticClass:"fxdti"},[e._v("分享到")]),t("v-uni-view",{staticClass:"Share-popup-info"},[t("v-uni-view",{staticClass:"fenxiang-btn"},[t("v-uni-view",{staticClass:"btn-1"},[t("v-uni-image",{staticClass:"wxicon",attrs:{src:"/static/images/wx_icon.png"},on:{click:function(i){arguments[0]=i=e.$handleEvent(i),e.sharewxapp()}}}),t("v-uni-view",[e._v("微信好友")])],1),t("v-uni-view",{staticClass:"btn-2"},[t("v-uni-image",{staticClass:"baocunicon",attrs:{src:"/static/images/pyq_icon.png"},on:{click:function(i){arguments[0]=i=e.$handleEvent(i),e.shareWXSceneTimeline()}}}),t("v-uni-view",[e._v("朋友圈")])],1),t("v-uni-view",{staticClass:"btn-2",on:{click:function(i){arguments[0]=i=e.$handleEvent(i),e.H5savePic()}}},[t("v-uni-image",{staticClass:"baocunicon",attrs:{src:"/static/images/baocun_icon.png"}}),t("v-uni-view",[e._v("保存图片")])],1)],1)],1)],1)],1)],1)},n=[]},a395:function(e,i,t){var a=t("7037")["default"],n=t("e50d");e.exports=function(e){var i=n(e,"string");return"symbol"===a(i)?i:String(i)},e.exports.__esModule=!0,e.exports["default"]=e.exports},bfcc:function(e,i,t){"use strict";var a=t("4c3c"),n=t.n(a);n.a},e50d:function(e,i,t){t("8172"),t("efec"),t("a4d3"),t("e01a"),t("d3b7"),t("d9e2"),t("d401"),t("a9e3");var a=t("7037")["default"];e.exports=function(e,i){if("object"!==a(e)||null===e)return e;var t=e[Symbol.toPrimitive];if(void 0!==t){var n=t.call(e,i||"default");if("object"!==a(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===i?String:Number)(e)},e.exports.__esModule=!0,e.exports["default"]=e.exports},e7a1:function(e,i,t){var a=t("24fb");i=a(!1),i.push([e.i,"uni-page-body[data-v-682a2d6c]{background-color:#f7f7f7}body.?%PAGE?%[data-v-682a2d6c]{background-color:#f7f7f7}.uni-margin-wrap[data-v-682a2d6c]{width:%?690?%;width:100%}.swiper .swiper-item[data-v-682a2d6c]{border-radius:%?30?% %?30?% 0 0}.swiper .swiper-item uni-image[data-v-682a2d6c]{width:100%;border-radius:%?30?% %?30?% 0 0}[data-v-682a2d6c] .u-swiper-wrap{border-radius:%?30?% %?30?% 0 0}[data-v-682a2d6c] .u-swiper-image{border-radius:%?30?% %?30?% 0 0}.haibao_wrap11[data-v-682a2d6c]{position:absolute;top:0;left:0;width:100%;height:100%;padding:%?30?%;background-color:#000;z-index:9999}.haibao_wrap11 .ca_tishi11[data-v-682a2d6c]{text-align:center;background-color:rgba(0,0,0,.65);width:100%;padding:%?20?%;position:absolute;bottom:2%;left:0;right:0;z-index:4;color:#fff;border-radius:0 0 0 0}.haibao_wrap11 .haibaotu[data-v-682a2d6c]{width:100%;height:%?1200?%;background-color:#f7f7f7;border-radius:%?20?%;vertical-align:bottom}.haibao_wrap11 .arrow_box[data-v-682a2d6c]{-webkit-animation:shake-data-v-682a2d6c .82s cubic-bezier(.36,.07,.19,.97) both;animation:shake-data-v-682a2d6c .82s cubic-bezier(.36,.07,.19,.97) both}.haibao[data-v-682a2d6c]{padding:%?40?%;text-align:center;position:relative;border-radius:%?30?% %?30?%}.haibao .haibao_swiper[data-v-682a2d6c]{border-radius:%?30?% %?30?% 0 0;position:relative}.haibao .haibao_swiper .zhishiqi[data-v-682a2d6c]{position:absolute;left:0;right:0;margin:0 auto;bottom:%?-50?%;display:flex;align-items:center;justify-content:center}.haibao .haibao_swiper .zhishiqi span[data-v-682a2d6c]{margin:0 %?10?%;display:inline-block;width:%?40?%;height:%?12?%;background-color:#ececec;border-radius:%?200?%}.haibao .haibao_swiper .zhishiqi .xuanzhong[data-v-682a2d6c]{width:%?40?%!important;background-color:#ff9a44!important}.haibao .haibao_wrap[data-v-682a2d6c]{position:relative}.haibao .haibao_wrap .ca_tishi[data-v-682a2d6c]{text-align:center;background-color:rgba(0,0,0,.65);width:100%;padding:%?20?%;position:absolute;bottom:0;left:0;right:0;z-index:4;color:#fff;border-radius:0 0 0 0}.haibao .haibao_wrap .haibaotu[data-v-682a2d6c]{width:100%;height:%?960?%;background-color:#f7f7f7;border-radius:%?20?%;vertical-align:bottom}.haibao .haibao_wrap .arrow_box[data-v-682a2d6c]{-webkit-animation:shake-data-v-682a2d6c .82s cubic-bezier(.36,.07,.19,.97) both;animation:shake-data-v-682a2d6c .82s cubic-bezier(.36,.07,.19,.97) both}.haibao .hb_gongju_bar[data-v-682a2d6c]{background-color:#fff;border-radius:0 0 %?30?% %?30?%}.haibao .hb_gongju_bar .fxdti[data-v-682a2d6c]{text-align:left;padding:0 0 0 %?30?%;height:40px;line-height:40px}.haibao .hb_gongju_bar .Share-popup-info[data-v-682a2d6c]{background-color:#fff;padding:0 %?30?%;height:90px;border-radius:0 0 %?30?% %?30?%;display:flex;align-items:center}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn[data-v-682a2d6c]{display:flex;align-items:center;width:96%;margin:0 auto;justify-content:space-between}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn .btn-1[data-v-682a2d6c]{text-align:center;color:#333;position:relative}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn .btn-1 .wxicon[data-v-682a2d6c]{width:%?70?%;height:%?70?%;border-radius:%?200?%;margin-bottom:%?10?%}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn .btn-2[data-v-682a2d6c]{text-align:center;color:#333}.haibao .hb_gongju_bar .Share-popup-info .fenxiang-btn .btn-2 .baocunicon[data-v-682a2d6c]{width:%?70?%;height:%?70?%;border-radius:%?200?%;margin-bottom:%?10?%}.haibao .hb_gongju_bar .Share-popup-info .quxiao-btn[data-v-682a2d6c]{border-radius:%?15?%;background-color:#f7f8fa;color:#666;padding:%?30?% %?50?%;text-align:center}.xuanzwe_img[data-v-682a2d6c]{position:fixed;bottom:0;left:0;right:0;margin:0 auto;width:100%;background-color:#f7f7f7;padding:%?20?%}.xuanzwe_img .uni-swiper-tab[data-v-682a2d6c]{white-space:nowrap}.xuanzwe_img .scrollx_items[data-v-682a2d6c]{text-align:left;display:inline-block;width:%?100?%;box-sizing:border-box;margin:%?20?% %?14?% %?40?% 0}.xuanzwe_img .card_list_item[data-v-682a2d6c]{text-align:center;background-color:#f7f7f7;height:%?100?%;width:%?100?%;border-radius:%?20?%;padding:0 0;flex:1;margin:0 %?12?%;position:relative}.xuanzwe_img .card_list_item .duihao[data-v-682a2d6c]{right:-4px;bottom:%?-16?%;position:absolute}.xuanzwe_img .card_list_item .duihao uni-image[data-v-682a2d6c]{width:%?40?%;border-bottom-right-radius:10px}.xuanzwe_img .card_list_item .card_icon[data-v-682a2d6c]{width:%?100?%;height:%?100?%;border-radius:%?20?%;border:3px solid #f7f7f7}.xuanzwe_img .card_list_item .selectA[data-v-682a2d6c]{border:3px solid #ff9a44!important;background-color:#fdf2e3!important}@-webkit-keyframes shake-data-v-682a2d6c{10%,\n  90%{-webkit-transform:translate3d(-1px,0 0);transform:translate3d(-1px,0 0)}20%,\n  80%{-webkit-transform:translate3d(2px,0,0);transform:translate3d(2px,0,0)}30%,\n  50%,\n  70%{-webkit-transform:translate3d(-4px,0,0);transform:translate3d(-4px,0,0)}40%,\n  60%{-webkit-transform:translate3d(4px,0,0);transform:translate3d(4px,0,0)}}@keyframes shake-data-v-682a2d6c{10%,\n  90%{-webkit-transform:translate3d(-1px,0 0);transform:translate3d(-1px,0 0)}20%,\n  80%{-webkit-transform:translate3d(2px,0,0);transform:translate3d(2px,0,0)}30%,\n  50%,\n  70%{-webkit-transform:translate3d(-4px,0,0);transform:translate3d(-4px,0,0)}40%,\n  60%{-webkit-transform:translate3d(4px,0,0);transform:translate3d(4px,0,0)}}@-webkit-keyframes glow-data-v-682a2d6c{0%{border-color:#f7f7f7;box-shadow:0 0 0 2px #ff9a44,inset 0 0 0 2px #ff9a44,0 0 0 #ff9a44}100%{border-color:#f7f7f7;box-shadow:0 0 0 5px #ff9a44,inset 0 0 0 5px #ff9a44,0 0 0 #ff9a44}}@keyframes glow-data-v-682a2d6c{0%{border-color:#f7f7f7;box-shadow:0 0 0 2px #ff9a44,inset 0 0 0 2px #ff9a44,0 0 0 #ff9a44}100%{border-color:#f7f7f7;box-shadow:0 0 0 5px #ff9a44,inset 0 0 0 5px #ff9a44,0 0 0 #ff9a44}}",""]),e.exports=i}}]);