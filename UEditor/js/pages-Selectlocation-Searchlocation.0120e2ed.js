(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-Selectlocation-Searchlocation"],{"0378":function(t,e,a){"use strict";a.d(e,"b",(function(){return o})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return i}));var i={uSearch:a("e618").default},o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[a("v-uni-view",{staticClass:"map-wrap"},[a("v-uni-view",{staticClass:"map-top"},[a("v-uni-view",{staticClass:"sousuokuang"},[a("u-search",{attrs:{placeholder:"搜索位置",color:"#333",focus:!0,"search-icon-color":"#999","show-action":!1,"bg-color":"#f7f7f7"},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.searchchange.apply(void 0,arguments)}},model:{value:t.sousuokey,callback:function(e){t.sousuokey=e},expression:"sousuokey"}})],1)],1),0!=t.poiss.length?a("v-uni-view",{staticClass:"x-weizhi-list-wrap"},t._l(t.poiss,(function(e,i){return a("v-uni-view",{key:i,staticClass:"addresxuanze",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.OkSelect(e,i)}}},[a("v-uni-view",{staticClass:"xiangxidizhi"},[a("v-uni-rich-text",{attrs:{nodes:e.title}}),a("v-uni-view",[t._v(t._s(e.address))])],1)],1)})),1):a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:"/static/images/noData.png",mode:"widthFix"}}),a("v-uni-view",[t._v("暂无位置")])],1)],1)],1)},n=[]},"1a45":function(t,e,a){"use strict";(function(t){a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("d3b7"),a("159b"),a("14d9"),a("4d63"),a("c607"),a("ac1f"),a("2c3e"),a("25f0"),a("5319");var i={data:function(){return{mapshow:!1,sousuokey:"",poiss:[],morenidx:-1,chengshi:"当前位置",latitude:"",longitude:""}},onLoad:function(e){t("log",e," at pages/Selectlocation/Searchlocation.vue:47");this.latitude=e.lat,this.longitude=e.log},methods:{searchchange:function(e){var a=this;a.morenidx=0;var i=a.longitude,o=a.latitude;a.$jsonp("https://apis.map.qq.com/ws/place/v1/suggestion",{page_size:20,page_index:1,keyword:a.sousuokey,key:"7DZBZ-Q5BWK-23ZJ7-AOV3F-4VZBZ-NCFO3",region:uni.getStorageSync("CityName"),region_fix:1,location:o+","+i,output:"jsonp"}).then((function(i){if(0===i.status)if(t("log","H5-1",i," at pages/Selectlocation/Searchlocation.vue:86"),0===i.data.length)uni.showToast({title:"暂无数据",icon:"none",duration:2e3});else{var o=[];i.data.forEach((function(t,i){o.push({ad_info:{adcode:t.adcode,city:t.city,district:t.district,province:t.province},address:t.address,category:t.category,id:t.id,location:{lat:t.location.lat,lng:t.location.lng},title:a.join(t.title,e),lstTitle:t.title,type:t.type})})),a.poiss=o}else a.poiss=[]})).catch((function(t){}))},join:function(t,e){var a=new RegExp("(".concat(e,")"),"gm");return t.replace(a,'<span style="color:#FF611E;font-weight:bold;">$1</span>')},OkSelect:function(e,a){t("log",e," at pages/Selectlocation/Searchlocation.vue:295");this.morenidx=a;var i=e.ad_info.city,o=uni.getStorageSync("CityName");if(o!=i)uni.showModal({title:"提示",showCancel:!1,content:"不能切换到定位之外的其他城市",confirmText:"我知道了",success:function(e){e.confirm?t("log","用户点击确定"," at pages/Selectlocation/Searchlocation.vue:312"):e.cancel&&t("log","用户点击取消"," at pages/Selectlocation/Searchlocation.vue:314")}});else{var n={address:{poistitle:e.lstTitle,address:e.address},longitude:e.location.lng,latitude:e.location.lat};uni.$emit("GetAddressData",{data:n}),uni.navigateBack({delta:2})}}}};e.default=i}).call(this,a("0de9")["log"])},2887:function(t,e,a){var i=a("a991");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("19ca80db",i,!0,{sourceMap:!1,shadowMode:!1})},3609:function(t,e,a){"use strict";a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("a9e3");var i={name:"u-search",props:{shape:{type:String,default:"round"},bgColor:{type:String,default:"#f2f2f2"},placeholder:{type:String,default:"请输入关键字"},clearabled:{type:Boolean,default:!0},focus:{type:Boolean,default:!1},showAction:{type:Boolean,default:!0},actionStyle:{type:Object,default:function(){return{}}},actionText:{type:String,default:"搜索"},inputAlign:{type:String,default:"left"},disabled:{type:Boolean,default:!1},animation:{type:Boolean,default:!1},borderColor:{type:String,default:"none"},value:{type:String,default:""},height:{type:[Number,String],default:64},inputStyle:{type:Object,default:function(){return{}}},maxlength:{type:[Number,String],default:"-1"},searchIconColor:{type:String,default:""},color:{type:String,default:"#606266"},placeholderColor:{type:String,default:"#909399"},margin:{type:String,default:"0"},searchIcon:{type:String,default:"search"}},data:function(){return{keyword:"",showClear:!1,show:!1,focused:this.focus}},watch:{keyword:function(t){this.$emit("input",t),this.$emit("change",t)},value:{immediate:!0,handler:function(t){this.keyword=t}}},computed:{showActionBtn:function(){return!(this.animation||!this.showAction)},borderStyle:function(){return this.borderColor?"1px solid ".concat(this.borderColor):"none"}},methods:{inputChange:function(t){this.keyword=t.detail.value},clear:function(){var t=this;this.keyword="",this.$nextTick((function(){t.$emit("clear")}))},search:function(t){this.$emit("search",t.detail.value);try{uni.hideKeyboard()}catch(t){}},custom:function(){this.$emit("custom",this.keyword);try{uni.hideKeyboard()}catch(t){}},getFocus:function(){this.focused=!0,this.animation&&this.showAction&&(this.show=!0),this.$emit("focus",this.keyword)},blur:function(){var t=this;setTimeout((function(){t.focused=!1}),100),this.show=!1,this.$emit("blur",this.keyword)},clickHandler:function(){this.disabled&&this.$emit("click")}}};e.default=i},"40d0":function(t,e,a){var i=a("4354");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("d6bf173e",i,!0,{sourceMap:!1,shadowMode:!1})},4354:function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,".noData_box[data-v-a73b2d80]{margin-top:0;text-align:center;color:#999}.noData_box uni-image[data-v-a73b2d80]{width:%?340?%}.noData_box .lijipay[data-v-a73b2d80]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-a73b2d80]{height:%?70?%!important;line-height:%?70?%!important}.map-wrap[data-v-a73b2d80]{padding:%?30?%}.map-wrap .map-top[data-v-a73b2d80]{background-color:#fff}.map-wrap .map-top .bianbiano[data-v-a73b2d80]{width:%?100?%;height:%?10?%;background-color:#eaeaea;border-radius:%?200?%;margin:%?30?% auto %?30?%}.map-wrap .xzbgcolor[data-v-a73b2d80]{background-color:#ffe62e!important;color:#333!important}.map-wrap .xzbgcolor uni-view[data-v-a73b2d80]:nth-child(2){color:#333!important}.map-wrap .sousuokuang[data-v-a73b2d80]{margin-bottom:%?30?%}.map-wrap .x-weizhi-list-wrap[data-v-a73b2d80]{padding:0 0 0 0}.map-wrap .x-weizhi-list-wrap .addresxuanze[data-v-a73b2d80]{background-color:#f7f7f7;border-radius:%?14?%;padding:%?26?% %?20?%;margin-bottom:%?30?%;position:relative;display:flex;align-items:center;justify-content:space-between}.map-wrap .x-weizhi-list-wrap .addresxuanze .xiangxidizhi uni-view[data-v-a73b2d80]:nth-child(1){margin-bottom:%?10?%;font-weight:700;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.map-wrap .x-weizhi-list-wrap .addresxuanze .xiangxidizhi uni-view[data-v-a73b2d80]:nth-child(2){display:flex;align-items:center;color:#999;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}",""]),t.exports=e},"68b0":function(t,e,a){"use strict";a.d(e,"b",(function(){return o})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return i}));var i={uIcon:a("21cf").default},o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"u-search",style:{margin:t.margin},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.clickHandler.apply(void 0,arguments)}}},[a("v-uni-view",{staticClass:"u-content",style:{backgroundColor:t.bgColor,borderRadius:"round"==t.shape?"100rpx":"10rpx",border:t.borderStyle,height:t.height+"rpx"}},[a("v-uni-view",{staticClass:"u-icon-wrap"},[a("u-icon",{staticClass:"u-clear-icon",attrs:{size:36,name:t.searchIcon,color:t.searchIconColor?t.searchIconColor:t.color}})],1),a("v-uni-input",{staticClass:"u-input",style:[{textAlign:t.inputAlign,color:t.color,backgroundColor:t.bgColor},t.inputStyle],attrs:{"confirm-type":"search",value:t.value,disabled:t.disabled,focus:t.focus,maxlength:t.maxlength,"placeholder-class":"u-placeholder-class",placeholder:t.placeholder,"placeholder-style":"color: "+t.placeholderColor,type:"text"},on:{blur:function(e){arguments[0]=e=t.$handleEvent(e),t.blur.apply(void 0,arguments)},confirm:function(e){arguments[0]=e=t.$handleEvent(e),t.search.apply(void 0,arguments)},input:function(e){arguments[0]=e=t.$handleEvent(e),t.inputChange.apply(void 0,arguments)},focus:function(e){arguments[0]=e=t.$handleEvent(e),t.getFocus.apply(void 0,arguments)}}}),t.keyword&&t.clearabled&&t.focused?a("v-uni-view",{staticClass:"u-close-wrap",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.clear.apply(void 0,arguments)}}},[a("u-icon",{staticClass:"u-clear-icon",attrs:{name:"close-circle-fill",size:"34",color:"#c0c4cc"}})],1):t._e()],1),a("v-uni-view",{staticClass:"u-action",class:[t.showActionBtn||t.show?"u-action-active":""],style:[t.actionStyle],on:{click:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e),t.custom.apply(void 0,arguments)}}},[t._v(t._s(t.actionText))])],1)},n=[]},"72f3":function(t,e,a){"use strict";a.r(e);var i=a("1a45"),o=a.n(i);for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);e["default"]=o.a},"75ac":function(t,e,a){"use strict";a.r(e);var i=a("0378"),o=a("72f3");for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);a("ea62");var c=a("f0c5"),r=Object(c["a"])(o["default"],i["b"],i["c"],!1,null,"a73b2d80",null,!1,i["a"],void 0);e["default"]=r.exports},a2d9:function(t,e,a){"use strict";var i=a("2887"),o=a.n(i);o.a},a991:function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,".u-search[data-v-901b6f94]{display:flex;flex-direction:row;align-items:center;flex:1}.u-content[data-v-901b6f94]{display:flex;flex-direction:row;align-items:center;padding:0 %?18?%;flex:1}.u-clear-icon[data-v-901b6f94]{display:flex;flex-direction:row;align-items:center}.u-input[data-v-901b6f94]{flex:1;font-size:%?28?%;line-height:1;margin:0 %?6?%;color:#909399}.u-close-wrap[data-v-901b6f94]{width:%?40?%;height:100%;display:flex;flex-direction:row;align-items:center;justify-content:center;border-radius:50%}.u-placeholder-class[data-v-901b6f94]{color:#909399}.u-action[data-v-901b6f94]{font-size:%?28?%;color:#303133;width:0;overflow:hidden;transition:all .3s;white-space:nowrap;text-align:center}.u-action-active[data-v-901b6f94]{width:%?80?%;margin-left:%?10?%}",""]),t.exports=e},c3c4:function(t,e,a){"use strict";a.r(e);var i=a("3609"),o=a.n(i);for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);e["default"]=o.a},e618:function(t,e,a){"use strict";a.r(e);var i=a("68b0"),o=a("c3c4");for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);a("a2d9");var c=a("f0c5"),r=Object(c["a"])(o["default"],i["b"],i["c"],!1,null,"901b6f94",null,!1,i["a"],void 0);e["default"]=r.exports},ea62:function(t,e,a){"use strict";var i=a("40d0"),o=a.n(i);o.a}}]);