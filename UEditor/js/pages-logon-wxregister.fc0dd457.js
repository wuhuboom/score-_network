(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-logon-wxregister"],{"0361":function(e,t,a){"use strict";var o=a("0dab"),n=a.n(o);n.a},"0dab":function(e,t,a){var o=a("a9f0");o.__esModule&&(o=o.default),"string"===typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);var n=a("4f06").default;n("9bea869c",o,!0,{sourceMap:!1,shadowMode:!1})},"18ec":function(e,t,a){"use strict";var o=a("afe1"),n=a.n(o);n.a},"5a44":function(e,t,a){"use strict";a.r(t);var o=a("6a83"),n=a.n(o);for(var i in o)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return o[e]}))}(i);t["default"]=n.a},"69a4":function(e,t,a){"use strict";a.d(t,"b",(function(){return o})),a.d(t,"c",(function(){return n})),a.d(t,"a",(function(){}));var o=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-button",{staticClass:"u-btn u-line-1 u-fix-ios-appearance",class:["u-size-"+e.size,e.plain?"u-btn--"+e.type+"--plain":"",e.loading?"u-loading":"","circle"==e.shape?"u-round-circle":"",e.hairLine?e.showHairLineBorder:"u-btn--bold-border","u-btn--"+e.type,e.disabled?"u-btn--"+e.type+"--disabled":""],style:[e.customStyle,{overflow:e.ripple?"hidden":"visible"}],attrs:{id:"u-wave-btn","hover-start-time":Number(e.hoverStartTime),"hover-stay-time":Number(e.hoverStayTime),disabled:e.disabled,"form-type":e.formType,"open-type":e.openType,"app-parameter":e.appParameter,"hover-stop-propagation":e.hoverStopPropagation,"send-message-title":e.sendMessageTitle,"send-message-path":"sendMessagePath",lang:e.lang,"data-name":e.dataName,"session-from":e.sessionFrom,"send-message-img":e.sendMessageImg,"show-message-card":e.showMessageCard,"hover-class":e.getHoverClass,loading:e.loading},on:{getphonenumber:function(t){arguments[0]=t=e.$handleEvent(t),e.getphonenumber.apply(void 0,arguments)},getuserinfo:function(t){arguments[0]=t=e.$handleEvent(t),e.getuserinfo.apply(void 0,arguments)},error:function(t){arguments[0]=t=e.$handleEvent(t),e.error.apply(void 0,arguments)},opensetting:function(t){arguments[0]=t=e.$handleEvent(t),e.opensetting.apply(void 0,arguments)},launchapp:function(t){arguments[0]=t=e.$handleEvent(t),e.launchapp.apply(void 0,arguments)},click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.click(t)}}},[e._t("default"),e.ripple?a("v-uni-view",{staticClass:"u-wave-ripple",class:[e.waveActive?"u-wave-active":""],style:{top:e.rippleTop+"px",left:e.rippleLeft+"px",width:e.fields.targetWidth+"px",height:e.fields.targetWidth+"px","background-color":e.rippleBgColor||"rgba(0, 0, 0, 0.15)"}}):e._e()],2)},n=[]},"6a83":function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("e9c4"),a("ac1f"),a("5319"),a("4d63"),a("c607"),a("2c3e"),a("25f0");var o={data:function(){return{Payloading:!1,check_on:!1}},onLoad:function(){var e=uni.getStorageSync("wechat_login_tag")||null;e&&this.checkWeChatCode()},methods:{yhxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/fuxy.html"))})},ysxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/ysxy.html"))})},checkWeChatCode:function(){var e=this.getUrlCode("code");e&&this.handleToLogin(e)},getUrlCode:function(e){return decodeURIComponent((new RegExp("[?|&]"+e+"=([^&;]+?)(&|#|;|$)").exec(location.href)||[,""])[1].replace(/\+/g,"%20"))||null},getWeChatCode:function(){var e=this;uni.setStorageSync("wechat_login_tag","true"),e.Payloading=!0,setTimeout((function(){e.Payloading=!1;var t=uni.getStorageSync("getOfficialAccountInfo").appid,a=encodeURIComponent(window.location.href);console.log(t,a),window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid="+t+"&redirect_uri="+a+"&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"}),2e3)},handleToLogin:function(e){console.log("微信code",e);this.$api.WxwechatLogin({code:e}).then((function(e){uni.setStorageSync("token",e.data.result.token);var t="https://"+document.domain+"/#/";window.location.href=t})).catch((function(e){console.log("失败",e.data),uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))},check_icon:function(){1==this.check_on?this.check_on=!1:this.check_on=!0},Topages:function(e){uni.navigateTo({url:e})},returnpages1:function(){uni.navigateBack({delta:1})}}};t.default=o},"96d7":function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("c975"),a("d3b7"),a("ac1f");var o={name:"u-button",props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:function(){return{}}},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:1e3},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150}},computed:{getHoverClass:function(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";var e;return e=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",e},showHairLineBorder:function(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data:function(){return{rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click:function(e){var t=this;this.$u.throttle((function(){!0!==t.loading&&!0!==t.disabled&&(t.ripple&&(t.waveActive=!1,t.$nextTick((function(){this.getWaveQuery(e)}))),t.$emit("click",e))}),this.throttleTime)},getWaveQuery:function(e){var t=this;this.getElQuery().then((function(a){var o=a[0];if(o.width&&o.width&&(o.targetWidth=o.height>o.width?o.height:o.width,o.targetWidth)){t.fields=o;var n,i;n=e.touches[0].clientX,i=e.touches[0].clientY,t.rippleTop=i-o.top-o.targetWidth/2,t.rippleLeft=n-o.left-o.targetWidth/2,t.$nextTick((function(){t.waveActive=!0}))}}))},getElQuery:function(){var e=this;return new Promise((function(t){var a="";a=uni.createSelectorQuery().in(e),a.select(".u-btn").boundingClientRect(),a.exec((function(e){t(e)}))}))},getphonenumber:function(e){this.$emit("getphonenumber",e)},getuserinfo:function(e){this.$emit("getuserinfo",e)},error:function(e){this.$emit("error",e)},opensetting:function(e){this.$emit("opensetting",e)},launchapp:function(e){this.$emit("launchapp",e)}}};t.default=o},a4bf:function(e,t,a){"use strict";a.r(t);var o=a("96d7"),n=a.n(o);for(var i in o)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return o[e]}))}(i);t["default"]=n.a},a9f0:function(e,t,a){var o=a("24fb");t=o(!1),t.push([e.i,'.u-btn[data-v-52fefc8e]::after{border:none}.u-btn[data-v-52fefc8e]{position:relative;border:0;display:inline-flex;overflow:visible;line-height:1;display:flex;flex-direction:row;align-items:center;justify-content:center;cursor:pointer;padding:0 %?40?%;z-index:1;box-sizing:border-box;transition:all .15s}.u-btn--bold-border[data-v-52fefc8e]{border:1px solid #fff}.u-btn--default[data-v-52fefc8e]{color:#606266;border-color:#c0c4cc;background-color:#fff}.u-btn--primary[data-v-52fefc8e]{color:#fff;border-color:#fe6736;background-color:#fe6736}.u-btn--success[data-v-52fefc8e]{color:#fff;border-color:#19be6b;background-color:#19be6b}.u-btn--error[data-v-52fefc8e]{color:#fff;border-color:#fa3534;background-color:#fa3534}.u-btn--warning[data-v-52fefc8e]{color:#fff;border-color:#f90;background-color:#f90}.u-btn--default--disabled[data-v-52fefc8e]{color:#fff;border-color:#e4e7ed;background-color:#fff}.u-btn--primary--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#71d5a1!important;background-color:#71d5a1!important}.u-btn--error--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fab6b6!important;background-color:#fab6b6!important}.u-btn--warning--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fcbd71!important;background-color:#fcbd71!important}.u-btn--primary--plain[data-v-52fefc8e]{color:#fe6736!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--plain[data-v-52fefc8e]{color:#19be6b!important;border-color:#71d5a1!important;background-color:#dbf1e1!important}.u-btn--error--plain[data-v-52fefc8e]{color:#fa3534!important;border-color:#fab6b6!important;background-color:#fef0f0!important}.u-btn--warning--plain[data-v-52fefc8e]{color:#f90!important;border-color:#fcbd71!important;background-color:#fdf6ec!important}.u-hairline-border[data-v-52fefc8e]:after{content:" ";position:absolute;pointer-events:none;box-sizing:border-box;-webkit-transform-origin:0 0;transform-origin:0 0;left:0;top:0;width:199.8%;height:199.7%;-webkit-transform:scale(.5);transform:scale(.5);border:1px solid currentColor;z-index:1}.u-wave-ripple[data-v-52fefc8e]{z-index:0;position:absolute;border-radius:100%;background-clip:padding-box;pointer-events:none;-webkit-user-select:none;user-select:none;-webkit-transform:scale(0);transform:scale(0);opacity:1;-webkit-transform-origin:center;transform-origin:center}.u-wave-ripple.u-wave-active[data-v-52fefc8e]{opacity:0;-webkit-transform:scale(2);transform:scale(2);transition:opacity 1s linear,-webkit-transform .4s linear;transition:opacity 1s linear,transform .4s linear;transition:opacity 1s linear,transform .4s linear,-webkit-transform .4s linear}.u-round-circle[data-v-52fefc8e]{border-radius:%?100?%}.u-round-circle[data-v-52fefc8e]::after{border-radius:%?100?%}.u-loading[data-v-52fefc8e]::after{background-color:hsla(0,0%,100%,.35)}.u-size-default[data-v-52fefc8e]{font-size:%?30?%;height:%?70?%;line-height:%?70?%}.u-size-medium[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?26?%;height:%?70?%;line-height:%?70?%;padding:0 %?80?%}.u-size-mini[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?22?%;padding-top:1px;height:%?50?%;line-height:%?50?%;padding:0 %?20?%}.u-primary-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#ffa373!important}.u-default-plain-hover[data-v-52fefc8e]{color:#ffa373!important;background:#fff!important}.u-success-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#18b566!important}.u-warning-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#f29100!important}.u-error-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#dd6161!important}.u-info-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#5a6c76!important}.u-default-hover[data-v-52fefc8e]{color:#ffa373!important;border-color:#ffa373!important;background-color:#fff!important}.u-primary-hover[data-v-52fefc8e]{background:#ffa373!important;color:#fff}.u-success-hover[data-v-52fefc8e]{background:#18b566!important;color:#fff}.u-info-hover[data-v-52fefc8e]{background:#5a6c76!important;color:#fff}.u-warning-hover[data-v-52fefc8e]{background:#f29100!important;color:#fff}.u-error-hover[data-v-52fefc8e]{background:#dd6161!important;color:#fff}',""]),e.exports=t},afe1:function(e,t,a){var o=a("fc00");o.__esModule&&(o=o.default),"string"===typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);var n=a("4f06").default;n("ea8a46da",o,!0,{sourceMap:!1,shadowMode:!1})},bc35:function(e,t,a){"use strict";a.r(t);var o=a("f0a4"),n=a("5a44");for(var i in n)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(i);a("18ec");var r=a("f0c5"),c=Object(r["a"])(n["default"],o["b"],o["c"],!1,null,"d91086da",null,!1,o["a"],void 0);t["default"]=c.exports},eeee:function(e,t,a){"use strict";a.r(t);var o=a("69a4"),n=a("a4bf");for(var i in n)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(i);a("0361");var r=a("f0c5"),c=Object(r["a"])(n["default"],o["b"],o["c"],!1,null,"52fefc8e",null,!1,o["a"],void 0);t["default"]=c.exports},f0a4:function(e,t,a){"use strict";a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return i})),a.d(t,"a",(function(){return o}));var o={uButton:a("eeee").default,uIcon:a("21cf").default},n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",[a("v-uni-view",{staticClass:"hb_page_wrap"},[a("v-uni-image",{staticClass:"portrait",attrs:{src:"/static/logo.png"}}),a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle",ripple:!1,loading:e.Payloading},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getWeChatCode()}}},[a("u-icon",{attrs:{name:"weixin-fill",color:"#fff",size:"42"}}),e._v("微信注册")],1)],1),a("v-uni-view",{staticClass:"new_user",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.returnpages1()}}},[e._v("已有账号,立即登录")]),a("v-uni-view",{staticClass:"other_box"},[a("v-uni-view",{staticClass:"protocol"},[a("v-uni-view",{staticClass:"dianji"},[0==e.check_on?a("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_gray.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.check_icon()}}}):a("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_on.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.check_icon()}}})],1),a("v-uni-view",[e._v("登录代表您已同意《"),a("span",{on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.yhxy.apply(void 0,arguments)}}},[e._v("用户协议")]),e._v("》和《"),a("span",{on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.ysxy.apply(void 0,arguments)}}},[e._v("隐私政策")]),e._v("》")])],1)],1)],1)],1)},i=[]},fc00:function(e,t,a){var o=a("24fb");t=o(!1),t.push([e.i,".hb_page_wrap[data-v-d91086da]{text-align:center;padding:%?120?% %?40?% %?40?% %?40?%}.hb_page_wrap .portrait[data-v-d91086da]{width:%?200?%;height:%?200?%}.hb_page_wrap .portrait2[data-v-d91086da]{width:%?500?%;height:%?200?%;margin-top:%?30?%}.lijipay[data-v-d91086da]{width:100%;margin-top:%?50?%;position:relative}.lijipay .u-icon[data-v-d91086da]{margin-right:%?10?%}.lijipay .u-size-default[data-v-d91086da]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#28c445,#28c445)!important;color:#fff}.new_user[data-v-d91086da]{color:#666;margin:%?20?% 0}.other_box[data-v-d91086da]{margin-top:%?100?%}.other_box .logon_type[data-v-d91086da]{margin-top:%?50?%}.other_box .logon_type .logon_type_item[data-v-d91086da]{text-align:center}.other_box .logon_type .logon_type_item uni-image[data-v-d91086da]{width:%?120?%;height:%?120?%;border-radius:%?200?%}.other_box .logon_type .logon_type_item uni-view[data-v-d91086da]{color:#333}.protocol[data-v-d91086da]{width:100%;margin:%?60?% auto 0;color:#999;padding:0 0 10px 0;margin-bottom:10px;display:flex;align-items:flex-start;font-size:%?24?%;justify-content:center;position:fixed;bottom:2%;left:0;right:0;margin:0 auto}.protocol span[data-v-d91086da]{color:#ff8848}.check_icon[data-v-d91086da]{width:%?34?%;height:%?34?%;position:relative;top:0;margin-right:%?7?%}",""]),e.exports=t}}]);