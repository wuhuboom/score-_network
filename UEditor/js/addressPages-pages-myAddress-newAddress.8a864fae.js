(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["addressPages-pages-myAddress-newAddress"],{"024c":function(t,e,i){"use strict";var a=i("82ff"),n=i.n(a);n.a},1894:function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,".jianbianse[data-v-29321a7b]{width:100%;background-image:linear-gradient(0deg,#fff,transparent);position:absolute;top:144px;height:150px}.add_res_wrap[data-v-29321a7b]{position:absolute;margin:0 auto;top:180px;width:94%;left:0;right:0;border-radius:%?20?%}.add_res_wrap .yixuandizhi[data-v-29321a7b]{display:flex;align-items:center;justify-content:space-between;padding:%?20?%;background-color:#fff;box-shadow:0 0 10px rgba(0,0,0,.05);border-radius:%?20?%;margin-bottom:%?30?%}.add_res_wrap .yixuandizhi .yx_name[data-v-29321a7b]{flex:1}.add_res_wrap .yixuandizhi .yx_name uni-view[data-v-29321a7b]:nth-child(1){font-size:%?28?%}.add_res_wrap .yixuandizhi .yx_name uni-view[data-v-29321a7b]:nth-child(2){color:#999;font-size:%?24?%;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.add_res_wrap .yixuandizhi .yx_xg[data-v-29321a7b]{color:#ff4910;border-radius:%?200?%;border:1px solid #ff4910;font-size:%?24?%;height:%?56?%;display:flex;align-items:center;justify-content:center;padding:0 %?20?%}.add_res_wrap .add_res_box[data-v-29321a7b]{background-color:#fff;box-shadow:0 0 10px rgba(0,0,0,.05);border-radius:%?20?%;padding:%?20?%}.add_res_wrap .add_res_box .xz_dz[data-v-29321a7b]{color:#ff4910;border-radius:%?6?%;border:1px solid #ff4910;text-align:center;height:%?64?%;display:flex;align-items:center;justify-content:center;margin-bottom:%?20?%}.add_res_wrap .add_res_box .inout_box[data-v-29321a7b]{display:flex;align-items:center;padding:%?14?% 0;border-bottom:1px solid #f3f3f3}.add_res_wrap .add_res_box .inout_box .input_title[data-v-29321a7b]{margin-right:%?10?%}.add_res_wrap .add_res_box .inout_box .input_k[data-v-29321a7b]{flex:1}.add_res_wrap .add_res_box .inout_box .xingbie[data-v-29321a7b]{margin-left:auto}.lijipay[data-v-29321a7b]{width:100%;margin:%?48?% auto 0}.lijipay .u-size-default[data-v-29321a7b]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.controls-location[data-v-29321a7b]{height:46px;width:46px;position:absolute}",""]),t.exports=e},"4df0":function(t,e,i){"use strict";i.r(e);var a=i("e77d"),n=i.n(a);for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);e["default"]=n.a},"82ff":function(t,e,i){var a=i("1894");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("56126988",a,!0,{sourceMap:!1,shadowMode:!1})},bf56:function(t,e,i){"use strict";i.r(e);var a=i("e500"),n=i("4df0");for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);i("024c");var s=i("f0c5"),d=Object(s["a"])(n["default"],a["b"],a["c"],!1,null,"29321a7b",null,!1,a["a"],void 0);e["default"]=d.exports},e500:function(t,e,i){"use strict";i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return a}));var a={uIcon:i("21cf").default,uInput:i("dab7").default,uRadioGroup:i("5096").default,uRadio:i("4201").default,uButton:i("eeee").default},n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",[i("v-uni-view",{staticStyle:{width:"100%"}},[i("v-uni-map",{ref:"map",staticStyle:{width:"100%"},style:{height:t.mapH+"px"},attrs:{id:"map","enable-scroll":!1,scale:t.scaleSize,latitude:t.latitude,longitude:t.longitude,controls:t.controls,"enable-poi":!0}},[i("v-uni-cover-view",{staticStyle:{width:"100%",height:"100%"}})],1),i("v-uni-cover-image",{staticClass:"controls-location",style:{left:t.controlsLeft+"px",top:t.controlsTop+"px"},attrs:{src:t.positionIcon}})],1),i("v-uni-view",{staticClass:"add_res_wrap"},[0!=Object.keys(t.addressData).length?i("v-uni-view",{staticClass:"yixuandizhi"},[i("v-uni-view",{staticClass:"yx_name"},[i("v-uni-view",[t._v(t._s(t.addressData.address.poistitle))]),i("v-uni-view",[t._v(t._s(t.addressData.address.address))])],1),i("v-uni-view",{staticClass:"yx_xg",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.Toxuanze()}}},[t._v("修改地址")])],1):t._e(),i("v-uni-view",{staticClass:"add_res_box"},[0===Object.keys(t.addressData).length?i("v-uni-view",{staticClass:"xz_dz",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.Toxuanze()}}},[i("v-uni-view",[t._v("选择收货地址"),i("u-icon",{attrs:{name:"arrow-right",size:"22",color:"#FF4910"}})],1)],1):t._e(),i("v-uni-view",{staticClass:"inout_box"},[i("v-uni-view",{staticClass:"input_title"},[t._v("门牌号")]),i("v-uni-view",{staticClass:"input_k"},[i("u-input",{attrs:{focus:!1,type:"text",border:!1,placeholder:"详细地址，例1层101室"},model:{value:t.menpai,callback:function(e){t.menpai=e},expression:"menpai"}})],1)],1),i("v-uni-view",{staticClass:"inout_box"},[i("v-uni-view",{staticClass:"input_title"},[t._v("联系人")]),i("v-uni-view",{staticClass:"input_k"},[i("u-input",{attrs:{type:"text",border:!1,placeholder:"请填写收货人的姓名"},model:{value:t.name,callback:function(e){t.name=e},expression:"name"}})],1),i("v-uni-view",{staticClass:"xingbie"},[i("u-radio-group",{attrs:{"active-color":"#FF8F3D",size:"32"},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.radioGroupChange.apply(void 0,arguments)}},model:{value:t.value,callback:function(e){t.value=e},expression:"value"}},t._l(t.list,(function(e,a){return i("u-radio",{key:a,attrs:{"label-size":"28",name:e.name,disabled:e.disabled}},[t._v(t._s(e.name))])})),1)],1)],1),i("v-uni-view",{staticClass:"inout_box"},[i("v-uni-view",{staticClass:"input_title"},[t._v("手机号")]),i("v-uni-view",{staticClass:"input_k"},[i("u-input",{attrs:{maxlength:"11",type:"number",border:!1,placeholder:"请填写收货人手机号码"},model:{value:t.phone,callback:function(e){t.phone=e},expression:"phone"}})],1)],1),i("v-uni-view",{staticClass:"inout_box",staticStyle:{padding:"24rpx 0"}},[i("v-uni-view",{staticClass:"input_title"},[t._v("是否默认")]),i("v-uni-view",{staticClass:"input_k"},[i("v-uni-view",{})],1),i("v-uni-view",{staticClass:"xingbie"},[i("u-radio-group",{attrs:{"active-color":"#FF8F3D",size:"32"},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.radioGroupChange22.apply(void 0,arguments)}},model:{value:t.value2,callback:function(e){t.value2=e},expression:"value2"}},t._l(t.list2,(function(e,a){return i("u-radio",{key:a,attrs:{"label-size":"28",name:e.name,disabled:e.disabled}},[t._v(t._s(e.name))])})),1)],1)],1),i("v-uni-view",{staticClass:"lijipay"},[i("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.baocun()}}},[t._v("保存地址")])],1)],1)],1)],1)},o=[]},e77d:function(t,e,i){"use strict";(function(t){i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("b64b");var a={data:function(){return{scaleSize:18,mapH:0,mapW:0,longitude:0,latitude:0,controlsLeft:1e3,controlsTop:1e3,controls:[],positionIcon:"/static/position.png",menpai:"",name:"",phone:"",sex:"先生",list:[{name:"先生",disabled:!1},{name:"女士",disabled:!1}],value:"先生",list2:[{name:"是",disabled:!1},{name:"否",disabled:!1}],value2:"是",moooo:"",addressData:{},is_moren:1}},onLoad:function(){var t=this;this.H5getLocation(),this.initMapH(),this.initPositionIcon(),uni.$on("GetAddressData",(function(e){t.xindingwei(e)}))},methods:{radioGroupChange:function(e){t("log",e," at addressPages/pages/myAddress/newAddress.vue:175"),this.sex=e},radioGroupChange22:function(e){this.is_moren="是"==e?1:0,t("log",this.is_moren," at addressPages/pages/myAddress/newAddress.vue:185")},baocun:function(){t("log","执行了吗"," at addressPages/pages/myAddress/newAddress.vue:188");0===Object.keys(this.addressData).length?uni.showToast({title:"请选择收货地址",icon:"none",duration:2e3}):""==this.name?uni.showToast({title:"请输入联系人",icon:"none",duration:2e3}):""==this.phone?uni.showToast({title:"请输入手机号",icon:"none",duration:2e3}):this.$api.AddnewAddress({latitude:this.latitude,longitude:this.longitude,name:this.name,tel:this.phone,sex:this.sex,address:this.addressData.address.poistitle,house_number:this.menpai,is_default:this.is_moren}).then((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3}),setTimeout((function(){uni.navigateBack()}),2e3)})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},Toxuanze:function(){uni.navigateTo({url:"/pages/Selectlocation/Selectlocation"})},xindingwei:function(e){t("log","从地图选择的位置",e," at addressPages/pages/myAddress/newAddress.vue:246"),this.addressData=e.data,this.longitude=e.data.longitude,this.latitude=e.data.latitude,uni.createMapContext("map",this).moveToLocation({latitude:e.data.latitude,longitude:e.data.longitude})},AppgetLocation:function(){var t=this,e=uni.getStorageSync("lat"),i=uni.getStorageSync("lng");if(e&&i){var a={latitude:e,longitude:i};t.longitude=a.longitude,t.latitude=a.latitude}else uni.getLocation({type:"gcj02",success:function(e){t.longitude=e.longitude,t.latitude=e.latitude},fail:function(t){uni.showToast({icon:"none",title:"获取地址失败, 请检查是否开启定位权限~~"})}})},H5getLocation:function(){var t=this,e=uni.getStorageSync("lat"),i=uni.getStorageSync("lng");if(e&&i){var a={latitude:e,longitude:i};t.longitude=a.longitude,t.latitude=a.latitude}else uni.getLocation({type:"gcj02",highAccuracyExpireTime:3e3,isHighAccuracy:!0,success:function(e){t.longitude=e.longitude,t.latitude=e.latitude},fail:function(t){uni.showToast({icon:"none",title:"获取地址失败, 请检查是否开启定位权限~~"})}})},initPositionIcon:function(){var t=this;setTimeout((function(){t.controlsLeft=t.mapW/2-20,t.controlsTop=t.mapH/3}),100)},initMapH:function(){this.mapW=uni.getSystemInfoSync().windowWidth,this.mapH=uni.getSystemInfoSync().windowHeight-520}}};e.default=a}).call(this,i("0de9")["log"])}}]);