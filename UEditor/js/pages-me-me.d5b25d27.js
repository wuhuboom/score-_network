(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-me-me"],{"0361":function(e,t,a){"use strict";var i=a("0dab"),n=a.n(i);n.a},"0dab":function(e,t,a){var i=a("a9f0");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var n=a("4f06").default;n("9bea869c",i,!0,{sourceMap:!1,shadowMode:!1})},3566:function(e,t,a){"use strict";a.d(t,"b",(function(){return i})),a.d(t,"c",(function(){return n})),a.d(t,"a",(function(){}));var i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",{staticClass:"u-col",class:["u-col-"+e.span],style:{padding:"0 "+Number(e.gutter)/2+"rpx",marginLeft:100/12*e.offset+"%",flex:"0 0 "+100/12*e.span+"%",alignItems:e.uAlignItem,justifyContent:e.uJustify,textAlign:e.textAlign},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.click.apply(void 0,arguments)}}},[e._t("default")],2)},n=[]},"3fec":function(e,t,a){"use strict";a.r(t);var i=a("d5e9"),n=a.n(i);for(var o in i)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(o);t["default"]=n.a},"54c8":function(e,t,a){var i=a("b15c");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var n=a("4f06").default;n("0ae16a04",i,!0,{sourceMap:!1,shadowMode:!1})},"654f":function(e,t,a){"use strict";var i=a("8025"),n=a.n(i);n.a},"661f":function(e,t,a){"use strict";(function(e){a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var i=getApp(),n={data:function(){return{fensiqun_Show:!1,BestImgUrl:i.globalData.imgurl,tabslist:[],Tabcurrent:0,mtmemberInfo:{},bdingPhone_Show:!1,navbackground:{backgroundImage:"linear-gradient(180deg, transparent, transparent)"},menuList:[],userInfo:{},mytel:"",qr_image:{}}},onPageScroll:function(e){e.scrollTop>=1?this.navbackground.backgroundImage="linear-gradient(180deg, #fff6e9, #fff6e9)":this.navbackground.backgroundImage="linear-gradient(180deg, transparent, transparent)"},onLoad:function(e){this.getMenuList()},onShow:function(){var e=uni.getStorageSync("token");if(e){this.Getmyinfo();var t={parent_id:uni.getStorageSync("parent_id"),reseller_id:{reseller_id:uni.getStorageSync("reseller_id")}};i.globalData.bindSaveParentId(t)}else this.userInfo={};this.getFanGroup()},methods:{Getmyinfo:function(){var t=this;t.$api.GetuserInfo({}).then((function(a){e("log","个人信息",a," at pages/me/me.vue:274"),t.userInfo=a.data.result,t.userInfo.username||(t.bdingPhone_Show=!0);var i=t.userInfo.username.substring(0,3)+"****"+t.userInfo.username.substring(7);t.mytel=i,uni.setStorageSync("userinfo",a.data.result)})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})})),t.$api.getMembertype({version:uni.getStorageSync("version")}).then((function(e){t.mtmemberInfo=e.data.result})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))},getFanGroup:function(){var e=this,t=uni.getStorageSync("CityName");e.$api.GetFanGroup({city:t,province:""}).then((function(t){null==t.data.result||(e.qr_image=t.data.result)})).catch((function(e){}))},getMenuList:function(){var t=this;t.$api.GetMeMenulist({client:"h5"}).then((function(e){t.menuList=e.data.result})).catch((function(t){e("log","失败",t.data," at pages/me/me.vue:332"),uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},Tomenus:function(t,a){e("log",t," at pages/me/me.vue:345");var i=uni.getStorageSync("token");i?2==t.type?uni.switchTab({url:t.path}):1==t.type?uni.navigateTo({url:t.path}):3==t.type?window.location.href=t.path:t.type:uni.navigateTo({url:"/pages/logon/logon"})},ToUrlpage:function(e){var t=uni.getStorageSync("token");t?uni.navigateTo({url:e,animationType:"pop-in"}):uni.navigateTo({url:"/pages/logon/logon"})},Toindex:function(e){uni.switchTab({url:e})},TobingdingPhone:function(){uni.navigateTo({url:"/pages/me/Bindphone",animationType:"pop-in"})},callservice:function(){var t=uni.getStorageSync("customerServiceData");e("log","客服链接",t," at pages/me/me.vue:463"),window.location.href=t.h5.url}}};t.default=n}).call(this,a("0de9")["log"])},6728:function(e,t,a){"use strict";var i=a("54c8"),n=a.n(i);n.a},"69a4":function(e,t,a){"use strict";a.d(t,"b",(function(){return i})),a.d(t,"c",(function(){return n})),a.d(t,"a",(function(){}));var i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-button",{staticClass:"u-btn u-line-1 u-fix-ios-appearance",class:["u-size-"+e.size,e.plain?"u-btn--"+e.type+"--plain":"",e.loading?"u-loading":"","circle"==e.shape?"u-round-circle":"",e.hairLine?e.showHairLineBorder:"u-btn--bold-border","u-btn--"+e.type,e.disabled?"u-btn--"+e.type+"--disabled":""],style:[e.customStyle,{overflow:e.ripple?"hidden":"visible"}],attrs:{id:"u-wave-btn","hover-start-time":Number(e.hoverStartTime),"hover-stay-time":Number(e.hoverStayTime),disabled:e.disabled,"form-type":e.formType,"open-type":e.openType,"app-parameter":e.appParameter,"hover-stop-propagation":e.hoverStopPropagation,"send-message-title":e.sendMessageTitle,"send-message-path":"sendMessagePath",lang:e.lang,"data-name":e.dataName,"session-from":e.sessionFrom,"send-message-img":e.sendMessageImg,"show-message-card":e.showMessageCard,"hover-class":e.getHoverClass,loading:e.loading},on:{getphonenumber:function(t){arguments[0]=t=e.$handleEvent(t),e.getphonenumber.apply(void 0,arguments)},getuserinfo:function(t){arguments[0]=t=e.$handleEvent(t),e.getuserinfo.apply(void 0,arguments)},error:function(t){arguments[0]=t=e.$handleEvent(t),e.error.apply(void 0,arguments)},opensetting:function(t){arguments[0]=t=e.$handleEvent(t),e.opensetting.apply(void 0,arguments)},launchapp:function(t){arguments[0]=t=e.$handleEvent(t),e.launchapp.apply(void 0,arguments)},click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.click(t)}}},[e._t("default"),e.ripple?a("v-uni-view",{staticClass:"u-wave-ripple",class:[e.waveActive?"u-wave-active":""],style:{top:e.rippleTop+"px",left:e.rippleLeft+"px",width:e.fields.targetWidth+"px",height:e.fields.targetWidth+"px","background-color":e.rippleBgColor||"rgba(0, 0, 0, 0.15)"}}):e._e()],2)},n=[]},"73d3":function(e,t,a){"use strict";a.r(t);var i=a("8de1"),n=a.n(i);for(var o in i)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(o);t["default"]=n.a},8025:function(e,t,a){var i=a("aeaa");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var n=a("4f06").default;n("684fcc78",i,!0,{sourceMap:!1,shadowMode:!1})},8259:function(e,t,a){"use strict";var i=a("bde6"),n=a.n(i);n.a},"8de1":function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3");var i={name:"u-col",props:{span:{type:[Number,String],default:12},offset:{type:[Number,String],default:0},justify:{type:String,default:"start"},align:{type:String,default:"center"},textAlign:{type:String,default:"left"},stop:{type:Boolean,default:!0}},data:function(){return{gutter:20}},created:function(){this.parent=!1},mounted:function(){this.parent=this.$u.$parent.call(this,"u-row"),this.parent&&(this.gutter=this.parent.gutter)},computed:{uJustify:function(){return"end"==this.justify||"start"==this.justify?"flex-"+this.justify:"around"==this.justify||"between"==this.justify?"space-"+this.justify:this.justify},uAlignItem:function(){return"top"==this.align?"flex-start":"bottom"==this.align?"flex-end":this.align}},methods:{click:function(e){this.$emit("click")}}};t.default=i},"93fa":function(e,t,a){"use strict";a.r(t);var i=a("b785"),n=a("b51f");for(var o in n)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(o);a("654f");var r=a("f0c5"),c=Object(r["a"])(n["default"],i["b"],i["c"],!1,null,"785184e3",null,!1,i["a"],void 0);t["default"]=c.exports},"96d7":function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("c975"),a("d3b7"),a("ac1f");var i={name:"u-button",props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:function(){return{}}},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:1e3},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150}},computed:{getHoverClass:function(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";var e;return e=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",e},showHairLineBorder:function(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data:function(){return{rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click:function(e){var t=this;this.$u.throttle((function(){!0!==t.loading&&!0!==t.disabled&&(t.ripple&&(t.waveActive=!1,t.$nextTick((function(){this.getWaveQuery(e)}))),t.$emit("click",e))}),this.throttleTime)},getWaveQuery:function(e){var t=this;this.getElQuery().then((function(a){var i=a[0];if(i.width&&i.width&&(i.targetWidth=i.height>i.width?i.height:i.width,i.targetWidth)){t.fields=i;var n,o;n=e.touches[0].clientX,o=e.touches[0].clientY,t.rippleTop=o-i.top-i.targetWidth/2,t.rippleLeft=n-i.left-i.targetWidth/2,t.$nextTick((function(){t.waveActive=!0}))}}))},getElQuery:function(){var e=this;return new Promise((function(t){var a="";a=uni.createSelectorQuery().in(e),a.select(".u-btn").boundingClientRect(),a.exec((function(e){t(e)}))}))},getphonenumber:function(e){this.$emit("getphonenumber",e)},getuserinfo:function(e){this.$emit("getuserinfo",e)},error:function(e){this.$emit("error",e)},opensetting:function(e){this.$emit("opensetting",e)},launchapp:function(e){this.$emit("launchapp",e)}}};t.default=i},"99c5":function(e,t,a){var i=a("24fb");t=i(!1),t.push([e.i,".u-row[data-v-3a08278e]{display:flex;flex-direction:row;flex-wrap:wrap}",""]),e.exports=t},"9e90":function(e,t,a){"use strict";a.r(t);var i=a("bc33"),n=a("3fec");for(var o in n)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(o);a("8259");var r=a("f0c5"),c=Object(r["a"])(n["default"],i["b"],i["c"],!1,null,"3a08278e",null,!1,i["a"],void 0);t["default"]=c.exports},a4bf:function(e,t,a){"use strict";a.r(t);var i=a("96d7"),n=a.n(i);for(var o in i)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(o);t["default"]=n.a},a9f0:function(e,t,a){var i=a("24fb");t=i(!1),t.push([e.i,'.u-btn[data-v-52fefc8e]::after{border:none}.u-btn[data-v-52fefc8e]{position:relative;border:0;display:inline-flex;overflow:visible;line-height:1;display:flex;flex-direction:row;align-items:center;justify-content:center;cursor:pointer;padding:0 %?40?%;z-index:1;box-sizing:border-box;transition:all .15s}.u-btn--bold-border[data-v-52fefc8e]{border:1px solid #fff}.u-btn--default[data-v-52fefc8e]{color:#606266;border-color:#c0c4cc;background-color:#fff}.u-btn--primary[data-v-52fefc8e]{color:#fff;border-color:#fe6736;background-color:#fe6736}.u-btn--success[data-v-52fefc8e]{color:#fff;border-color:#19be6b;background-color:#19be6b}.u-btn--error[data-v-52fefc8e]{color:#fff;border-color:#fa3534;background-color:#fa3534}.u-btn--warning[data-v-52fefc8e]{color:#fff;border-color:#f90;background-color:#f90}.u-btn--default--disabled[data-v-52fefc8e]{color:#fff;border-color:#e4e7ed;background-color:#fff}.u-btn--primary--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#71d5a1!important;background-color:#71d5a1!important}.u-btn--error--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fab6b6!important;background-color:#fab6b6!important}.u-btn--warning--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fcbd71!important;background-color:#fcbd71!important}.u-btn--primary--plain[data-v-52fefc8e]{color:#fe6736!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--plain[data-v-52fefc8e]{color:#19be6b!important;border-color:#71d5a1!important;background-color:#dbf1e1!important}.u-btn--error--plain[data-v-52fefc8e]{color:#fa3534!important;border-color:#fab6b6!important;background-color:#fef0f0!important}.u-btn--warning--plain[data-v-52fefc8e]{color:#f90!important;border-color:#fcbd71!important;background-color:#fdf6ec!important}.u-hairline-border[data-v-52fefc8e]:after{content:" ";position:absolute;pointer-events:none;box-sizing:border-box;-webkit-transform-origin:0 0;transform-origin:0 0;left:0;top:0;width:199.8%;height:199.7%;-webkit-transform:scale(.5);transform:scale(.5);border:1px solid currentColor;z-index:1}.u-wave-ripple[data-v-52fefc8e]{z-index:0;position:absolute;border-radius:100%;background-clip:padding-box;pointer-events:none;-webkit-user-select:none;user-select:none;-webkit-transform:scale(0);transform:scale(0);opacity:1;-webkit-transform-origin:center;transform-origin:center}.u-wave-ripple.u-wave-active[data-v-52fefc8e]{opacity:0;-webkit-transform:scale(2);transform:scale(2);transition:opacity 1s linear,-webkit-transform .4s linear;transition:opacity 1s linear,transform .4s linear;transition:opacity 1s linear,transform .4s linear,-webkit-transform .4s linear}.u-round-circle[data-v-52fefc8e]{border-radius:%?100?%}.u-round-circle[data-v-52fefc8e]::after{border-radius:%?100?%}.u-loading[data-v-52fefc8e]::after{background-color:hsla(0,0%,100%,.35)}.u-size-default[data-v-52fefc8e]{font-size:%?30?%;height:%?70?%;line-height:%?70?%}.u-size-medium[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?26?%;height:%?70?%;line-height:%?70?%;padding:0 %?80?%}.u-size-mini[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?22?%;padding-top:1px;height:%?50?%;line-height:%?50?%;padding:0 %?20?%}.u-primary-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#ffa373!important}.u-default-plain-hover[data-v-52fefc8e]{color:#ffa373!important;background:#fff!important}.u-success-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#18b566!important}.u-warning-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#f29100!important}.u-error-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#dd6161!important}.u-info-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#5a6c76!important}.u-default-hover[data-v-52fefc8e]{color:#ffa373!important;border-color:#ffa373!important;background-color:#fff!important}.u-primary-hover[data-v-52fefc8e]{background:#ffa373!important;color:#fff}.u-success-hover[data-v-52fefc8e]{background:#18b566!important;color:#fff}.u-info-hover[data-v-52fefc8e]{background:#5a6c76!important;color:#fff}.u-warning-hover[data-v-52fefc8e]{background:#f29100!important;color:#fff}.u-error-hover[data-v-52fefc8e]{background:#dd6161!important;color:#fff}',""]),e.exports=t},aeaa:function(e,t,a){var i=a("24fb");t=i(!1),t.push([e.i,"uni-page-body[data-v-785184e3]{background-image:linear-gradient(180deg,#f8f8fb,#f8f8fb);height:100%;-webkit-animation:dialog-fade-in-data-v-785184e3 .3s linear 1;animation:dialog-fade-in-data-v-785184e3 .3s linear 1}body.?%PAGE?%[data-v-785184e3]{background-image:linear-gradient(180deg,#f8f8fb,#f8f8fb)}.subtitle[data-v-785184e3]{display:flex;align-items:center;justify-content:space-between}.subtitle uni-view[data-v-785184e3]{font-weight:700;font-size:%?28?%}.subtitle uni-view span[data-v-785184e3]{font-weight:400!important;font-size:%?24?%;color:#999}.tc_wrap22[data-v-785184e3]{padding:0;text-align:center}.tc_wrap22 .tc_images22 uni-image[data-v-785184e3]{width:100%;height:%?350?%}.tc_wrap22 .tc_info uni-view[data-v-785184e3]:nth-child(1){font-weight:700;font-size:%?34?%;margin-bottom:%?20?%}.tc_wrap22 .tc_info uni-view[data-v-785184e3]:nth-child(2){font-weight:700;color:#333}.tc_wrap22 .tc_info uni-view:nth-child(2) span[data-v-785184e3]{color:#ff611e}.tc_wrap22 .tc_btn_box[data-v-785184e3]{display:flex;align-items:center;padding:%?30?% %?30?% %?60?% %?30?%}.tc_wrap22 .tc_btn_box .tc_btn_huise[data-v-785184e3]{flex:1;margin-right:%?12?%;background:linear-gradient(90deg,#f7f7f7,50%,#f7f7f7);border-radius:%?200?%;padding:%?28?% 0;text-align:center;color:#333}.tc_wrap22 .tc_btn_box .tc_btn_huise_err[data-v-785184e3]{flex:1;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff;border-radius:%?200?%;padding:%?28?% 0;text-align:center}.tc_wrap22 .tc_btn_box .lijipay[data-v-785184e3]{width:%?300?%;margin-left:%?12?%;position:relative;margin:0 auto}.tc_wrap22 .tc_btn_box .lijipay .u-size-default[data-v-785184e3]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.toos_box[data-v-785184e3]{flex:1;padding:0 %?30?% 0 0}.toos_box uni-view[data-v-785184e3]{display:flex;align-items:center;justify-content:flex-end}.toos_box uni-view uni-image[data-v-785184e3]{width:%?44?%;height:%?44?%;margin-left:%?24?%}.toos_box[data-v-785184e3] uni-button{background-color:initial!important;padding:0!important;margin:0!important;line-height:0!important}.toos_box[data-v-785184e3] uni-button::after{border:none!important}.toos_box222[data-v-785184e3]{position:absolute;top:%?30?%;right:%?10?%;flex:1;padding:0 %?30?% 0 0}.toos_box222 uni-view[data-v-785184e3]{display:flex;align-items:center;justify-content:flex-end}.toos_box222 uni-view uni-image[data-v-785184e3]{width:%?44?%;height:%?44?%;margin-left:%?24?%}.toos_box222[data-v-785184e3] uni-button{background-color:initial!important;padding:0!important;margin:0!important;line-height:0!important}.toos_box222[data-v-785184e3] uni-button::after{border:none!important}.membar-wrap[data-v-785184e3]{margin-top:0;margin-bottom:%?24?%;position:relative;height:%?144?%}.membar-wrap .zuan_bg[data-v-785184e3]{width:100%;height:%?144?%;border-radius:%?20?%;vertical-align:bottom}.membar-wrap .zuan_info[data-v-785184e3]{position:absolute;top:0;left:0;display:flex;align-items:center;width:100%;padding-right:%?20?%}.membar-wrap .zuan_info .zuan_1[data-v-785184e3]{width:%?170?%;height:%?144?%;position:relative;top:%?22?%}.membar-wrap .zuan_info .zuan_l_info uni-view[data-v-785184e3]:nth-child(1){font-weight:700;margin-bottom:%?10?%}.membar-wrap .zuan_info .zuan_l_info uni-view[data-v-785184e3]:nth-child(2){background-color:#f3f5ef;border-radius:%?200?%;padding:%?4?% %?20?%;font-size:%?24?%;color:#666}.membar-wrap .zuan_info .zuan_l_info .yishihuiyuan[data-v-785184e3]{background-color:#e8e8e8!important;display:inline-block}.membar-wrap .zuan_info .zuan_l_info2 uni-view[data-v-785184e3]:nth-child(1){font-weight:700;margin-bottom:%?10?%}.membar-wrap .zuan_info .zuan_l_info2 uni-view[data-v-785184e3]:nth-child(2){background-color:#f3f5ef;border-radius:%?200?%;padding:%?4?% %?20?%;font-size:%?24?%;color:#666}.membar-wrap .zuan_info .zuan_l_info2 .yishihuiyuan[data-v-785184e3]{background-color:hsla(0,0%,100%,.4)!important;display:inline-block}.membar-wrap .zuan_info .zuan_btn[data-v-785184e3]{margin-left:auto;background-color:#bebebe;border-radius:%?200?%;padding:%?10?% %?10?% %?10?% %?20?%;font-size:%?24?%;text-align:center;color:#333}.membar-wrap .zuan_info .zuan_btn2[data-v-785184e3]{margin-left:auto;background-image:linear-gradient(80deg,#fff,#ffe68f);border-radius:%?200?%;padding:%?10?% %?10?% %?10?% %?20?%;font-size:%?24?%;text-align:center;color:#f09536}.page_wrap[data-v-785184e3]{padding:0 %?30?% %?30?% %?30?%;background-image:linear-gradient(180deg,#f8f8fb,#f8f8fb)}.page_wrap .income_wrap[data-v-785184e3]{background-color:#fff;border-radius:%?20?%;padding:%?30?%;margin:0 0 %?16?% 0}.page_wrap .income_wrap .order_tool_bar .tool_title[data-v-785184e3]{padding:%?20?% 0 0 0;font-weight:700;margin-top:%?10?%}.page_wrap .income_wrap .order_tool_bar .tool_menu[data-v-785184e3]{margin-top:0}.page_wrap .income_wrap .order_tool_bar .tool_menu .demo-layout[data-v-785184e3]{text-align:center;margin-top:%?20?%;font-size:%?24?%}.page_wrap .income_wrap .order_tool_bar .tool_menu .demo-layout uni-image[data-v-785184e3]{width:%?56?%;height:%?56?%}.page_wrap .income_wrap .order_tool_bar .tool_menu .demo-layout .menu_name[data-v-785184e3]{font-size:%?24?%;margin-top:%?16?%}.page_wrap .income_wrap .title[data-v-785184e3]{border-bottom:1px solid #f7f7f7;padding:0 0 %?20?% 0}.page_wrap .income_wrap .title22[data-v-785184e3]{padding:0 0 0 0}.page_wrap .income_wrap .income_mx[data-v-785184e3]{padding:%?20?% 0 0 0}.page_wrap .income_wrap .income_mx .income_mx_1[data-v-785184e3]{margin-bottom:%?10?%;color:#000;font-size:%?28?%}.page_wrap .income_wrap .income_mx .income_mx_2[data-v-785184e3]{display:flex;align-items:center;justify-content:space-between}.page_wrap .income_wrap .income_mx .income_mx_2 .income_mx_3[data-v-785184e3]{font-size:%?56?%;font-weight:700;color:#ff4910}.page_wrap .income_wrap .income_mx .income_mx_2 .income_mx_3 span[data-v-785184e3]{font-size:%?30?%;color:#333}.page_wrap .income_wrap .income_mx .income_mx_2 .income_mx_4[data-v-785184e3]{border-radius:%?200?%;color:#fff;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;text-align:center;padding:%?10?% %?40?%}.page_wrap .income_wrap .income_xj[data-v-785184e3]{display:flex;align-items:center;justify-content:space-between;margin-top:%?24?%}.page_wrap .income_wrap .income_xj .income_xj1[data-v-785184e3]{display:flex;align-items:center;justify-content:space-between;flex:1;background-color:#f9f9f9;padding:%?16?% %?16?%;border-radius:%?10?%}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2[data-v-785184e3]{flex:1}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2 uni-view[data-v-785184e3]:nth-child(1){color:#999;margin-bottom:%?14?%;font-size:%?24?%}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2 uni-view[data-v-785184e3]:nth-child(2){font-size:%?32?%;font-weight:700;display:flex;align-items:center;justify-content:space-between}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2 uni-view:nth-child(2) .income_xj3[data-v-785184e3]{color:#999;text-align:center;font-size:%?24?%;font-weight:400;margin:0}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2 uni-view:nth-child(2) .income_xj3 .u-icon[data-v-785184e3]{margin:0!important;position:relative;top:%?2?%}.page_wrap .income_wrap .income_xj .line_1[data-v-785184e3]{width:1px;height:%?70?%;background-color:#f7f7f7;margin:0 %?30?%}.page_wrap .tx_box[data-v-785184e3]{display:flex;align-items:center;padding-top:%?30?%;padding-bottom:%?20?%}.page_wrap .tx_box .tx_img .my_img[data-v-785184e3]{width:%?120?%;height:%?120?%;border-radius:%?200?%;border:2px solid #fff}.page_wrap .tx_box .my_info[data-v-785184e3]{padding-left:%?20?%}.page_wrap .tx_box .my_info .my_name[data-v-785184e3]{font-weight:700;font-size:%?34?%;margin-bottom:%?14?%}.page_wrap .tx_box .my_info .my_id[data-v-785184e3]{color:#999;display:flex;align-items:center;font-size:%?24?%}.page_wrap .tx_box .my_info .my_id span[data-v-785184e3]{padding-left:%?20?%}.tc_wrap[data-v-785184e3]{padding:%?30?%;text-align:center}.tc_wrap .tc_images uni-image[data-v-785184e3]{width:%?300?%;height:%?300?%}.tc_wrap .tc_info uni-view[data-v-785184e3]:nth-child(1){font-weight:700;font-size:%?32?%;margin-bottom:%?20?%}.tc_wrap .tc_info uni-view[data-v-785184e3]:nth-child(2){font-size:%?28?%;color:#999}.tc_wrap .tc_info uni-view:nth-child(2) span[data-v-785184e3]{color:#ff611e}.tc_wrap .tc_btn_box[data-v-785184e3]{display:flex;align-items:center;margin-top:%?36?%;justify-content:center;padding:0 %?30?%}.tc_wrap .tc_btn_box .tc_btn_huise[data-v-785184e3]{flex:1;margin-right:%?12?%;background:linear-gradient(90deg,#f7f7f7,50%,#f7f7f7);border-radius:%?200?%;padding:0 0;height:%?80?%!important;line-height:%?80?%!important;text-align:center;color:#333}.tc_wrap .tc_btn_box .tc_btn_huise_err[data-v-785184e3]{flex:1;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff;border-radius:%?200?%;padding:0 0;height:%?80?%!important;line-height:%?80?%!important;text-align:center}.tc_wrap .tc_btn_box .lijipay[data-v-785184e3]{flex:1;margin-left:%?12?%;position:relative}.tc_wrap .tc_btn_box .lijipay .u-size-default[data-v-785184e3]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}@-webkit-keyframes dialog-fade-in-data-v-785184e3{0%{opacity:0}100%{opacity:1}}@keyframes dialog-fade-in-data-v-785184e3{0%{opacity:0}100%{opacity:1}}",""]),e.exports=t},b15c:function(e,t,a){var i=a("24fb");t=i(!1),t.push([e.i,".u-col-0[data-v-790095f8]{width:0}.u-col-1[data-v-790095f8]{width:calc(100%/12)}.u-col-2[data-v-790095f8]{width:calc(100%/12 * 2)}.u-col-3[data-v-790095f8]{width:calc(100%/12 * 3)}.u-col-4[data-v-790095f8]{width:calc(100%/12 * 4)}.u-col-5[data-v-790095f8]{width:calc(100%/12 * 5)}.u-col-6[data-v-790095f8]{width:calc(100%/12 * 6)}.u-col-7[data-v-790095f8]{width:calc(100%/12 * 7)}.u-col-8[data-v-790095f8]{width:calc(100%/12 * 8)}.u-col-9[data-v-790095f8]{width:calc(100%/12 * 9)}.u-col-10[data-v-790095f8]{width:calc(100%/12 * 10)}.u-col-11[data-v-790095f8]{width:calc(100%/12 * 11)}.u-col-12[data-v-790095f8]{width:calc(100%/12 * 12)}",""]),e.exports=t},b51f:function(e,t,a){"use strict";a.r(t);var i=a("661f"),n=a.n(i);for(var o in i)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(o);t["default"]=n.a},b785:function(e,t,a){"use strict";a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return o})),a.d(t,"a",(function(){return i}));var i={uPopup:a("627b").default,uButton:a("eeee").default,uIcon:a("21cf").default,uRow:a("9e90").default,uCol:a("c483").default},n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",[a("u-popup",{attrs:{mode:"center",width:"550","border-radius":"28"},model:{value:e.bdingPhone_Show,callback:function(t){e.bdingPhone_Show=t},expression:"bdingPhone_Show"}},[a("v-uni-view",{staticClass:"tc_wrap22"},[a("v-uni-view",{staticClass:"tc_images22"},[a("v-uni-image",{attrs:{src:e.BestImgUrl+"me/lhy_Mask-group.png"}})],1),a("v-uni-view",{staticClass:"tc_info"},[a("v-uni-view",[e._v("绑定手机号")]),a("v-uni-view",[e._v("领1个月"),a("span",[e._v("VIP会员")])])],1),a("v-uni-view",{staticClass:"tc_btn_box"},[a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.TobingdingPhone()}}},[e._v("去绑定")])],1)],1)],1)],1),a("v-uni-view",{staticClass:"page_wrap"},[a("v-uni-view",{staticClass:"tx_box"},[a("v-uni-view",{staticClass:"toos_box222"},[a("v-uni-view",[a("v-uni-image",{attrs:{src:"/static/images/me/me_set.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.ToUrlpage("/pages/me/BasicSettings/BasicSettings")}}}),a("v-uni-image",{attrs:{src:"/static/images/me/me_kefu.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.callservice()}}})],1)],1),a("v-uni-view",{staticClass:"tx_img"},[a("v-uni-image",{staticClass:"my_img",attrs:{src:e.userInfo.avatar||"/static/logo.png"}})],1),e.userInfo.id?a("v-uni-view",{staticClass:"my_info"},[a("v-uni-view",{staticClass:"my_name"},[e._v(e._s(e.userInfo.nickname||"暂无昵称"))]),a("v-uni-view",{staticClass:"my_id"},[e._v("ID: "+e._s(e.userInfo.id)),a("span",[e._v("手机号: "+e._s(e.mytel))])])],1):a("v-uni-view",{staticClass:"my_info"},[a("v-uni-view",{staticClass:"my_name",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.ToUrlpage("/pages/logon/logon")}}},[e._v("登录")])],1)],1),e.userInfo.id?a("v-uni-view",{staticClass:"membar-wrap"},[0==e.mtmemberInfo.is_member?a("v-uni-image",{staticClass:"zuan_bg",attrs:{src:e.BestImgUrl+"me/me_zuan_bg.png",mode:"aspectFill"}}):e._e(),1==e.mtmemberInfo.is_member?a("v-uni-image",{staticClass:"zuan_bg",attrs:{src:e.BestImgUrl+"me/me_zuan_bg2.png",mode:"aspectFill"}}):e._e(),a("v-uni-view",{staticClass:"zuan_info",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.ToUrlpage("/pages/member/member")}}},[0==e.mtmemberInfo.is_member?a("v-uni-image",{staticClass:"zuan_1",attrs:{src:e.BestImgUrl+"me/me_zuan.png",mode:"aspectFill"}}):e._e(),1==e.mtmemberInfo.is_member?a("v-uni-image",{staticClass:"zuan_1",attrs:{src:e.BestImgUrl+"me/me_zuan2.png",mode:"aspectFill"}}):e._e(),0==e.mtmemberInfo.is_member?a("v-uni-view",{staticClass:"zuan_l_info"},[a("v-uni-view",[e._v("普通用户")]),a("v-uni-view",[e._v("开通会员每月多省1000元")])],1):e._e(),1==e.mtmemberInfo.is_member?a("v-uni-view",{staticClass:"zuan_l_info2"},[a("v-uni-view",[e._v("您是尊贵的VIP会员")]),a("v-uni-view",{staticClass:"yishihuiyuan"},[e._v(e._s(e.userInfo.member_expiry_time)+" 到期")])],1):e._e(),0==e.mtmemberInfo.is_member?a("v-uni-view",{staticClass:"zuan_btn",on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.ToUrlpage("/pages/member/member")}}},[e._v("立即开通"),a("u-icon",{attrs:{name:"arrow-right",color:"#333",size:"28"}})],1):e._e(),1==e.mtmemberInfo.is_member?a("v-uni-view",{staticClass:"zuan_btn2",on:{click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.Toindex("/pages/index/index")}}},[e._v("立即抢单"),a("u-icon",{attrs:{name:"arrow-right",color:"#F09536",size:"28"}})],1):e._e()],1)],1):e._e(),a("v-uni-view",{staticClass:"income_wrap",staticStyle:{padding:"10px 15px 15px 15px"}},[a("v-uni-view",{staticClass:"title"},[a("v-uni-view",{staticClass:"subtitle"},[a("v-uni-view",[e._v("我的收益")]),a("v-uni-view",{on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.ToUrlpage("/pages/me/incomeInfo")}}},[a("span",[e._v("收益明细")]),a("u-icon",{attrs:{name:"arrow-right",color:"#999",size:"24"}})],1)],1)],1),a("v-uni-view",{staticClass:"income_mx"},[a("v-uni-view",{staticClass:"income_mx_1"},[e._v("余额")]),a("v-uni-view",{staticClass:"income_mx_2"},[e.userInfo.money?a("v-uni-view",{staticClass:"income_mx_3"},[e._v(e._s(e.userInfo.money)),a("span",[e._v("元")])]):a("v-uni-view",{staticClass:"income_mx_3"},[e._v("****"),a("span",[e._v("元")])]),a("v-uni-view",{staticClass:"income_mx_4",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.ToUrlpage("/pages/me/Cashwithdrawal")}}},[e._v("提现")])],1)],1),a("v-uni-view",{staticClass:"income_xj"},[a("v-uni-view",{staticClass:"income_xj1"},[a("v-uni-view",{staticClass:"income_xj2"},[a("v-uni-view",[e._v("已省")]),a("v-uni-view",[e.userInfo.all_money?a("v-uni-text",[e._v(e._s(e.userInfo.all_money)+"元")]):a("v-uni-text",[e._v("**元")]),a("v-uni-view",{staticClass:"income_xj3",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.Toindex("/pages/index/index")}}},[e._v("去抢单"),a("u-icon",{attrs:{name:"arrow-right",color:"#999",size:"24"}})],1)],1)],1)],1),a("v-uni-view",{staticClass:"line_1"}),a("v-uni-view",{staticClass:"income_xj1"},[a("v-uni-view",{staticClass:"income_xj2"},[a("v-uni-view",[e._v("已赚")]),a("v-uni-view",[e.userInfo.income_money?a("v-uni-text",[e._v(e._s(e.userInfo.income_money)+"元")]):a("v-uni-text",[e._v("**元")]),1==e.mtmemberInfo.is_open?a("v-uni-view",{staticClass:"income_xj3",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.Toindex("/pages/makemoney/makemoney")}}},[e._v("去赚钱"),a("u-icon",{attrs:{name:"arrow-right",color:"#999",size:"24"}})],1):e._e()],1)],1)],1)],1)],1),e._l(e.menuList,(function(t,i){return a("v-uni-view",{key:i,staticClass:"income_wrap"},[a("v-uni-view",{staticClass:"title22"},[a("v-uni-view",{staticClass:"subtitle"},[a("v-uni-view",[e._v(e._s(t.name))])],1)],1),a("v-uni-view",{staticClass:"order_tool_bar"},[a("v-uni-view",{staticClass:"tool_menu"},[a("u-row",{attrs:{gutter:"16"}},e._l(t.menu,(function(t,i){return a("u-col",{key:i,attrs:{span:"3"},on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.Tomenus(t,i)}}},[a("v-uni-view",{staticClass:"demo-layout"},[a("v-uni-image",{attrs:{src:t.image,mode:"aspectFill"}}),a("v-uni-view",{staticClass:"menu_name"},[e._v(e._s(t.name))])],1)],1)})),1)],1)],1)],1)})),a("v-uni-view",{staticStyle:{height:"120rpx",width:"100%"}})],2),a("u-popup",{attrs:{mode:"center",width:"524","border-radius":"28","mask-close-able":!1},model:{value:e.fensiqun_Show,callback:function(t){e.fensiqun_Show=t},expression:"fensiqun_Show"}},[a("v-uni-view",{staticClass:"tc_wrap"},[a("v-uni-view",{staticClass:"tc_images",staticStyle:{"padding-top":"20rpx",margin:"0 0 0 0"}},[a("v-uni-image",{attrs:{src:e.qr_image.qr_code}})],1),a("v-uni-view",{staticClass:"tc_info"},[a("v-uni-view",[e._v(e._s(e.qr_image.name))]),a("v-uni-view",{staticStyle:{color:"#999"}},[e._v("微信扫一扫或长按识别")])],1),a("v-uni-view",{staticClass:"tc_btn_box"},[a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.fensiqun_Show=!1}}},[e._v("知道了")])],1)],1)],1)],1)],1)},o=[]},bc33:function(e,t,a){"use strict";a.d(t,"b",(function(){return i})),a.d(t,"c",(function(){return n})),a.d(t,"a",(function(){}));var i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",{staticClass:"u-row",style:{alignItems:e.uAlignItem,justifyContent:e.uJustify},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.click.apply(void 0,arguments)}}},[e._t("default")],2)},n=[]},bde6:function(e,t,a){var i=a("99c5");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var n=a("4f06").default;n("6af7f8d4",i,!0,{sourceMap:!1,shadowMode:!1})},c483:function(e,t,a){"use strict";a.r(t);var i=a("3566"),n=a("73d3");for(var o in n)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(o);a("6728");var r=a("f0c5"),c=Object(r["a"])(n["default"],i["b"],i["c"],!1,null,"790095f8",null,!1,i["a"],void 0);t["default"]=c.exports},d5e9:function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3");var i={name:"u-row",props:{gutter:{type:[String,Number],default:20},justify:{type:String,default:"start"},align:{type:String,default:"center"},stop:{type:Boolean,default:!0}},computed:{uJustify:function(){return"end"==this.justify||"start"==this.justify?"flex-"+this.justify:"around"==this.justify||"between"==this.justify?"space-"+this.justify:this.justify},uAlignItem:function(){return"top"==this.align?"flex-start":"bottom"==this.align?"flex-end":this.align}},methods:{click:function(e){this.$emit("click")}}};t.default=i},eeee:function(e,t,a){"use strict";a.r(t);var i=a("69a4"),n=a("a4bf");for(var o in n)["default"].indexOf(o)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(o);a("0361");var r=a("f0c5"),c=Object(r["a"])(n["default"],i["b"],i["c"],!1,null,"52fefc8e",null,!1,i["a"],void 0);t["default"]=c.exports}}]);