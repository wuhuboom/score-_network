(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["mePages-pages-incomeInfo"],{"12ff":function(t,i,a){"use strict";a.d(i,"b",(function(){return n})),a.d(i,"c",(function(){return o})),a.d(i,"a",(function(){return e}));var e={uTabs:a("25db").default,lSvga:a("9f25").default,uLoadmore:a("dd5b").default},n=function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("v-uni-view",[a("v-uni-view",{staticClass:"top_box_wrap"},[a("v-uni-view",{staticClass:"top_box"},[a("v-uni-view",{staticClass:"top_item1"},[a("v-uni-view",[t._v("余额")]),a("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.lijitixian()}}},[t._v("立即提现")])],1),a("v-uni-view",{staticClass:"top_item2"},[a("v-uni-view",[t._v(t._s(t.userData.money))]),a("v-uni-view",[t._v("今日收益："+t._s(t.makemoneyData.today_income_money)+"元")])],1)],1),a("v-uni-view",{staticClass:"tabs_box"},[a("u-tabs",{attrs:{list:t.list,"is-scroll":!1,current:t.current,"active-color":"#FF4910"},on:{change:function(i){arguments[0]=i=t.$handleEvent(i),t.change.apply(void 0,arguments)}}})],1)],1),t.skeletonLoading?a("v-uni-view",{staticClass:"lanjiazai"},[a("v-uni-view",[a("v-uni-view",{staticClass:"loading_icon"},[a("l-svga",{attrs:{src:t.BestImgUrl+"loading.svga"}})],1),a("v-uni-view",{staticClass:"tag"},[t._v("加载中...")])],1)],1):a("v-uni-view",[0!=t.incomeList.length?a("v-uni-view",{staticClass:"m_list_wrap"},[t._l(t.incomeList,(function(i,e){return a("v-uni-view",{key:e,staticClass:"m_list_item"},[a("v-uni-view",{staticClass:"m_list_item_info"},[a("v-uni-view",{staticClass:"m_title"},[a("v-uni-view",{staticClass:"type_title"},[t._v(t._s(i.title))])],1),a("v-uni-view",{staticClass:"m_time"},[t._v(t._s(i.create_time))])],1),a("v-uni-view",{staticClass:"m_price"},[t._v(t._s(i.amount))])],1)})),a("u-loadmore",{attrs:{"icon-type":"flower",status:t.loadingstatus,"font-size":"24","load-text":t.loadText,"margin-bottom":"60"}})],2):0==t.incomeList.length&&0==t.failTimeOutShow?a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:"/static/images/noData.png",mode:"widthFix"}}),a("v-uni-view",[t._v("暂无明细")])],1):1==t.failTimeOutShow&&0==t.incomeList.length?a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:"/static/images/Frame33412.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"timeOut"},[a("v-uni-view",[t._v("网络好像出问题了~")]),a("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.refurbish()}}},[t._v("立即刷新")])],1)],1):t._e()],1)],1)},o=[]},"148d":function(t,i,a){"use strict";a.r(i);var e=a("f3e5"),n=a.n(e);for(var o in e)["default"].indexOf(o)<0&&function(t){a.d(i,t,(function(){return e[t]}))}(o);i["default"]=n.a},"1f2a":function(t,i,a){"use strict";var e=a("ae0a"),n=a.n(e);n.a},6283:function(t,i,a){var e=a("24fb");i=e(!1),i.push([t.i,"uni-page-body[data-v-33546a08]{background-color:#fbf8fb}body.?%PAGE?%[data-v-33546a08]{background-color:#fbf8fb}.lanjiazai[data-v-33546a08]{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.noData_box[data-v-33546a08]{margin-top:0;padding-bottom:%?260?%;text-align:center;color:#999;text-align:center}.noData_box uni-image[data-v-33546a08]{width:%?280?%}.noData_box .timeOut[data-v-33546a08]{font-size:12px;color:#666;margin:0 0 7px;display:flex;align-items:center;justify-content:center}.noData_box .timeOut uni-view[data-v-33546a08]:nth-child(2){color:#00acfd;padding-left:%?10?%}.noData_box .lijipay[data-v-33546a08]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-33546a08]{height:%?70?%!important;line-height:%?70?%!important}.m_list_wrap[data-v-33546a08]{padding:%?30?%}.m_list_wrap .m_list_item[data-v-33546a08]{display:flex;align-items:center;justify-content:space-between;background-color:#fff;border-radius:%?24?%;padding:%?30?%;margin-bottom:%?30?%}.m_list_wrap .m_list_item .m_list_item_info[data-v-33546a08]{flex:1}.m_list_wrap .m_list_item .m_list_item_info .m_title[data-v-33546a08]{display:flex;align-items:center;margin-bottom:%?20?%}.m_list_wrap .m_list_item .m_list_item_info .m_title .type_title[data-v-33546a08]{font-weight:700;font-size:%?34?%;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.m_list_wrap .m_list_item .m_list_item_info .m_title uni-image[data-v-33546a08]{width:%?50?%;height:%?50?%;border-radius:%?200?%;margin:0 %?10?%}.m_list_wrap .m_list_item .m_list_item_info .m_title span[data-v-33546a08]{font-weight:400;color:#666;margin-right:%?6?%}.m_list_wrap .m_list_item .m_list_item_info .m_type[data-v-33546a08]{margin:%?10?% 0;color:#666;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.m_list_wrap .m_list_item .m_list_item_info .m_time[data-v-33546a08]{color:#666}.m_list_wrap .m_list_item .m_price[data-v-33546a08]{color:#ff4910;font-weight:700;font-size:%?40?%}.top_box_wrap[data-v-33546a08]{padding:%?30?% %?20?% %?20?% %?20?%;background-color:#fff}.top_box_wrap .tabs_box[data-v-33546a08]{margin-top:%?20?%}.top_box_wrap .top_box[data-v-33546a08]{background-image:url(https://bwc.laimeitong.com/public/uploads/h5/me/mx_bg.jpg);background-size:100% 100%;background-repeat:no-repeat;padding:%?34?% %?50?%;border-radius:%?28?%;color:#fbe8cd}.top_box_wrap .top_box .top_item1[data-v-33546a08]{margin-bottom:%?10?%;display:flex;align-items:center;justify-content:space-between}.top_box_wrap .top_box .top_item1 uni-view[data-v-33546a08]:nth-child(2){border-radius:%?200?%;padding:%?10?% %?38?%;background-color:#fbe8cd;color:#3e4759}.top_box_wrap .top_box .top_item2[data-v-33546a08]{display:flex;align-items:center;justify-content:space-between}.top_box_wrap .top_box .top_item2 uni-view[data-v-33546a08]:nth-child(1){font-size:%?48?%;font-weight:700}",""]),t.exports=i},7174:function(t,i,a){"use strict";a.r(i);var e=a("12ff"),n=a("148d");for(var o in n)["default"].indexOf(o)<0&&function(t){a.d(i,t,(function(){return n[t]}))}(o);a("1f2a");var s=a("f0c5"),l=Object(s["a"])(n["default"],e["b"],e["c"],!1,null,"33546a08",null,!1,e["a"],void 0);i["default"]=l.exports},ae0a:function(t,i,a){var e=a("6283");e.__esModule&&(e=e.default),"string"===typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);var n=a("4f06").default;n("760de3a6",e,!0,{sourceMap:!1,shadowMode:!1})},f3e5:function(t,i,a){"use strict";(function(t){a("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,a("99af");var e=getApp(),n={data:function(){return{skeletonLoading:!0,list:[{name:"全部"},{name:"霸王餐补贴"},{name:"推广收益"},{name:"提现/支付"}],current:0,pageSize:1,pageNum:10,typs:"",BestImgUrl:e.globalData.imgurl,loadingstatus:"loading",loadText:{loadmore:"轻轻上拉",loading:"加载中...",nomore:"没有更多了"},failTimeOutShow:!1,userData:{},makemoneyData:{},incomeList:[]}},onShow:function(){this.getMyinCome();var t=uni.getStorageSync("userinfo");this.userData=t,this.getmakemoney()},onPullDownRefresh:function(){var t=this;t.pageSize=1,t.pageNum=10,t.skeletonLoading=!0,t.failTimeOutShow=!1,setTimeout((function(){t.getMyinCome(),uni.stopPullDownRefresh()}),1500)},onReachBottom:function(){var t=this;this.loadingstatus="loading",setTimeout((function(){t.pageSize++,t.getMyinCome(),uni.hideNavigationBarLoading()}),500)},methods:{refurbish:function(){var t=this;t.pageSize=1,t.pageNum=10,t.skeletonLoading=!0,setTimeout((function(){t.getMyinCome()}),2e3)},getmakemoney:function(){var t=this;t.$api.Getmakemoney({}).then((function(i){t.makemoneyData=i.data.result})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},getMyinCome:function(){var i=this;i.$api.getMyincome({page:i.pageSize,limit:i.pageNum,type:i.typs}).then((function(t){setTimeout((function(){1!=i.pageSize?0!=t.data.result.length?(i.loadingstatus="loading",i.incomeList=i.incomeList.concat(t.data.result)):i.loadingstatus="nomore":(i.incomeList=t.data.result,i.loadingstatus="nomore"),i.failTimeOutShow=!1,i.skeletonLoading=!1}),2e3)})).catch((function(a){a.data?uni.showToast({title:a.data.msg,icon:"none",duration:2e3}):(t("log","请求错误或请求超时",a.errMsg," at mePages/pages/incomeInfo.vue:185"),i.incomeList=[],i.skeletonLoading=!1,i.failTimeOutShow=!0)}))},change:function(t){this.current=t,0==t?(this.typs="",this.pageSize=1,this.skeletonLoading=!0,this.getMyinCome()):1==t?(this.typs=1,this.pageSize=1,this.skeletonLoading=!0,this.getMyinCome()):2==t?(this.typs=2,this.pageSize=1,this.skeletonLoading=!0,this.getMyinCome()):3==t&&(this.typs=3,this.pageSize=1,this.skeletonLoading=!0,this.getMyinCome())},lijitixian:function(){uni.navigateTo({url:"/pages/me/Cashwithdrawal"})}}};i.default=n}).call(this,a("0de9")["log"])}}]);