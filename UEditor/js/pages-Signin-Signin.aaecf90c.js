(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-Signin-Signin"],{"0361":function(t,i,e){"use strict";var a=e("0dab"),n=e.n(a);n.a},"040b":function(t,i,e){"use strict";(function(t){e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var a=getApp(),n={data:function(){return{qiancheng_Show:!1,colSpan:"1.71",BestImgUrl:a.globalData.imgurl,bdingPhone_Show:!1,guizeData:{},hiidemore:31,supplementary:!0,dayArr:[],localDate:"",day:(new Date).getDate(),year:(new Date).getFullYear(),month:(new Date).getMonth()+1,cudcoin:""}},onLoad:function(){this.getGuize(),this.GetriliData()},methods:{moreRiqi:function(){14==this.hiidemore?this.hiidemore=31:this.hiidemore=14},GetriliData:function(){var t=this;t.$api.getriliData({month:t.year+"-"+t.formatNum(t.month)}).then((function(i){t.localDate=t.year+"-"+t.formatNum(t.month)+"-"+t.formatNum(t.day),t.dayArr=i.data.result})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},formatNum:function(t){return t<10?"0"+t:t},daySign:function(i,e){t("log",i," at pages/Signin/Signin.vue:263");var a=this;a.cudcoin=i.coin,""!=i.date&&(i.day<a.day||i.day==a.day)?a.$api.toDaySign({}).then((function(t){a.qiancheng_Show=!0,a.GetriliData(),a.getGuize()})).catch((function(t){a.GetriliData(),a.getGuize(),uni.showToast({title:t.data.msg,icon:"none",duration:2e3})})):uni.showToast({title:"签到不能大于今天",icon:"none"})},buqian:function(i,e){var a=this;t("log","补签",i," at pages/Signin/Signin.vue:296"),a.cudcoin=i.coin,""!=i.date&&(i.day<a.day||i.day==a.day)?a.$api.buqianSign({date:i.date}).then((function(t){a.qiancheng_Show=!0,a.GetriliData(),a.getGuize()})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})})):uni.showToast({title:"签到不能大于今天",icon:"none"})},tomingxi:function(){uni.navigateTo({url:"/pages/Signin/signDetails?jinbi="+this.guizeData.my_gold_coin})},getGuize:function(){var t=this;t.$api.signGuize({}).then((function(i){t.guizeData=i.data.result})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},duihuaVip:function(t){var i=this;i.$api.duihuanVip({member_type:t}).then((function(t){i.bdingPhone_Show=!0})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))}}};i.default=n}).call(this,e("0de9")["log"])},"0cab":function(t,i,e){"use strict";e.d(i,"b",(function(){return n})),e.d(i,"c",(function(){return o})),e.d(i,"a",(function(){return a}));var a={uIcon:e("21cf").default},n=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",{staticClass:"u-section"},[e("v-uni-view",{staticClass:"u-section__title",class:{"u-section--line":t.showLine},style:{fontWeight:t.bold?"bold":"normal",color:t.color,fontSize:t.fontSize+"rpx",paddingLeft:t.showLine?.7*t.fontSize+"rpx":0}},[t.showLine?e("v-uni-view",{staticClass:"u-section__title__icon-wrap u-flex",style:[t.lineStyle]},[e("u-icon",{attrs:{top:"0",name:"column-line",size:1.25*t.fontSize,bold:!0,color:t.lineColor?t.lineColor:t.color}})],1):t._e(),e("v-uni-text",{staticClass:"u-flex u-section__title__text"},[t._v(t._s(t.title))])],1),t.right||t.$slots.right?e("v-uni-view",{staticClass:"u-section__right-info",style:{color:t.subColor},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.rightClick.apply(void 0,arguments)}}},[t.$slots.right?t._t("right"):[t._v(t._s(t.subTitle)),t.arrow?e("v-uni-view",{staticClass:"u-section__right-info__icon-arrow u-flex"},[e("u-icon",{attrs:{name:"arrow-right",size:"24",color:t.subColor}})],1):t._e()]],2):t._e()],1)},o=[]},"0dab":function(t,i,e){var a=e("a9f0");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=e("4f06").default;n("9bea869c",a,!0,{sourceMap:!1,shadowMode:!1})},"157d":function(t,i,e){var a=e("60f0");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=e("4f06").default;n("a75a32f8",a,!0,{sourceMap:!1,shadowMode:!1})},"270c":function(t,i,e){"use strict";var a=e("157d"),n=e.n(a);n.a},3566:function(t,i,e){"use strict";e.d(i,"b",(function(){return a})),e.d(i,"c",(function(){return n})),e.d(i,"a",(function(){}));var a=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",{staticClass:"u-col",class:["u-col-"+t.span],style:{padding:"0 "+Number(t.gutter)/2+"rpx",marginLeft:100/12*t.offset+"%",flex:"0 0 "+100/12*t.span+"%",alignItems:t.uAlignItem,justifyContent:t.uJustify,textAlign:t.textAlign},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.click.apply(void 0,arguments)}}},[t._t("default")],2)},n=[]},"3fec":function(t,i,e){"use strict";e.r(i);var a=e("d5e9"),n=e.n(a);for(var o in a)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(o);i["default"]=n.a},"4fba":function(t,i,e){"use strict";e.r(i);var a=e("0cab"),n=e("d1af");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(o);e("fa1a");var r=e("f0c5"),c=Object(r["a"])(n["default"],a["b"],a["c"],!1,null,"5f4a289b",null,!1,a["a"],void 0);i["default"]=c.exports},"54c8":function(t,i,e){var a=e("b15c");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=e("4f06").default;n("0ae16a04",a,!0,{sourceMap:!1,shadowMode:!1})},"5a6a":function(t,i){t.exports="data:image/png;base64,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"},"60f0":function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,"uni-page-body[data-v-22c9b0bc]{background-color:#ffeadd}body.?%PAGE?%[data-v-22c9b0bc]{background-color:#ffeadd}.tc_wrap[data-v-22c9b0bc]{padding:0;text-align:center}.tc_wrap .tc_images uni-image[data-v-22c9b0bc]{width:100%;height:%?350?%}.tc_wrap .jinbiGif[data-v-22c9b0bc]{position:absolute;top:9%;left:0;right:0;margin:0 auto}.tc_wrap .jinbiGif uni-image[data-v-22c9b0bc]{width:%?180?%;height:%?180?%}.tc_wrap .tc_info uni-view[data-v-22c9b0bc]:nth-child(1){font-weight:700;font-size:%?34?%;margin-bottom:%?20?%}.tc_wrap .tc_info uni-view[data-v-22c9b0bc]:nth-child(2){font-weight:700;color:#ff611e}.tc_wrap .tc_info uni-view:nth-child(2) span[data-v-22c9b0bc]{color:#ff611e}.tc_wrap .tc_btn_box[data-v-22c9b0bc]{display:flex;align-items:center;padding:%?30?% %?30?% %?60?% %?30?%}.tc_wrap .tc_btn_box .tc_btn_huise[data-v-22c9b0bc]{flex:1;margin-right:%?12?%;background:linear-gradient(90deg,#f7f7f7,50%,#f7f7f7);border-radius:%?200?%;padding:%?28?% 0;text-align:center;color:#333}.tc_wrap .tc_btn_box .tc_btn_huise_err[data-v-22c9b0bc]{flex:1;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff;border-radius:%?200?%;padding:%?28?% 0;text-align:center}.tc_wrap .tc_btn_box .lijipay[data-v-22c9b0bc]{width:%?300?%;margin-left:%?12?%;position:relative;margin:0 auto}.tc_wrap .tc_btn_box .lijipay .u-size-default[data-v-22c9b0bc]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.poage_wrap .top_bg[data-v-22c9b0bc]{width:100%}.poage_wrap .content_box[data-v-22c9b0bc]{padding:%?30?%;position:relative;top:%?-70?%}.poage_wrap .content_box .liest_task[data-v-22c9b0bc]{background-color:#fff;border-radius:%?20?%;padding:0 %?30?%;margin-top:%?30?%}.poage_wrap .content_box .liest_task .dh_title[data-v-22c9b0bc]{padding:%?30?% 0 %?30?% 0;border-bottom:1px solid #f1f1f1;font-size:%?32?%}.poage_wrap .content_box .liest_task .dh_title[data-v-22c9b0bc] .u-section__right-info{font-size:%?24?%!important}.poage_wrap .content_box .liest_task .tz_list .tz_list_item[data-v-22c9b0bc]{display:flex;align-items:center;border-bottom:1px solid #f1f1f1;padding:%?30?% 0}.poage_wrap .content_box .liest_task .tz_list .tz_list_item uni-image[data-v-22c9b0bc]{width:%?86?%;height:%?86?%;margin-right:%?30?%}.poage_wrap .content_box .liest_task .tz_list .tz_list_item .tz_item_info[data-v-22c9b0bc]{flex:1}.poage_wrap .content_box .liest_task .tz_list .tz_list_item .tz_item_info .tz_title[data-v-22c9b0bc]{display:flex;align-items:center;justify-content:space-between}.poage_wrap .content_box .liest_task .tz_list .tz_list_item .tz_item_info .tz_title uni-view[data-v-22c9b0bc]{font-weight:700;font-size:%?28?%;margin-bottom:%?8?%;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.poage_wrap .content_box .liest_task .tz_list .tz_list_item .tz_item_info .tz_content[data-v-22c9b0bc]{font-size:%?24?%;color:#faa425;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.poage_wrap .content_box .liest_task .tz_list .tz_list_item .tz_item_info .tz_content uni-image[data-v-22c9b0bc]{width:%?24?%;height:%?24?%;position:relative;top:%?2?%}.poage_wrap .content_box .liest_task .tz_list .tz_list_item .btm[data-v-22c9b0bc]{border-radius:%?200?%;padding:%?10?% %?30?%;background-image:linear-gradient(270deg,#fa0020,#ff823c)!important;color:#fff;font-size:%?24?%}.poage_wrap .content_box .liest_task .tz_list .tz_list_item[data-v-22c9b0bc]:last-child{border:none}.poage_wrap .content_box .sign_biao[data-v-22c9b0bc]{background-color:#fff;border-radius:%?20?%;padding:%?30?% %?20?% %?20?% %?20?%}.poage_wrap .content_box .sign_biao .gengduo_btn[data-v-22c9b0bc]{text-align:right;color:#999;font-size:%?24?%;margin-top:%?10?%}.poage_wrap .content_box .sign_biao .rili[data-v-22c9b0bc]{display:flex;align-items:center;justify-content:space-between;margin-bottom:%?20?%;border-top:1px solid #f1f1f1;padding-top:%?20?%}.poage_wrap .content_box .sign_biao .rili uni-view[data-v-22c9b0bc]{flex:1;color:#999;text-align:center;font-size:%?24?%}.poage_wrap .content_box .sign_biao .sign_title[data-v-22c9b0bc]{display:flex;align-items:center;justify-content:space-between;font-weight:700;padding:0 0 %?30?% 0}.poage_wrap .content_box .sign_biao .sign_title .tishi[data-v-22c9b0bc]{font-size:%?32?%}.poage_wrap .content_box .sign_biao .sign_title .tishi span[data-v-22c9b0bc]{color:#ff4910;font-weight:700}.poage_wrap .content_box .sign_biao .sign_title .kaiguan[data-v-22c9b0bc]{display:flex;align-items:center;font-size:%?28?%}.poage_wrap .content_box .sign_biao .sign_title .kaiguan span[data-v-22c9b0bc]{color:#ff4910}.poage_wrap .content_box .sign_biao .sign_title .kaiguan uni-image[data-v-22c9b0bc]{width:%?32?%;margin-right:%?30?%;margin-left:%?8?%}.poage_wrap .content_box .sign_biao .sign_title .kaiguan .mx_text[data-v-22c9b0bc]{display:flex;align-items:center;font-weight:400;font-size:%?24?%;color:#999}.poage_wrap .content_box .sign_biao .sign_title .kaiguan .mx_text .u-icon[data-v-22c9b0bc]{position:relative;top:%?2?%}.poage_wrap .content_box .sign_biao .sign_list[data-v-22c9b0bc]{overflow:hidden;padding:0 0 0 0}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item[data-v-22c9b0bc]{text-align:center;float:left;width:100%;height:%?148?%;margin:0 0 %?14?% 0}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item .s_item_box[data-v-22c9b0bc]{height:%?148?%;border-radius:%?14?%;text-align:center;padding-top:%?20?%}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item .s_item_box .jl_price[data-v-22c9b0bc]{font-size:%?24?%;color:#f09536}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item .s_item_box uni-image[data-v-22c9b0bc]{width:%?40?%}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item .s_item_box .zhihuise[data-v-22c9b0bc]{-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%);filter:grayscale(100%);filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1)}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item .s_item_box .s_riqi[data-v-22c9b0bc]{text-align:center;height:%?30?%;margin-top:%?10?%;font-size:%?24?%;color:#333}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item .s_item_box .s_riqi_tday[data-v-22c9b0bc]{text-align:center;height:%?30?%;margin-top:%?10?%;font-size:%?20?%;color:#333}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item .yiqiandbg[data-v-22c9b0bc]{background-color:#fff7da!important}.poage_wrap .content_box .sign_biao .sign_list .sign_list_wrap .s_list_item .morenbgc[data-v-22c9b0bc]{background-color:#f8f6f7!important;color:#999!important}.chenggong_show[data-v-22c9b0bc]{width:100%;height:100%;position:fixed;top:0;background-color:rgba(0,0,0,.55)}.chenggong_show .tc_wrap[data-v-22c9b0bc]{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);text-align:center;width:%?520?%;height:336px}.chenggong_show .tc_wrap .tc_wrap_box[data-v-22c9b0bc]{position:relative}.chenggong_show .tc_wrap .tc_wrap_box .tc_images uni-image[data-v-22c9b0bc]{width:100%;height:336px}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn[data-v-22c9b0bc]{position:absolute;top:52.5%;left:0;right:0;margin:0 auto}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_info666[data-v-22c9b0bc]{width:%?350?%;margin:0 auto}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_info666 uni-view[data-v-22c9b0bc]:nth-child(1){border-radius:%?20?% %?20?% 0 0;font-weight:700;font-size:%?28?%;background-image:linear-gradient(90deg,#f6c152,#f2a741)!important;padding:%?10?%;color:#fff}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_info666 uni-view[data-v-22c9b0bc]:nth-child(2){font-weight:700;background-color:#fff;padding:%?30?% %?20?%;border-radius:0 0 %?20?% %?20?%;color:#ff611e;display:flex;align-items:center;justify-content:center;font-size:%?40?%}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_info666 uni-view:nth-child(2) span[data-v-22c9b0bc]{color:#ff611e;font-size:%?28?%;margin-right:%?4?%;position:relative;top:%?4?%}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_info666 uni-view:nth-child(2) uni-image[data-v-22c9b0bc]{width:%?50?%;height:%?50?%;margin-left:%?10?%}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_btn_box[data-v-22c9b0bc]{display:flex;align-items:center;padding:%?30?% %?30?% %?60?% %?30?%}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_btn_box .tc_btn_huise[data-v-22c9b0bc]{flex:1;margin-right:%?12?%;background:linear-gradient(90deg,#f7f7f7,50%,#f7f7f7);border-radius:%?200?%;padding:%?28?% 0;text-align:center;color:#333}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_btn_box .tc_btn_huise_err[data-v-22c9b0bc]{flex:1;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff;border-radius:%?200?%;padding:%?28?% 0;text-align:center}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_btn_box .lijipay[data-v-22c9b0bc]{width:%?350?%;margin-left:%?12?%;position:relative;margin:0 auto;border:%?2?% solid #fe9400;border-radius:%?200?%}.chenggong_show .tc_wrap .tc_wrap_box .tc_wrap_btn .tc_btn_box .lijipay .u-size-default[data-v-22c9b0bc]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#ef874b,#eb5f32)!important;color:#fff}",""]),t.exports=i},6728:function(t,i,e){"use strict";var a=e("54c8"),n=e.n(a);n.a},"69a4":function(t,i,e){"use strict";e.d(i,"b",(function(){return a})),e.d(i,"c",(function(){return n})),e.d(i,"a",(function(){}));var a=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-button",{staticClass:"u-btn u-line-1 u-fix-ios-appearance",class:["u-size-"+t.size,t.plain?"u-btn--"+t.type+"--plain":"",t.loading?"u-loading":"","circle"==t.shape?"u-round-circle":"",t.hairLine?t.showHairLineBorder:"u-btn--bold-border","u-btn--"+t.type,t.disabled?"u-btn--"+t.type+"--disabled":""],style:[t.customStyle,{overflow:t.ripple?"hidden":"visible"}],attrs:{id:"u-wave-btn","hover-start-time":Number(t.hoverStartTime),"hover-stay-time":Number(t.hoverStayTime),disabled:t.disabled,"form-type":t.formType,"open-type":t.openType,"app-parameter":t.appParameter,"hover-stop-propagation":t.hoverStopPropagation,"send-message-title":t.sendMessageTitle,"send-message-path":"sendMessagePath",lang:t.lang,"data-name":t.dataName,"session-from":t.sessionFrom,"send-message-img":t.sendMessageImg,"show-message-card":t.showMessageCard,"hover-class":t.getHoverClass,loading:t.loading},on:{getphonenumber:function(i){arguments[0]=i=t.$handleEvent(i),t.getphonenumber.apply(void 0,arguments)},getuserinfo:function(i){arguments[0]=i=t.$handleEvent(i),t.getuserinfo.apply(void 0,arguments)},error:function(i){arguments[0]=i=t.$handleEvent(i),t.error.apply(void 0,arguments)},opensetting:function(i){arguments[0]=i=t.$handleEvent(i),t.opensetting.apply(void 0,arguments)},launchapp:function(i){arguments[0]=i=t.$handleEvent(i),t.launchapp.apply(void 0,arguments)},click:function(i){i.stopPropagation(),arguments[0]=i=t.$handleEvent(i),t.click(i)}}},[t._t("default"),t.ripple?e("v-uni-view",{staticClass:"u-wave-ripple",class:[t.waveActive?"u-wave-active":""],style:{top:t.rippleTop+"px",left:t.rippleLeft+"px",width:t.fields.targetWidth+"px",height:t.fields.targetWidth+"px","background-color":t.rippleBgColor||"rgba(0, 0, 0, 0.15)"}}):t._e()],2)},n=[]},"6ed6":function(t,i,e){"use strict";e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,e("a9e3");var a={name:"u-section",props:{title:{type:String,default:""},subTitle:{type:String,default:"更多"},right:{type:Boolean,default:!0},fontSize:{type:[Number,String],default:28},bold:{type:Boolean,default:!0},color:{type:String,default:"#303133"},subColor:{type:String,default:"#909399"},showLine:{type:Boolean,default:!0},lineColor:{type:String,default:""},arrow:{type:Boolean,default:!0}},computed:{lineStyle:function(){return{left:-.9*Number(this.fontSize)+"rpx",top:-Number(this.fontSize)*("ios"==this.$u.os()?.14:.15)+"rpx"}}},methods:{rightClick:function(){this.$emit("click")}}};i.default=a},"73d3":function(t,i,e){"use strict";e.r(i);var a=e("8de1"),n=e.n(a);for(var o in a)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(o);i["default"]=n.a},8259:function(t,i,e){"use strict";var a=e("bde6"),n=e.n(a);n.a},"8de1":function(t,i,e){"use strict";e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,e("a9e3");var a={name:"u-col",props:{span:{type:[Number,String],default:12},offset:{type:[Number,String],default:0},justify:{type:String,default:"start"},align:{type:String,default:"center"},textAlign:{type:String,default:"left"},stop:{type:Boolean,default:!0}},data:function(){return{gutter:20}},created:function(){this.parent=!1},mounted:function(){this.parent=this.$u.$parent.call(this,"u-row"),this.parent&&(this.gutter=this.parent.gutter)},computed:{uJustify:function(){return"end"==this.justify||"start"==this.justify?"flex-"+this.justify:"around"==this.justify||"between"==this.justify?"space-"+this.justify:this.justify},uAlignItem:function(){return"top"==this.align?"flex-start":"bottom"==this.align?"flex-end":this.align}},methods:{click:function(t){this.$emit("click")}}};i.default=a},"8ec3":function(t,i,e){var a=e("b20c");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=e("4f06").default;n("68726160",a,!0,{sourceMap:!1,shadowMode:!1})},"92d7":function(t,i,e){"use strict";e.r(i);var a=e("e709"),n=e("a763");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(o);e("270c");var r=e("f0c5"),c=Object(r["a"])(n["default"],a["b"],a["c"],!1,null,"22c9b0bc",null,!1,a["a"],void 0);i["default"]=c.exports},"96d7":function(t,i,e){"use strict";e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,e("a9e3"),e("c975"),e("d3b7"),e("ac1f");var a={name:"u-button",props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:function(){return{}}},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:1e3},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150}},computed:{getHoverClass:function(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";var t;return t=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",t},showHairLineBorder:function(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data:function(){return{rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click:function(t){var i=this;this.$u.throttle((function(){!0!==i.loading&&!0!==i.disabled&&(i.ripple&&(i.waveActive=!1,i.$nextTick((function(){this.getWaveQuery(t)}))),i.$emit("click",t))}),this.throttleTime)},getWaveQuery:function(t){var i=this;this.getElQuery().then((function(e){var a=e[0];if(a.width&&a.width&&(a.targetWidth=a.height>a.width?a.height:a.width,a.targetWidth)){i.fields=a;var n,o;n=t.touches[0].clientX,o=t.touches[0].clientY,i.rippleTop=o-a.top-a.targetWidth/2,i.rippleLeft=n-a.left-a.targetWidth/2,i.$nextTick((function(){i.waveActive=!0}))}}))},getElQuery:function(){var t=this;return new Promise((function(i){var e="";e=uni.createSelectorQuery().in(t),e.select(".u-btn").boundingClientRect(),e.exec((function(t){i(t)}))}))},getphonenumber:function(t){this.$emit("getphonenumber",t)},getuserinfo:function(t){this.$emit("getuserinfo",t)},error:function(t){this.$emit("error",t)},opensetting:function(t){this.$emit("opensetting",t)},launchapp:function(t){this.$emit("launchapp",t)}}};i.default=a},"99c5":function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,".u-row[data-v-3a08278e]{display:flex;flex-direction:row;flex-wrap:wrap}",""]),t.exports=i},"9e90":function(t,i,e){"use strict";e.r(i);var a=e("bc33"),n=e("3fec");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(o);e("8259");var r=e("f0c5"),c=Object(r["a"])(n["default"],a["b"],a["c"],!1,null,"3a08278e",null,!1,a["a"],void 0);i["default"]=c.exports},a4bf:function(t,i,e){"use strict";e.r(i);var a=e("96d7"),n=e.n(a);for(var o in a)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(o);i["default"]=n.a},a763:function(t,i,e){"use strict";e.r(i);var a=e("040b"),n=e.n(a);for(var o in a)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(o);i["default"]=n.a},a9f0:function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,'.u-btn[data-v-52fefc8e]::after{border:none}.u-btn[data-v-52fefc8e]{position:relative;border:0;display:inline-flex;overflow:visible;line-height:1;display:flex;flex-direction:row;align-items:center;justify-content:center;cursor:pointer;padding:0 %?40?%;z-index:1;box-sizing:border-box;transition:all .15s}.u-btn--bold-border[data-v-52fefc8e]{border:1px solid #fff}.u-btn--default[data-v-52fefc8e]{color:#606266;border-color:#c0c4cc;background-color:#fff}.u-btn--primary[data-v-52fefc8e]{color:#fff;border-color:#fe6736;background-color:#fe6736}.u-btn--success[data-v-52fefc8e]{color:#fff;border-color:#19be6b;background-color:#19be6b}.u-btn--error[data-v-52fefc8e]{color:#fff;border-color:#fa3534;background-color:#fa3534}.u-btn--warning[data-v-52fefc8e]{color:#fff;border-color:#f90;background-color:#f90}.u-btn--default--disabled[data-v-52fefc8e]{color:#fff;border-color:#e4e7ed;background-color:#fff}.u-btn--primary--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#71d5a1!important;background-color:#71d5a1!important}.u-btn--error--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fab6b6!important;background-color:#fab6b6!important}.u-btn--warning--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fcbd71!important;background-color:#fcbd71!important}.u-btn--primary--plain[data-v-52fefc8e]{color:#fe6736!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--plain[data-v-52fefc8e]{color:#19be6b!important;border-color:#71d5a1!important;background-color:#dbf1e1!important}.u-btn--error--plain[data-v-52fefc8e]{color:#fa3534!important;border-color:#fab6b6!important;background-color:#fef0f0!important}.u-btn--warning--plain[data-v-52fefc8e]{color:#f90!important;border-color:#fcbd71!important;background-color:#fdf6ec!important}.u-hairline-border[data-v-52fefc8e]:after{content:" ";position:absolute;pointer-events:none;box-sizing:border-box;-webkit-transform-origin:0 0;transform-origin:0 0;left:0;top:0;width:199.8%;height:199.7%;-webkit-transform:scale(.5);transform:scale(.5);border:1px solid currentColor;z-index:1}.u-wave-ripple[data-v-52fefc8e]{z-index:0;position:absolute;border-radius:100%;background-clip:padding-box;pointer-events:none;-webkit-user-select:none;user-select:none;-webkit-transform:scale(0);transform:scale(0);opacity:1;-webkit-transform-origin:center;transform-origin:center}.u-wave-ripple.u-wave-active[data-v-52fefc8e]{opacity:0;-webkit-transform:scale(2);transform:scale(2);transition:opacity 1s linear,-webkit-transform .4s linear;transition:opacity 1s linear,transform .4s linear;transition:opacity 1s linear,transform .4s linear,-webkit-transform .4s linear}.u-round-circle[data-v-52fefc8e]{border-radius:%?100?%}.u-round-circle[data-v-52fefc8e]::after{border-radius:%?100?%}.u-loading[data-v-52fefc8e]::after{background-color:hsla(0,0%,100%,.35)}.u-size-default[data-v-52fefc8e]{font-size:%?30?%;height:%?70?%;line-height:%?70?%}.u-size-medium[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?26?%;height:%?70?%;line-height:%?70?%;padding:0 %?80?%}.u-size-mini[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?22?%;padding-top:1px;height:%?50?%;line-height:%?50?%;padding:0 %?20?%}.u-primary-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#ffa373!important}.u-default-plain-hover[data-v-52fefc8e]{color:#ffa373!important;background:#fff!important}.u-success-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#18b566!important}.u-warning-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#f29100!important}.u-error-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#dd6161!important}.u-info-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#5a6c76!important}.u-default-hover[data-v-52fefc8e]{color:#ffa373!important;border-color:#ffa373!important;background-color:#fff!important}.u-primary-hover[data-v-52fefc8e]{background:#ffa373!important;color:#fff}.u-success-hover[data-v-52fefc8e]{background:#18b566!important;color:#fff}.u-info-hover[data-v-52fefc8e]{background:#5a6c76!important;color:#fff}.u-warning-hover[data-v-52fefc8e]{background:#f29100!important;color:#fff}.u-error-hover[data-v-52fefc8e]{background:#dd6161!important;color:#fff}',""]),t.exports=i},b15c:function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,".u-col-0[data-v-790095f8]{width:0}.u-col-1[data-v-790095f8]{width:calc(100%/12)}.u-col-2[data-v-790095f8]{width:calc(100%/12 * 2)}.u-col-3[data-v-790095f8]{width:calc(100%/12 * 3)}.u-col-4[data-v-790095f8]{width:calc(100%/12 * 4)}.u-col-5[data-v-790095f8]{width:calc(100%/12 * 5)}.u-col-6[data-v-790095f8]{width:calc(100%/12 * 6)}.u-col-7[data-v-790095f8]{width:calc(100%/12 * 7)}.u-col-8[data-v-790095f8]{width:calc(100%/12 * 8)}.u-col-9[data-v-790095f8]{width:calc(100%/12 * 9)}.u-col-10[data-v-790095f8]{width:calc(100%/12 * 10)}.u-col-11[data-v-790095f8]{width:calc(100%/12 * 11)}.u-col-12[data-v-790095f8]{width:calc(100%/12 * 12)}",""]),t.exports=i},b20c:function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,".u-section[data-v-5f4a289b]{display:flex;flex-direction:row;justify-content:space-between;align-items:center;width:100%}.u-section__title[data-v-5f4a289b]{position:relative;font-size:%?28?%;padding-left:%?20?%;display:flex;flex-direction:row;align-items:center}.u-section__title__icon-wrap[data-v-5f4a289b]{position:absolute}.u-section__title__text[data-v-5f4a289b]{line-height:1}.u-section__right-info[data-v-5f4a289b]{color:#909399;font-size:%?26?%;display:flex;flex-direction:row;align-items:center}.u-section__right-info__icon-arrow[data-v-5f4a289b]{margin-left:%?6?%}",""]),t.exports=i},bc33:function(t,i,e){"use strict";e.d(i,"b",(function(){return a})),e.d(i,"c",(function(){return n})),e.d(i,"a",(function(){}));var a=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",{staticClass:"u-row",style:{alignItems:t.uAlignItem,justifyContent:t.uJustify},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.click.apply(void 0,arguments)}}},[t._t("default")],2)},n=[]},bde6:function(t,i,e){var a=e("99c5");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=e("4f06").default;n("6af7f8d4",a,!0,{sourceMap:!1,shadowMode:!1})},c483:function(t,i,e){"use strict";e.r(i);var a=e("3566"),n=e("73d3");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(o);e("6728");var r=e("f0c5"),c=Object(r["a"])(n["default"],a["b"],a["c"],!1,null,"790095f8",null,!1,a["a"],void 0);i["default"]=c.exports},d1af:function(t,i,e){"use strict";e.r(i);var a=e("6ed6"),n=e.n(a);for(var o in a)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(o);i["default"]=n.a},d5e9:function(t,i,e){"use strict";e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,e("a9e3");var a={name:"u-row",props:{gutter:{type:[String,Number],default:20},justify:{type:String,default:"start"},align:{type:String,default:"center"},stop:{type:Boolean,default:!0}},computed:{uJustify:function(){return"end"==this.justify||"start"==this.justify?"flex-"+this.justify:"around"==this.justify||"between"==this.justify?"space-"+this.justify:this.justify},uAlignItem:function(){return"top"==this.align?"flex-start":"bottom"==this.align?"flex-end":this.align}},methods:{click:function(t){this.$emit("click")}}};i.default=a},e709:function(t,i,e){"use strict";e.d(i,"b",(function(){return n})),e.d(i,"c",(function(){return o})),e.d(i,"a",(function(){return a}));var a={uIcon:e("21cf").default,uRow:e("9e90").default,uCol:e("c483").default,uSection:e("4fba").default,uPopup:e("627b").default,uButton:e("eeee").default},n=function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("v-uni-view",[a("v-uni-view",{staticClass:"poage_wrap"},[a("v-uni-image",{staticClass:"top_bg",attrs:{src:t.BestImgUrl+"Frame2004.jpg",mode:"widthFix"}}),a("v-uni-view",{staticClass:"content_box"},[a("v-uni-view",{staticClass:"sign_biao"},[a("v-uni-view",{staticClass:"sign_title"},[a("v-uni-view",{staticClass:"tishi"},[t._v(t._s(t.formatNum(t.month))+"月")]),a("v-uni-view",{staticClass:"kaiguan"},[a("v-uni-view",{staticClass:"my_jb"}),t._v("我的金币："),a("span",[t._v(t._s(t.guizeData.my_gold_coin))]),a("v-uni-image",{attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"mx_text",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.tomingxi()}}},[t._v("明细"),a("u-icon",{attrs:{name:"arrow-right",size:"24",color:"#999999"}})],1)],1)],1),a("v-uni-view",{staticClass:"rili"},[a("v-uni-view",[t._v("一")]),a("v-uni-view",[t._v("二")]),a("v-uni-view",[t._v("三")]),a("v-uni-view",[t._v("四")]),a("v-uni-view",[t._v("五")]),a("v-uni-view",[t._v("六")]),a("v-uni-view",[t._v("日")])],1),a("v-uni-view",{staticClass:"sign_list"},[a("v-uni-view",{staticClass:"sign_list_wrap"},[a("u-row",{attrs:{gutter:"14"}},t._l(t.dayArr,(function(i,e){return e<t.hiidemore?a("u-col",{key:e,attrs:{span:t.colSpan}},[a("v-uni-view",{staticClass:"s_list_item",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),1==i.type&&i.date==t.localDate?t.daySign(i,e):t.buqian(i,e)}}},[i.date<t.localDate?a("v-uni-view",{staticClass:"s_item_box",class:[1==i.flag&&i.date<=t.localDate?"yiqiandbg":"morenbgc"]},[i.date==t.localDate?a("v-uni-image",{attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}}):i.date>t.localDate?a("v-uni-image",{staticClass:"zhihuise",attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}}):i.date<=t.localDate&&0==i.flag?a("v-uni-image",{staticClass:"zhihuise",attrs:{src:"/static/images/buqian_icon.png",mode:"widthFix"}}):a("v-uni-image",{attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"jl_price",class:i.date>t.localDate?"zhihuise":""},[t._v(t._s(i.coin))]),i.date==t.localDate?a("v-uni-view",{staticClass:"s_riqi_tday"},[t._v("今天")]):a("v-uni-view",{staticClass:"s_riqi"},[t._v(t._s(i.day))])],1):a("v-uni-view",{staticClass:"s_item_box",class:[i.date==t.localDate?"yiqiandbg":"morenbgc"]},[i.date==t.localDate?a("v-uni-image",{attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}}):i.date>t.localDate?a("v-uni-image",{staticClass:"zhihuise",attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}}):i.date<=t.localDate&&0==i.flag?a("v-uni-image",{staticClass:"zhihuise",attrs:{src:"/static/images/buqian_icon.png",mode:"widthFix"}}):a("v-uni-image",{attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"jl_price",class:i.date>t.localDate?"zhihuise":""},[t._v(t._s(i.coin))]),i.date==t.localDate&&0==i.flag?a("v-uni-view",{staticClass:"s_riqi_tday"},[t._v("今天")]):i.date==t.localDate&&1==i.flag?a("v-uni-view",{staticClass:"s_riqi_tday"},[t._v("已签到")]):a("v-uni-view",{staticClass:"s_riqi"},[t._v(t._s(i.day))])],1)],1)],1):t._e()})),1)],1)],1)],1),a("v-uni-view",{staticClass:"liest_task"},[a("v-uni-view",{staticClass:"dh_title"},[a("u-section",{attrs:{title:"兑换区","font-size":"32",right:!1,"sub-title":"活动规则","show-line":!1}})],1),a("v-uni-view",{staticClass:"tz_list"},[a("v-uni-view",{staticClass:"tz_list_item"},[a("v-uni-image",{attrs:{src:"/static/images/sign_1859.png"}}),a("v-uni-view",{staticClass:"tz_item_info"},[a("v-uni-view",{staticClass:"tz_title"},[a("v-uni-view",[t._v("7天会员体验卡")])],1),a("v-uni-view",{staticClass:"tz_content"},[t._v("+"+t._s(t.guizeData.week_member_gold_coin)),a("v-uni-image",{attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}})],1)],1),a("v-uni-view",{staticClass:"btm",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.duihuaVip("week")}}},[t._v("兑换")])],1),a("v-uni-view",{staticClass:"tz_list_item"},[a("v-uni-image",{attrs:{src:"/static/images/sign_1858.png"}}),a("v-uni-view",{staticClass:"tz_item_info"},[a("v-uni-view",{staticClass:"tz_title"},[a("v-uni-view",[t._v("30天会员体验卡")])],1),a("v-uni-view",{staticClass:"tz_content"},[t._v("+"+t._s(t.guizeData.month_member_gold_coin)),a("v-uni-image",{attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}})],1)],1),a("v-uni-view",{staticClass:"btm",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.duihuaVip("month")}}},[t._v("兑换")])],1)],1)],1)],1)],1),a("u-popup",{attrs:{mode:"center",width:"550","border-radius":"38"},model:{value:t.bdingPhone_Show,callback:function(i){t.bdingPhone_Show=i},expression:"bdingPhone_Show"}},[a("v-uni-view",{staticClass:"tc_wrap"},[a("v-uni-view",{staticClass:"tc_images"},[a("v-uni-image",{attrs:{src:t.BestImgUrl+"me/lhy_Mask-group.png"}})],1),a("v-uni-view",{staticClass:"tc_info"},[a("v-uni-view",[t._v("兑换成功！")]),a("v-uni-view",[t._v("您已成为呵味惠会员")])],1),a("v-uni-view",{staticClass:"tc_btn_box"},[a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle"},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.bdingPhone_Show=!1}}},[t._v("确定")])],1)],1)],1)],1),a("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.qiancheng_Show,expression:"qiancheng_Show"}],staticClass:"chenggong_show",attrs:{catchtouchmove:"true"},on:{touchmove:function(i){i.preventDefault(),arguments[0]=i=t.$handleEvent(i)}}},[a("v-uni-view",{staticClass:"tc_wrap"},[a("v-uni-view",{staticClass:"tc_wrap_box"},[a("v-uni-view",{staticClass:"tc_images"},[a("v-uni-image",{attrs:{src:t.BestImgUrl+"Group-44478.png",mode:"widthFix"}})],1),a("v-uni-view",{staticClass:"jinbiGif"},[a("v-uni-image",{attrs:{src:t.BestImgUrl+"jinbi.gif",mode:"widthFix"}})],1),a("v-uni-view",{staticClass:"tc_wrap_btn"},[a("v-uni-view",{staticClass:"tc_info666"},[a("v-uni-view",[t._v("恭喜你获得")]),a("v-uni-view",[a("span",[t._v("¥")]),t._v(t._s(t.cudcoin)),a("v-uni-image",{attrs:{src:e("5a6a")}})],1)],1),a("v-uni-view",{staticClass:"tc_btn_box"},[a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle"},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.qiancheng_Show=!1}}},[t._v("我知道了")])],1)],1)],1)],1)],1)],1)],1)},o=[]},eeee:function(t,i,e){"use strict";e.r(i);var a=e("69a4"),n=e("a4bf");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(o);e("0361");var r=e("f0c5"),c=Object(r["a"])(n["default"],a["b"],a["c"],!1,null,"52fefc8e",null,!1,a["a"],void 0);i["default"]=c.exports},fa1a:function(t,i,e){"use strict";var a=e("8ec3"),n=e.n(a);n.a}}]);