(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-logon-logon"],{"0361":function(e,t,o){"use strict";var n=o("0dab"),a=o.n(n);a.a},"0dab":function(e,t,o){var n=o("a9f0");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);var a=o("4f06").default;a("9bea869c",n,!0,{sourceMap:!1,shadowMode:!1})},"25f8":function(e,t,o){var n=o("3cb3");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);var a=o("4f06").default;a("55951aa6",n,!0,{sourceMap:!1,shadowMode:!1})},"3cb3":function(e,t,o){var n=o("24fb");t=n(!1),t.push([e.i,".hb_page_wrap[data-v-637e8900]{text-align:center;padding:%?120?% %?40?% %?40?% %?40?%}.hb_page_wrap .portrait[data-v-637e8900]{width:%?200?%;height:%?200?%}.hb_page_wrap .portrait2[data-v-637e8900]{width:%?500?%;height:%?200?%;margin-top:%?30?%}.lijipay[data-v-637e8900]{width:100%;margin-top:%?50?%;position:relative}.lijipay .u-icon[data-v-637e8900]{margin-right:%?10?%}.lijipay .u-size-default[data-v-637e8900]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#28c445,#28c445)!important;color:#fff}.new_user[data-v-637e8900]{color:#666;margin:%?20?% 0}.other_box[data-v-637e8900]{margin-top:%?100?%}.other_box .logon_type[data-v-637e8900]{margin-top:%?50?%}.other_box .logon_type .logon_type_item[data-v-637e8900]{text-align:center}.other_box .logon_type .logon_type_item uni-image[data-v-637e8900]{width:%?120?%;height:%?120?%;border-radius:%?200?%}.other_box .logon_type .logon_type_item uni-view[data-v-637e8900]{color:#333}.protocol[data-v-637e8900]{width:100%;margin:%?60?% auto 0;color:#999;padding:0 0 10px 0;margin-bottom:10px;display:flex;align-items:flex-start;font-size:%?24?%;justify-content:center;position:fixed;bottom:2%;left:0;right:0;margin:0 auto}.protocol span[data-v-637e8900]{color:#ff8848}.check_icon[data-v-637e8900]{width:%?34?%;height:%?34?%;position:relative;top:0;margin-right:%?7?%}",""]),e.exports=t},5071:function(e,t,o){"use strict";o.d(t,"b",(function(){return a})),o.d(t,"c",(function(){return i})),o.d(t,"a",(function(){return n}));var n={uButton:o("eeee").default,uIcon:o("21cf").default},a=function(){var e=this,t=e.$createElement,o=e._self._c||t;return o("v-uni-view",[o("v-uni-view",{staticClass:"hb_page_wrap"},[o("v-uni-image",{staticClass:"portrait",attrs:{src:"/static/logo.png"}}),o("v-uni-view",{staticClass:"lijipay"},[o("u-button",{attrs:{type:"info",shape:"circle",ripple:!1,loading:e.Payloading},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getWeChatCode()}}},[o("u-icon",{attrs:{name:"weixin-fill",color:"#fff",size:"42"}}),e._v("微信登录")],1)],1),o("v-uni-view",{staticClass:"new_user",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.Topages("/pages/logon/wxregister")}}},[e._v("新用户注册")]),o("v-uni-view",{staticClass:"other_box"},[o("v-uni-view",{staticClass:"protocol"},[o("v-uni-view",{staticClass:"dianji"},[0==e.check_on?o("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_gray.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.check_icon()}}}):o("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_on.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.check_icon()}}})],1),o("v-uni-view",[e._v("登录代表您已同意《"),o("span",{on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.yhxy.apply(void 0,arguments)}}},[e._v("用户协议")]),e._v("》和《"),o("span",{on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.ysxy.apply(void 0,arguments)}}},[e._v("隐私政策")]),e._v("》")])],1)],1)],1)],1)},i=[]},"69a4":function(e,t,o){"use strict";o.d(t,"b",(function(){return n})),o.d(t,"c",(function(){return a})),o.d(t,"a",(function(){}));var n=function(){var e=this,t=e.$createElement,o=e._self._c||t;return o("v-uni-button",{staticClass:"u-btn u-line-1 u-fix-ios-appearance",class:["u-size-"+e.size,e.plain?"u-btn--"+e.type+"--plain":"",e.loading?"u-loading":"","circle"==e.shape?"u-round-circle":"",e.hairLine?e.showHairLineBorder:"u-btn--bold-border","u-btn--"+e.type,e.disabled?"u-btn--"+e.type+"--disabled":""],style:[e.customStyle,{overflow:e.ripple?"hidden":"visible"}],attrs:{id:"u-wave-btn","hover-start-time":Number(e.hoverStartTime),"hover-stay-time":Number(e.hoverStayTime),disabled:e.disabled,"form-type":e.formType,"open-type":e.openType,"app-parameter":e.appParameter,"hover-stop-propagation":e.hoverStopPropagation,"send-message-title":e.sendMessageTitle,"send-message-path":"sendMessagePath",lang:e.lang,"data-name":e.dataName,"session-from":e.sessionFrom,"send-message-img":e.sendMessageImg,"show-message-card":e.showMessageCard,"hover-class":e.getHoverClass,loading:e.loading},on:{getphonenumber:function(t){arguments[0]=t=e.$handleEvent(t),e.getphonenumber.apply(void 0,arguments)},getuserinfo:function(t){arguments[0]=t=e.$handleEvent(t),e.getuserinfo.apply(void 0,arguments)},error:function(t){arguments[0]=t=e.$handleEvent(t),e.error.apply(void 0,arguments)},opensetting:function(t){arguments[0]=t=e.$handleEvent(t),e.opensetting.apply(void 0,arguments)},launchapp:function(t){arguments[0]=t=e.$handleEvent(t),e.launchapp.apply(void 0,arguments)},click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.click(t)}}},[e._t("default"),e.ripple?o("v-uni-view",{staticClass:"u-wave-ripple",class:[e.waveActive?"u-wave-active":""],style:{top:e.rippleTop+"px",left:e.rippleLeft+"px",width:e.fields.targetWidth+"px",height:e.fields.targetWidth+"px","background-color":e.rippleBgColor||"rgba(0, 0, 0, 0.15)"}}):e._e()],2)},a=[]},"7c11":function(e,t,o){"use strict";var n=o("25f8"),a=o.n(n);a.a},"96d7":function(e,t,o){"use strict";o("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,o("a9e3"),o("c975"),o("d3b7"),o("ac1f");var n={name:"u-button",props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:function(){return{}}},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:1e3},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150}},computed:{getHoverClass:function(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";var e;return e=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",e},showHairLineBorder:function(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data:function(){return{rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click:function(e){var t=this;this.$u.throttle((function(){!0!==t.loading&&!0!==t.disabled&&(t.ripple&&(t.waveActive=!1,t.$nextTick((function(){this.getWaveQuery(e)}))),t.$emit("click",e))}),this.throttleTime)},getWaveQuery:function(e){var t=this;this.getElQuery().then((function(o){var n=o[0];if(n.width&&n.width&&(n.targetWidth=n.height>n.width?n.height:n.width,n.targetWidth)){t.fields=n;var a,i;a=e.touches[0].clientX,i=e.touches[0].clientY,t.rippleTop=i-n.top-n.targetWidth/2,t.rippleLeft=a-n.left-n.targetWidth/2,t.$nextTick((function(){t.waveActive=!0}))}}))},getElQuery:function(){var e=this;return new Promise((function(t){var o="";o=uni.createSelectorQuery().in(e),o.select(".u-btn").boundingClientRect(),o.exec((function(e){t(e)}))}))},getphonenumber:function(e){this.$emit("getphonenumber",e)},getuserinfo:function(e){this.$emit("getuserinfo",e)},error:function(e){this.$emit("error",e)},opensetting:function(e){this.$emit("opensetting",e)},launchapp:function(e){this.$emit("launchapp",e)}}};t.default=n},a4bf:function(e,t,o){"use strict";o.r(t);var n=o("96d7"),a=o.n(n);for(var i in n)["default"].indexOf(i)<0&&function(e){o.d(t,e,(function(){return n[e]}))}(i);t["default"]=a.a},a9f0:function(e,t,o){var n=o("24fb");t=n(!1),t.push([e.i,'.u-btn[data-v-52fefc8e]::after{border:none}.u-btn[data-v-52fefc8e]{position:relative;border:0;display:inline-flex;overflow:visible;line-height:1;display:flex;flex-direction:row;align-items:center;justify-content:center;cursor:pointer;padding:0 %?40?%;z-index:1;box-sizing:border-box;transition:all .15s}.u-btn--bold-border[data-v-52fefc8e]{border:1px solid #fff}.u-btn--default[data-v-52fefc8e]{color:#606266;border-color:#c0c4cc;background-color:#fff}.u-btn--primary[data-v-52fefc8e]{color:#fff;border-color:#fe6736;background-color:#fe6736}.u-btn--success[data-v-52fefc8e]{color:#fff;border-color:#19be6b;background-color:#19be6b}.u-btn--error[data-v-52fefc8e]{color:#fff;border-color:#fa3534;background-color:#fa3534}.u-btn--warning[data-v-52fefc8e]{color:#fff;border-color:#f90;background-color:#f90}.u-btn--default--disabled[data-v-52fefc8e]{color:#fff;border-color:#e4e7ed;background-color:#fff}.u-btn--primary--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#71d5a1!important;background-color:#71d5a1!important}.u-btn--error--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fab6b6!important;background-color:#fab6b6!important}.u-btn--warning--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fcbd71!important;background-color:#fcbd71!important}.u-btn--primary--plain[data-v-52fefc8e]{color:#fe6736!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--plain[data-v-52fefc8e]{color:#19be6b!important;border-color:#71d5a1!important;background-color:#dbf1e1!important}.u-btn--error--plain[data-v-52fefc8e]{color:#fa3534!important;border-color:#fab6b6!important;background-color:#fef0f0!important}.u-btn--warning--plain[data-v-52fefc8e]{color:#f90!important;border-color:#fcbd71!important;background-color:#fdf6ec!important}.u-hairline-border[data-v-52fefc8e]:after{content:" ";position:absolute;pointer-events:none;box-sizing:border-box;-webkit-transform-origin:0 0;transform-origin:0 0;left:0;top:0;width:199.8%;height:199.7%;-webkit-transform:scale(.5);transform:scale(.5);border:1px solid currentColor;z-index:1}.u-wave-ripple[data-v-52fefc8e]{z-index:0;position:absolute;border-radius:100%;background-clip:padding-box;pointer-events:none;-webkit-user-select:none;user-select:none;-webkit-transform:scale(0);transform:scale(0);opacity:1;-webkit-transform-origin:center;transform-origin:center}.u-wave-ripple.u-wave-active[data-v-52fefc8e]{opacity:0;-webkit-transform:scale(2);transform:scale(2);transition:opacity 1s linear,-webkit-transform .4s linear;transition:opacity 1s linear,transform .4s linear;transition:opacity 1s linear,transform .4s linear,-webkit-transform .4s linear}.u-round-circle[data-v-52fefc8e]{border-radius:%?100?%}.u-round-circle[data-v-52fefc8e]::after{border-radius:%?100?%}.u-loading[data-v-52fefc8e]::after{background-color:hsla(0,0%,100%,.35)}.u-size-default[data-v-52fefc8e]{font-size:%?30?%;height:%?70?%;line-height:%?70?%}.u-size-medium[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?26?%;height:%?70?%;line-height:%?70?%;padding:0 %?80?%}.u-size-mini[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?22?%;padding-top:1px;height:%?50?%;line-height:%?50?%;padding:0 %?20?%}.u-primary-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#ffa373!important}.u-default-plain-hover[data-v-52fefc8e]{color:#ffa373!important;background:#fff!important}.u-success-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#18b566!important}.u-warning-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#f29100!important}.u-error-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#dd6161!important}.u-info-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#5a6c76!important}.u-default-hover[data-v-52fefc8e]{color:#ffa373!important;border-color:#ffa373!important;background-color:#fff!important}.u-primary-hover[data-v-52fefc8e]{background:#ffa373!important;color:#fff}.u-success-hover[data-v-52fefc8e]{background:#18b566!important;color:#fff}.u-info-hover[data-v-52fefc8e]{background:#5a6c76!important;color:#fff}.u-warning-hover[data-v-52fefc8e]{background:#f29100!important;color:#fff}.u-error-hover[data-v-52fefc8e]{background:#dd6161!important;color:#fff}',""]),e.exports=t},e2f0:function(e,t,o){"use strict";(function(e){o("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,o("e9c4"),o("ac1f"),o("5319"),o("4d63"),o("c607"),o("2c3e"),o("25f0");var n=getApp(),a={data:function(){return{Payloading:!1,check_on:!1}},onLoad:function(e){n.globalData.bindSaveParentId(e);var t=uni.getStorageSync("wechat_login_tag")||null;t&&this.checkWeChatCode()},onShow:function(){var e=uni.getStorageSync("token");e&&uni.switchTab({url:"/pages/me/me"})},methods:{yhxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/fuxy.html"))})},ysxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/ysxy.html"))})},checkWeChatCode:function(){var e=this.getUrlCode("code");e&&this.handleToLogin(e)},getUrlCode:function(e){return decodeURIComponent((new RegExp("[?|&]"+e+"=([^&;]+?)(&|#|;|$)").exec(location.href)||[,""])[1].replace(/\+/g,"%20"))||null},getWeChatCode:function(){var t=this;uni.setStorageSync("wechat_login_tag","true"),t.Payloading=!0,setTimeout((function(){t.Payloading=!1;var o=uni.getStorageSync("getOfficialAccountInfo").appid,n=encodeURIComponent(window.location.href);e("log",o,n," at pages/logon/logon.vue:150"),window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid="+o+"&redirect_uri="+n+"&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"}),2e3)},handleToLogin:function(t){e("log","微信code",t," at pages/logon/logon.vue:161");this.$api.WxwechatLogin({code:t}).then((function(e){uni.setStorageSync("token",e.data.result.token);var t="https://"+document.domain+"/#/";window.location.href=t})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))},check_icon:function(){1==this.check_on?this.check_on=!1:this.check_on=!0},Topages:function(e){uni.navigateTo({url:e})},wxAppLogon:function(){var t=this;t.Payloading=!0,setTimeout((function(){t.Payloading=!1,uni.login({provider:"weixin",onlyAuthorize:!0,success:function(o){e("log","调起微信APP信息",o," at pages/logon/logon.vue:209"),t.$api.wxappLogon({code:o.code}).then((function(t){e("log","微信APP登录",t," at pages/logon/logon.vue:215"),uni.setStorageSync("token",t.data.result.token),uni.switchTab({url:"/pages/me/me"})})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))},fail:function(t){e("log",t," at pages/logon/logon.vue:230")}})}),2e3)},wxminiAppLogon:function(){var t=this;t.Payloading=!0,wx.getUserProfile({desc:"用于完善会员资料",success:function(o){e("log","用户信息",o," at pages/logon/logon.vue:242");var n=o.userInfo.nickName,a=o.userInfo.avatarUrl;uni.login({provider:"weixin",success:function(o){e("log","获取小程序code",o.code," at pages/logon/logon.vue:248"),t.$api.wxminiappLogon({code:o.code,avatar:a,nickname:n}).then((function(o){t.Payloading=!1,e("log","微信小程序登录",o," at pages/logon/logon.vue:256"),uni.setStorageSync("token",o.data.result.token),uni.switchTab({url:"/pages/me/me"})})).catch((function(e){t.Payloading=!1,uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))}})},fail:function(o){t.Payloading=!1,e("log",o," at pages/logon/logon.vue:276")}})}}};t.default=a}).call(this,o("0de9")["log"])},e443:function(e,t,o){"use strict";o.r(t);var n=o("e2f0"),a=o.n(n);for(var i in n)["default"].indexOf(i)<0&&function(e){o.d(t,e,(function(){return n[e]}))}(i);t["default"]=a.a},ec7f:function(e,t,o){"use strict";o.r(t);var n=o("5071"),a=o("e443");for(var i in a)["default"].indexOf(i)<0&&function(e){o.d(t,e,(function(){return a[e]}))}(i);o("7c11");var r=o("f0c5"),c=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"637e8900",null,!1,n["a"],void 0);t["default"]=c.exports},eeee:function(e,t,o){"use strict";o.r(t);var n=o("69a4"),a=o("a4bf");for(var i in a)["default"].indexOf(i)<0&&function(e){o.d(t,e,(function(){return a[e]}))}(i);o("0361");var r=o("f0c5"),c=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"52fefc8e",null,!1,n["a"],void 0);t["default"]=c.exports}}]);