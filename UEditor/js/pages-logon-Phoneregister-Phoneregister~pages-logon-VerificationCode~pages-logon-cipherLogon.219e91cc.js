(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-logon-Phoneregister-Phoneregister~pages-logon-VerificationCode~pages-logon-cipherLogon"],{"0361":function(e,t,a){"use strict";var r=a("0dab"),o=a.n(r);o.a},"0dab":function(e,t,a){var r=a("a9f0");r.__esModule&&(r=r.default),"string"===typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);var o=a("4f06").default;o("9bea869c",r,!0,{sourceMap:!1,shadowMode:!1})},"1e64d":function(e,t,a){"use strict";a.r(t);var r=a("e4e1"),o=a.n(r);for(var i in r)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return r[e]}))}(i);t["default"]=o.a},2123:function(e,t,a){"use strict";var r=a("a54f"),o=a.n(r);o.a},2371:function(e,t,a){"use strict";a.r(t);var r=a("8d1f"),o=a.n(r);for(var i in r)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return r[e]}))}(i);t["default"]=o.a},"287a":function(e,t,a){var r=a("24fb");t=r(!1),t.push([e.i,".u-divider[data-v-fec8ac4c]{width:100%;position:relative;text-align:center;display:flex;flex-direction:row;justify-content:center;align-items:center;overflow:hidden;flex-direction:row}.u-divider-line[data-v-fec8ac4c]{border-bottom:1px solid #e4e7ed;-webkit-transform:scaleY(.5);transform:scaleY(.5);-webkit-transform-origin:center;transform-origin:center}.u-divider-line--bordercolor--primary[data-v-fec8ac4c]{border-color:#fe6736}.u-divider-line--bordercolor--success[data-v-fec8ac4c]{border-color:#19be6b}.u-divider-line--bordercolor--error[data-v-fec8ac4c]{border-color:#fe6736}.u-divider-line--bordercolor--info[data-v-fec8ac4c]{border-color:#5a6c76}.u-divider-line--bordercolor--warning[data-v-fec8ac4c]{border-color:#f90}.u-divider-text[data-v-fec8ac4c]{white-space:nowrap;padding:0 %?16?%;display:inline-flex}",""]),e.exports=t},"372a":function(e,t,a){var r=a("a775");r.__esModule&&(r=r.default),"string"===typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);var o=a("4f06").default;o("662274fd",r,!0,{sourceMap:!1,shadowMode:!1})},"69a4":function(e,t,a){"use strict";a.d(t,"b",(function(){return r})),a.d(t,"c",(function(){return o})),a.d(t,"a",(function(){}));var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-button",{staticClass:"u-btn u-line-1 u-fix-ios-appearance",class:["u-size-"+e.size,e.plain?"u-btn--"+e.type+"--plain":"",e.loading?"u-loading":"","circle"==e.shape?"u-round-circle":"",e.hairLine?e.showHairLineBorder:"u-btn--bold-border","u-btn--"+e.type,e.disabled?"u-btn--"+e.type+"--disabled":""],style:[e.customStyle,{overflow:e.ripple?"hidden":"visible"}],attrs:{id:"u-wave-btn","hover-start-time":Number(e.hoverStartTime),"hover-stay-time":Number(e.hoverStayTime),disabled:e.disabled,"form-type":e.formType,"open-type":e.openType,"app-parameter":e.appParameter,"hover-stop-propagation":e.hoverStopPropagation,"send-message-title":e.sendMessageTitle,"send-message-path":"sendMessagePath",lang:e.lang,"data-name":e.dataName,"session-from":e.sessionFrom,"send-message-img":e.sendMessageImg,"show-message-card":e.showMessageCard,"hover-class":e.getHoverClass,loading:e.loading},on:{getphonenumber:function(t){arguments[0]=t=e.$handleEvent(t),e.getphonenumber.apply(void 0,arguments)},getuserinfo:function(t){arguments[0]=t=e.$handleEvent(t),e.getuserinfo.apply(void 0,arguments)},error:function(t){arguments[0]=t=e.$handleEvent(t),e.error.apply(void 0,arguments)},opensetting:function(t){arguments[0]=t=e.$handleEvent(t),e.opensetting.apply(void 0,arguments)},launchapp:function(t){arguments[0]=t=e.$handleEvent(t),e.launchapp.apply(void 0,arguments)},click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.click(t)}}},[e._t("default"),e.ripple?a("v-uni-view",{staticClass:"u-wave-ripple",class:[e.waveActive?"u-wave-active":""],style:{top:e.rippleTop+"px",left:e.rippleLeft+"px",width:e.fields.targetWidth+"px",height:e.fields.targetWidth+"px","background-color":e.rippleBgColor||"rgba(0, 0, 0, 0.15)"}}):e._e()],2)},o=[]},"6f79":function(e,t,a){"use strict";a.r(t);var r=a("fe96"),o=a("1e64d");for(var i in o)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return o[e]}))}(i);a("2123");var n=a("f0c5"),l=Object(n["a"])(o["default"],r["b"],r["c"],!1,null,"fec8ac4c",null,!1,r["a"],void 0);t["default"]=l.exports},"8d1f":function(e,t,a){"use strict";a("7a82");var r=a("4ea4").default;Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("498a");var o=r(a("ea90")),i={name:"u-input",mixins:[o.default],props:{value:{type:[String,Number],default:""},type:{type:String,default:"text"},inputAlign:{type:String,default:"left"},placeholder:{type:String,default:"请输入内容"},disabled:{type:Boolean,default:!1},maxlength:{type:[Number,String],default:140},placeholderStyle:{type:String,default:"color: #c0c4cc;"},confirmType:{type:String,default:"done"},customStyle:{type:Object,default:function(){return{}}},fixed:{type:Boolean,default:!1},focus:{type:Boolean,default:!1},passwordIcon:{type:Boolean,default:!0},border:{type:Boolean,default:!1},borderColor:{type:String,default:"#dcdfe6"},autoHeight:{type:Boolean,default:!0},selectOpen:{type:Boolean,default:!1},height:{type:[Number,String],default:""},clearable:{type:Boolean,default:!0},cursorSpacing:{type:[Number,String],default:0},selectionStart:{type:[Number,String],default:-1},selectionEnd:{type:[Number,String],default:-1},trim:{type:Boolean,default:!0},showConfirmbar:{type:Boolean,default:!0},adjustPosition:{type:Boolean,default:!0}},data:function(){return{defaultValue:this.value,inputHeight:70,textareaHeight:100,validateState:!1,focused:!1,showPassword:!1,lastValue:""}},watch:{value:function(e,t){this.defaultValue=e,e!=t&&"select"==this.type&&this.handleInput({detail:{value:e}})}},computed:{inputMaxlength:function(){return Number(this.maxlength)},getStyle:function(){var e={};return e.minHeight=this.height?this.height+"rpx":"textarea"==this.type?this.textareaHeight+"rpx":this.inputHeight+"rpx",e=Object.assign(e,this.customStyle),e},getCursorSpacing:function(){return Number(this.cursorSpacing)},uSelectionStart:function(){return String(this.selectionStart)},uSelectionEnd:function(){return String(this.selectionEnd)}},created:function(){this.$on("on-form-item-error",this.onFormItemError)},methods:{handleInput:function(e){var t=this,a=e.detail.value;this.trim&&(a=this.$u.trim(a)),this.$emit("input",a),this.defaultValue=a,setTimeout((function(){t.dispatch("u-form-item","on-form-change",a)}),40)},handleBlur:function(e){var t=this,a=e.detail.value;setTimeout((function(){t.focused=!1}),100),this.$emit("blur",a),setTimeout((function(){t.dispatch("u-form-item","on-form-blur",a)}),40)},onFormItemError:function(e){this.validateState=e},onFocus:function(e){this.focused=!0,this.$emit("focus")},onConfirm:function(e){this.$emit("confirm",e.detail.value)},onClear:function(e){this.$emit("input","")},inputClick:function(){this.$emit("click")}}};t.default=i},"96d7":function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("c975"),a("d3b7"),a("ac1f");var r={name:"u-button",props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:function(){return{}}},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:1e3},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150}},computed:{getHoverClass:function(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";var e;return e=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",e},showHairLineBorder:function(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data:function(){return{rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click:function(e){var t=this;this.$u.throttle((function(){!0!==t.loading&&!0!==t.disabled&&(t.ripple&&(t.waveActive=!1,t.$nextTick((function(){this.getWaveQuery(e)}))),t.$emit("click",e))}),this.throttleTime)},getWaveQuery:function(e){var t=this;this.getElQuery().then((function(a){var r=a[0];if(r.width&&r.width&&(r.targetWidth=r.height>r.width?r.height:r.width,r.targetWidth)){t.fields=r;var o,i;o=e.touches[0].clientX,i=e.touches[0].clientY,t.rippleTop=i-r.top-r.targetWidth/2,t.rippleLeft=o-r.left-r.targetWidth/2,t.$nextTick((function(){t.waveActive=!0}))}}))},getElQuery:function(){var e=this;return new Promise((function(t){var a="";a=uni.createSelectorQuery().in(e),a.select(".u-btn").boundingClientRect(),a.exec((function(e){t(e)}))}))},getphonenumber:function(e){this.$emit("getphonenumber",e)},getuserinfo:function(e){this.$emit("getuserinfo",e)},error:function(e){this.$emit("error",e)},opensetting:function(e){this.$emit("opensetting",e)},launchapp:function(e){this.$emit("launchapp",e)}}};t.default=r},a4bf:function(e,t,a){"use strict";a.r(t);var r=a("96d7"),o=a.n(r);for(var i in r)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return r[e]}))}(i);t["default"]=o.a},a54f:function(e,t,a){var r=a("287a");r.__esModule&&(r=r.default),"string"===typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);var o=a("4f06").default;o("dacac898",r,!0,{sourceMap:!1,shadowMode:!1})},a775:function(e,t,a){var r=a("24fb");t=r(!1),t.push([e.i,".u-input[data-v-3aa0e5ac]{position:relative;flex:1;display:flex;flex-direction:row}.u-input__input[data-v-3aa0e5ac]{font-size:%?28?%;color:#303133;flex:1}.u-input__textarea[data-v-3aa0e5ac]{width:auto;font-size:%?28?%;color:#303133;padding:%?10?% 0;line-height:normal;flex:1}.u-input--border[data-v-3aa0e5ac]{border-radius:%?6?%;border-radius:4px;border:1px solid #dcdfe6}.u-input--error[data-v-3aa0e5ac]{border-color:#fa3534!important}.u-input__right-icon__item[data-v-3aa0e5ac]{margin-left:%?10?%}.u-input__right-icon--select[data-v-3aa0e5ac]{transition:-webkit-transform .4s;transition:transform .4s;transition:transform .4s,-webkit-transform .4s}.u-input__right-icon--select--reverse[data-v-3aa0e5ac]{-webkit-transform:rotate(-180deg);transform:rotate(-180deg)}",""]),e.exports=t},a8f6:function(e,t,a){"use strict";a.d(t,"b",(function(){return o})),a.d(t,"c",(function(){return i})),a.d(t,"a",(function(){return r}));var r={uIcon:a("21cf").default},o=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",{staticClass:"u-input",class:{"u-input--border":e.border,"u-input--error":e.validateState},style:{padding:"0 "+(e.border?20:0)+"rpx",borderColor:e.borderColor,textAlign:e.inputAlign},on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.inputClick.apply(void 0,arguments)}}},["textarea"==e.type?a("v-uni-textarea",{staticClass:"u-input__input u-input__textarea",style:[e.getStyle],attrs:{value:e.defaultValue,placeholder:e.placeholder,placeholderStyle:e.placeholderStyle,disabled:e.disabled,maxlength:e.inputMaxlength,fixed:e.fixed,focus:e.focus,autoHeight:e.autoHeight,"selection-end":e.uSelectionEnd,"selection-start":e.uSelectionStart,"cursor-spacing":e.getCursorSpacing,"show-confirm-bar":e.showConfirmbar},on:{input:function(t){arguments[0]=t=e.$handleEvent(t),e.handleInput.apply(void 0,arguments)},blur:function(t){arguments[0]=t=e.$handleEvent(t),e.handleBlur.apply(void 0,arguments)},focus:function(t){arguments[0]=t=e.$handleEvent(t),e.onFocus.apply(void 0,arguments)},confirm:function(t){arguments[0]=t=e.$handleEvent(t),e.onConfirm.apply(void 0,arguments)}}}):a("v-uni-input",{staticClass:"u-input__input",style:[e.getStyle],attrs:{type:"password"==e.type?"text":e.type,value:e.defaultValue,password:"password"==e.type&&!e.showPassword,placeholder:e.placeholder,placeholderStyle:e.placeholderStyle,disabled:e.disabled||"select"===e.type,maxlength:e.inputMaxlength,focus:e.focus,confirmType:e.confirmType,"cursor-spacing":e.getCursorSpacing,"selection-end":e.uSelectionEnd,"selection-start":e.uSelectionStart,"show-confirm-bar":e.showConfirmbar,"adjust-position":e.adjustPosition},on:{focus:function(t){arguments[0]=t=e.$handleEvent(t),e.onFocus.apply(void 0,arguments)},blur:function(t){arguments[0]=t=e.$handleEvent(t),e.handleBlur.apply(void 0,arguments)},input:function(t){arguments[0]=t=e.$handleEvent(t),e.handleInput.apply(void 0,arguments)},confirm:function(t){arguments[0]=t=e.$handleEvent(t),e.onConfirm.apply(void 0,arguments)}}}),a("v-uni-view",{staticClass:"u-input__right-icon u-flex"},[e.clearable&&""!=e.value&&e.focused?a("v-uni-view",{staticClass:"u-input__right-icon__clear u-input__right-icon__item",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.onClear.apply(void 0,arguments)}}},[a("u-icon",{attrs:{size:"32",name:"close-circle-fill",color:"#c0c4cc"}})],1):e._e(),e.passwordIcon&&"password"==e.type?a("v-uni-view",{staticClass:"u-input__right-icon__clear u-input__right-icon__item"},[a("u-icon",{attrs:{size:"32",name:e.showPassword?"eye-fill":"eye",color:"#c0c4cc"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.showPassword=!e.showPassword}}})],1):e._e(),"select"==e.type?a("v-uni-view",{staticClass:"u-input__right-icon--select u-input__right-icon__item",class:{"u-input__right-icon--select--reverse":e.selectOpen}},[a("u-icon",{attrs:{name:"arrow-down-fill",size:"26",color:"#c0c4cc"}})],1):e._e()],1)],1)},i=[]},a9f0:function(e,t,a){var r=a("24fb");t=r(!1),t.push([e.i,'.u-btn[data-v-52fefc8e]::after{border:none}.u-btn[data-v-52fefc8e]{position:relative;border:0;display:inline-flex;overflow:visible;line-height:1;display:flex;flex-direction:row;align-items:center;justify-content:center;cursor:pointer;padding:0 %?40?%;z-index:1;box-sizing:border-box;transition:all .15s}.u-btn--bold-border[data-v-52fefc8e]{border:1px solid #fff}.u-btn--default[data-v-52fefc8e]{color:#606266;border-color:#c0c4cc;background-color:#fff}.u-btn--primary[data-v-52fefc8e]{color:#fff;border-color:#fe6736;background-color:#fe6736}.u-btn--success[data-v-52fefc8e]{color:#fff;border-color:#19be6b;background-color:#19be6b}.u-btn--error[data-v-52fefc8e]{color:#fff;border-color:#fa3534;background-color:#fa3534}.u-btn--warning[data-v-52fefc8e]{color:#fff;border-color:#f90;background-color:#f90}.u-btn--default--disabled[data-v-52fefc8e]{color:#fff;border-color:#e4e7ed;background-color:#fff}.u-btn--primary--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#71d5a1!important;background-color:#71d5a1!important}.u-btn--error--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fab6b6!important;background-color:#fab6b6!important}.u-btn--warning--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fcbd71!important;background-color:#fcbd71!important}.u-btn--primary--plain[data-v-52fefc8e]{color:#fe6736!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--plain[data-v-52fefc8e]{color:#19be6b!important;border-color:#71d5a1!important;background-color:#dbf1e1!important}.u-btn--error--plain[data-v-52fefc8e]{color:#fa3534!important;border-color:#fab6b6!important;background-color:#fef0f0!important}.u-btn--warning--plain[data-v-52fefc8e]{color:#f90!important;border-color:#fcbd71!important;background-color:#fdf6ec!important}.u-hairline-border[data-v-52fefc8e]:after{content:" ";position:absolute;pointer-events:none;box-sizing:border-box;-webkit-transform-origin:0 0;transform-origin:0 0;left:0;top:0;width:199.8%;height:199.7%;-webkit-transform:scale(.5);transform:scale(.5);border:1px solid currentColor;z-index:1}.u-wave-ripple[data-v-52fefc8e]{z-index:0;position:absolute;border-radius:100%;background-clip:padding-box;pointer-events:none;-webkit-user-select:none;user-select:none;-webkit-transform:scale(0);transform:scale(0);opacity:1;-webkit-transform-origin:center;transform-origin:center}.u-wave-ripple.u-wave-active[data-v-52fefc8e]{opacity:0;-webkit-transform:scale(2);transform:scale(2);transition:opacity 1s linear,-webkit-transform .4s linear;transition:opacity 1s linear,transform .4s linear;transition:opacity 1s linear,transform .4s linear,-webkit-transform .4s linear}.u-round-circle[data-v-52fefc8e]{border-radius:%?100?%}.u-round-circle[data-v-52fefc8e]::after{border-radius:%?100?%}.u-loading[data-v-52fefc8e]::after{background-color:hsla(0,0%,100%,.35)}.u-size-default[data-v-52fefc8e]{font-size:%?30?%;height:%?70?%;line-height:%?70?%}.u-size-medium[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?26?%;height:%?70?%;line-height:%?70?%;padding:0 %?80?%}.u-size-mini[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?22?%;padding-top:1px;height:%?50?%;line-height:%?50?%;padding:0 %?20?%}.u-primary-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#ffa373!important}.u-default-plain-hover[data-v-52fefc8e]{color:#ffa373!important;background:#fff!important}.u-success-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#18b566!important}.u-warning-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#f29100!important}.u-error-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#dd6161!important}.u-info-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#5a6c76!important}.u-default-hover[data-v-52fefc8e]{color:#ffa373!important;border-color:#ffa373!important;background-color:#fff!important}.u-primary-hover[data-v-52fefc8e]{background:#ffa373!important;color:#fff}.u-success-hover[data-v-52fefc8e]{background:#18b566!important;color:#fff}.u-info-hover[data-v-52fefc8e]{background:#5a6c76!important;color:#fff}.u-warning-hover[data-v-52fefc8e]{background:#f29100!important;color:#fff}.u-error-hover[data-v-52fefc8e]{background:#dd6161!important;color:#fff}',""]),e.exports=t},dab7:function(e,t,a){"use strict";a.r(t);var r=a("a8f6"),o=a("2371");for(var i in o)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return o[e]}))}(i);a("ebd9");var n=a("f0c5"),l=Object(n["a"])(o["default"],r["b"],r["c"],!1,null,"3aa0e5ac",null,!1,r["a"],void 0);t["default"]=l.exports},e4e1:function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("c975");var r={name:"u-divider",props:{halfWidth:{type:[Number,String],default:150},borderColor:{type:String,default:"#dcdfe6"},type:{type:String,default:"primary"},color:{type:String,default:"#909399"},fontSize:{type:[Number,String],default:26},bgColor:{type:String,default:"#ffffff"},height:{type:[Number,String],default:"auto"},marginTop:{type:[String,Number],default:0},marginBottom:{type:[String,Number],default:0},useSlot:{type:Boolean,default:!0}},computed:{lineStyle:function(){var e={};return-1!=String(this.halfWidth).indexOf("%")?e.width=this.halfWidth:e.width=this.halfWidth+"rpx",this.borderColor&&(e.borderColor=this.borderColor),e}},methods:{click:function(){this.$emit("click")}}};t.default=r},ea90:function(e,t,a){"use strict";function r(e,t,a){this.$children.map((function(o){e===o.$options.name?o.$emit.apply(o,[t].concat(a)):r.apply(o,[e,t].concat(a))}))}a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("d81d"),a("99af");var o={methods:{dispatch:function(e,t,a){var r=this.$parent||this.$root,o=r.$options.name;while(r&&(!o||o!==e))r=r.$parent,r&&(o=r.$options.name);r&&r.$emit.apply(r,[t].concat(a))},broadcast:function(e,t,a){r.call(this,e,t,a)}}};t.default=o},ebd9:function(e,t,a){"use strict";var r=a("372a"),o=a.n(r);o.a},eeee:function(e,t,a){"use strict";a.r(t);var r=a("69a4"),o=a("a4bf");for(var i in o)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return o[e]}))}(i);a("0361");var n=a("f0c5"),l=Object(n["a"])(o["default"],r["b"],r["c"],!1,null,"52fefc8e",null,!1,r["a"],void 0);t["default"]=l.exports},fe96:function(e,t,a){"use strict";a.d(t,"b",(function(){return r})),a.d(t,"c",(function(){return o})),a.d(t,"a",(function(){}));var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",{staticClass:"u-divider",style:{height:"auto"==e.height?"auto":e.height+"rpx",backgroundColor:e.bgColor,marginBottom:e.marginBottom+"rpx",marginTop:e.marginTop+"rpx"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.click.apply(void 0,arguments)}}},[a("v-uni-view",{staticClass:"u-divider-line",class:[e.type?"u-divider-line--bordercolor--"+e.type:""],style:[e.lineStyle]}),e.useSlot?a("v-uni-view",{staticClass:"u-divider-text",style:{color:e.color,fontSize:e.fontSize+"rpx"}},[e._t("default")],2):e._e(),a("v-uni-view",{staticClass:"u-divider-line",class:[e.type?"u-divider-line--bordercolor--"+e.type:""],style:[e.lineStyle]})],1)},o=[]}}]);