(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-logon-cipherLogon"],{4705:function(t,n,e){"use strict";(function(t){e("7a82"),Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0,e("e9c4");var i={data:function(){return{Payloading:!1,check_on:!1,pass:"",phone:"",is_open:0}},onShow:function(){this.getwxlogon()},methods:{getwxlogon:function(){var n=this;n.$api.iswxlogon({version:uni.getStorageSync("version")}).then((function(e){t("log",e," at pages/logon/cipherLogon.vue:93"),n.is_open=e.data.result.is_open})).catch((function(t){}))},yhxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/fuxy.html"))})},ysxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/ysxy.html"))})},lipay:function(){var n=this;""==n.phone?uni.showToast({title:"请输入手机号",icon:"none",duration:2e3}):""==n.pass?uni.showToast({title:"请输入密码",icon:"none",duration:2e3}):0==n.check_on?uni.showToast({title:"请勾选协议",icon:"none",duration:2e3}):(n.Payloading=!0,setTimeout((function(){n.Payloading=!1,n.$api.loginpasswordLogin({tel:n.phone,password:n.pass}).then((function(t){uni.setStorageSync("token",t.data.result.token),uni.switchTab({url:"/pages/me/me"})})).catch((function(n){t("log","失败",n.data," at pages/logon/cipherLogon.vue:142"),uni.showToast({title:n.data.msg,icon:"none",duration:2e3})}))}),2e3))},check_icon:function(){1==this.check_on?this.check_on=!1:this.check_on=!0},returnpages:function(t){uni.navigateBack()},ToPages:function(t){uni.navigateTo({url:t})}}};n.default=i}).call(this,e("0de9")["log"])},"56e5":function(t,n,e){var i=e("24fb");n=i(!1),n.push([t.i,".phone_box[data-v-1bb22fc2]{padding:%?30?% 0 0 0}.phone_box .input_item[data-v-1bb22fc2]{border-radius:%?200?%;background-color:#f9f9f9;padding:%?20?% %?40?%;margin:%?30?% 0;position:relative;display:flex;align-items:center}.phone_box .input_item u-input[data-v-1bb22fc2]{flex:1}.phone_box .input_item .getCode[data-v-1bb22fc2]{right:0;top:0;color:#0084ff}.hb_page_wrap[data-v-1bb22fc2]{text-align:center;padding:%?120?% %?40?% %?40?% %?40?%}.hb_page_wrap .portrait[data-v-1bb22fc2]{width:%?200?%;height:%?200?%}.hb_page_wrap .portrait2[data-v-1bb22fc2]{width:%?500?%;height:%?200?%;margin-top:%?30?%}.lijipay[data-v-1bb22fc2]{width:100%;margin-top:%?20?%;position:relative}.lijipay .u-icon[data-v-1bb22fc2]{margin-right:%?10?%}.lijipay .u-size-default[data-v-1bb22fc2]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.new_user[data-v-1bb22fc2]{color:#666;margin:%?20?% 0;display:flex;align-items:center;justify-content:space-between}.new_user uni-text[data-v-1bb22fc2]{flex:1;border-right:1px solid #d9d9d9}.new_user uni-text[data-v-1bb22fc2]:last-child{border:none!important}.other_box[data-v-1bb22fc2]{margin-top:%?100?%}.other_box .logon_type[data-v-1bb22fc2]{margin-top:%?50?%;display:flex;align-items:center;justify-content:center}.other_box .logon_type .logon_type_item[data-v-1bb22fc2]{text-align:center}.other_box .logon_type .logon_type_item .wx_icon[data-v-1bb22fc2]{border-radius:%?200?%;background-color:#f7f7f7;width:%?120?%;height:%?120?%;display:flex;align-items:center;justify-content:center}.other_box .logon_type .logon_type_item uni-image[data-v-1bb22fc2]{width:%?120?%;height:%?120?%;border-radius:%?200?%}.other_box .logon_type .logon_type_item uni-view[data-v-1bb22fc2]{color:#333;margin-top:%?10?%}.protocol[data-v-1bb22fc2]{width:100%;margin:%?60?% auto 0;color:#999;padding:0 0 10px 0;margin-bottom:10px;display:flex;align-items:flex-start;font-size:%?24?%;justify-content:center}.protocol span[data-v-1bb22fc2]{color:#ff8848}.check_icon[data-v-1bb22fc2]{width:%?34?%;height:%?34?%;position:relative;top:0;margin-right:%?7?%}",""]),t.exports=n},5913:function(t,n,e){"use strict";e.d(n,"b",(function(){return o})),e.d(n,"c",(function(){return a})),e.d(n,"a",(function(){return i}));var i={uInput:e("dab7").default,uButton:e("eeee").default,uDivider:e("6f79").default,uIcon:e("21cf").default},o=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",[e("v-uni-view",{staticClass:"hb_page_wrap"},[e("v-uni-image",{staticClass:"portrait",attrs:{src:"/static/logo.png"}}),e("v-uni-view",{staticClass:"phone_box"},[e("v-uni-view",{staticClass:"input_item"},[e("u-input",{attrs:{type:"text",border:!1,placeholder:"请输入手机号"},model:{value:t.phone,callback:function(n){t.phone=n},expression:"phone"}})],1),e("v-uni-view",{staticClass:"input_item"},[e("u-input",{attrs:{type:"password",border:!1,placeholder:"请输入密码"},model:{value:t.pass,callback:function(n){t.pass=n},expression:"pass"}})],1)],1),e("v-uni-view",{staticClass:"lijipay"},[e("u-button",{attrs:{type:"info",shape:"circle",ripple:!1,loading:t.Payloading},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.lipay()}}},[t._v("立即登录")])],1),e("v-uni-view",{staticClass:"new_user"},[e("v-uni-text",{on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.ToPages("/pages/logon/VerificationCode")}}},[t._v("验证码登录")]),e("v-uni-text",{on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.ToPages("/pages/logon/wxregister")}}},[t._v("新用户注册")])],1),e("v-uni-view",{staticClass:"other_box"},[1==t.is_open?e("u-divider",{attrs:{color:"#999999","half-width":"200","border-color":"#D9D9D9"}},[t._v("其他登录方式")]):t._e(),1==t.is_open?e("v-uni-view",{staticClass:"logon_type"},[e("v-uni-view",{staticClass:"logon_type_item",on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.returnpages()}}},[e("v-uni-view",{staticClass:"wx_icon"},[e("u-icon",{attrs:{name:"weixin-fill",color:"#28C445",size:"74"}})],1),e("v-uni-view",[t._v("微信登录")])],1)],1):t._e(),e("v-uni-view",{staticClass:"protocol"},[e("v-uni-view",{staticClass:"dianji"},[0==t.check_on?e("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_gray.png"},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.check_icon()}}}):e("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_on.png"},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.check_icon()}}})],1),e("v-uni-view",[t._v("登录代表您已同意《"),e("span",{on:{click:function(n){n.stopPropagation(),arguments[0]=n=t.$handleEvent(n),t.yhxy.apply(void 0,arguments)}}},[t._v("用户协议")]),t._v("》和《"),e("span",{on:{click:function(n){n.stopPropagation(),arguments[0]=n=t.$handleEvent(n),t.ysxy.apply(void 0,arguments)}}},[t._v("隐私政策")]),t._v("》")])],1)],1)],1)],1)},a=[]},"7d38":function(t,n,e){var i=e("56e5");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=e("4f06").default;o("36a35998",i,!0,{sourceMap:!1,shadowMode:!1})},"80eb":function(t,n,e){"use strict";e.r(n);var i=e("5913"),o=e("fa28");for(var a in o)["default"].indexOf(a)<0&&function(t){e.d(n,t,(function(){return o[t]}))}(a);e("8e17");var c=e("f0c5"),s=Object(c["a"])(o["default"],i["b"],i["c"],!1,null,"1bb22fc2",null,!1,i["a"],void 0);n["default"]=s.exports},"8e17":function(t,n,e){"use strict";var i=e("7d38"),o=e.n(i);o.a},fa28:function(t,n,e){"use strict";e.r(n);var i=e("4705"),o=e.n(i);for(var a in i)["default"].indexOf(a)<0&&function(t){e.d(n,t,(function(){return i[t]}))}(a);n["default"]=o.a}}]);