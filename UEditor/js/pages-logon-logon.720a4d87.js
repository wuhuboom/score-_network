(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-logon-logon"],{"0361":function(t,e,a){"use strict";var n=a("0dab"),o=a.n(n);o.a},"0dab":function(t,e,a){var n=a("a9f0");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var o=a("4f06").default;o("9bea869c",n,!0,{sourceMap:!1,shadowMode:!1})},"1fe6":function(t,e,a){"use strict";a.d(e,"b",(function(){return o})),a.d(e,"c",(function(){return i})),a.d(e,"a",(function(){return n}));var n={uCountTo:a("4655").default,uButton:a("eeee").default,uIcon:a("21cf").default},o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[a("v-uni-image",{staticClass:"logon_page_bg",attrs:{src:"/static/images/Frame-33444.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"logo_wenan"},[a("v-uni-view",[t._v("已有"),a("u-count-to",{attrs:{"start-val":30,separator:",","end-val":120843,color:"#FE6832",decimals:0,"font-size":"72",bold:!0}}),t._v("位吃货加入小惠")],1),a("v-uni-view",[t._v("共省"),a("u-count-to",{attrs:{"start-val":30,separator:",","end-val":7208433,color:"#FE6832",decimals:0,"font-size":"72",bold:!0}}),t._v("元")],1)],1),a("v-uni-view",{staticClass:"hb_page_wrap"},[a("v-uni-image",{staticClass:"portrait",attrs:{src:"/static/logo-2.png"}}),a("v-uni-view",{staticClass:"logo_bottom_box"},[a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle",ripple:!1,loading:t.Payloading},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.getWeChatCode()}}},[a("u-icon",{attrs:{name:"weixin-fill",color:"#fff",size:"42"}}),t._v("微信登录")],1)],1),a("v-uni-view",{staticClass:"other_box"},[a("v-uni-view",{staticClass:"protocol"},[a("v-uni-view",{staticClass:"dianji"},[0==t.check_on?a("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_gray.png"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.check_icon()}}}):a("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_on.png"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.check_icon()}}})],1),a("v-uni-view",[t._v("登录代表您已同意《"),a("span",{on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.yhxy.apply(void 0,arguments)}}},[t._v("用户协议")]),t._v("》和《"),a("span",{on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.ysxy.apply(void 0,arguments)}}},[t._v("隐私政策")]),t._v("》")])],1)],1)],1)],1)],1)},i=[]},"21fe":function(t,e,a){"use strict";a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){}));var n=function(){var t=this.$createElement,e=this._self._c||t;return e("v-uni-view",{staticClass:"u-count-num",style:{fontSize:this.fontSize+"rpx",fontWeight:this.bold?"bold":"normal",color:this.color}},[this._v(this._s(this.displayValue))])},o=[]},"3c73":function(t,e,a){"use strict";a.r(e);var n=a("78f8"),o=a.n(n);for(var i in n)["default"].indexOf(i)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(i);e["default"]=o.a},4655:function(t,e,a){"use strict";a.r(e);var n=a("21fe"),o=a("3c73");for(var i in o)["default"].indexOf(i)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(i);a("46dc");var r=a("f0c5"),l=Object(r["a"])(o["default"],n["b"],n["c"],!1,null,"29bb7519",null,!1,n["a"],void 0);e["default"]=l.exports},"46dc":function(t,e,a){"use strict";var n=a("9a7b"),o=a.n(n);o.a},"5e49":function(t,e,a){"use strict";var n=a("9fb0"),o=a.n(n);o.a},"69a4":function(t,e,a){"use strict";a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-button",{staticClass:"u-btn u-line-1 u-fix-ios-appearance",class:["u-size-"+t.size,t.plain?"u-btn--"+t.type+"--plain":"",t.loading?"u-loading":"","circle"==t.shape?"u-round-circle":"",t.hairLine?t.showHairLineBorder:"u-btn--bold-border","u-btn--"+t.type,t.disabled?"u-btn--"+t.type+"--disabled":""],style:[t.customStyle,{overflow:t.ripple?"hidden":"visible"}],attrs:{id:"u-wave-btn","hover-start-time":Number(t.hoverStartTime),"hover-stay-time":Number(t.hoverStayTime),disabled:t.disabled,"form-type":t.formType,"open-type":t.openType,"app-parameter":t.appParameter,"hover-stop-propagation":t.hoverStopPropagation,"send-message-title":t.sendMessageTitle,"send-message-path":"sendMessagePath",lang:t.lang,"data-name":t.dataName,"session-from":t.sessionFrom,"send-message-img":t.sendMessageImg,"show-message-card":t.showMessageCard,"hover-class":t.getHoverClass,loading:t.loading},on:{getphonenumber:function(e){arguments[0]=e=t.$handleEvent(e),t.getphonenumber.apply(void 0,arguments)},getuserinfo:function(e){arguments[0]=e=t.$handleEvent(e),t.getuserinfo.apply(void 0,arguments)},error:function(e){arguments[0]=e=t.$handleEvent(e),t.error.apply(void 0,arguments)},opensetting:function(e){arguments[0]=e=t.$handleEvent(e),t.opensetting.apply(void 0,arguments)},launchapp:function(e){arguments[0]=e=t.$handleEvent(e),t.launchapp.apply(void 0,arguments)},click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.click(e)}}},[t._t("default"),t.ripple?a("v-uni-view",{staticClass:"u-wave-ripple",class:[t.waveActive?"u-wave-active":""],style:{top:t.rippleTop+"px",left:t.rippleLeft+"px",width:t.fields.targetWidth+"px",height:t.fields.targetWidth+"px","background-color":t.rippleBgColor||"rgba(0, 0, 0, 0.15)"}}):t._e()],2)},o=[]},"78f8":function(t,e,a){"use strict";a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("a9e3"),a("acd8"),a("ac1f"),a("00b4"),a("5319");var n={name:"u-count-to",props:{startVal:{type:[Number,String],default:0},endVal:{type:[Number,String],default:0,required:!0},duration:{type:[Number,String],default:2e3},autoplay:{type:Boolean,default:!0},decimals:{type:[Number,String],default:0},useEasing:{type:Boolean,default:!0},decimal:{type:[Number,String],default:"."},color:{type:String,default:"#303133"},fontSize:{type:[Number,String],default:50},bold:{type:Boolean,default:!1},separator:{type:String,default:""}},data:function(){return{localStartVal:this.startVal,displayValue:this.formatNumber(this.startVal),printVal:null,paused:!1,localDuration:Number(this.duration),startTime:null,timestamp:null,remaining:null,rAF:null,lastTime:0}},computed:{countDown:function(){return this.startVal>this.endVal}},watch:{startVal:function(){this.autoplay&&this.start()},endVal:function(){this.autoplay&&this.start()}},mounted:function(){this.autoplay&&this.start()},methods:{easingFn:function(t,e,a,n){return a*(1-Math.pow(2,-10*t/n))*1024/1023+e},requestAnimationFrame:function(t){var e=(new Date).getTime(),a=Math.max(0,16-(e-this.lastTime)),n=setTimeout((function(){t(e+a)}),a);return this.lastTime=e+a,n},cancelAnimationFrame:function(t){clearTimeout(t)},start:function(){this.localStartVal=this.startVal,this.startTime=null,this.localDuration=this.duration,this.paused=!1,this.rAF=this.requestAnimationFrame(this.count)},reStart:function(){this.paused?(this.resume(),this.paused=!1):(this.stop(),this.paused=!0)},stop:function(){this.cancelAnimationFrame(this.rAF)},resume:function(){this.startTime=null,this.localDuration=this.remaining,this.localStartVal=this.printVal,this.requestAnimationFrame(this.count)},reset:function(){this.startTime=null,this.cancelAnimationFrame(this.rAF),this.displayValue=this.formatNumber(this.startVal)},count:function(t){this.startTime||(this.startTime=t),this.timestamp=t;var e=t-this.startTime;this.remaining=this.localDuration-e,this.useEasing?this.countDown?this.printVal=this.localStartVal-this.easingFn(e,0,this.localStartVal-this.endVal,this.localDuration):this.printVal=this.easingFn(e,this.localStartVal,this.endVal-this.localStartVal,this.localDuration):this.countDown?this.printVal=this.localStartVal-(this.localStartVal-this.endVal)*(e/this.localDuration):this.printVal=this.localStartVal+(this.endVal-this.localStartVal)*(e/this.localDuration),this.countDown?this.printVal=this.printVal<this.endVal?this.endVal:this.printVal:this.printVal=this.printVal>this.endVal?this.endVal:this.printVal,this.displayValue=this.formatNumber(this.printVal),e<this.localDuration?this.rAF=this.requestAnimationFrame(this.count):this.$emit("end")},isNumber:function(t){return!isNaN(parseFloat(t))},formatNumber:function(t){t=Number(t),t=t.toFixed(Number(this.decimals)),t+="";var e=t.split("."),a=e[0],n=e.length>1?this.decimal+e[1]:"",o=/(\d+)(\d{3})/;if(this.separator&&!this.isNumber(this.separator))while(o.test(a))a=a.replace(o,"$1"+this.separator+"$2");return a+n},destroyed:function(){this.cancelAnimationFrame(this.rAF)}}};e.default=n},"96d7":function(t,e,a){"use strict";a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("a9e3"),a("c975"),a("d3b7"),a("ac1f");var n={name:"u-button",props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:function(){return{}}},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:1e3},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150}},computed:{getHoverClass:function(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";var t;return t=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",t},showHairLineBorder:function(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data:function(){return{rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click:function(t){var e=this;this.$u.throttle((function(){!0!==e.loading&&!0!==e.disabled&&(e.ripple&&(e.waveActive=!1,e.$nextTick((function(){this.getWaveQuery(t)}))),e.$emit("click",t))}),this.throttleTime)},getWaveQuery:function(t){var e=this;this.getElQuery().then((function(a){var n=a[0];if(n.width&&n.width&&(n.targetWidth=n.height>n.width?n.height:n.width,n.targetWidth)){e.fields=n;var o,i;o=t.touches[0].clientX,i=t.touches[0].clientY,e.rippleTop=i-n.top-n.targetWidth/2,e.rippleLeft=o-n.left-n.targetWidth/2,e.$nextTick((function(){e.waveActive=!0}))}}))},getElQuery:function(){var t=this;return new Promise((function(e){var a="";a=uni.createSelectorQuery().in(t),a.select(".u-btn").boundingClientRect(),a.exec((function(t){e(t)}))}))},getphonenumber:function(t){this.$emit("getphonenumber",t)},getuserinfo:function(t){this.$emit("getuserinfo",t)},error:function(t){this.$emit("error",t)},opensetting:function(t){this.$emit("opensetting",t)},launchapp:function(t){this.$emit("launchapp",t)}}};e.default=n},"9a7b":function(t,e,a){var n=a("dfc2");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var o=a("4f06").default;o("09676032",n,!0,{sourceMap:!1,shadowMode:!1})},"9c26":function(t,e,a){var n=a("24fb");e=n(!1),e.push([t.i,".logo_wenan[data-v-07c97f92]{position:fixed;top:23%;left:%?50?%}.logo_wenan uni-view[data-v-07c97f92]{font-size:%?40?%;font-weight:700;margin-bottom:%?4?%}.logo_wenan uni-view span[data-v-07c97f92]{font-size:%?72?%;color:#fe6832;margin:0 %?10?%}.logo_bottom_box[data-v-07c97f92]{position:fixed;bottom:10%;width:100%;padding:0 %?40?%}.hb_page_wrap[data-v-07c97f92]{text-align:center;padding:%?120?% 0 %?40?% 0}.hb_page_wrap .portrait[data-v-07c97f92]{width:%?160?%;height:%?160?%}.hb_page_wrap .portrait2[data-v-07c97f92]{width:%?500?%;height:%?200?%;margin-top:%?30?%}.lijipay[data-v-07c97f92]{width:100%;position:relative}.lijipay .u-icon[data-v-07c97f92]{margin-right:%?10?%}.lijipay .u-size-default[data-v-07c97f92]{height:%?96?%!important;line-height:%?96?%!important;background-image:linear-gradient(90deg,#ffa13b,#fd6331)!important;color:#fff}.new_user[data-v-07c97f92]{color:#666;margin:%?24?% 0 %?32?% 0;font-size:%?24?%}.other_box[data-v-07c97f92]{margin-top:%?30?%}.other_box .logon_type[data-v-07c97f92]{margin-top:%?50?%}.other_box .logon_type .logon_type_item[data-v-07c97f92]{text-align:center}.other_box .logon_type .logon_type_item uni-image[data-v-07c97f92]{width:%?88?%;height:%?88?%;border-radius:%?200?%}.other_box .logon_type .logon_type_item uni-view[data-v-07c97f92]{color:#333}.protocol[data-v-07c97f92]{width:100%;margin:%?60?% auto 0;color:#999;padding:0 0 10px 0;margin-bottom:10px;display:flex;align-items:flex-start;font-size:%?24?%;justify-content:center;position:fixed;bottom:2%;left:0;right:0;margin:0 auto}.protocol span[data-v-07c97f92]{color:#ff8848}.check_icon[data-v-07c97f92]{width:%?34?%;height:%?34?%;position:relative;top:0;margin-right:%?7?%}",""]),t.exports=e},"9fb0":function(t,e,a){var n=a("9c26");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var o=a("4f06").default;o("e07d10a6",n,!0,{sourceMap:!1,shadowMode:!1})},a4bf:function(t,e,a){"use strict";a.r(e);var n=a("96d7"),o=a.n(n);for(var i in n)["default"].indexOf(i)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(i);e["default"]=o.a},a9f0:function(t,e,a){var n=a("24fb");e=n(!1),e.push([t.i,'.u-btn[data-v-52fefc8e]::after{border:none}.u-btn[data-v-52fefc8e]{position:relative;border:0;display:inline-flex;overflow:visible;line-height:1;display:flex;flex-direction:row;align-items:center;justify-content:center;cursor:pointer;padding:0 %?40?%;z-index:1;box-sizing:border-box;transition:all .15s}.u-btn--bold-border[data-v-52fefc8e]{border:1px solid #fff}.u-btn--default[data-v-52fefc8e]{color:#606266;border-color:#c0c4cc;background-color:#fff}.u-btn--primary[data-v-52fefc8e]{color:#fff;border-color:#fe6736;background-color:#fe6736}.u-btn--success[data-v-52fefc8e]{color:#fff;border-color:#19be6b;background-color:#19be6b}.u-btn--error[data-v-52fefc8e]{color:#fff;border-color:#fa3534;background-color:#fa3534}.u-btn--warning[data-v-52fefc8e]{color:#fff;border-color:#f90;background-color:#f90}.u-btn--default--disabled[data-v-52fefc8e]{color:#fff;border-color:#e4e7ed;background-color:#fff}.u-btn--primary--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#71d5a1!important;background-color:#71d5a1!important}.u-btn--error--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fab6b6!important;background-color:#fab6b6!important}.u-btn--warning--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fcbd71!important;background-color:#fcbd71!important}.u-btn--primary--plain[data-v-52fefc8e]{color:#fe6736!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--plain[data-v-52fefc8e]{color:#19be6b!important;border-color:#71d5a1!important;background-color:#dbf1e1!important}.u-btn--error--plain[data-v-52fefc8e]{color:#fa3534!important;border-color:#fab6b6!important;background-color:#fef0f0!important}.u-btn--warning--plain[data-v-52fefc8e]{color:#f90!important;border-color:#fcbd71!important;background-color:#fdf6ec!important}.u-hairline-border[data-v-52fefc8e]:after{content:" ";position:absolute;pointer-events:none;box-sizing:border-box;-webkit-transform-origin:0 0;transform-origin:0 0;left:0;top:0;width:199.8%;height:199.7%;-webkit-transform:scale(.5);transform:scale(.5);border:1px solid currentColor;z-index:1}.u-wave-ripple[data-v-52fefc8e]{z-index:0;position:absolute;border-radius:100%;background-clip:padding-box;pointer-events:none;-webkit-user-select:none;user-select:none;-webkit-transform:scale(0);transform:scale(0);opacity:1;-webkit-transform-origin:center;transform-origin:center}.u-wave-ripple.u-wave-active[data-v-52fefc8e]{opacity:0;-webkit-transform:scale(2);transform:scale(2);transition:opacity 1s linear,-webkit-transform .4s linear;transition:opacity 1s linear,transform .4s linear;transition:opacity 1s linear,transform .4s linear,-webkit-transform .4s linear}.u-round-circle[data-v-52fefc8e]{border-radius:%?100?%}.u-round-circle[data-v-52fefc8e]::after{border-radius:%?100?%}.u-loading[data-v-52fefc8e]::after{background-color:hsla(0,0%,100%,.35)}.u-size-default[data-v-52fefc8e]{font-size:%?30?%;height:%?70?%;line-height:%?70?%}.u-size-medium[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?26?%;height:%?70?%;line-height:%?70?%;padding:0 %?80?%}.u-size-mini[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?22?%;padding-top:1px;height:%?50?%;line-height:%?50?%;padding:0 %?20?%}.u-primary-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#ffa373!important}.u-default-plain-hover[data-v-52fefc8e]{color:#ffa373!important;background:#fff!important}.u-success-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#18b566!important}.u-warning-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#f29100!important}.u-error-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#dd6161!important}.u-info-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#5a6c76!important}.u-default-hover[data-v-52fefc8e]{color:#ffa373!important;border-color:#ffa373!important;background-color:#fff!important}.u-primary-hover[data-v-52fefc8e]{background:#ffa373!important;color:#fff}.u-success-hover[data-v-52fefc8e]{background:#18b566!important;color:#fff}.u-info-hover[data-v-52fefc8e]{background:#5a6c76!important;color:#fff}.u-warning-hover[data-v-52fefc8e]{background:#f29100!important;color:#fff}.u-error-hover[data-v-52fefc8e]{background:#dd6161!important;color:#fff}',""]),t.exports=e},dfc2:function(t,e,a){var n=a("24fb");e=n(!1),e.push([t.i,".u-count-num[data-v-29bb7519]{display:inline-flex;text-align:center}",""]),t.exports=e},e2f0:function(t,e,a){"use strict";(function(t){a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("e9c4"),a("ac1f"),a("5319"),a("4d63"),a("c607"),a("2c3e"),a("25f0");var n=getApp(),o={data:function(){return{Payloading:!1,check_on:!1}},onLoad:function(t){if("{}"!=JSON.stringify(t)){var e={parent_id:t.parent_id,reseller_id:{reseller_id:uni.getStorageSync("reseller_id")||""}};n.globalData.bindSaveParentId(e)}var a=uni.getStorageSync("wechat_login_tag")||null;a&&this.checkWeChatCode()},onShow:function(){var t=uni.getStorageSync("token");t&&uni.switchTab({url:"/pages/me/me"})},methods:{yhxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/fuxy.html"))})},ysxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/ysxy.html"))})},checkWeChatCode:function(){var t=this.getUrlCode("code");t&&this.handleToLogin(t)},getUrlCode:function(t){return decodeURIComponent((new RegExp("[?|&]"+t+"=([^&;]+?)(&|#|;|$)").exec(location.href)||[,""])[1].replace(/\+/g,"%20"))||null},getWeChatCode:function(){var e=this;uni.setStorageSync("wechat_login_tag","true"),e.Payloading=!0,setTimeout((function(){e.Payloading=!1;var a=uni.getStorageSync("getOfficialAccountInfo").appid,n=encodeURIComponent(window.location.href);t("log",a,n," at pages/logon/logon.vue:175"),window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid="+a+"&redirect_uri="+n+"&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"}),2e3)},handleToLogin:function(e){t("log","微信code",e," at pages/logon/logon.vue:186");this.$api.WxwechatLogin({code:e}).then((function(t){uni.setStorageSync("token",t.data.result.token);var e="https://"+document.domain+"/#/";window.location.href=e})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},check_icon:function(){1==this.check_on?this.check_on=!1:this.check_on=!0},Topages:function(t){uni.navigateTo({url:t})},wxAppLogon:function(){var e=this;e.Payloading=!0,setTimeout((function(){e.Payloading=!1,uni.login({provider:"weixin",onlyAuthorize:!0,success:function(a){t("log","调起微信APP信息",a," at pages/logon/logon.vue:234"),e.$api.wxappLogon({code:a.code}).then((function(e){t("log","微信APP登录",e," at pages/logon/logon.vue:240"),uni.setStorageSync("token",e.data.result.token),uni.switchTab({url:"/pages/me/me"})})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},fail:function(e){t("log",e," at pages/logon/logon.vue:255")}})}),2e3)},wxminiAppLogon:function(){var e=this;e.Payloading=!0,wx.getUserProfile({desc:"用于完善会员资料",success:function(a){t("log","用户信息",a," at pages/logon/logon.vue:267");var n=a.userInfo.nickName,o=a.userInfo.avatarUrl;uni.login({provider:"weixin",success:function(a){t("log","获取小程序code",a.code," at pages/logon/logon.vue:273"),e.$api.wxminiappLogon({code:a.code,avatar:o,nickname:n}).then((function(a){e.Payloading=!1,t("log","微信小程序登录",a," at pages/logon/logon.vue:281"),uni.setStorageSync("token",a.data.result.token),uni.switchTab({url:"/pages/me/me"})})).catch((function(t){e.Payloading=!1,uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))}})},fail:function(a){e.Payloading=!1,t("log",a," at pages/logon/logon.vue:301")}})}}};e.default=o}).call(this,a("0de9")["log"])},e443:function(t,e,a){"use strict";a.r(e);var n=a("e2f0"),o=a.n(n);for(var i in n)["default"].indexOf(i)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(i);e["default"]=o.a},ec7f:function(t,e,a){"use strict";a.r(e);var n=a("1fe6"),o=a("e443");for(var i in o)["default"].indexOf(i)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(i);a("5e49");var r=a("f0c5"),l=Object(r["a"])(o["default"],n["b"],n["c"],!1,null,"07c97f92",null,!1,n["a"],void 0);e["default"]=l.exports},eeee:function(t,e,a){"use strict";a.r(e);var n=a("69a4"),o=a("a4bf");for(var i in o)["default"].indexOf(i)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(i);a("0361");var r=a("f0c5"),l=Object(r["a"])(o["default"],n["b"],n["c"],!1,null,"52fefc8e",null,!1,n["a"],void 0);e["default"]=l.exports}}]);