(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-me-incomeInfo"],{"1ecc":function(t,i,e){var a=e("ab90");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=e("4f06").default;n("9f701d16",a,!0,{sourceMap:!1,shadowMode:!1})},"4a0f":function(t,i,e){"use strict";(function(t){e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,e("99af");var a={data:function(){return{skeletonLoading:!0,list:[{name:"全部"},{name:"霸王餐补贴"},{name:"推广收益"},{name:"提现/支付"}],current:0,pageSize:1,pageNum:10,typs:"",loadingstatus:"loading",loadText:{loadmore:"轻轻上拉",loading:"加载中...",nomore:"没有更多了"},failTimeOutShow:!1,userData:{},makemoneyData:{},incomeList:[]}},onShow:function(){this.getMyinCome();var t=uni.getStorageSync("userinfo");this.userData=t,this.getmakemoney()},onPullDownRefresh:function(){var t=this;t.pageSize=1,t.pageNum=10,t.skeletonLoading=!0,t.failTimeOutShow=!1,setTimeout((function(){t.getMyinCome(),uni.stopPullDownRefresh()}),1500)},onReachBottom:function(){var t=this;this.loadingstatus="loading",setTimeout((function(){t.pageSize++,t.getMyinCome(),uni.hideNavigationBarLoading()}),500)},methods:{refurbish:function(){var t=this;t.pageSize=1,t.pageNum=10,t.skeletonLoading=!0,setTimeout((function(){t.getMyinCome()}),2e3)},getmakemoney:function(){var t=this;t.$api.Getmakemoney({}).then((function(i){t.makemoneyData=i.data.result})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},getMyinCome:function(){var i=this;i.$api.getMyincome({page:i.pageSize,limit:i.pageNum,type:i.typs}).then((function(t){setTimeout((function(){1!=i.pageSize?0!=t.data.result.length?(i.loadingstatus="loading",i.incomeList=i.incomeList.concat(t.data.result)):i.loadingstatus="nomore":(i.incomeList=t.data.result,i.loadingstatus="nomore"),i.failTimeOutShow=!1,i.skeletonLoading=!1}),2e3)})).catch((function(e){e.data?uni.showToast({title:e.data.msg,icon:"none",duration:2e3}):(t("log","请求错误或请求超时",e.errMsg," at pages/me/incomeInfo.vue:184"),i.incomeList=[],i.skeletonLoading=!1,i.failTimeOutShow=!0)}))},change:function(t){this.current=t,0==t?(this.typs="",this.pageSize=1,this.skeletonLoading=!0,this.getMyinCome()):1==t?(this.typs=1,this.pageSize=1,this.skeletonLoading=!0,this.getMyinCome()):2==t?(this.typs=2,this.pageSize=1,this.skeletonLoading=!0,this.getMyinCome()):3==t&&(this.typs=3,this.pageSize=1,this.skeletonLoading=!0,this.getMyinCome())},lijitixian:function(){uni.navigateTo({url:"/pages/me/Cashwithdrawal"})}}};i.default=a}).call(this,e("0de9")["log"])},6179:function(t,i,e){"use strict";e.d(i,"b",(function(){return n})),e.d(i,"c",(function(){return o})),e.d(i,"a",(function(){return a}));var a={uTabs:e("25db").default,lSvga:e("9f25").default,uLoadmore:e("dd5b").default},n=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",[e("v-uni-view",{staticClass:"top_box_wrap"},[e("v-uni-view",{staticClass:"top_box"},[e("v-uni-view",{staticClass:"top_item1"},[e("v-uni-view",[t._v("余额")]),e("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.lijitixian()}}},[t._v("立即提现")])],1),e("v-uni-view",{staticClass:"top_item2"},[e("v-uni-view",[t._v(t._s(t.userData.money))]),e("v-uni-view",[t._v("今日收益："+t._s(t.makemoneyData.today_income_money)+"元")])],1)],1),e("v-uni-view",{staticClass:"tabs_box"},[e("u-tabs",{attrs:{list:t.list,"is-scroll":!1,current:t.current,"active-color":"#FF4910"},on:{change:function(i){arguments[0]=i=t.$handleEvent(i),t.change.apply(void 0,arguments)}}})],1)],1),t.skeletonLoading?e("v-uni-view",{staticClass:"lanjiazai"},[e("v-uni-view",[e("v-uni-view",{staticClass:"loading_icon"},[e("l-svga",{attrs:{src:"/static/images/loading.svga"}})],1),e("v-uni-view",{staticClass:"tag"},[t._v("加载中...")])],1)],1):e("v-uni-view",[0!=t.incomeList.length?e("v-uni-view",{staticClass:"m_list_wrap"},[t._l(t.incomeList,(function(i,a){return e("v-uni-view",{key:a,staticClass:"m_list_item"},[e("v-uni-view",{staticClass:"m_list_item_info"},[e("v-uni-view",{staticClass:"m_title"},[e("v-uni-view",{staticClass:"type_title"},[t._v(t._s(i.title))])],1),e("v-uni-view",{staticClass:"m_time"},[t._v(t._s(i.create_time))])],1),e("v-uni-view",{staticClass:"m_price"},[t._v(t._s(i.amount))])],1)})),e("u-loadmore",{attrs:{"icon-type":"flower",status:t.loadingstatus,"font-size":"24","load-text":t.loadText,"margin-bottom":"60"}})],2):0==t.incomeList.length&&0==t.failTimeOutShow?e("v-uni-view",{staticClass:"noData_box"},[e("v-uni-image",{attrs:{src:"/static/images/noData.png",mode:"widthFix"}}),e("v-uni-view",[t._v("暂无明细")])],1):1==t.failTimeOutShow&&0==t.incomeList.length?e("v-uni-view",{staticClass:"noData_box"},[e("v-uni-image",{attrs:{src:"/static/images/Frame33412.png",mode:"widthFix"}}),e("v-uni-view",{staticClass:"timeOut"},[e("v-uni-view",[t._v("网络好像出问题了~")]),e("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.refurbish()}}},[t._v("立即刷新")])],1)],1):t._e()],1)],1)},o=[]},"9b3c":function(t,i,e){"use strict";e.r(i);var a=e("4a0f"),n=e.n(a);for(var o in a)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(o);i["default"]=n.a},"9fae":function(t,i,e){"use strict";e.r(i);var a=e("6179"),n=e("9b3c");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(o);e("abc5");var s=e("f0c5"),l=Object(s["a"])(n["default"],a["b"],a["c"],!1,null,"0fde0a33",null,!1,a["a"],void 0);i["default"]=l.exports},ab90:function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,"uni-page-body[data-v-0fde0a33]{background-color:#fbf8fb}body.?%PAGE?%[data-v-0fde0a33]{background-color:#fbf8fb}.lanjiazai[data-v-0fde0a33]{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.noData_box[data-v-0fde0a33]{margin-top:0;padding-bottom:%?260?%;text-align:center;color:#999;text-align:center}.noData_box uni-image[data-v-0fde0a33]{width:%?280?%}.noData_box .timeOut[data-v-0fde0a33]{font-size:12px;color:#666;margin:0 0 7px;display:flex;align-items:center;justify-content:center}.noData_box .timeOut uni-view[data-v-0fde0a33]:nth-child(2){color:#00acfd;padding-left:%?10?%}.noData_box .lijipay[data-v-0fde0a33]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-0fde0a33]{height:%?70?%!important;line-height:%?70?%!important}.m_list_wrap[data-v-0fde0a33]{padding:%?30?%}.m_list_wrap .m_list_item[data-v-0fde0a33]{display:flex;align-items:center;justify-content:space-between;background-color:#fff;border-radius:%?24?%;padding:%?30?%;margin-bottom:%?30?%}.m_list_wrap .m_list_item .m_list_item_info[data-v-0fde0a33]{flex:1}.m_list_wrap .m_list_item .m_list_item_info .m_title[data-v-0fde0a33]{display:flex;align-items:center;margin-bottom:%?20?%}.m_list_wrap .m_list_item .m_list_item_info .m_title .type_title[data-v-0fde0a33]{font-weight:700;font-size:%?34?%;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.m_list_wrap .m_list_item .m_list_item_info .m_title uni-image[data-v-0fde0a33]{width:%?50?%;height:%?50?%;border-radius:%?200?%;margin:0 %?10?%}.m_list_wrap .m_list_item .m_list_item_info .m_title span[data-v-0fde0a33]{font-weight:400;color:#666;margin-right:%?6?%}.m_list_wrap .m_list_item .m_list_item_info .m_type[data-v-0fde0a33]{margin:%?10?% 0;color:#666;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.m_list_wrap .m_list_item .m_list_item_info .m_time[data-v-0fde0a33]{color:#666}.m_list_wrap .m_list_item .m_price[data-v-0fde0a33]{color:#ff4910;font-weight:700;font-size:%?40?%}.top_box_wrap[data-v-0fde0a33]{padding:%?30?% %?20?% %?20?% %?20?%;background-color:#fff}.top_box_wrap .tabs_box[data-v-0fde0a33]{margin-top:%?20?%}.top_box_wrap .top_box[data-v-0fde0a33]{background-image:url(https://bwc.laimeitong.com/public/uploads/h5/me/mx_bg.jpg);background-size:100% 100%;background-repeat:no-repeat;padding:%?34?% %?50?%;border-radius:%?28?%;color:#fbe8cd}.top_box_wrap .top_box .top_item1[data-v-0fde0a33]{margin-bottom:%?10?%;display:flex;align-items:center;justify-content:space-between}.top_box_wrap .top_box .top_item1 uni-view[data-v-0fde0a33]:nth-child(2){border-radius:%?200?%;padding:%?10?% %?38?%;background-color:#fbe8cd;color:#3e4759}.top_box_wrap .top_box .top_item2[data-v-0fde0a33]{display:flex;align-items:center;justify-content:space-between}.top_box_wrap .top_box .top_item2 uni-view[data-v-0fde0a33]:nth-child(1){font-size:%?48?%;font-weight:700}",""]),t.exports=i},abc5:function(t,i,e){"use strict";var a=e("1ecc"),n=e.n(a);n.a}}]);