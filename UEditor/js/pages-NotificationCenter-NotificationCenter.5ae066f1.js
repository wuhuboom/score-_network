(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-NotificationCenter-NotificationCenter"],{1993:function(t,i,e){"use strict";e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var n={data:function(){return{list:[{name:"全部"},{name:"公告"},{name:"订单通知"},{name:"活动"},{name:"粉丝群消息"}],current:0}},methods:{change:function(t){this.current=t},Todetails:function(){uni.navigateTo({url:"/pages/NotificationCenter/noticDetails/noticDetails"})},Torankinglist:function(){uni.navigateTo({url:"/pages/savemoneySort/savemoneySort"})},ToshopAply:function(){uni.navigateTo({url:"/pages/businessApply/businessApply"})}}};i.default=n},"639f":function(t,i,e){"use strict";e.r(i);var n=e("888c"),a=e("744e");for(var s in a)["default"].indexOf(s)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(s);e("e3f0");var o=e("f0c5"),c=Object(o["a"])(a["default"],n["b"],n["c"],!1,null,"f49c3dc0",null,!1,n["a"],void 0);i["default"]=c.exports},"744e":function(t,i,e){"use strict";e.r(i);var n=e("1993"),a=e.n(n);for(var s in n)["default"].indexOf(s)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(s);i["default"]=a.a},8044:function(t,i,e){t.exports=e.p+"static/img/noData.c0e225d6.png"},"888c":function(t,i,e){"use strict";e.d(i,"b",(function(){return a})),e.d(i,"c",(function(){return s})),e.d(i,"a",(function(){return n}));var n={uTabs:e("25db").default},a=function(){var t=this,i=t.$createElement,n=t._self._c||i;return n("v-uni-view",[n("v-uni-view",{staticClass:"tabs_box"},[n("u-tabs",{attrs:{list:t.list,"is-scroll":!0,current:t.current,"active-color":"#FF4910","show-bar":!1},on:{change:function(i){arguments[0]=i=t.$handleEvent(i),t.change.apply(void 0,arguments)}}})],1),0==t.current?n("v-uni-view",{staticClass:"tz_list"},[n("v-uni-view",{staticClass:"tz_list_item",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.Todetails()}}},[n("v-uni-view",{staticClass:"tz_item_info"},[n("v-uni-view",{staticClass:"tz_title"},[n("v-uni-view",[t._v("签到领会员")]),n("span",[t._v("2020-05-12")])],1),n("v-uni-view",{staticClass:"tz_content"},[t._v("签到得金币，兑30天会员卡")])],1)],1),n("v-uni-view",{staticClass:"tz_list_item"},[n("v-uni-view",{staticClass:"tz_item_info"},[n("v-uni-view",{staticClass:"tz_title"},[n("v-uni-view",[t._v("邀请好友")]),n("span",[t._v("2020-05-12")])],1),n("v-uni-view",{staticClass:"tz_content"},[t._v("每邀请7个下单好友得7天会员卡")])],1)],1),n("v-uni-view",{staticClass:"tz_list_item"},[n("v-uni-view",{staticClass:"tz_item_info"},[n("v-uni-view",{staticClass:"tz_title"},[n("v-uni-view",[t._v("下单得会员")]),n("span",[t._v("2020-05-12")])],1),n("v-uni-view",{staticClass:"tz_content"},[t._v("本月完成30单，得30天会员卡")])],1)],1)],1):t._e(),0!=t.current?n("v-uni-view",{staticClass:"noData_box"},[n("v-uni-image",{attrs:{src:e("8044"),mode:"widthFix"}}),n("v-uni-view",[t._v("无数据")])],1):t._e()],1)},s=[]},bf165:function(t,i,e){var n=e("24fb");i=n(!1),i.push([t.i,".tabs_box[data-v-f49c3dc0]{border-bottom:1px solid #f1f1f1}.tabs_box[data-v-f49c3dc0] .u-tab-item{font-weight:700;font-size:%?28?%}.noData_box[data-v-f49c3dc0]{margin-top:%?200?%;text-align:center;color:#999}.noData_box uni-image[data-v-f49c3dc0]{width:%?340?%}.tz_list[data-v-f49c3dc0]{padding:%?30?%}.tz_list .tz_list_item[data-v-f49c3dc0]{display:flex;align-items:center;margin-bottom:%?30?%;border-bottom:1px solid #f1f1f1;padding-bottom:%?30?%}.tz_list .tz_list_item uni-image[data-v-f49c3dc0]{width:%?88?%;height:%?88?%;margin-right:%?20?%}.tz_list .tz_list_item .tz_item_info[data-v-f49c3dc0]{flex:1}.tz_list .tz_list_item .tz_item_info .tz_title[data-v-f49c3dc0]{display:flex;align-items:center;justify-content:space-between}.tz_list .tz_list_item .tz_item_info .tz_title uni-view[data-v-f49c3dc0]{font-weight:700;font-size:%?28?%;margin-bottom:%?8?%;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.tz_list .tz_list_item .tz_item_info .tz_title span[data-v-f49c3dc0]{color:#ccc;font-size:%?24?%}.tz_list .tz_list_item .tz_item_info .tz_content[data-v-f49c3dc0]{font-size:%?28?%;color:#ccc;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}",""]),t.exports=i},e3f0:function(t,i,e){"use strict";var n=e("f8af"),a=e.n(n);a.a},f8af:function(t,i,e){var n=e("bf165");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=e("4f06").default;a("9f31f4de",n,!0,{sourceMap:!1,shadowMode:!1})}}]);