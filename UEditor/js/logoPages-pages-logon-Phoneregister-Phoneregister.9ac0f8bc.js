(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["logoPages-pages-logon-Phoneregister-Phoneregister"],{2721:function(e,t,i){"use strict";(function(e){i("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,i("e9c4");var n={data:function(){return{imagescode:"",codeimages:"",imgCodeshow:!1,Payloading:!1,check_on:!1,pass1:"",pass2:"",phone:"",code:"",tips:"",seconds:60,is_open:0}},onShow:function(){this.getwxlogon()},methods:{getwxlogon:function(){var t=this;t.$api.iswxlogon({version:uni.getStorageSync("version")}).then((function(i){e("log",i," at logoPages/pages/logon/Phoneregister/Phoneregister.vue:112"),t.is_open=i.data.result.is_open})).catch((function(e){}))},yhxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/fuxy.html"))})},ysxy:function(){uni.navigateTo({url:"/pages/Webview/Webview?url="+encodeURIComponent(JSON.stringify("/static/ysxy.html"))})},codeChange:function(e){this.tips=e},getCode:function(){var e=this;""==e.imagescode?uni.showToast({title:"请输入图形验证码",icon:"none",duration:2e3}):(e.imgCodeshow=!1,e.$refs.uCode.canGetCode?(uni.showLoading({title:"正在获取验证码"}),setTimeout((function(){e.$api.getLoginCode({tel:e.phone,image_code:e.imagescode}).then((function(t){uni.hideLoading(),e.$u.toast("验证码已发送"),e.$refs.uCode.start()}))}),2e3)):e.$u.toast("倒计时结束后再发送"))},getimagesCode:function(){var e=this;""==e.phone?uni.showToast({title:"请输入手机号",icon:"none",duration:2e3}):e.$refs.uCode.canGetCode?(e.imgCodeshow=!0,e.Payloading=!1,e.$api.getimageCode({tel:e.phone,type:"base64"}).then((function(t){e.codeimages=t.data.result.base64}))):e.$u.toast("倒计时结束后再发送")},end:function(){},start:function(){},lipay:function(){var e=this;e.Payloading=!0,setTimeout((function(){e.Payloading=!1}),2e3)},check_icon:function(){1==this.check_on?this.check_on=!1:this.check_on=!0},returnpages:function(){uni.navigateBack({delta:1})},returnpages1:function(){uni.navigateBack({delta:2})},ToPages:function(e){uni.navigateTo({url:e})}}};t.default=n}).call(this,i("0de9")["log"])},3765:function(e,t,i){var n=i("641d");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);var a=i("4f06").default;a("3d14e589",n,!0,{sourceMap:!1,shadowMode:!1})},"48a6":function(e,t,i){"use strict";var n=i("831a"),a=i.n(n);a.a},"49d9":function(e,t,i){var n=i("24fb");t=n(!1),t.push([e.i,".u-code-wrap[data-v-3f7be65c]{width:0;height:0;position:fixed;z-index:-1}",""]),e.exports=t},"4a88":function(e,t,i){"use strict";i.r(t);var n=i("9988"),a=i("db54");for(var o in a)["default"].indexOf(o)<0&&function(e){i.d(t,e,(function(){return a[e]}))}(o);i("48a6");var s=i("f0c5"),c=Object(s["a"])(a["default"],n["b"],n["c"],!1,null,"3f7be65c",null,!1,n["a"],void 0);t["default"]=c.exports},"641d":function(e,t,i){var n=i("24fb");t=n(!1),t.push([e.i,".imgCodeshow_wrap[data-v-677279a4]{padding:%?50?% %?50?% %?40?% %?50?%}.imgCodeshow_box[data-v-677279a4]{display:flex;align-items:center}.imgCodeshow_box .img_input[data-v-677279a4]{flex:1;background-color:#f5f5f5;border-radius:%?18?%;padding:%?10?% %?20?%;margin-right:%?18?%}.imgCodeshow_box .img_code[data-v-677279a4]{flex:1}.imgCodeshow_box .img_code uni-image[data-v-677279a4]{width:100%;height:%?90?%}.imgCodeshow_box .queren_Btn[data-v-677279a4]{margin-top:%?50?%}.phone_box[data-v-677279a4]{padding:0}.phone_box .input_item[data-v-677279a4]{border-radius:%?200?%;background-color:#f9f9f9;padding:%?20?% %?40?%;margin:%?30?% 0;position:relative;display:flex;align-items:center}.phone_box .input_item u-input[data-v-677279a4]{flex:1}.phone_box .input_item .getCode[data-v-677279a4]{right:0;top:0;color:#0084ff}.hb_page_wrap[data-v-677279a4]{text-align:center;padding:%?40?% %?40?% %?40?% %?40?%}.hb_page_wrap .portrait[data-v-677279a4]{width:%?200?%;height:%?200?%}.hb_page_wrap .portrait2[data-v-677279a4]{width:%?500?%;height:%?200?%;margin-top:%?30?%}.lijipay[data-v-677279a4]{width:100%;margin-top:%?20?%;position:relative}.lijipay .u-icon[data-v-677279a4]{margin-right:%?10?%}.lijipay .u-size-default[data-v-677279a4]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.new_user[data-v-677279a4]{color:#666;margin:%?20?% 0;display:flex;align-items:center;justify-content:space-between}.new_user uni-text[data-v-677279a4]{flex:1;border-right:1px solid #d9d9d9}.new_user uni-text[data-v-677279a4]:last-child{border:none!important}.other_box[data-v-677279a4]{margin-top:%?100?%}.other_box .logon_type[data-v-677279a4]{margin-top:%?50?%;display:flex;align-items:center;justify-content:center}.other_box .logon_type .logon_type_item[data-v-677279a4]{text-align:center}.other_box .logon_type .logon_type_item .wx_icon[data-v-677279a4]{border-radius:%?200?%;background-color:#f7f7f7;width:%?120?%;height:%?120?%;display:flex;align-items:center;justify-content:center}.other_box .logon_type .logon_type_item uni-image[data-v-677279a4]{width:%?120?%;height:%?120?%;border-radius:%?200?%}.other_box .logon_type .logon_type_item uni-view[data-v-677279a4]{color:#333;margin-top:%?10?%}.protocol[data-v-677279a4]{width:100%;margin:%?60?% auto 0;color:#999;padding:0 0 10px 0;margin-bottom:10px;display:flex;align-items:flex-start;font-size:%?24?%;justify-content:center}.protocol span[data-v-677279a4]{color:#ff8848}.check_icon[data-v-677279a4]{width:%?34?%;height:%?34?%;position:relative;top:0;margin-right:%?7?%}",""]),e.exports=t},"7e28":function(e,t,i){"use strict";i.r(t);var n=i("c7d3"),a=i("d179");for(var o in a)["default"].indexOf(o)<0&&function(e){i.d(t,e,(function(){return a[e]}))}(o);i("bf68");var s=i("f0c5"),c=Object(s["a"])(a["default"],n["b"],n["c"],!1,null,"677279a4",null,!1,n["a"],void 0);t["default"]=c.exports},"831a":function(e,t,i){var n=i("49d9");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);var a=i("4f06").default;a("7046eaee",n,!0,{sourceMap:!1,shadowMode:!1})},9988:function(e,t,i){"use strict";i.d(t,"b",(function(){return n})),i.d(t,"c",(function(){return a})),i.d(t,"a",(function(){}));var n=function(){var e=this.$createElement,t=this._self._c||e;return t("v-uni-view",{staticClass:"u-code-wrap"})},a=[]},bf68:function(e,t,i){"use strict";var n=i("3765"),a=i.n(n);a.a},c76d:function(e,t,i){"use strict";i("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,i("a9e3"),i("ac1f"),i("5319");var n={name:"u-verification-code",props:{seconds:{type:[String,Number],default:60},startText:{type:String,default:"获取验证码"},changeText:{type:String,default:"X秒重新获取"},endText:{type:String,default:"重新获取"},keepRunning:{type:Boolean,default:!1},uniqueKey:{type:String,default:""}},data:function(){return{secNum:this.seconds,timer:null,canGetCode:!0}},mounted:function(){this.checkKeepRunning()},watch:{seconds:{immediate:!0,handler:function(e){this.secNum=e}}},methods:{checkKeepRunning:function(){var e=Number(uni.getStorageSync(this.uniqueKey+"_$uCountDownTimestamp"));if(!e)return this.changeEvent(this.startText);var t=Math.floor(+new Date/1e3);this.keepRunning&&e&&e>t?(this.secNum=e-t,uni.removeStorageSync(this.uniqueKey+"_$uCountDownTimestamp"),this.start()):this.changeEvent(this.startText)},start:function(){var e=this;this.timer&&(clearInterval(this.timer),this.timer=null),this.$emit("start"),this.canGetCode=!1,this.changeEvent(this.changeText.replace(/x|X/,this.secNum)),this.setTimeToStorage(),this.timer=setInterval((function(){--e.secNum?e.changeEvent(e.changeText.replace(/x|X/,e.secNum)):(clearInterval(e.timer),e.timer=null,e.changeEvent(e.endText),e.secNum=e.seconds,e.$emit("end"),e.canGetCode=!0)}),1e3)},reset:function(){this.canGetCode=!0,clearInterval(this.timer),this.secNum=this.seconds,this.changeEvent(this.endText)},changeEvent:function(e){this.$emit("change",e)},setTimeToStorage:function(){if(this.keepRunning&&this.timer&&this.secNum>0&&this.secNum<=this.seconds){var e=Math.floor(+new Date/1e3);uni.setStorage({key:this.uniqueKey+"_$uCountDownTimestamp",data:e+Number(this.secNum)})}}},beforeDestroy:function(){this.setTimeToStorage(),clearTimeout(this.timer),this.timer=null}};t.default=n},c7d3:function(e,t,i){"use strict";i.d(t,"b",(function(){return a})),i.d(t,"c",(function(){return o})),i.d(t,"a",(function(){return n}));var n={uInput:i("dab7").default,uButton:i("eeee").default,uDivider:i("6f79").default,uIcon:i("21cf").default,uVerificationCode:i("4a88").default,uPopup:i("627b").default},a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("v-uni-view",[i("v-uni-view",{staticClass:"hb_page_wrap"},[i("v-uni-view",{staticClass:"phone_box"},[i("v-uni-view",{staticClass:"input_item"},[i("u-input",{attrs:{type:"text",border:!1,placeholder:"请输入手机号"},model:{value:e.phone,callback:function(t){e.phone=t},expression:"phone"}})],1),i("v-uni-view",{staticClass:"input_item"},[i("u-input",{attrs:{type:"text",border:!1,placeholder:"数字、字母、符号组合不少于6位的新密码"},model:{value:e.pass1,callback:function(t){e.pass1=t},expression:"pass1"}})],1),i("v-uni-view",{staticClass:"input_item"},[i("u-input",{attrs:{type:"text",border:!1,placeholder:"确认密码"},model:{value:e.pass2,callback:function(t){e.pass2=t},expression:"pass2"}})],1),i("v-uni-view",{staticClass:"input_item"},[i("u-input",{attrs:{type:"text",border:!1,placeholder:"请输入手机验证码"},model:{value:e.code,callback:function(t){e.code=t},expression:"code"}}),i("v-uni-view",{staticClass:"getCode",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getimagesCode.apply(void 0,arguments)}}},[e._v(e._s(e.tips))])],1)],1),i("v-uni-view",{staticClass:"lijipay"},[i("u-button",{attrs:{type:"info",shape:"circle",ripple:!1,loading:e.Payloading},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.lipay()}}},[e._v("立即注册")])],1),i("v-uni-view",{staticClass:"new_user"},[i("v-uni-text",{on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.returnpages1()}}},[e._v("已有账号,立即登录")])],1),i("v-uni-view",{staticClass:"other_box"},[1==e.is_open?i("u-divider",{attrs:{color:"#999999","half-width":"200","border-color":"#D9D9D9"}},[e._v("其他登录方式")]):e._e(),1==e.is_open?i("v-uni-view",{staticClass:"logon_type"},[i("v-uni-view",{staticClass:"logon_type_item",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.returnpages()}}},[i("v-uni-view",{staticClass:"wx_icon"},[i("u-icon",{attrs:{name:"weixin-fill",color:"#28C445",size:"74"}})],1),i("v-uni-view",[e._v("微信注册")])],1)],1):e._e(),i("v-uni-view",{staticClass:"protocol"},[i("v-uni-view",{staticClass:"dianji"},[0==e.check_on?i("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_gray.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.check_icon()}}}):i("v-uni-image",{staticClass:"check_icon",attrs:{src:"/static/images/icon_check_on.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.check_icon()}}})],1),i("v-uni-view",[e._v("登录代表您已同意《"),i("span",{on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.yhxy.apply(void 0,arguments)}}},[e._v("用户协议")]),e._v("》和《"),i("span",{on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.ysxy.apply(void 0,arguments)}}},[e._v("隐私政策")]),e._v("》")])],1)],1)],1),i("u-verification-code",{ref:"uCode",attrs:{seconds:e.seconds},on:{end:function(t){arguments[0]=t=e.$handleEvent(t),e.end.apply(void 0,arguments)},start:function(t){arguments[0]=t=e.$handleEvent(t),e.start.apply(void 0,arguments)},change:function(t){arguments[0]=t=e.$handleEvent(t),e.codeChange.apply(void 0,arguments)}}}),i("u-popup",{attrs:{mode:"center",width:"560","border-radius":"20"},model:{value:e.imgCodeshow,callback:function(t){e.imgCodeshow=t},expression:"imgCodeshow"}},[i("v-uni-view",{staticClass:"imgCodeshow_wrap"},[i("v-uni-view",{staticClass:"imgCodeshow_box"},[i("v-uni-view",{staticClass:"img_input"},[i("u-input",{attrs:{type:"text",clearable:!1,border:!1,placeholder:"验证码"},model:{value:e.imagescode,callback:function(t){e.imagescode=t},expression:"imagescode"}})],1),i("v-uni-view",{staticClass:"img_code"},[i("v-uni-image",{attrs:{src:e.codeimages},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getimagesCode()}}})],1)],1),i("v-uni-view",{staticClass:"queren_Btn"},[i("v-uni-view",{staticClass:"lijipay"},[i("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getCode.apply(void 0,arguments)}}},[e._v("确认")])],1)],1)],1)],1)],1)},o=[]},d179:function(e,t,i){"use strict";i.r(t);var n=i("2721"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(e){i.d(t,e,(function(){return n[e]}))}(o);t["default"]=a.a},db54:function(e,t,i){"use strict";i.r(t);var n=i("c76d"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(e){i.d(t,e,(function(){return n[e]}))}(o);t["default"]=a.a}}]);