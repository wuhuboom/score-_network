(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-me-Bindphone"],{"0361":function(e,t,a){"use strict";var n=a("0dab"),i=a.n(n);i.a},"0dab":function(e,t,a){var n=a("a9f0");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);var i=a("4f06").default;i("9bea869c",n,!0,{sourceMap:!1,shadowMode:!1})},"1e7d":function(e,t,a){"use strict";a.d(t,"b",(function(){return i})),a.d(t,"c",(function(){return o})),a.d(t,"a",(function(){return n}));var n={uInput:a("dab7").default,uButton:a("eeee").default,uVerificationCode:a("4a88").default,uPopup:a("627b").default},i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",[a("v-uni-view",{staticClass:"phone_box"},[a("v-uni-view",{staticClass:"input_item"},[a("u-input",{attrs:{type:"text",border:!1,placeholder:"新手机号"},model:{value:e.newphone,callback:function(t){e.newphone=t},expression:"newphone"}})],1),a("v-uni-view",{staticClass:"input_item"},[a("u-input",{attrs:{type:"text",border:!1,placeholder:"请输入手机验证码"},model:{value:e.code,callback:function(t){e.code=t},expression:"code"}}),a("v-uni-view",{staticClass:"getCode",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getimagesCode.apply(void 0,arguments)}}},[e._v(e._s(e.tips))])],1),a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.lipay()}}},[e._v("确定")])],1)],1),a("u-verification-code",{ref:"uCode",attrs:{seconds:e.seconds},on:{end:function(t){arguments[0]=t=e.$handleEvent(t),e.end.apply(void 0,arguments)},start:function(t){arguments[0]=t=e.$handleEvent(t),e.start.apply(void 0,arguments)},change:function(t){arguments[0]=t=e.$handleEvent(t),e.codeChange.apply(void 0,arguments)}}}),a("u-popup",{attrs:{mode:"center",width:"560","border-radius":"20"},model:{value:e.imgCodeshow,callback:function(t){e.imgCodeshow=t},expression:"imgCodeshow"}},[a("v-uni-view",{staticClass:"imgCodeshow_wrap"},[a("v-uni-view",{staticClass:"imgCodeshow_box"},[a("v-uni-view",{staticClass:"img_input"},[a("u-input",{attrs:{type:"text",clearable:!1,border:!1,placeholder:"验证码"},model:{value:e.imagescode,callback:function(t){e.imagescode=t},expression:"imagescode"}})],1),a("v-uni-view",{staticClass:"img_code"},[a("v-uni-image",{attrs:{src:e.codeimages},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getimagesCode()}}})],1)],1),a("v-uni-view",{staticClass:"queren_Btn"},[a("v-uni-view",{staticClass:"lijipay2"},[a("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.getCode.apply(void 0,arguments)}}},[e._v("确认")])],1)],1)],1)],1),a("u-popup",{attrs:{mode:"center",width:"550","border-radius":"44"},model:{value:e.bdingPhone_Show,callback:function(t){e.bdingPhone_Show=t},expression:"bdingPhone_Show"}},[a("v-uni-view",{staticClass:"tc_wrap"},[a("v-uni-view",{staticClass:"tc_images"},[a("v-uni-image",{attrs:{src:e.BestImgUrl+"lhy_success.png"}})],1),a("v-uni-view",{staticClass:"tc_info"},[a("v-uni-view",[e._v("绑定成功，立即领取")]),a("v-uni-view",[e._v("「一个月VIP会员」")])],1),a("v-uni-view",{staticClass:"tc_btn_box"},[a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.TobingdingPhone()}}},[e._v("领取")])],1)],1)],1)],1)],1)},o=[]},2371:function(e,t,a){"use strict";a.r(t);var n=a("8d1f"),i=a.n(n);for(var o in n)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(o);t["default"]=i.a},"372a":function(e,t,a){var n=a("a775");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);var i=a("4f06").default;i("662274fd",n,!0,{sourceMap:!1,shadowMode:!1})},"48a6":function(e,t,a){"use strict";var n=a("831a"),i=a.n(n);i.a},"49d9":function(e,t,a){var n=a("24fb");t=n(!1),t.push([e.i,".u-code-wrap[data-v-3f7be65c]{width:0;height:0;position:fixed;z-index:-1}",""]),e.exports=t},"4a88":function(e,t,a){"use strict";a.r(t);var n=a("9988"),i=a("db54");for(var o in i)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(o);a("48a6");var r=a("f0c5"),u=Object(r["a"])(i["default"],n["b"],n["c"],!1,null,"3f7be65c",null,!1,n["a"],void 0);t["default"]=u.exports},"63ad":function(e,t,a){"use strict";a.r(t);var n=a("1e7d"),i=a("a632");for(var o in i)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(o);a("adea");var r=a("f0c5"),u=Object(r["a"])(i["default"],n["b"],n["c"],!1,null,"3bb4a6d0",null,!1,n["a"],void 0);t["default"]=u.exports},"69a4":function(e,t,a){"use strict";a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return i})),a.d(t,"a",(function(){}));var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-button",{staticClass:"u-btn u-line-1 u-fix-ios-appearance",class:["u-size-"+e.size,e.plain?"u-btn--"+e.type+"--plain":"",e.loading?"u-loading":"","circle"==e.shape?"u-round-circle":"",e.hairLine?e.showHairLineBorder:"u-btn--bold-border","u-btn--"+e.type,e.disabled?"u-btn--"+e.type+"--disabled":""],style:[e.customStyle,{overflow:e.ripple?"hidden":"visible"}],attrs:{id:"u-wave-btn","hover-start-time":Number(e.hoverStartTime),"hover-stay-time":Number(e.hoverStayTime),disabled:e.disabled,"form-type":e.formType,"open-type":e.openType,"app-parameter":e.appParameter,"hover-stop-propagation":e.hoverStopPropagation,"send-message-title":e.sendMessageTitle,"send-message-path":"sendMessagePath",lang:e.lang,"data-name":e.dataName,"session-from":e.sessionFrom,"send-message-img":e.sendMessageImg,"show-message-card":e.showMessageCard,"hover-class":e.getHoverClass,loading:e.loading},on:{getphonenumber:function(t){arguments[0]=t=e.$handleEvent(t),e.getphonenumber.apply(void 0,arguments)},getuserinfo:function(t){arguments[0]=t=e.$handleEvent(t),e.getuserinfo.apply(void 0,arguments)},error:function(t){arguments[0]=t=e.$handleEvent(t),e.error.apply(void 0,arguments)},opensetting:function(t){arguments[0]=t=e.$handleEvent(t),e.opensetting.apply(void 0,arguments)},launchapp:function(t){arguments[0]=t=e.$handleEvent(t),e.launchapp.apply(void 0,arguments)},click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.click(t)}}},[e._t("default"),e.ripple?a("v-uni-view",{staticClass:"u-wave-ripple",class:[e.waveActive?"u-wave-active":""],style:{top:e.rippleTop+"px",left:e.rippleLeft+"px",width:e.fields.targetWidth+"px",height:e.fields.targetWidth+"px","background-color":e.rippleBgColor||"rgba(0, 0, 0, 0.15)"}}):e._e()],2)},i=[]},"831a":function(e,t,a){var n=a("49d9");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);var i=a("4f06").default;i("7046eaee",n,!0,{sourceMap:!1,shadowMode:!1})},"8d1f":function(e,t,a){"use strict";a("7a82");var n=a("4ea4").default;Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("498a");var i=n(a("ea90")),o={name:"u-input",mixins:[i.default],props:{value:{type:[String,Number],default:""},type:{type:String,default:"text"},inputAlign:{type:String,default:"left"},placeholder:{type:String,default:"请输入内容"},disabled:{type:Boolean,default:!1},maxlength:{type:[Number,String],default:140},placeholderStyle:{type:String,default:"color: #c0c4cc;"},confirmType:{type:String,default:"done"},customStyle:{type:Object,default:function(){return{}}},fixed:{type:Boolean,default:!1},focus:{type:Boolean,default:!1},passwordIcon:{type:Boolean,default:!0},border:{type:Boolean,default:!1},borderColor:{type:String,default:"#dcdfe6"},autoHeight:{type:Boolean,default:!0},selectOpen:{type:Boolean,default:!1},height:{type:[Number,String],default:""},clearable:{type:Boolean,default:!0},cursorSpacing:{type:[Number,String],default:0},selectionStart:{type:[Number,String],default:-1},selectionEnd:{type:[Number,String],default:-1},trim:{type:Boolean,default:!0},showConfirmbar:{type:Boolean,default:!0},adjustPosition:{type:Boolean,default:!0}},data:function(){return{defaultValue:this.value,inputHeight:70,textareaHeight:100,validateState:!1,focused:!1,showPassword:!1,lastValue:""}},watch:{value:function(e,t){this.defaultValue=e,e!=t&&"select"==this.type&&this.handleInput({detail:{value:e}})}},computed:{inputMaxlength:function(){return Number(this.maxlength)},getStyle:function(){var e={};return e.minHeight=this.height?this.height+"rpx":"textarea"==this.type?this.textareaHeight+"rpx":this.inputHeight+"rpx",e=Object.assign(e,this.customStyle),e},getCursorSpacing:function(){return Number(this.cursorSpacing)},uSelectionStart:function(){return String(this.selectionStart)},uSelectionEnd:function(){return String(this.selectionEnd)}},created:function(){this.$on("on-form-item-error",this.onFormItemError)},methods:{handleInput:function(e){var t=this,a=e.detail.value;this.trim&&(a=this.$u.trim(a)),this.$emit("input",a),this.defaultValue=a,setTimeout((function(){t.dispatch("u-form-item","on-form-change",a)}),40)},handleBlur:function(e){var t=this,a=e.detail.value;setTimeout((function(){t.focused=!1}),100),this.$emit("blur",a),setTimeout((function(){t.dispatch("u-form-item","on-form-blur",a)}),40)},onFormItemError:function(e){this.validateState=e},onFocus:function(e){this.focused=!0,this.$emit("focus")},onConfirm:function(e){this.$emit("confirm",e.detail.value)},onClear:function(e){this.$emit("input","")},inputClick:function(){this.$emit("click")}}};t.default=o},"96d7":function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("c975"),a("d3b7"),a("ac1f");var n={name:"u-button",props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:function(){return{}}},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:1e3},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150}},computed:{getHoverClass:function(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";var e;return e=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",e},showHairLineBorder:function(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data:function(){return{rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click:function(e){var t=this;this.$u.throttle((function(){!0!==t.loading&&!0!==t.disabled&&(t.ripple&&(t.waveActive=!1,t.$nextTick((function(){this.getWaveQuery(e)}))),t.$emit("click",e))}),this.throttleTime)},getWaveQuery:function(e){var t=this;this.getElQuery().then((function(a){var n=a[0];if(n.width&&n.width&&(n.targetWidth=n.height>n.width?n.height:n.width,n.targetWidth)){t.fields=n;var i,o;i=e.touches[0].clientX,o=e.touches[0].clientY,t.rippleTop=o-n.top-n.targetWidth/2,t.rippleLeft=i-n.left-n.targetWidth/2,t.$nextTick((function(){t.waveActive=!0}))}}))},getElQuery:function(){var e=this;return new Promise((function(t){var a="";a=uni.createSelectorQuery().in(e),a.select(".u-btn").boundingClientRect(),a.exec((function(e){t(e)}))}))},getphonenumber:function(e){this.$emit("getphonenumber",e)},getuserinfo:function(e){this.$emit("getuserinfo",e)},error:function(e){this.$emit("error",e)},opensetting:function(e){this.$emit("opensetting",e)},launchapp:function(e){this.$emit("launchapp",e)}}};t.default=n},9988:function(e,t,a){"use strict";a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return i})),a.d(t,"a",(function(){}));var n=function(){var e=this.$createElement,t=this._self._c||e;return t("v-uni-view",{staticClass:"u-code-wrap"})},i=[]},a4bf:function(e,t,a){"use strict";a.r(t);var n=a("96d7"),i=a.n(n);for(var o in n)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(o);t["default"]=i.a},a632:function(e,t,a){"use strict";a.r(t);var n=a("fec1"),i=a.n(n);for(var o in n)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(o);t["default"]=i.a},a775:function(e,t,a){var n=a("24fb");t=n(!1),t.push([e.i,".u-input[data-v-3aa0e5ac]{position:relative;flex:1;display:flex;flex-direction:row}.u-input__input[data-v-3aa0e5ac]{font-size:%?28?%;color:#303133;flex:1}.u-input__textarea[data-v-3aa0e5ac]{width:auto;font-size:%?28?%;color:#303133;padding:%?10?% 0;line-height:normal;flex:1}.u-input--border[data-v-3aa0e5ac]{border-radius:%?6?%;border-radius:4px;border:1px solid #dcdfe6}.u-input--error[data-v-3aa0e5ac]{border-color:#fa3534!important}.u-input__right-icon__item[data-v-3aa0e5ac]{margin-left:%?10?%}.u-input__right-icon--select[data-v-3aa0e5ac]{transition:-webkit-transform .4s;transition:transform .4s;transition:transform .4s,-webkit-transform .4s}.u-input__right-icon--select--reverse[data-v-3aa0e5ac]{-webkit-transform:rotate(-180deg);transform:rotate(-180deg)}",""]),e.exports=t},a8f6:function(e,t,a){"use strict";a.d(t,"b",(function(){return i})),a.d(t,"c",(function(){return o})),a.d(t,"a",(function(){return n}));var n={uIcon:a("21cf").default},i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",{staticClass:"u-input",class:{"u-input--border":e.border,"u-input--error":e.validateState},style:{padding:"0 "+(e.border?20:0)+"rpx",borderColor:e.borderColor,textAlign:e.inputAlign},on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.inputClick.apply(void 0,arguments)}}},["textarea"==e.type?a("v-uni-textarea",{staticClass:"u-input__input u-input__textarea",style:[e.getStyle],attrs:{value:e.defaultValue,placeholder:e.placeholder,placeholderStyle:e.placeholderStyle,disabled:e.disabled,maxlength:e.inputMaxlength,fixed:e.fixed,focus:e.focus,autoHeight:e.autoHeight,"selection-end":e.uSelectionEnd,"selection-start":e.uSelectionStart,"cursor-spacing":e.getCursorSpacing,"show-confirm-bar":e.showConfirmbar},on:{input:function(t){arguments[0]=t=e.$handleEvent(t),e.handleInput.apply(void 0,arguments)},blur:function(t){arguments[0]=t=e.$handleEvent(t),e.handleBlur.apply(void 0,arguments)},focus:function(t){arguments[0]=t=e.$handleEvent(t),e.onFocus.apply(void 0,arguments)},confirm:function(t){arguments[0]=t=e.$handleEvent(t),e.onConfirm.apply(void 0,arguments)}}}):a("v-uni-input",{staticClass:"u-input__input",style:[e.getStyle],attrs:{type:"password"==e.type?"text":e.type,value:e.defaultValue,password:"password"==e.type&&!e.showPassword,placeholder:e.placeholder,placeholderStyle:e.placeholderStyle,disabled:e.disabled||"select"===e.type,maxlength:e.inputMaxlength,focus:e.focus,confirmType:e.confirmType,"cursor-spacing":e.getCursorSpacing,"selection-end":e.uSelectionEnd,"selection-start":e.uSelectionStart,"show-confirm-bar":e.showConfirmbar,"adjust-position":e.adjustPosition},on:{focus:function(t){arguments[0]=t=e.$handleEvent(t),e.onFocus.apply(void 0,arguments)},blur:function(t){arguments[0]=t=e.$handleEvent(t),e.handleBlur.apply(void 0,arguments)},input:function(t){arguments[0]=t=e.$handleEvent(t),e.handleInput.apply(void 0,arguments)},confirm:function(t){arguments[0]=t=e.$handleEvent(t),e.onConfirm.apply(void 0,arguments)}}}),a("v-uni-view",{staticClass:"u-input__right-icon u-flex"},[e.clearable&&""!=e.value&&e.focused?a("v-uni-view",{staticClass:"u-input__right-icon__clear u-input__right-icon__item",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.onClear.apply(void 0,arguments)}}},[a("u-icon",{attrs:{size:"32",name:"close-circle-fill",color:"#c0c4cc"}})],1):e._e(),e.passwordIcon&&"password"==e.type?a("v-uni-view",{staticClass:"u-input__right-icon__clear u-input__right-icon__item"},[a("u-icon",{attrs:{size:"32",name:e.showPassword?"eye-fill":"eye",color:"#c0c4cc"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.showPassword=!e.showPassword}}})],1):e._e(),"select"==e.type?a("v-uni-view",{staticClass:"u-input__right-icon--select u-input__right-icon__item",class:{"u-input__right-icon--select--reverse":e.selectOpen}},[a("u-icon",{attrs:{name:"arrow-down-fill",size:"26",color:"#c0c4cc"}})],1):e._e()],1)],1)},o=[]},a9f0:function(e,t,a){var n=a("24fb");t=n(!1),t.push([e.i,'.u-btn[data-v-52fefc8e]::after{border:none}.u-btn[data-v-52fefc8e]{position:relative;border:0;display:inline-flex;overflow:visible;line-height:1;display:flex;flex-direction:row;align-items:center;justify-content:center;cursor:pointer;padding:0 %?40?%;z-index:1;box-sizing:border-box;transition:all .15s}.u-btn--bold-border[data-v-52fefc8e]{border:1px solid #fff}.u-btn--default[data-v-52fefc8e]{color:#606266;border-color:#c0c4cc;background-color:#fff}.u-btn--primary[data-v-52fefc8e]{color:#fff;border-color:#fe6736;background-color:#fe6736}.u-btn--success[data-v-52fefc8e]{color:#fff;border-color:#19be6b;background-color:#19be6b}.u-btn--error[data-v-52fefc8e]{color:#fff;border-color:#fa3534;background-color:#fa3534}.u-btn--warning[data-v-52fefc8e]{color:#fff;border-color:#f90;background-color:#f90}.u-btn--default--disabled[data-v-52fefc8e]{color:#fff;border-color:#e4e7ed;background-color:#fff}.u-btn--primary--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#71d5a1!important;background-color:#71d5a1!important}.u-btn--error--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fab6b6!important;background-color:#fab6b6!important}.u-btn--warning--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fcbd71!important;background-color:#fcbd71!important}.u-btn--primary--plain[data-v-52fefc8e]{color:#fe6736!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--plain[data-v-52fefc8e]{color:#19be6b!important;border-color:#71d5a1!important;background-color:#dbf1e1!important}.u-btn--error--plain[data-v-52fefc8e]{color:#fa3534!important;border-color:#fab6b6!important;background-color:#fef0f0!important}.u-btn--warning--plain[data-v-52fefc8e]{color:#f90!important;border-color:#fcbd71!important;background-color:#fdf6ec!important}.u-hairline-border[data-v-52fefc8e]:after{content:" ";position:absolute;pointer-events:none;box-sizing:border-box;-webkit-transform-origin:0 0;transform-origin:0 0;left:0;top:0;width:199.8%;height:199.7%;-webkit-transform:scale(.5);transform:scale(.5);border:1px solid currentColor;z-index:1}.u-wave-ripple[data-v-52fefc8e]{z-index:0;position:absolute;border-radius:100%;background-clip:padding-box;pointer-events:none;-webkit-user-select:none;user-select:none;-webkit-transform:scale(0);transform:scale(0);opacity:1;-webkit-transform-origin:center;transform-origin:center}.u-wave-ripple.u-wave-active[data-v-52fefc8e]{opacity:0;-webkit-transform:scale(2);transform:scale(2);transition:opacity 1s linear,-webkit-transform .4s linear;transition:opacity 1s linear,transform .4s linear;transition:opacity 1s linear,transform .4s linear,-webkit-transform .4s linear}.u-round-circle[data-v-52fefc8e]{border-radius:%?100?%}.u-round-circle[data-v-52fefc8e]::after{border-radius:%?100?%}.u-loading[data-v-52fefc8e]::after{background-color:hsla(0,0%,100%,.35)}.u-size-default[data-v-52fefc8e]{font-size:%?30?%;height:%?70?%;line-height:%?70?%}.u-size-medium[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?26?%;height:%?70?%;line-height:%?70?%;padding:0 %?80?%}.u-size-mini[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?22?%;padding-top:1px;height:%?50?%;line-height:%?50?%;padding:0 %?20?%}.u-primary-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#ffa373!important}.u-default-plain-hover[data-v-52fefc8e]{color:#ffa373!important;background:#fff!important}.u-success-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#18b566!important}.u-warning-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#f29100!important}.u-error-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#dd6161!important}.u-info-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#5a6c76!important}.u-default-hover[data-v-52fefc8e]{color:#ffa373!important;border-color:#ffa373!important;background-color:#fff!important}.u-primary-hover[data-v-52fefc8e]{background:#ffa373!important;color:#fff}.u-success-hover[data-v-52fefc8e]{background:#18b566!important;color:#fff}.u-info-hover[data-v-52fefc8e]{background:#5a6c76!important;color:#fff}.u-warning-hover[data-v-52fefc8e]{background:#f29100!important;color:#fff}.u-error-hover[data-v-52fefc8e]{background:#dd6161!important;color:#fff}',""]),e.exports=t},adea:function(e,t,a){"use strict";var n=a("d58e"),i=a.n(n);i.a},c76d:function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("ac1f"),a("5319");var n={name:"u-verification-code",props:{seconds:{type:[String,Number],default:60},startText:{type:String,default:"获取验证码"},changeText:{type:String,default:"X秒重新获取"},endText:{type:String,default:"重新获取"},keepRunning:{type:Boolean,default:!1},uniqueKey:{type:String,default:""}},data:function(){return{secNum:this.seconds,timer:null,canGetCode:!0}},mounted:function(){this.checkKeepRunning()},watch:{seconds:{immediate:!0,handler:function(e){this.secNum=e}}},methods:{checkKeepRunning:function(){var e=Number(uni.getStorageSync(this.uniqueKey+"_$uCountDownTimestamp"));if(!e)return this.changeEvent(this.startText);var t=Math.floor(+new Date/1e3);this.keepRunning&&e&&e>t?(this.secNum=e-t,uni.removeStorageSync(this.uniqueKey+"_$uCountDownTimestamp"),this.start()):this.changeEvent(this.startText)},start:function(){var e=this;this.timer&&(clearInterval(this.timer),this.timer=null),this.$emit("start"),this.canGetCode=!1,this.changeEvent(this.changeText.replace(/x|X/,this.secNum)),this.setTimeToStorage(),this.timer=setInterval((function(){--e.secNum?e.changeEvent(e.changeText.replace(/x|X/,e.secNum)):(clearInterval(e.timer),e.timer=null,e.changeEvent(e.endText),e.secNum=e.seconds,e.$emit("end"),e.canGetCode=!0)}),1e3)},reset:function(){this.canGetCode=!0,clearInterval(this.timer),this.secNum=this.seconds,this.changeEvent(this.endText)},changeEvent:function(e){this.$emit("change",e)},setTimeToStorage:function(){if(this.keepRunning&&this.timer&&this.secNum>0&&this.secNum<=this.seconds){var e=Math.floor(+new Date/1e3);uni.setStorage({key:this.uniqueKey+"_$uCountDownTimestamp",data:e+Number(this.secNum)})}}},beforeDestroy:function(){this.setTimeToStorage(),clearTimeout(this.timer),this.timer=null}};t.default=n},d58e:function(e,t,a){var n=a("f3a4");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);var i=a("4f06").default;i("65283263",n,!0,{sourceMap:!1,shadowMode:!1})},dab7:function(e,t,a){"use strict";a.r(t);var n=a("a8f6"),i=a("2371");for(var o in i)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(o);a("ebd9");var r=a("f0c5"),u=Object(r["a"])(i["default"],n["b"],n["c"],!1,null,"3aa0e5ac",null,!1,n["a"],void 0);t["default"]=u.exports},db54:function(e,t,a){"use strict";a.r(t);var n=a("c76d"),i=a.n(n);for(var o in n)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(o);t["default"]=i.a},ea90:function(e,t,a){"use strict";function n(e,t,a){this.$children.map((function(i){e===i.$options.name?i.$emit.apply(i,[t].concat(a)):n.apply(i,[e,t].concat(a))}))}a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("d81d"),a("99af");var i={methods:{dispatch:function(e,t,a){var n=this.$parent||this.$root,i=n.$options.name;while(n&&(!i||i!==e))n=n.$parent,n&&(i=n.$options.name);n&&n.$emit.apply(n,[t].concat(a))},broadcast:function(e,t,a){n.call(this,e,t,a)}}};t.default=i},ebd9:function(e,t,a){"use strict";var n=a("372a"),i=a.n(n);i.a},eeee:function(e,t,a){"use strict";a.r(t);var n=a("69a4"),i=a("a4bf");for(var o in i)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(o);a("0361");var r=a("f0c5"),u=Object(r["a"])(i["default"],n["b"],n["c"],!1,null,"52fefc8e",null,!1,n["a"],void 0);t["default"]=u.exports},f3a4:function(e,t,a){var n=a("24fb");t=n(!1),t.push([e.i,".tc_wrap[data-v-3bb4a6d0]{padding:0;text-align:center}.tc_wrap .tc_images uni-image[data-v-3bb4a6d0]{width:100%;height:%?300?%}.tc_wrap .tc_info[data-v-3bb4a6d0]{margin-top:%?30?%}.tc_wrap .tc_info uni-view[data-v-3bb4a6d0]:nth-child(1){font-weight:700;font-size:%?34?%;margin-bottom:%?20?%}.tc_wrap .tc_info uni-view[data-v-3bb4a6d0]:nth-child(2){font-weight:700;color:#ff611e}.tc_wrap .tc_info uni-view:nth-child(2) span[data-v-3bb4a6d0]{color:#ff611e}.tc_wrap .tc_btn_box[data-v-3bb4a6d0]{display:flex;align-items:center;padding:%?30?% %?30?% %?60?% %?30?%}.tc_wrap .tc_btn_box .tc_btn_huise[data-v-3bb4a6d0]{flex:1;margin-right:%?12?%;background:linear-gradient(90deg,#f7f7f7,50%,#f7f7f7);border-radius:%?200?%;padding:%?28?% 0;text-align:center;color:#333}.tc_wrap .tc_btn_box .tc_btn_huise_err[data-v-3bb4a6d0]{flex:1;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff;border-radius:%?200?%;padding:%?28?% 0;text-align:center}.tc_wrap .tc_btn_box .lijipay[data-v-3bb4a6d0]{width:%?300?%;margin-left:%?12?%;position:relative;margin:0 auto}.tc_wrap .tc_btn_box .lijipay .u-size-default[data-v-3bb4a6d0]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.imgCodeshow_wrap[data-v-3bb4a6d0]{padding:%?50?% %?50?% %?40?% %?50?%}.imgCodeshow_box[data-v-3bb4a6d0]{display:flex;align-items:center}.imgCodeshow_box .img_input[data-v-3bb4a6d0]{flex:1;background-color:#f5f5f5;border-radius:%?18?%;padding:%?10?% %?20?%;margin-right:%?18?%}.imgCodeshow_box .img_code[data-v-3bb4a6d0]{flex:1}.imgCodeshow_box .img_code uni-image[data-v-3bb4a6d0]{width:100%;height:%?90?%}.imgCodeshow_box .queren_Btn[data-v-3bb4a6d0]{margin-top:%?50?%}.phone_box[data-v-3bb4a6d0]{padding:%?30?%}.phone_box .input_item[data-v-3bb4a6d0]{border-radius:%?200?%;background-color:#f9f9f9;padding:%?20?% %?40?%;margin:%?30?% 0;position:relative;display:flex;align-items:center}.phone_box .input_item u-input[data-v-3bb4a6d0]{flex:1}.phone_box .input_item .getCode[data-v-3bb4a6d0]{right:0;top:0;color:#0084ff}.lijipay[data-v-3bb4a6d0]{width:90%;margin-top:%?100?%;position:fixed;left:0;right:0;margin:0 auto;bottom:2%}.lijipay .u-size-default[data-v-3bb4a6d0]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.lijipay2[data-v-3bb4a6d0]{width:100%;margin-top:%?30?%}.lijipay2 .u-size-default[data-v-3bb4a6d0]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}",""]),e.exports=t},fec1:function(e,t,a){"use strict";(function(e){a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=getApp(),i={data:function(){return{BestImgUrl:n.globalData.imgurl,bdingPhone_Show:!1,imgCodeshow:!1,newphone:"",code:"",imagescode:"",codeimages:"",tips:"",seconds:60}},methods:{lipay:function(){var t=this;t.$api.bindPhoneBtn({tel:t.newphone,code:t.code}).then((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3}),setTimeout((function(){t.bdingPhone_Show=!0}),2e3)})).catch((function(t){e("log","失败",t.data," at pages/me/Bindphone.vue:100"),uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},codeChange:function(e){this.tips=e},getCode:function(){var e=this;""==e.imagescode?uni.showToast({title:"请输入图形验证码",icon:"none",duration:2e3}):(e.imgCodeshow=!1,e.$refs.uCode.canGetCode?(uni.showLoading({title:"正在获取验证码"}),setTimeout((function(){e.$api.getLoginCode({tel:e.newphone,image_code:e.imagescode}).then((function(t){uni.hideLoading(),e.$u.toast("验证码已发送"),e.$refs.uCode.start()})).catch((function(e){uni.hideLoading(),uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))}),2e3)):e.$u.toast("倒计时结束后再发送"))},getimagesCode:function(){var e=this;""==e.newphone?uni.showToast({title:"请输入手机号",icon:"none",duration:2e3}):e.$refs.uCode.canGetCode?(e.imgCodeshow=!0,e.Payloading=!1,e.$api.getimageCode({tel:e.newphone,type:"base64"}).then((function(t){e.codeimages=t.data.result.base64}))):e.$u.toast("倒计时结束后再发送")},end:function(){},start:function(){},TobingdingPhone:function(){this.$api.drawMembers({}).then((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3}),setTimeout((function(){uni.navigateBack()}),2e3)})).catch((function(e){setTimeout((function(){uni.navigateBack()}),2e3),uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))}}};t.default=i}).call(this,a("0de9")["log"])}}]);