(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["logoPages-pages-logon-cipherLogon"],{"2d3b":function(t,e,n){"use strict";n.r(e);var i=n("98e6"),o=n.n(i);for(var a in i)["default"].indexOf(a)<0&&function(t){n.d(e,t,(function(){return i[t]}))}(a);e["default"]=o.a},"5b0f":function(t,e,n){"use strict";var i=n("7f4b"),o=n.n(i);o.a},"7a23":function(t,e,n){var i=n("24fb");e=i(!1),e.push([t.i,".phone_box[data-v-35e255b8]{padding:%?30?% 0 0 0}.phone_box .input_item[data-v-35e255b8]{border-radius:%?200?%;background-color:#f9f9f9;padding:%?20?% %?40?%;margin:%?30?% 0;position:relative;display:flex;align-items:center}.phone_box .input_item u-input[data-v-35e255b8]{flex:1}.phone_box .input_item .getCode[data-v-35e255b8]{right:0;top:0;color:#0084ff}.hb_page_wrap[data-v-35e255b8]{text-align:center;padding:%?120?% %?40?% %?40?% %?40?%}.hb_page_wrap .portrait[data-v-35e255b8]{width:%?200?%;height:%?200?%}.hb_page_wrap .portrait2[data-v-35e255b8]{width:%?500?%;height:%?200?%;margin-top:%?30?%}.lijipay[data-v-35e255b8]{width:100%;margin-top:%?20?%;position:relative}.lijipay .u-icon[data-v-35e255b8]{margin-right:%?10?%}.lijipay .u-size-default[data-v-35e255b8]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.new_user[data-v-35e255b8]{color:#666;margin:%?20?% 0;display:flex;align-items:center;justify-content:space-between}.new_user uni-text[data-v-35e255b8]{flex:1;border-right:1px solid #d9d9d9}.new_user uni-text[data-v-35e255b8]:last-child{border:none!important}.other_box[data-v-35e255b8]{margin-top:%?100?%}.other_box .logon_type[data-v-35e255b8]{margin-top:%?50?%;display:flex;align-items:center;justify-content:center}.other_box .logon_type .logon_type_item[data-v-35e255b8]{text-align:center}.other_box .logon_type .logon_type_item .wx_icon[data-v-35e255b8]{border-radius:%?200?%;background-color:#f7f7f7;width:%?120?%;height:%?120?%;display:flex;align-items:center;justify-content:center}.other_box .logon_type .logon_type_item uni-image[data-v-35e255b8]{width:%?120?%;height:%?120?%;border-radius:%?200?%}.other_box .logon_type .logon_type_item uni-view[data-v-35e255b8]{color:#333;margin-top:%?10?%}.protocol[data-v-35e255b8]{width:100%;margin:%?60?% auto 0;color:#999;padding:0 0 10px 0;margin-bottom:10px;display:flex;align-items:flex-start;font-size:%?24?%;justify-content:center}.protocol span[data-v-35e255b8]{color:#ff8848}.check_icon[data-v-35e255b8]{width:%?34?%;height:%?34?%;position:relative;top:0;margin-right:%?7?%}",""]),t.exports=e},"7f4b":function(t,e,n){var i=n("7a23");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=n("4f06").default;o("c645d858",i,!0,{sourceMap:!1,shadowMode:!1})},"98e6":function(t,e,n){"use strict";(function(t){n("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,n("e9c4");var i={data:function(){return{Payloading:!1,check_on:!1,pass:"",phone:"",is_open:0}},onShow:function(){this.getwxlogon()},methods:{getwxlogon:function(){var e=this;e.$api.iswxlogon({version:uni.getStorageSync("version")}).then((function(n){t("log",n," at logoPages/pages/logon/cipherLogon.vue:94"),e.is_open=n.data.result.is_open})).catch((function(t){}))},yhxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/fuxy.html"))})},ysxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/ysxy.html"))})},lipay:function(){var e=this;""==e.phone?uni.showToast({title:"请输入手机号",icon:"none",duration:2e3}):""==e.pass?uni.showToast({title:"请输入密码",icon:"none",duration:2e3}):0==e.check_on?uni.showToast({title:"请勾选协议",icon:"none",duration:2e3}):(e.Payloading=!0,setTimeout((function(){e.Payloading=!1,e.$api.loginpasswordLogin({tel:e.phone,password:e.pass}).then((function(t){uni.setStorageSync("token",t.data.result.token),uni.switchTab({url:"/pages/me/me"})})).catch((function(e){t("log","失败",e.data," at logoPages/pages/logon/cipherLogon.vue:143"),uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))}),2e3))},check_icon:function(){1==this.check_on?this.check_on=!1:this.check_on=!0},returnpages:function(t){uni.navigateBack()},ToPages:function(t){uni.navigateTo({url:t})}}};e.default=i}).call(this,n("0de9")["log"])},ca9e:function(t,e,n){"use strict";n.r(e);var i=n("da77"),o=n("2d3b");for(var a in o)["default"].indexOf(a)<0&&function(t){n.d(e,t,(function(){return o[t]}))}(a);n("5b0f");var s=n("f0c5"),c=Object(s["a"])(o["default"],i["b"],i["c"],!1,null,"35e255b8",null,!1,i["a"],void 0);e["default"]=c.exports},da77:function(t,e,n){"use strict";n.d(e,"b",(function(){return o})),n.d(e,"c",(function(){return a})),n.d(e,"a",(function(){return i}));var i={uInput:n("dab7").default,uButton:n("eeee").default,uDivider:n("6f79").default,uIcon:n("21cf").default},o=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("v-uni-view",{staticClass:"hb_page_wrap"},[n("v-uni-image",{staticClass:"portrait",attrs:{src:"/static/logo-2.png"}}),n("v-uni-view",{staticClass:"phone_box"},[n("v-uni-view",{staticClass:"input_item"},[n("u-input",{attrs:{type:"text",border:!1,placeholder:"请输入手机号"},model:{value:t.phone,callback:function(e){t.phone=e},expression:"phone"}})],1),n("v-uni-view",{staticClass:"input_item"},[n("u-input",{attrs:{type:"password",border:!1,placeholder:"请输入密码"},model:{value:t.pass,callback:function(e){t.pass=e},expression:"pass"}})],1)],1),n("v-uni-view",{staticClass:"lijipay"},[n("u-button",{attrs:{type:"info",shape:"circle",ripple:!1,loading:t.Payloading},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.lipay()}}},[t._v("立即登录")])],1),n("v-uni-view",{staticClass:"new_user"},[n("v-uni-text",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.ToPages("/logoPages/pages/logon/VerificationCode")}}},[t._v("验证码登录")]),n("v-uni-text",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.ToPages("/logoPages/pages/logon/wxregister")}}},[t._v("新用户注册")])],1),n("v-uni-view",{staticClass:"other_box"},[1==t.is_open?n("u-divider",{attrs:{color:"#999999","half-width":"200","border-color":"#D9D9D9"}},[t._v("其他登录方式")]):t._e(),1==t.is_open?n("v-uni-view",{staticClass:"logon_type"},[n("v-uni-view",{staticClass:"logon_type_item",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.returnpages()}}},[n("v-uni-view",{staticClass:"wx_icon"},[n("u-icon",{attrs:{name:"weixin-fill",color:"#28C445",size:"74"}})],1),n("v-uni-view",[t._v("微信登录")])],1)],1):t._e(),n("v-uni-view",{staticClass:"protocol"},[n("v-uni-view",{staticClass:"dianji"},[0==t.check_on?n("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_gray.png"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.check_icon()}}}):n("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_on.png"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.check_icon()}}})],1),n("v-uni-view",[t._v("登录代表您已同意《"),n("span",{on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.yhxy.apply(void 0,arguments)}}},[t._v("用户协议")]),t._v("》和《"),n("span",{on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.ysxy.apply(void 0,arguments)}}},[t._v("隐私政策")]),t._v("》")])],1)],1)],1)],1)},a=[]}}]);