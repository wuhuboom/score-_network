(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-me-BasicSettings-ChangebindingPhone"],{"7a86":function(e,t,n){var i=n("24fb");t=i(!1),t.push([e.i,".phone_box[data-v-bbecbc5e]{padding:%?30?%}.phone_box .input_item[data-v-bbecbc5e]{border-radius:%?200?%;background-color:#f9f9f9;padding:%?20?% %?40?%;margin:%?30?% 0;position:relative;display:flex;align-items:center}.phone_box .input_item .getCode[data-v-bbecbc5e]{right:0;top:0;color:#0084ff}.lijipay[data-v-bbecbc5e]{width:90%;margin-top:%?100?%;position:fixed;left:0;right:0;margin:0 auto;bottom:2%}.lijipay .u-size-default[data-v-bbecbc5e]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}",""]),e.exports=t},"955b":function(e,t,n){"use strict";var i=n("f4f6"),a=n.n(i);a.a},acca:function(e,t,n){"use strict";n.r(t);var i=n("d525"),a=n.n(i);for(var o in i)["default"].indexOf(o)<0&&function(e){n.d(t,e,(function(){return i[e]}))}(o);t["default"]=a.a},b8e8:function(e,t,n){"use strict";n.r(t);var i=n("c10c"),a=n("acca");for(var o in a)["default"].indexOf(o)<0&&function(e){n.d(t,e,(function(){return a[e]}))}(o);n("955b");var c=n("f0c5"),s=Object(c["a"])(a["default"],i["b"],i["c"],!1,null,"bbecbc5e",null,!1,i["a"],void 0);t["default"]=s.exports},c10c:function(e,t,n){"use strict";n.d(t,"b",(function(){return a})),n.d(t,"c",(function(){return o})),n.d(t,"a",(function(){return i}));var i={uInput:n("807a").default,uButton:n("6226").default,uVerificationCode:n("4c68").default},a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-uni-view",[n("v-uni-view",{staticClass:"phone_box"},[n("v-uni-view",{staticClass:"input_item"},[n("u-input",{attrs:{type:"text",border:!1,placeholder:"新手机号"},model:{value:e.newphone,callback:function(t){e.newphone=t},expression:"newphone"}})],1),n("v-uni-view",{staticClass:"input_item"},[n("u-input",{attrs:{type:"text",border:!1,placeholder:"数字、字母、符号组合不少于6位的新密码"},model:{value:e.pass,callback:function(t){e.pass=t},expression:"pass"}})],1),n("v-uni-view",{staticClass:"input_item"},[n("u-input",{attrs:{type:"text",border:!1,placeholder:"确认新密码"},model:{value:e.pass2,callback:function(t){e.pass2=t},expression:"pass2"}})],1),n("v-uni-view",{staticClass:"input_item"},[n("u-input",{attrs:{type:"text",border:!1,placeholder:"请输入手机验证码"},model:{value:e.code,callback:function(t){e.code=t},expression:"code"}}),n("v-uni-view",{staticClass:"getCode",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getCode.apply(void 0,arguments)}}},[e._v(e._s(e.tips))])],1),n("v-uni-view",{staticClass:"lijipay"},[n("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.lipay()}}},[e._v("确定")])],1)],1),n("u-verification-code",{ref:"uCode",attrs:{seconds:e.seconds},on:{end:function(t){arguments[0]=t=e.$handleEvent(t),e.end.apply(void 0,arguments)},start:function(t){arguments[0]=t=e.$handleEvent(t),e.start.apply(void 0,arguments)},change:function(t){arguments[0]=t=e.$handleEvent(t),e.codeChange.apply(void 0,arguments)}}})],1)},o=[]},d525:function(e,t,n){"use strict";n("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var i={data:function(){return{newphone:"",pass:"",pass2:"",code:"",tips:"",seconds:60}},methods:{lipay:function(){},codeChange:function(e){this.tips=e},getCode:function(){var e=this;this.$refs.uCode.canGetCode?(uni.showLoading({title:"正在获取验证码"}),setTimeout((function(){uni.hideLoading(),e.$u.toast("验证码已发送"),e.$refs.uCode.start()}),2e3)):this.$u.toast("倒计时结束后再发送")},end:function(){},start:function(){}}};t.default=i},f4f6:function(e,t,n){var i=n("7a86");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var a=n("4f06").default;a("d2ccf8e2",i,!0,{sourceMap:!1,shadowMode:!1})}}]);