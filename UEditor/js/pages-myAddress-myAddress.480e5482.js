(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-myAddress-myAddress"],{"0361":function(e,t,a){"use strict";var i=a("0dab"),n=a.n(i);n.a},"0c3b":function(e,t,a){"use strict";(function(e){a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("e9c4");var i=getApp(),n={data:function(){return{addresList:[],BestImgUrl:i.globalData.imgurl}},onLoad:function(){},onShow:function(){this.getlist()},methods:{getlist:function(){var e=this;e.$api.shAddresslist({page:1,limit:10}).then((function(t){e.addresList=t.data.result})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))},newadd:function(){uni.navigateTo({url:"/pages/myAddress/newAddress"})},bianji:function(e){uni.navigateTo({url:"/pages/myAddress/editAddress?data="+encodeURIComponent(JSON.stringify(e))})},fanhuiHome:function(t){e("log",t," at pages/myAddress/myAddress.vue:85"),uni.setStorageSync("lat",t.latitude),uni.setStorageSync("lng",t.longitude),uni.setStorageSync("address",t.address),uni.$emit("Getlist",{id:1}),uni.navigateBack()}}};t.default=n}).call(this,a("0de9")["log"])},"0dab":function(e,t,a){var i=a("a9f0");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var n=a("4f06").default;n("9bea869c",i,!0,{sourceMap:!1,shadowMode:!1})},3744:function(e,t,a){var i=a("5d8b");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var n=a("4f06").default;n("20311180",i,!0,{sourceMap:!1,shadowMode:!1})},"5d8b":function(e,t,a){var i=a("24fb");t=i(!1),t.push([e.i,".address_list[data-v-68bc1164]{padding-bottom:%?140?%}.address_list .list_item[data-v-68bc1164]{display:flex;align-items:center;padding:%?26?% %?30?%;border-bottom:1px solid #f3f3f3}.address_list .list_item .a_name[data-v-68bc1164]{flex:1}.address_list .list_item .a_name .dizhi[data-v-68bc1164]{font-size:%?28?%;color:#333;display:flex;align-items:center}.address_list .list_item .a_name .dizhi .moren[data-v-68bc1164]{font-size:%?24?%;background-color:#05b6fd;color:#fff;border-radius:%?10?%;padding:%?2?% %?10?%;margin-right:%?6?%}.address_list .list_item .a_name .dizhi .tueAddres[data-v-68bc1164]{word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.address_list .list_item .a_name .u_name[data-v-68bc1164]{font-size:%?24?%;color:#999}.address_list .list_item .a_name .u_name uni-text[data-v-68bc1164]:nth-child(2){padding-left:%?30?%}.address_list .list_item .a_edit[data-v-68bc1164]{margin-left:auto}.address[data-v-68bc1164]{margin-left:auto;padding-right:%?30?%;color:#fe9400}.lijipay[data-v-68bc1164]{width:90%;margin-top:%?100?%;position:fixed;left:0;right:0;margin:0 auto;bottom:2%}.lijipay .u-size-default[data-v-68bc1164]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.noData_box[data-v-68bc1164]{margin-top:%?200?%;text-align:center;color:#999}.noData_box uni-image[data-v-68bc1164]{width:%?340?%}.noData_box .lijipay[data-v-68bc1164]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-68bc1164]{height:%?70?%!important;line-height:%?70?%!important}",""]),e.exports=t},"5e84":function(e,t,a){"use strict";a.r(t);var i=a("c117"),n=a("e791");for(var r in n)["default"].indexOf(r)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(r);a("e4ea");var o=a("f0c5"),d=Object(o["a"])(n["default"],i["b"],i["c"],!1,null,"68bc1164",null,!1,i["a"],void 0);t["default"]=d.exports},"69a4":function(e,t,a){"use strict";a.d(t,"b",(function(){return i})),a.d(t,"c",(function(){return n})),a.d(t,"a",(function(){}));var i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-button",{staticClass:"u-btn u-line-1 u-fix-ios-appearance",class:["u-size-"+e.size,e.plain?"u-btn--"+e.type+"--plain":"",e.loading?"u-loading":"","circle"==e.shape?"u-round-circle":"",e.hairLine?e.showHairLineBorder:"u-btn--bold-border","u-btn--"+e.type,e.disabled?"u-btn--"+e.type+"--disabled":""],style:[e.customStyle,{overflow:e.ripple?"hidden":"visible"}],attrs:{id:"u-wave-btn","hover-start-time":Number(e.hoverStartTime),"hover-stay-time":Number(e.hoverStayTime),disabled:e.disabled,"form-type":e.formType,"open-type":e.openType,"app-parameter":e.appParameter,"hover-stop-propagation":e.hoverStopPropagation,"send-message-title":e.sendMessageTitle,"send-message-path":"sendMessagePath",lang:e.lang,"data-name":e.dataName,"session-from":e.sessionFrom,"send-message-img":e.sendMessageImg,"show-message-card":e.showMessageCard,"hover-class":e.getHoverClass,loading:e.loading},on:{getphonenumber:function(t){arguments[0]=t=e.$handleEvent(t),e.getphonenumber.apply(void 0,arguments)},getuserinfo:function(t){arguments[0]=t=e.$handleEvent(t),e.getuserinfo.apply(void 0,arguments)},error:function(t){arguments[0]=t=e.$handleEvent(t),e.error.apply(void 0,arguments)},opensetting:function(t){arguments[0]=t=e.$handleEvent(t),e.opensetting.apply(void 0,arguments)},launchapp:function(t){arguments[0]=t=e.$handleEvent(t),e.launchapp.apply(void 0,arguments)},click:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t),e.click(t)}}},[e._t("default"),e.ripple?a("v-uni-view",{staticClass:"u-wave-ripple",class:[e.waveActive?"u-wave-active":""],style:{top:e.rippleTop+"px",left:e.rippleLeft+"px",width:e.fields.targetWidth+"px",height:e.fields.targetWidth+"px","background-color":e.rippleBgColor||"rgba(0, 0, 0, 0.15)"}}):e._e()],2)},n=[]},"96d7":function(e,t,a){"use strict";a("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a9e3"),a("c975"),a("d3b7"),a("ac1f");var i={name:"u-button",props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:function(){return{}}},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:1e3},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150}},computed:{getHoverClass:function(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";var e;return e=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",e},showHairLineBorder:function(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data:function(){return{rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click:function(e){var t=this;this.$u.throttle((function(){!0!==t.loading&&!0!==t.disabled&&(t.ripple&&(t.waveActive=!1,t.$nextTick((function(){this.getWaveQuery(e)}))),t.$emit("click",e))}),this.throttleTime)},getWaveQuery:function(e){var t=this;this.getElQuery().then((function(a){var i=a[0];if(i.width&&i.width&&(i.targetWidth=i.height>i.width?i.height:i.width,i.targetWidth)){t.fields=i;var n,r;n=e.touches[0].clientX,r=e.touches[0].clientY,t.rippleTop=r-i.top-i.targetWidth/2,t.rippleLeft=n-i.left-i.targetWidth/2,t.$nextTick((function(){t.waveActive=!0}))}}))},getElQuery:function(){var e=this;return new Promise((function(t){var a="";a=uni.createSelectorQuery().in(e),a.select(".u-btn").boundingClientRect(),a.exec((function(e){t(e)}))}))},getphonenumber:function(e){this.$emit("getphonenumber",e)},getuserinfo:function(e){this.$emit("getuserinfo",e)},error:function(e){this.$emit("error",e)},opensetting:function(e){this.$emit("opensetting",e)},launchapp:function(e){this.$emit("launchapp",e)}}};t.default=i},a4bf:function(e,t,a){"use strict";a.r(t);var i=a("96d7"),n=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(r);t["default"]=n.a},a9f0:function(e,t,a){var i=a("24fb");t=i(!1),t.push([e.i,'.u-btn[data-v-52fefc8e]::after{border:none}.u-btn[data-v-52fefc8e]{position:relative;border:0;display:inline-flex;overflow:visible;line-height:1;display:flex;flex-direction:row;align-items:center;justify-content:center;cursor:pointer;padding:0 %?40?%;z-index:1;box-sizing:border-box;transition:all .15s}.u-btn--bold-border[data-v-52fefc8e]{border:1px solid #fff}.u-btn--default[data-v-52fefc8e]{color:#606266;border-color:#c0c4cc;background-color:#fff}.u-btn--primary[data-v-52fefc8e]{color:#fff;border-color:#fe6736;background-color:#fe6736}.u-btn--success[data-v-52fefc8e]{color:#fff;border-color:#19be6b;background-color:#19be6b}.u-btn--error[data-v-52fefc8e]{color:#fff;border-color:#fa3534;background-color:#fa3534}.u-btn--warning[data-v-52fefc8e]{color:#fff;border-color:#f90;background-color:#f90}.u-btn--default--disabled[data-v-52fefc8e]{color:#fff;border-color:#e4e7ed;background-color:#fff}.u-btn--primary--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#71d5a1!important;background-color:#71d5a1!important}.u-btn--error--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fab6b6!important;background-color:#fab6b6!important}.u-btn--warning--disabled[data-v-52fefc8e]{color:#fff!important;border-color:#fcbd71!important;background-color:#fcbd71!important}.u-btn--primary--plain[data-v-52fefc8e]{color:#fe6736!important;border-color:#fff!important;background-color:#fff!important}.u-btn--success--plain[data-v-52fefc8e]{color:#19be6b!important;border-color:#71d5a1!important;background-color:#dbf1e1!important}.u-btn--error--plain[data-v-52fefc8e]{color:#fa3534!important;border-color:#fab6b6!important;background-color:#fef0f0!important}.u-btn--warning--plain[data-v-52fefc8e]{color:#f90!important;border-color:#fcbd71!important;background-color:#fdf6ec!important}.u-hairline-border[data-v-52fefc8e]:after{content:" ";position:absolute;pointer-events:none;box-sizing:border-box;-webkit-transform-origin:0 0;transform-origin:0 0;left:0;top:0;width:199.8%;height:199.7%;-webkit-transform:scale(.5);transform:scale(.5);border:1px solid currentColor;z-index:1}.u-wave-ripple[data-v-52fefc8e]{z-index:0;position:absolute;border-radius:100%;background-clip:padding-box;pointer-events:none;-webkit-user-select:none;user-select:none;-webkit-transform:scale(0);transform:scale(0);opacity:1;-webkit-transform-origin:center;transform-origin:center}.u-wave-ripple.u-wave-active[data-v-52fefc8e]{opacity:0;-webkit-transform:scale(2);transform:scale(2);transition:opacity 1s linear,-webkit-transform .4s linear;transition:opacity 1s linear,transform .4s linear;transition:opacity 1s linear,transform .4s linear,-webkit-transform .4s linear}.u-round-circle[data-v-52fefc8e]{border-radius:%?100?%}.u-round-circle[data-v-52fefc8e]::after{border-radius:%?100?%}.u-loading[data-v-52fefc8e]::after{background-color:hsla(0,0%,100%,.35)}.u-size-default[data-v-52fefc8e]{font-size:%?30?%;height:%?70?%;line-height:%?70?%}.u-size-medium[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?26?%;height:%?70?%;line-height:%?70?%;padding:0 %?80?%}.u-size-mini[data-v-52fefc8e]{display:inline-flex;width:auto;font-size:%?22?%;padding-top:1px;height:%?50?%;line-height:%?50?%;padding:0 %?20?%}.u-primary-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#ffa373!important}.u-default-plain-hover[data-v-52fefc8e]{color:#ffa373!important;background:#fff!important}.u-success-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#18b566!important}.u-warning-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#f29100!important}.u-error-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#dd6161!important}.u-info-plain-hover[data-v-52fefc8e]{color:#fff!important;background:#5a6c76!important}.u-default-hover[data-v-52fefc8e]{color:#ffa373!important;border-color:#ffa373!important;background-color:#fff!important}.u-primary-hover[data-v-52fefc8e]{background:#ffa373!important;color:#fff}.u-success-hover[data-v-52fefc8e]{background:#18b566!important;color:#fff}.u-info-hover[data-v-52fefc8e]{background:#5a6c76!important;color:#fff}.u-warning-hover[data-v-52fefc8e]{background:#f29100!important;color:#fff}.u-error-hover[data-v-52fefc8e]{background:#dd6161!important;color:#fff}',""]),e.exports=t},c117:function(e,t,a){"use strict";a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return r})),a.d(t,"a",(function(){return i}));var i={uIcon:a("21cf").default,uButton:a("eeee").default},n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",[0!=e.addresList.length?a("v-uni-view",{staticClass:"address_list"},e._l(e.addresList,(function(t,i){return a("v-uni-view",{key:i,staticClass:"list_item"},[a("v-uni-view",{staticClass:"a_name",on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.fanhuiHome(t)}}},[a("v-uni-view",{staticClass:"dizhi"},[1==t.is_default?a("span",{staticClass:"moren"},[e._v("默认")]):e._e(),a("v-uni-view",{staticClass:"tueAddres"},[e._v(e._s(t.address)+" "+e._s(t.house_number))])],1),a("v-uni-view",{staticClass:"u_name"},[a("v-uni-text",[e._v(e._s(t.name)+" "+e._s(t.sex))]),a("v-uni-text",[e._v(e._s(t.tel))])],1)],1),a("v-uni-view",{staticClass:"a_edit"},[a("u-icon",{attrs:{name:"/static/images/bianji.png",size:"42",color:"#000000"},on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.bianji(t)}}})],1)],1)})),1):a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:e.BestImgUrl+"noAddrss.png",mode:"widthFix"}}),a("v-uni-view",[e._v("暂无地址")])],1),a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.newadd()}}},[e._v("新增地址")])],1)],1)},r=[]},e4ea:function(e,t,a){"use strict";var i=a("3744"),n=a.n(i);n.a},e791:function(e,t,a){"use strict";a.r(t);var i=a("0c3b"),n=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(r);t["default"]=n.a},eeee:function(e,t,a){"use strict";a.r(t);var i=a("69a4"),n=a("a4bf");for(var r in n)["default"].indexOf(r)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(r);a("0361");var o=a("f0c5"),d=Object(o["a"])(n["default"],i["b"],i["c"],!1,null,"52fefc8e",null,!1,i["a"],void 0);t["default"]=d.exports}}]);