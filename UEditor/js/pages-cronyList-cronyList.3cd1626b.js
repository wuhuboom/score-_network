(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-cronyList-cronyList"],{"07fa5":function(t,i,a){"use strict";a.r(i);var e=a("6e11"),n=a.n(e);for(var s in e)["default"].indexOf(s)<0&&function(t){a.d(i,t,(function(){return e[t]}))}(s);i["default"]=n.a},"6e11":function(t,i,a){"use strict";(function(t){a("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,a("99af");var e={data:function(){return{tabsRlist:[{name:"我的好友"},{name:"收益明细"}],tabsrcurrent:0,haoyouList:[],types:1,shouyiList:[],skeletonLoading:!0,skeletonLoading2:!1,pageSize:1,pageNum:10,failTimeOutShow:!1,loadingstatus2:"loading",loadingstatus:"loading",loadText:{loadmore:"轻轻上拉",loading:"加载中...",nomore:"没有更多了"}}},onPullDownRefresh:function(){var t=this;0==this.tabsrcurrent?setTimeout((function(){t.pageSize=1,t.pageNum=10,t.skeletonLoading=!0,t.failTimeOutShow=!1,t.getLeaderboard(),uni.stopPullDownRefresh()}),1500):1==this.tabsrcurrent&&setTimeout((function(){t.pageSize=1,t.pageNum=10,t.skeletonLoading2=!0,t.failTimeOutShow=!1,t.getLeaderboard2(),uni.stopPullDownRefresh()}),1500)},onReachBottom:function(){var t=this;0==this.tabsrcurrent?(this.loadingstatus="loading",setTimeout((function(){t.pageSize++,t.getLeaderboard(),uni.hideNavigationBarLoading()}),500)):1==this.tabsrcurrent&&(this.loadingstatus2="loading",setTimeout((function(){t.pageSize++,t.getLeaderboard2(),uni.hideNavigationBarLoading()}),500))},onShow:function(){this.getLeaderboard()},methods:{refurbish:function(){var t=this;t.pageSize=1,t.pageNum=10,0==this.tabsrcurrent?(t.skeletonLoading=!0,setTimeout((function(){t.getLeaderboard()}),2e3)):1==this.tabsrcurrent&&(t.skeletonLoading2=!0,setTimeout((function(){t.getLeaderboard2()}),2e3))},getLeaderboard:function(){var i=this;i.$api.getinvitemingxi({page:i.pageSize,limit:i.pageNum,order_by:"amount_desc"}).then((function(t){setTimeout((function(){1!=i.pageSize?0!=t.data.result.length?(i.loadingstatus="loading",i.haoyouList=i.haoyouList.concat(t.data.result)):i.loadingstatus="nomore":(i.haoyouList=t.data.result,i.loadingstatus="nomore"),i.failTimeOutShow=!1,i.skeletonLoading=!1}),2e3)})).catch((function(a){a.data?uni.showToast({title:a.data.msg,icon:"none",duration:2e3}):(t("log","请求错误或请求超时",a.errMsg," at pages/cronyList/cronyList.vue:224"),i.haoyouList=[],i.skeletonLoading=!1,i.failTimeOutShow=!0)}))},getLeaderboard2:function(){var i=this;i.$api.getmyshouyimingxi({page:i.pageSize,limit:i.pageNum,order_by:"amount_desc"}).then((function(t){setTimeout((function(){1!=i.pageSize?0!=t.data.result.length?(i.loadingstatus2="loading",i.shouyiList=i.shouyiList.concat(t.data.result)):i.loadingstatus2="nomore":(i.shouyiList=t.data.result,i.loadingstatus2="nomore"),i.failTimeOutShow=!1,i.skeletonLoading2=!1}),2e3)})).catch((function(a){a.data?uni.showToast({title:a.data.msg,icon:"none",duration:2e3}):(t("log","请求错误或请求超时",a.errMsg," at pages/cronyList/cronyList.vue:269"),i.shouyiList=[],i.skeletonLoading2=!1,i.failTimeOutShow=!0)}))},tabsRchange:function(t){this.tabsrcurrent=t,0==t?(this.types=1,this.pageSize=1,this.pageNum=10,this.haoyouList=[],this.skeletonLoading=!0,this.getLeaderboard()):1==t&&(this.types=2,this.pageSize=1,this.pageNum=10,this.shouyiList=[],this.skeletonLoading2=!0,this.getLeaderboard2())}}};i.default=e}).call(this,a("0de9")["log"])},7464:function(t,i,a){"use strict";a.r(i);var e=a("bc2e"),n=a("07fa5");for(var s in n)["default"].indexOf(s)<0&&function(t){a.d(i,t,(function(){return n[t]}))}(s);a("d5ae");var o=a("f0c5"),r=Object(o["a"])(n["default"],e["b"],e["c"],!1,null,"902c39c8",null,!1,e["a"],void 0);i["default"]=r.exports},bb1f:function(t,i,a){var e=a("e214");e.__esModule&&(e=e.default),"string"===typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);var n=a("4f06").default;n("2ada7fc1",e,!0,{sourceMap:!1,shadowMode:!1})},bc2e:function(t,i,a){"use strict";a.d(i,"b",(function(){return n})),a.d(i,"c",(function(){return s})),a.d(i,"a",(function(){return e}));var e={uTabs:a("25db").default,lSvga:a("9f25").default,uLoadmore:a("dd5b").default},n=function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("v-uni-view",[a("v-uni-view",{staticClass:"r_list"},[a("v-uni-view",{staticClass:"tabs_wrap"},[a("u-tabs",{attrs:{list:t.tabsRlist,"is-scroll":!1,current:t.tabsrcurrent,"bar-width":"134","active-color":"#FF4910","inactive-color":"#999999"},on:{change:function(i){arguments[0]=i=t.$handleEvent(i),t.tabsRchange.apply(void 0,arguments)}}})],1),a("v-uni-view",{staticClass:"r_list_title"},[a("v-uni-view",[t._v("好友")]),a("v-uni-view",[t._v("注册时间")]),a("v-uni-view",[t._v("贡献(元)")])],1),0==t.tabsrcurrent?a("v-uni-view",[t.skeletonLoading?a("v-uni-view",{staticClass:"lanjiazai"},[a("v-uni-view",[a("v-uni-view",{staticClass:"loading_icon"},[a("l-svga",{attrs:{src:"/static/images/loading.svga"}})],1),a("v-uni-view",{staticClass:"tag"},[t._v("加载中...")])],1)],1):a("v-uni-view",[t._l(t.haoyouList,(function(i,e){return a("v-uni-view",{key:e,staticClass:"r_list_box"},[a("v-uni-view",{staticClass:"l_2"},[a("v-uni-view",{staticClass:"u_iamge"},[a("v-uni-image",{attrs:{src:i.avatar}})],1),a("v-uni-view",{staticClass:"u_name"},[t._v(t._s(i.nickname))])],1),a("v-uni-view",{staticClass:"l_1"},[a("v-uni-view",[t._v(t._s(i.create_time))])],1),a("v-uni-view",{staticClass:"l_4"},[t._v(t._s(i.amount)+"元")])],1)})),0==t.failTimeOutShow?a("v-uni-view",[a("u-loadmore",{attrs:{"icon-type":"flower",status:t.loadingstatus,"font-size":"24","load-text":t.loadText,"margin-top":"40","margin-bottom":"26"}})],1):t._e()],2)],1):t._e(),1==t.tabsrcurrent?a("v-uni-view",[t.skeletonLoading2?a("v-uni-view",{staticClass:"lanjiazai"},[a("v-uni-view",[a("v-uni-view",{staticClass:"loading_icon"},[a("l-svga",{attrs:{src:"/static/images/loading.svga"}})],1),a("v-uni-view",{staticClass:"tag"},[t._v("加载中...")])],1)],1):a("v-uni-view",[t._l(t.shouyiList,(function(i,e){return a("v-uni-view",{key:e,staticClass:"r_list_box"},[a("v-uni-view",{staticClass:"l_2"},[a("v-uni-view",{staticClass:"u_iamge"},[a("v-uni-image",{attrs:{src:i.avatar}})],1),a("v-uni-view",{staticClass:"u_name"},[t._v(t._s(i.nickname))])],1),a("v-uni-view",{staticClass:"l_1"},[a("v-uni-view",[t._v(t._s(i.create_time))])],1),a("v-uni-view",{staticClass:"l_4"},[t._v(t._s(i.amount)+"元")])],1)})),0==t.failTimeOutShow?a("v-uni-view",[a("u-loadmore",{attrs:{"icon-type":"flower",status:t.loadingstatus2,"font-size":"24","load-text":t.loadText,"margin-top":"40","margin-bottom":"26"}})],1):t._e()],2)],1):t._e(),1==t.failTimeOutShow?a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:"/static/images/Frame33412.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"timeOut"},[a("v-uni-view",[t._v("网络好像出问题了～")]),a("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.refurbish()}}},[t._v("立即刷新")])],1)],1):t._e()],1)],1)},s=[]},d5ae:function(t,i,a){"use strict";var e=a("bb1f"),n=a.n(e);n.a},e214:function(t,i,a){var e=a("24fb");i=e(!1),i.push([t.i,"[data-v-902c39c8] .u-tab-bar{position:absolute;bottom:-3px!important}.lanjiazai[data-v-902c39c8]{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.noData_box[data-v-902c39c8]{margin-top:0;padding-bottom:%?260?%;text-align:center;color:#999;text-align:center}.noData_box uni-image[data-v-902c39c8]{width:%?280?%}.noData_box .timeOut[data-v-902c39c8]{font-size:12px;color:#666;margin:0 0 7px;display:flex;align-items:center;justify-content:center}.noData_box .timeOut uni-view[data-v-902c39c8]:nth-child(2){color:#ff611e;padding-left:%?10?%}.noData_box .lijipay[data-v-902c39c8]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-902c39c8]{height:%?70?%!important;line-height:%?70?%!important}.r_list[data-v-902c39c8]{padding:0 %?30?%}.r_list .r_list_box[data-v-902c39c8]{display:flex;align-items:center;justify-content:space-between;margin:%?50?% 0 0 0}.r_list .r_list_box .l_1[data-v-902c39c8]{position:relative;text-align:center}.r_list .r_list_box .l_2[data-v-902c39c8]{display:flex;align-items:center;position:relative;width:%?180?%}.r_list .r_list_box .l_2 .u_iamge uni-image[data-v-902c39c8]{width:%?78?%;height:%?78?%;border-radius:%?200?%;margin-right:%?10?%}.r_list .r_list_box .l_2 .u_name[data-v-902c39c8]{font-weight:700;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.r_list .r_list_box .l_3[data-v-902c39c8]{font-weight:700}.r_list .r_list_box .l_4[data-v-902c39c8]{font-weight:700;color:#ff4910}.r_list .r_list_title[data-v-902c39c8]{display:flex;align-items:center;justify-content:space-between;padding:%?20?% 0;border-top:1px solid #f3f3f3;border-bottom:1px solid #f3f3f3}.r_list .r_list_title uni-view[data-v-902c39c8]{color:#999}.r_title[data-v-902c39c8]{text-align:center;margin:%?30?% 0 %?16?% 0}.r_title uni-text[data-v-902c39c8]{font-size:%?36?%;font-weight:700;color:#ff773a}",""]),t.exports=i}}]);