(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["signinPages-pages-Signin-signDetails"],{"1d5c":function(t,i,a){"use strict";a.r(i);var e=a("e126"),o=a.n(e);for(var n in e)["default"].indexOf(n)<0&&function(t){a.d(i,t,(function(){return e[t]}))}(n);i["default"]=o.a},"836e":function(t,i,a){"use strict";a.d(i,"b",(function(){return o})),a.d(i,"c",(function(){return n})),a.d(i,"a",(function(){return e}));var e={lSvga:a("9f25").default,uLoadmore:a("dd5b").default},o=function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("v-uni-view",[a("v-uni-view",{staticClass:"top_box_wrap"},[a("v-uni-view",{staticClass:"top_box"},[a("v-uni-view",{staticClass:"top_item2"},[a("v-uni-view",[t._v("我的金币")]),a("v-uni-view",[t._v(t._s(t.myjinbi||"0")),a("v-uni-image",{attrs:{src:"/static/images/sign_jb.png",mode:"widthFix"}})],1)],1)],1)],1),t.skeletonLoading?a("v-uni-view",{staticClass:"lanjiazai"},[a("v-uni-view",[a("v-uni-view",{staticClass:"loading_icon"},[a("l-svga",{attrs:{src:t.BestImgUrl+"loading.svga"}})],1),a("v-uni-view",{staticClass:"tag"},[t._v("加载中...")])],1)],1):a("v-uni-view",[0!=t.incomeList.length?a("v-uni-view",{staticClass:"m_list_wrap"},[t._l(t.incomeList,(function(i,e){return a("v-uni-view",{key:e,staticClass:"m_list_item"},[a("v-uni-view",{staticClass:"m_list_item_info"},[a("v-uni-view",{staticClass:"m_title"},[1==i.type?a("v-uni-view",{staticClass:"type_title"},[t._v("签到："+t._s(i.date))]):t._e(),2==i.type?a("v-uni-view",{staticClass:"type_title"},[t._v("补签："+t._s(i.date))]):t._e()],1),a("v-uni-view",{staticClass:"m_time"},[t._v(t._s(i.create_time))])],1),a("v-uni-view",{staticClass:"m_price"},[t._v("+ "+t._s(i.gold_coin))])],1)})),a("v-uni-view",{staticClass:"chudijiazai"},[a("u-loadmore",{attrs:{"icon-type":"flower",status:t.loadingstatus,"font-size":"24","load-text":t.loadText}}),1==t.Bottomingrefresh?a("v-uni-view",{staticClass:"Bottomingrefresh",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.RefreshBtn()}}},[t._v("立即刷新")]):t._e()],1)],2):0==t.failTimeOutShow?a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:"/static/images/noData.png",mode:"widthFix"}}),a("v-uni-view",[t._v("暂无明细")])],1):t._e(),1==t.failTimeOutShow?a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:"/static/images/Frame33412.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"timeOut"},[a("v-uni-view",[t._v("网络好像出问题了～")]),a("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.refurbish()}}},[t._v("立即刷新")])],1)],1):t._e()],1)],1)},n=[]},9587:function(t,i,a){var e=a("24fb");i=e(!1),i.push([t.i,"uni-page-body[data-v-4b92a496]{background-color:#fbf8fb}body.?%PAGE?%[data-v-4b92a496]{background-color:#fbf8fb}.lanjiazai[data-v-4b92a496]{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.noData_box[data-v-4b92a496]{margin-top:0;padding-bottom:%?260?%;text-align:center;color:#999;text-align:center}.noData_box uni-image[data-v-4b92a496]{width:%?280?%}.noData_box .timeOut[data-v-4b92a496]{font-size:12px;color:#666;margin:0 0 7px;display:flex;align-items:center;justify-content:center}.noData_box .timeOut uni-view[data-v-4b92a496]:nth-child(2){color:#ff611e;padding-left:%?10?%}.noData_box .lijipay[data-v-4b92a496]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-4b92a496]{height:%?70?%!important;line-height:%?70?%!important}.m_list_wrap[data-v-4b92a496]{padding:%?30?%}.m_list_wrap .m_list_item[data-v-4b92a496]{display:flex;align-items:center;justify-content:space-between;background-color:#fff;border-radius:%?24?%;padding:%?30?%;margin-bottom:%?30?%}.m_list_wrap .m_list_item .m_list_item_info[data-v-4b92a496]{flex:1}.m_list_wrap .m_list_item .m_list_item_info .m_title[data-v-4b92a496]{display:flex;align-items:center;margin-bottom:%?20?%}.m_list_wrap .m_list_item .m_list_item_info .m_title .type_title[data-v-4b92a496]{font-weight:700;font-size:%?28?%;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.m_list_wrap .m_list_item .m_list_item_info .m_title uni-image[data-v-4b92a496]{width:%?50?%;height:%?50?%;border-radius:%?200?%;margin:0 %?10?%}.m_list_wrap .m_list_item .m_list_item_info .m_title span[data-v-4b92a496]{font-weight:400;color:#666;margin-right:%?6?%}.m_list_wrap .m_list_item .m_list_item_info .m_type[data-v-4b92a496]{margin:%?10?% 0;color:#666;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.m_list_wrap .m_list_item .m_list_item_info .m_time[data-v-4b92a496]{color:#666;font-size:%?24?%}.m_list_wrap .m_list_item .m_price[data-v-4b92a496]{color:#ff4910;font-weight:700;font-size:%?40?%}.top_box_wrap[data-v-4b92a496]{padding:%?30?% %?20?% %?20?% %?20?%;background-color:#fff}.top_box_wrap .tabs_box[data-v-4b92a496]{margin-top:%?20?%}.top_box_wrap .top_box[data-v-4b92a496]{background-image:url(https://bwc.laimeitong.com/public/uploads/h5/Group33276.png);background-size:100% 100%;background-repeat:no-repeat;padding:%?24?% %?50?%;border-radius:%?28?%;height:%?110?%;color:#fbe8cd}.top_box_wrap .top_box .top_item1[data-v-4b92a496]{margin-bottom:%?10?%;display:flex;align-items:center;justify-content:space-between}.top_box_wrap .top_box .top_item1 uni-view[data-v-4b92a496]:nth-child(2){border-radius:%?200?%;padding:%?10?% %?38?%;background-color:#fbe8cd;color:#3e4759}.top_box_wrap .top_box .top_item2[data-v-4b92a496]{display:flex;align-items:center;justify-content:space-between}.top_box_wrap .top_box .top_item2 uni-view[data-v-4b92a496]:nth-child(1){font-size:%?28?%;color:#fff3a0}.top_box_wrap .top_box .top_item2 uni-view[data-v-4b92a496]:nth-child(2){font-size:%?48?%;color:#fff3a0;display:flex;align-items:center;font-weight:700}.top_box_wrap .top_box .top_item2 uni-view:nth-child(2) uni-image[data-v-4b92a496]{margin-left:%?8?%;width:%?46?%}",""]),t.exports=i},ac3e:function(t,i,a){"use strict";var e=a("ee70"),o=a.n(e);o.a},e0f2:function(t,i,a){"use strict";a.r(i);var e=a("836e"),o=a("1d5c");for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(i,t,(function(){return o[t]}))}(n);a("ac3e");var s=a("f0c5"),l=Object(s["a"])(o["default"],e["b"],e["c"],!1,null,"4b92a496",null,!1,e["a"],void 0);i["default"]=l.exports},e126:function(t,i,a){"use strict";(function(t){a("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,a("99af");var e=getApp(),o={data:function(){return{skeletonLoading:!0,failTimeOutShow:!1,Bottomingrefresh:!1,loadingstatus:"nomore",loadText:{loadmore:"轻轻上拉",loading:"加载中...",nomore:"没有更多了"},list:[{name:"全部"},{name:"收入"},{name:"兑换"}],current:0,pageSize:1,pageNum:10,typs:"",BestImgUrl:e.globalData.imgurl,myjinbi:"",incomeList:[]}},onLoad:function(t){this.myjinbi=t.jinbi},onShow:function(){this.getMyinCome()},onPullDownRefresh:function(){var t=this;t.pageSize=1,t.pageNum=10,t.skeletonLoading=!0,t.failTimeOutShow=!1,setTimeout((function(){t.getMyinCome(),uni.stopPullDownRefresh()}),1500)},onReachBottom:function(){var t=this;this.loadingstatus="loading",t.loadText.nomore="没有更多了",t.Bottomingrefresh=!1,setTimeout((function(){t.pageSize++,t.getMyinCome(),uni.hideNavigationBarLoading()}),500)},methods:{refurbish:function(){var t=this;t.pageSize=1,t.pageNum=10,t.skeletonLoading=!0,t.loadingstatus="nomore",t.Bottomingrefresh=!1,setTimeout((function(){t.getMyinCome()}),2e3)},RefreshBtn:function(){this.loadingstatus="loading",this.loadText.nomore="没有更多了",this.Bottomingrefresh=!1,this.GetShopslist()},getMyinCome:function(){var i=this;i.$api.signDetails({page:i.pageSize,limit:i.pageNum}).then((function(t){i.loadText.nomore="没有更多了",i.Bottomingrefresh=!1,setTimeout((function(){1!=i.pageSize?0!=t.data.result.length?(i.loadingstatus="loading",i.incomeList=i.incomeList.concat(t.data.result)):i.loadingstatus="nomore":(i.incomeList=t.data.result,i.loadingstatus="nomore"),i.failTimeOutShow=!1,i.skeletonLoading=!1}),2e3)})).catch((function(a){a.data?uni.showToast({title:a.data.msg,icon:"none",duration:2e3}):(t("log","请求错误或请求超时",a.errMsg," at signinPages/pages/Signin/signDetails.vue:196"),i.skeletonLoading=!1,"loading"==i.loadingstatus?(i.loadingstatus="nomore",i.loadText.nomore="网络好像出问题了~",i.Bottomingrefresh=!0):(i.incomeList=[],i.loadingstatus="loading",i.loadText.nomore="没有更多了",i.Bottomingrefresh=!1,i.failTimeOutShow=!0))}))},change:function(t){this.current=t,0==t?(this.typs="",this.pageSize=1):1==t?(this.typs=1,this.pageSize=1):2==t?(this.typs=2,this.pageSize=1):3==t&&(this.typs=3,this.pageSize=1)}}};i.default=o}).call(this,a("0de9")["log"])},ee70:function(t,i,a){var e=a("9587");e.__esModule&&(e=e.default),"string"===typeof e&&(e=[[t.i,e,""]]),e.locals&&(t.exports=e.locals);var o=a("4f06").default;o("ab4d6688",e,!0,{sourceMap:!1,shadowMode:!1})}}]);