(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["moviePages-pages-cinema_ticket-cinema_ticket"],{1076:function(e,t,i){"use strict";var a=i("55b5"),r=i.n(a);r.a},"17a9":function(e,t,i){"use strict";var a=i("17af"),r=i.n(a);r.a},"17af":function(e,t,i){var a=i("b0b6");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var r=i("4f06").default;r("7378d382",a,!0,{sourceMap:!1,shadowMode:!1})},"186e":function(e,t,i){"use strict";i("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,i("a434"),i("e9c4");var a={data:function(){return{}},props:{list:{type:Array,default:function(){return[]}}},onShow:function(){},methods:{timeOutEnd:function(e,t){this.list.splice(t,1)},clickDetail:function(e){if(0==e.is_pay&&0==e.is_cancel){encodeURIComponent(JSON.stringify(e));uni.navigateTo({url:"/moviePages/pages/seat/submit?item="+encodeURIComponent(JSON.stringify(e))+"&Laiyuan=我的订单"})}else uni.navigateTo({url:"/moviePages/pages/orderDetail/order-detail?no=".concat(e.id)})}}};t.default=a},"212a":function(e,t,i){"use strict";i.r(t);var a=i("fa3e"),r=i("9f8b");for(var n in r)["default"].indexOf(n)<0&&function(e){i.d(t,e,(function(){return r[e]}))}(n);i("1076");var o=i("f0c5"),s=Object(o["a"])(r["default"],a["b"],a["c"],!1,null,"061f54e8",null,!1,a["a"],void 0);t["default"]=s.exports},"3db4":function(e,t,i){var a=i("24fb");t=a(!1),t.push([e.i,'@charset "UTF-8";.orderItem .bg-white[data-v-061f54e8]{background-color:#fff;color:#666}.orderItem .margin-bottom-sm[data-v-061f54e8]{margin-bottom:%?20?%}.orderItem .grid[data-v-061f54e8]{display:flex;flex-wrap:wrap;width:94%;margin:%?25?% auto;border-radius:%?20?%}.orderItem .padding-sm[data-v-061f54e8]{padding:%?20?%}.orderItem .grid.col-1 > uni-view[data-v-061f54e8]{width:100%}.orderItem .justify-between[data-v-061f54e8]{-webkit-box-pack:justify;justify-content:space-between}.orderItem .align-center[data-v-061f54e8]{-webkit-box-align:center;align-items:center}.orderItem .flex[data-v-061f54e8]{display:flex}.orderItem .line-black[data-v-061f54e8], .orderItem .lines-black[data-v-061f54e8], .orderItem .text-black[data-v-061f54e8]{color:#333}.orderItem .text-lg[data-v-061f54e8]{font-size:%?32?%}.orderItem .fl[data-v-061f54e8]{float:left}.orderItem .line-red-new[data-v-061f54e8], .orderItem .text-red-new[data-v-061f54e8]{color:#f66c3f}.orderItem .fr[data-v-061f54e8]{float:right}.orderItem .text-price[data-v-061f54e8]:before{content:"¥";font-size:80%;margin-right:%?4?%}.orderItem .solid-bottom[data-v-061f54e8]:after{border-bottom:%?1?% solid rgba(0,0,0,.1)}.orderItem .dashed-bottom[data-v-061f54e8]:after, .orderItem .dashed-left[data-v-061f54e8]:after, .orderItem .dashed-right[data-v-061f54e8]:after, .orderItem .dashed-top[data-v-061f54e8]:after, .orderItem .dashed[data-v-061f54e8]:after, .orderItem .solid-bottom[data-v-061f54e8]:after, .orderItem .solid-left[data-v-061f54e8]:after, .orderItem .solid-right[data-v-061f54e8]:after, .orderItem .solid-top[data-v-061f54e8]:after, .orderItem .solid[data-v-061f54e8]:after, .orderItem .solids-bottom[data-v-061f54e8]:after, .orderItem .solids-left[data-v-061f54e8]:after, .orderItem .solids-right[data-v-061f54e8]:after, .orderItem .solids-top[data-v-061f54e8]:after, .orderItem .solids[data-v-061f54e8]:after{content:" ";width:200%;height:200%;position:absolute;top:0;left:0;border-radius:inherit;-webkit-transform:scale(.5);transform:scale(.5);-webkit-transform-origin:0 0;transform-origin:0 0;pointer-events:none;box-sizing:border-box}.orderItem .order-list .list-item .info[data-v-061f54e8]{height:%?150?%}.orderItem .padding-sm[data-v-061f54e8]{padding:%?20?%}.orderItem .zhiyu[data-v-061f54e8]{flex:1;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.orderItem .grid.col-1 > uni-view[data-v-061f54e8]{width:100%}.orderItem .align-center[data-v-061f54e8]{-webkit-box-align:center;align-items:center}.orderItem .order-list .list-item .info .left-icon[data-v-061f54e8]{width:%?100?%}.orderItem .text-sl[data-v-061f54e8]{font-size:%?80?%}.orderItem .flex-treble[data-v-061f54e8]{-webkit-box-flex:3;flex:3}.orderItem .line-black[data-v-061f54e8], .orderItem .lines-black[data-v-061f54e8], .orderItem .text-black[data-v-061f54e8]{color:#333}.orderItem .line-black[data-v-061f54e8], .orderItem .lines-black[data-v-061f54e8], .orderItem .text-black[data-v-061f54e8]{color:#333}.orderItem .margin-top-xs[data-v-061f54e8]{margin-top:%?10?%}.orderItem .line-gray[data-v-061f54e8], .orderItem .lines-gray[data-v-061f54e8], .orderItem .text-gray[data-v-061f54e8]{color:#aaa}.orderItem .margin-left-xs[data-v-061f54e8]{margin-left:%?10?%}.orderItem .cu-tag.sm[data-v-061f54e8]{font-size:%?20?%;padding:%?0?% %?12?%;height:%?32?%}.orderItem .cu-tag[data-v-061f54e8]{font-size:%?24?%;vertical-align:middle;position:relative;display:-webkit-inline-box;display:-webkit-inline-flex;display:inline-flex;-webkit-box-align:center;align-items:center;-webkit-box-pack:center;justify-content:center;box-sizing:border-box;padding:%?0?% %?16?%;height:%?48?%;font-family:Helvetica Neue,Helvetica,sans-serif;white-space:nowrap}.orderItem .radius[data-v-061f54e8]{border-radius:%?6?%}.orderItem .cu-tag[class*=line-][data-v-061f54e8]:after{content:" ";width:200%;height:200%;position:absolute;top:0;left:0;border:%?1?% solid;-webkit-transform:scale(.5);transform:scale(.5);-webkit-transform-origin:0 0;transform-origin:0 0;box-sizing:border-box;border-radius:inherit;z-index:1;pointer-events:none}.orderItem .text-center[data-v-061f54e8]{text-align:center}.orderItem .flex-sub[data-v-061f54e8]{-webkit-box-flex:1;flex:1}.orderItem .text-xsl[data-v-061f54e8]{font-size:%?120?%}.orderItem .list-item .info[data-v-061f54e8]{height:%?150?%}.orderItem .list-item .info .left-icon[data-v-061f54e8]{width:%?100?%}.orderItem .kongzhuangtai[data-v-061f54e8]{text-align:center;position:absolute;left:0;right:0;top:40%}.orderItem .cinimage[data-v-061f54e8]{width:50%;margin:0 auto}.orderItem .orderfont[data-v-061f54e8]{color:#666;margin-top:%?40?%;font-size:%?32?%;text-align:center}',""]),e.exports=t},"55b5":function(e,t,i){var a=i("3db4");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var r=i("4f06").default;r("6616c6fe",a,!0,{sourceMap:!1,shadowMode:!1})},"5e48":function(e,t,i){"use strict";i.d(t,"b",(function(){return a})),i.d(t,"c",(function(){return r})),i.d(t,"a",(function(){}));var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("v-uni-view",{staticClass:"cinemamain",on:{touchmover:function(t){t.stopPropagation(),arguments[0]=t=e.$handleEvent(t)}}},[i("v-uni-view",{staticClass:"movie_top",style:{"padding-top":1.5*e.height+100+"rpx"}}),i("v-uni-scroll-view",{style:{height:e.boxHeight+"px"},attrs:{"scroll-y":!0,"refresher-enabled":e.triggered,"refresher-triggered":e.freshing},on:{refresherrefresh:function(t){arguments[0]=t=e.$handleEvent(t),e.refresh(!0)},scrolltolower:function(t){arguments[0]=t=e.$handleEvent(t),e.onreachBottom.apply(void 0,arguments)}}},[i("order-item",{attrs:{list:e.orderList}})],1)],1)},r=[]},"6dde":function(e,t,i){"use strict";(function(e){i("7a82");var a=i("4ea4").default;Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r=a(i("2909"));i("ac1f"),i("d3b7"),i("159b"),i("14d9");var n=a(i("212a")),o={data:function(){return{boxHeight:0,triggered:!1,freshing:!1,height:0,loaded:!1,condition:{page:0,pageSize:20},orderList:[]}},components:{orderItem:n.default},onLoad:function(){uni.showToast({title:"此处在请求订单列表时需要接入用户的手机号",icon:"none",duration:4e3})},onShow:function(){var e=this;this.$nextTick((function(){e.height=e.$common.setWidthHeight((function(){e.getDom()}))})),this.refresh()},methods:{getDom:function(){var e=this,t=uni.createSelectorQuery().in(this);t.selectAll(".movie_top").boundingClientRect((function(t){var i=t[0]?t[0].height:0;e.boxHeight=e.$store.state.windowHeight-i})).exec()},toBack:function(e){uni.navigateBack({url:"/pages/index/index"})},countDown:function(e,t){var i="",a=new Date(e).getTime(),r=a+10*t*60*100,n=(new Date).getTime();return i=r-n,i<0?(i=0,i):i/1e3},getMyOrder:function(){var t=this,i="";this.$store.state.uInfo&&(i=this.$store.state.uInfo.tel),this.$api.getOrder({limit:this.condition.pageSize,offset:this.condition.page*this.condition.pageSize,btel:i}).then((function(i){var a,n=i.data.result.rows;n.forEach((function(i,a){i.m0=t.countDown(i.created_at,10),0===i.m0&&0===i.status&&0===i.is_pay&&t.$api.releaseOrder({id:i.id}).then((function(t){e("log",t," at moviePages/pages/cinema_ticket/cinema_ticket.vue:101")}))})),(a=t.orderList).push.apply(a,(0,r.default)(i.data.result.rows)),t.condition.page+=1,i.data.result.count<=t.condition.page*t.condition.pageSize&&(t.loaded=!0),t.freshing=!1}))},loadingFuc:function(){this.refresh()},refresh:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;e&&(this.freshing=!0),this.loaded=!1,this.condition.page=0,this.orderList=[],this.getMyOrder()},onreachBottom:function(){this.loaded||this.getMyOrder()}}};t.default=o}).call(this,i("0de9")["log"])},7305:function(e,t,i){"use strict";i.r(t);var a=i("6dde"),r=i.n(a);for(var n in a)["default"].indexOf(n)<0&&function(e){i.d(t,e,(function(){return a[e]}))}(n);t["default"]=r.a},"89f8":function(e,t,i){"use strict";i.r(t);var a=i("5e48"),r=i("7305");for(var n in r)["default"].indexOf(n)<0&&function(e){i.d(t,e,(function(){return r[e]}))}(n);i("17a9");var o=i("f0c5"),s=Object(o["a"])(r["default"],a["b"],a["c"],!1,null,"50ccc90b",null,!1,a["a"],void 0);t["default"]=s.exports},"9f8b":function(e,t,i){"use strict";i.r(t);var a=i("186e"),r=i.n(a);for(var n in a)["default"].indexOf(n)<0&&function(e){i.d(t,e,(function(){return a[e]}))}(n);t["default"]=r.a},b0b6:function(e,t,i){var a=i("24fb");t=a(!1),t.push([e.i,".cinemamain[data-v-50ccc90b]{background-color:#f9f9f9;font-size:%?28?%;color:#323232;height:100vh;overflow:hidden}",""]),e.exports=t},fa3e:function(e,t,i){"use strict";i.d(t,"b",(function(){return a})),i.d(t,"c",(function(){return r})),i.d(t,"a",(function(){}));var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("v-uni-view",{staticClass:"orderItem order-list"},[e.list.length>0?i("v-uni-view",{},e._l(e.list,(function(t,a){return i("v-uni-view",{key:a,staticClass:"bg-white list-item margin-bottom-sm grid col-1",on:{click:function(i){arguments[0]=i=e.$handleEvent(i),e.clickDetail(t)}}},[i("v-uni-view",{staticClass:"padding-sm cinema flex justify-between align-center"},[i("v-uni-view",{staticClass:"zhiyu",class:[4==t.status||5==t.status?"fl text-6d6d6d text-lg":"fl text-black text-lg"]},[e._v(e._s(t.cinemaName))]),0==t.status&&0==t.is_pay?i("v-uni-view",{staticStyle:{color:"#999"}},[e._v(e._s(t.cancel_time))]):i("v-uni-view",{class:[4==t.status||5==t.status?"text-6d6d6d text-price":"fr text-red-new text-price"]},[e._v(e._s(t.price*t.count))])],1),i("v-uni-view",{staticClass:"flex align-center padding-sm info"},[i("v-uni-view",{staticClass:"left-icon"},[i("v-uni-text",{class:[4==t.status||5==t.status?"iconfont icon-round_ticket_fill text-sl text-gray":"iconfont icon-round_ticket_fill text-red-new text-sl"]})],1),i("v-uni-view",{staticClass:"flex-treble"},[i("v-uni-view",{class:[4==t.status||5==t.status?"text-6d6d6d":"text-black"]},[e._v(e._s(t.movieName)),i("v-uni-view",{staticClass:"cu-tag line-gray sm radius margin-left-xs"},[e._v(e._s(t.count+"张"))])],1),i("v-uni-view",{class:[4==t.status||5==t.status?"text-gray margin-top-xs":"text-black margin-top-xs"]},[i("v-uni-text",[e._v(e._s(e._f("getWeekByDay")(t.show_time))+" "+e._s(e._f("formateDate")(t.show_time,"MM月DD日 HH:mm")))])],1)],1),i("v-uni-view",{staticClass:"flex-sub text-center"},[2!=t.status&&0!=t.status||1!=t.is_pay?e._e():i("v-uni-text",{staticClass:"text-red-new text-lg"},[e._v("出票中")]),3==t.status?i("v-uni-text",{staticClass:"text-red-new text-lg"},[e._v("已出票")]):e._e(),0==t.is_pay&&0==t.is_cancel?i("v-uni-text",{staticClass:"text-red-new text-lg"},[e._v("去支付")]):1==t.is_cancel?i("v-uni-text",{staticClass:"text-red-new text-lg",staticStyle:{color:"#999999"}},[e._v("已取消")]):e._e(),4==t.status?i("v-uni-text",{staticClass:"iconfont icon-yiwancheng7 text-xsl text-acacac"}):e._e(),5==t.status&&1==t.is_refund?i("v-uni-text",{staticClass:"iconfont icon-hgc-yituikuan text-xsl text-acacac"}):e._e()],1)],1)],1)})),1):e._e(),e.list.length<=0?i("v-uni-view",{staticClass:"kongzhuangtai"},[i("v-uni-image",{staticClass:"cinimage",attrs:{src:"https://img.alicdn.com/imgextra/i2/3829152210/O1CN01lHi68c1SCE3JVy9Qs_!!3829152210.png",mode:"widthFix"}})],1):e._e()],1)},r=[]}}]);