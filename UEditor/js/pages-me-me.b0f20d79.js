(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-me-me"],{"661f":function(e,a,i){"use strict";(function(e){i("7a82"),Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var t=getApp(),n={data:function(){return{fensiqun_Show:!1,BestImgUrl:t.globalData.imgurl,tabslist:[],Tabcurrent:0,mtmemberInfo:{},bdingPhone_Show:!1,navbackground:{backgroundImage:"linear-gradient(180deg, transparent, transparent)"},menuList:[],userInfo:{},mytel:"",qr_image:{}}},onPageScroll:function(e){e.scrollTop>=1?this.navbackground.backgroundImage="linear-gradient(180deg, #fff6e9, #fff6e9)":this.navbackground.backgroundImage="linear-gradient(180deg, transparent, transparent)"},onLoad:function(e){this.getMenuList()},onShow:function(){var e=uni.getStorageSync("token");if(e){this.Getmyinfo();var a={parent_id:uni.getStorageSync("parent_id"),reseller_id:{reseller_id:uni.getStorageSync("reseller_id")||""}};t.globalData.bindSaveParentId(a)}else this.userInfo={};this.getFanGroup()},methods:{Getmyinfo:function(){var a=this;a.$api.GetuserInfo({}).then((function(i){e("log","个人信息",i," at pages/me/me.vue:274"),a.userInfo=i.data.result,a.userInfo.username||(a.bdingPhone_Show=!0);var t=a.userInfo.username.substring(0,3)+"****"+a.userInfo.username.substring(7);a.mytel=t,uni.setStorageSync("userinfo",i.data.result)})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})})),a.$api.getMembertype({version:uni.getStorageSync("version")}).then((function(e){a.mtmemberInfo=e.data.result})).catch((function(e){uni.showToast({title:e.data.msg,icon:"none",duration:2e3})}))},getFanGroup:function(){var e=this,a=uni.getStorageSync("CityName");e.$api.GetFanGroup({city:a,province:""}).then((function(a){null==a.data.result||(e.qr_image=a.data.result)})).catch((function(e){}))},getMenuList:function(){var a=this;a.$api.GetMeMenulist({client:"h5"}).then((function(e){a.menuList=e.data.result})).catch((function(a){e("log","失败",a.data," at pages/me/me.vue:332"),uni.showToast({title:a.data.msg,icon:"none",duration:2e3})}))},Tomenus:function(e,a){var i=uni.getStorageSync("token");i?2==e.type?uni.switchTab({url:e.path}):1==e.type?uni.navigateTo({url:e.path}):3==e.type?window.location.href=e.path:e.type:uni.navigateTo({url:"/logoPages/pages/logon/logon"})},ToUrlpage:function(e){var a=uni.getStorageSync("token");a?uni.navigateTo({url:e,animationType:"pop-in"}):uni.navigateTo({url:"/logoPages/pages/logon/logon"})},Toindex:function(e){uni.switchTab({url:e})},TobingdingPhone:function(){uni.navigateTo({url:"/mePages/pages/Bindphone",animationType:"pop-in"})},callservice:function(){var a=uni.getStorageSync("customerServiceData");e("log","客服链接",a," at pages/me/me.vue:446"),window.location.href=a.h5.url}}};a.default=n}).call(this,i("0de9")["log"])},"750a":function(e,a,i){var t=i("24fb");a=t(!1),a.push([e.i,"uni-page-body[data-v-a15264e2]{background-image:linear-gradient(180deg,#f8f8fb,#f8f8fb);height:100%;-webkit-animation:dialog-fade-in-data-v-a15264e2 .3s linear 1;animation:dialog-fade-in-data-v-a15264e2 .3s linear 1}body.?%PAGE?%[data-v-a15264e2]{background-image:linear-gradient(180deg,#f8f8fb,#f8f8fb)}.subtitle[data-v-a15264e2]{display:flex;align-items:center;justify-content:space-between}.subtitle uni-view[data-v-a15264e2]{font-weight:700;font-size:%?28?%}.subtitle uni-view span[data-v-a15264e2]{font-weight:400!important;font-size:%?24?%;color:#999}.tc_wrap22[data-v-a15264e2]{padding:0;text-align:center}.tc_wrap22 .tc_images22 uni-image[data-v-a15264e2]{width:100%;height:%?350?%}.tc_wrap22 .tc_info uni-view[data-v-a15264e2]:nth-child(1){font-weight:700;font-size:%?34?%;margin-bottom:%?20?%}.tc_wrap22 .tc_info uni-view[data-v-a15264e2]:nth-child(2){font-weight:700;color:#333}.tc_wrap22 .tc_info uni-view:nth-child(2) span[data-v-a15264e2]{color:#ff611e}.tc_wrap22 .tc_btn_box[data-v-a15264e2]{display:flex;align-items:center;padding:%?30?% %?30?% %?60?% %?30?%}.tc_wrap22 .tc_btn_box .tc_btn_huise[data-v-a15264e2]{flex:1;margin-right:%?12?%;background:linear-gradient(90deg,#f7f7f7,50%,#f7f7f7);border-radius:%?200?%;padding:%?28?% 0;text-align:center;color:#333}.tc_wrap22 .tc_btn_box .tc_btn_huise_err[data-v-a15264e2]{flex:1;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff;border-radius:%?200?%;padding:%?28?% 0;text-align:center}.tc_wrap22 .tc_btn_box .lijipay[data-v-a15264e2]{width:%?300?%;margin-left:%?12?%;position:relative;margin:0 auto}.tc_wrap22 .tc_btn_box .lijipay .u-size-default[data-v-a15264e2]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}.toos_box[data-v-a15264e2]{flex:1;padding:0 %?30?% 0 0}.toos_box uni-view[data-v-a15264e2]{display:flex;align-items:center;justify-content:flex-end}.toos_box uni-view uni-image[data-v-a15264e2]{width:%?44?%;height:%?44?%;margin-left:%?24?%}.toos_box[data-v-a15264e2] uni-button{background-color:initial!important;padding:0!important;margin:0!important;line-height:0!important}.toos_box[data-v-a15264e2] uni-button::after{border:none!important}.toos_box222[data-v-a15264e2]{position:absolute;top:%?30?%;right:%?10?%;flex:1;padding:0 %?30?% 0 0}.toos_box222 uni-view[data-v-a15264e2]{display:flex;align-items:center;justify-content:flex-end}.toos_box222 uni-view uni-image[data-v-a15264e2]{width:%?44?%;height:%?44?%;margin-left:%?24?%}.toos_box222[data-v-a15264e2] uni-button{background-color:initial!important;padding:0!important;margin:0!important;line-height:0!important}.toos_box222[data-v-a15264e2] uni-button::after{border:none!important}.membar-wrap[data-v-a15264e2]{margin-top:0;margin-bottom:%?24?%;position:relative;height:%?144?%}.membar-wrap .zuan_bg[data-v-a15264e2]{width:100%;height:%?144?%;border-radius:%?20?%;vertical-align:bottom}.membar-wrap .zuan_info[data-v-a15264e2]{position:absolute;top:0;left:0;display:flex;align-items:center;width:100%;padding-right:%?20?%}.membar-wrap .zuan_info .zuan_1[data-v-a15264e2]{width:%?170?%;height:%?144?%;position:relative;top:%?22?%}.membar-wrap .zuan_info .zuan_l_info uni-view[data-v-a15264e2]:nth-child(1){font-weight:700;margin-bottom:%?10?%}.membar-wrap .zuan_info .zuan_l_info uni-view[data-v-a15264e2]:nth-child(2){background-color:#f3f5ef;border-radius:%?200?%;padding:%?4?% %?20?%;font-size:%?24?%;color:#666}.membar-wrap .zuan_info .zuan_l_info .yishihuiyuan[data-v-a15264e2]{background-color:#e8e8e8!important;display:inline-block}.membar-wrap .zuan_info .zuan_l_info2 uni-view[data-v-a15264e2]:nth-child(1){font-weight:700;margin-bottom:%?10?%}.membar-wrap .zuan_info .zuan_l_info2 uni-view[data-v-a15264e2]:nth-child(2){background-color:#f3f5ef;border-radius:%?200?%;padding:%?4?% %?20?%;font-size:%?24?%;color:#666}.membar-wrap .zuan_info .zuan_l_info2 .yishihuiyuan[data-v-a15264e2]{background-color:hsla(0,0%,100%,.4)!important;display:inline-block}.membar-wrap .zuan_info .zuan_btn[data-v-a15264e2]{margin-left:auto;background-color:#bebebe;border-radius:%?200?%;padding:%?10?% %?10?% %?10?% %?20?%;font-size:%?24?%;text-align:center;color:#333}.membar-wrap .zuan_info .zuan_btn2[data-v-a15264e2]{margin-left:auto;background-image:linear-gradient(80deg,#fff,#ffe68f);border-radius:%?200?%;padding:%?10?% %?10?% %?10?% %?20?%;font-size:%?24?%;text-align:center;color:#f09536}.page_wrap[data-v-a15264e2]{padding:0 %?30?% %?30?% %?30?%;background-image:linear-gradient(180deg,#f8f8fb,#f8f8fb)}.page_wrap .income_wrap[data-v-a15264e2]{background-color:#fff;border-radius:%?20?%;padding:%?30?%;margin:0 0 %?16?% 0}.page_wrap .income_wrap .order_tool_bar .tool_title[data-v-a15264e2]{padding:%?20?% 0 0 0;font-weight:700;margin-top:%?10?%}.page_wrap .income_wrap .order_tool_bar .tool_menu[data-v-a15264e2]{margin-top:0}.page_wrap .income_wrap .order_tool_bar .tool_menu .demo-layout[data-v-a15264e2]{text-align:center;margin-top:%?20?%;font-size:%?24?%}.page_wrap .income_wrap .order_tool_bar .tool_menu .demo-layout uni-image[data-v-a15264e2]{width:%?56?%;height:%?56?%}.page_wrap .income_wrap .order_tool_bar .tool_menu .demo-layout .menu_name[data-v-a15264e2]{font-size:%?24?%;margin-top:%?16?%}.page_wrap .income_wrap .title[data-v-a15264e2]{border-bottom:1px solid #f7f7f7;padding:0 0 %?20?% 0}.page_wrap .income_wrap .title22[data-v-a15264e2]{padding:0 0 0 0}.page_wrap .income_wrap .income_mx[data-v-a15264e2]{padding:%?20?% 0 0 0}.page_wrap .income_wrap .income_mx .income_mx_1[data-v-a15264e2]{margin-bottom:%?10?%;color:#000;font-size:%?28?%}.page_wrap .income_wrap .income_mx .income_mx_2[data-v-a15264e2]{display:flex;align-items:center;justify-content:space-between}.page_wrap .income_wrap .income_mx .income_mx_2 .income_mx_3[data-v-a15264e2]{font-size:%?56?%;font-weight:700;color:#ff4910}.page_wrap .income_wrap .income_mx .income_mx_2 .income_mx_3 span[data-v-a15264e2]{font-size:%?30?%;color:#333}.page_wrap .income_wrap .income_mx .income_mx_2 .income_mx_4[data-v-a15264e2]{border-radius:%?200?%;color:#fff;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;text-align:center;padding:%?10?% %?40?%}.page_wrap .income_wrap .income_xj[data-v-a15264e2]{display:flex;align-items:center;justify-content:space-between;margin-top:%?24?%}.page_wrap .income_wrap .income_xj .income_xj1[data-v-a15264e2]{display:flex;align-items:center;justify-content:space-between;flex:1;background-color:#f9f9f9;padding:%?16?% %?16?%;border-radius:%?10?%}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2[data-v-a15264e2]{flex:1}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2 uni-view[data-v-a15264e2]:nth-child(1){color:#999;font-size:%?24?%;display:flex;align-items:center;justify-content:space-between}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2 uni-view[data-v-a15264e2]:nth-child(2){margin-top:%?14?%;font-size:%?32?%;font-weight:700;display:flex;align-items:center;justify-content:space-between}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2 uni-view:nth-child(2) .income_xj3[data-v-a15264e2]{color:#999;text-align:center;font-size:%?24?%;font-weight:400;margin:0}.page_wrap .income_wrap .income_xj .income_xj1 .income_xj2 uni-view:nth-child(2) .income_xj3 .u-icon[data-v-a15264e2]{margin:0!important;position:relative;top:%?2?%}.page_wrap .income_wrap .income_xj .line_1[data-v-a15264e2]{width:1px;height:%?70?%;background-color:#f7f7f7;margin:0 %?30?%}.page_wrap .tx_box[data-v-a15264e2]{display:flex;align-items:center;padding-top:%?30?%;padding-bottom:%?20?%}.page_wrap .tx_box .tx_img .my_img[data-v-a15264e2]{width:%?120?%;height:%?120?%;border-radius:%?200?%;border:2px solid #fff}.page_wrap .tx_box .my_info[data-v-a15264e2]{padding-left:%?20?%}.page_wrap .tx_box .my_info .my_name[data-v-a15264e2]{font-weight:700;font-size:%?34?%;margin-bottom:%?14?%}.page_wrap .tx_box .my_info .my_id[data-v-a15264e2]{color:#999;display:flex;align-items:center;font-size:%?24?%}.page_wrap .tx_box .my_info .my_id span[data-v-a15264e2]{padding-left:%?20?%}.tc_wrap[data-v-a15264e2]{padding:%?30?%;text-align:center}.tc_wrap .tc_images uni-image[data-v-a15264e2]{width:%?300?%;height:%?300?%}.tc_wrap .tc_info uni-view[data-v-a15264e2]:nth-child(1){font-weight:700;font-size:%?32?%;margin-bottom:%?20?%}.tc_wrap .tc_info uni-view[data-v-a15264e2]:nth-child(2){font-size:%?28?%;color:#999}.tc_wrap .tc_info uni-view:nth-child(2) span[data-v-a15264e2]{color:#ff611e}.tc_wrap .tc_btn_box[data-v-a15264e2]{display:flex;align-items:center;margin-top:%?36?%;justify-content:center;padding:0 %?30?%}.tc_wrap .tc_btn_box .tc_btn_huise[data-v-a15264e2]{flex:1;margin-right:%?12?%;background:linear-gradient(90deg,#f7f7f7,50%,#f7f7f7);border-radius:%?200?%;padding:0 0;height:%?80?%!important;line-height:%?80?%!important;text-align:center;color:#333}.tc_wrap .tc_btn_box .tc_btn_huise_err[data-v-a15264e2]{flex:1;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff;border-radius:%?200?%;padding:0 0;height:%?80?%!important;line-height:%?80?%!important;text-align:center}.tc_wrap .tc_btn_box .lijipay[data-v-a15264e2]{flex:1;margin-left:%?12?%;position:relative}.tc_wrap .tc_btn_box .lijipay .u-size-default[data-v-a15264e2]{height:%?80?%!important;line-height:%?80?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important;color:#fff}@-webkit-keyframes dialog-fade-in-data-v-a15264e2{0%{opacity:0}100%{opacity:1}}@keyframes dialog-fade-in-data-v-a15264e2{0%{opacity:0}100%{opacity:1}}",""]),e.exports=a},"86dc":function(e,a,i){var t=i("750a");t.__esModule&&(t=t.default),"string"===typeof t&&(t=[[e.i,t,""]]),t.locals&&(e.exports=t.locals);var n=i("4f06").default;n("d1bcd472",t,!0,{sourceMap:!1,shadowMode:!1})},"93fa":function(e,a,i){"use strict";i.r(a);var t=i("fd99"),n=i("b51f");for(var o in n)["default"].indexOf(o)<0&&function(e){i.d(a,e,(function(){return n[e]}))}(o);i("ecd6");var r=i("f0c5"),s=Object(r["a"])(n["default"],t["b"],t["c"],!1,null,"a15264e2",null,!1,t["a"],void 0);a["default"]=s.exports},b51f:function(e,a,i){"use strict";i.r(a);var t=i("661f"),n=i.n(t);for(var o in t)["default"].indexOf(o)<0&&function(e){i.d(a,e,(function(){return t[e]}))}(o);a["default"]=n.a},ecd6:function(e,a,i){"use strict";var t=i("86dc"),n=i.n(t);n.a},fd99:function(e,a,i){"use strict";i.d(a,"b",(function(){return n})),i.d(a,"c",(function(){return o})),i.d(a,"a",(function(){return t}));var t={uPopup:i("627b").default,uButton:i("eeee").default,uIcon:i("21cf").default,uRow:i("9e90").default,uCol:i("c483").default},n=function(){var e=this,a=e.$createElement,i=e._self._c||a;return i("v-uni-view",[i("u-popup",{attrs:{mode:"center",width:"550","border-radius":"28"},model:{value:e.bdingPhone_Show,callback:function(a){e.bdingPhone_Show=a},expression:"bdingPhone_Show"}},[i("v-uni-view",{staticClass:"tc_wrap22"},[i("v-uni-view",{staticClass:"tc_images22"},[i("v-uni-image",{attrs:{src:e.BestImgUrl+"me/lhy_Mask-group.png"}})],1),i("v-uni-view",{staticClass:"tc_info"},[i("v-uni-view",[e._v("绑定手机号")]),i("v-uni-view",[e._v("领1个月"),i("span",[e._v("VIP会员")])])],1),i("v-uni-view",{staticClass:"tc_btn_box"},[i("v-uni-view",{staticClass:"lijipay"},[i("u-button",{attrs:{type:"info",shape:"circle"},on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.TobingdingPhone()}}},[e._v("去绑定")])],1)],1)],1)],1),i("v-uni-view",{staticClass:"page_wrap"},[i("v-uni-view",{staticClass:"tx_box"},[i("v-uni-view",{staticClass:"toos_box222"},[i("v-uni-view",[i("v-uni-image",{attrs:{src:e.BestImgUrl+"me/me_set.png"},on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.ToUrlpage("/mePages/pages/BasicSettings/BasicSettings")}}}),i("v-uni-image",{attrs:{src:e.BestImgUrl+"me/me_kefu.png"},on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.callservice()}}})],1)],1),i("v-uni-view",{staticClass:"tx_img"},[i("v-uni-image",{staticClass:"my_img",attrs:{src:e.userInfo.avatar||"/static/images/Group-33475.png"}})],1),e.userInfo.id?i("v-uni-view",{staticClass:"my_info"},[i("v-uni-view",{staticClass:"my_name"},[e._v(e._s(e.userInfo.nickname||"暂无昵称"))]),i("v-uni-view",{staticClass:"my_id"},[e._v("ID: "+e._s(e.userInfo.id)),i("span",[e._v("手机号: "+e._s(e.mytel))])])],1):i("v-uni-view",{staticClass:"my_info"},[i("v-uni-view",{staticClass:"my_name",on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.ToUrlpage("/logoPages/pages/logon/logon")}}},[e._v("登录")])],1)],1),e.userInfo.id?i("v-uni-view",{staticClass:"membar-wrap"},[0==e.mtmemberInfo.is_member?i("v-uni-image",{staticClass:"zuan_bg",attrs:{src:e.BestImgUrl+"me/me_zuan_bg.png",mode:"aspectFill"}}):e._e(),1==e.mtmemberInfo.is_member?i("v-uni-image",{staticClass:"zuan_bg",attrs:{src:e.BestImgUrl+"me/me_zuan_bg2.png",mode:"aspectFill"}}):e._e(),i("v-uni-view",{staticClass:"zuan_info",on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.ToUrlpage("/merberPages/pages/member/member")}}},[0==e.mtmemberInfo.is_member?i("v-uni-image",{staticClass:"zuan_1",attrs:{src:e.BestImgUrl+"me/me_zuan.png",mode:"aspectFill"}}):e._e(),1==e.mtmemberInfo.is_member?i("v-uni-image",{staticClass:"zuan_1",attrs:{src:e.BestImgUrl+"me/me_zuan2.png",mode:"aspectFill"}}):e._e(),0==e.mtmemberInfo.is_member?i("v-uni-view",{staticClass:"zuan_l_info"},[i("v-uni-view",[e._v("普通用户")]),i("v-uni-view",[e._v("开通会员每月多省1000元")])],1):e._e(),1==e.mtmemberInfo.is_member?i("v-uni-view",{staticClass:"zuan_l_info2"},[i("v-uni-view",[e._v("您是尊贵的VIP会员")]),i("v-uni-view",{staticClass:"yishihuiyuan"},[e._v(e._s(e.userInfo.member_expiry_time)+" 到期")])],1):e._e(),0==e.mtmemberInfo.is_member?i("v-uni-view",{staticClass:"zuan_btn",on:{click:function(a){a.stopPropagation(),arguments[0]=a=e.$handleEvent(a),e.ToUrlpage("/merberPages/pages/member/member")}}},[e._v("立即开通"),i("u-icon",{attrs:{name:"arrow-right",color:"#333",size:"28"}})],1):e._e(),1==e.mtmemberInfo.is_member?i("v-uni-view",{staticClass:"zuan_btn2",on:{click:function(a){a.stopPropagation(),arguments[0]=a=e.$handleEvent(a),e.Toindex("/pages/index/index")}}},[e._v("立即抢单"),i("u-icon",{attrs:{name:"arrow-right",color:"#F09536",size:"28"}})],1):e._e()],1)],1):e._e(),i("v-uni-view",{staticClass:"income_wrap",staticStyle:{padding:"10px 15px 15px 15px"}},[i("v-uni-view",{staticClass:"title"},[i("v-uni-view",{staticClass:"subtitle"},[i("v-uni-view",[e._v("我的收益")]),i("v-uni-view",{on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.ToUrlpage("/mePages/pages/incomeInfo")}}},[i("span",[e._v("收益明细")]),i("u-icon",{attrs:{name:"arrow-right",color:"#999",size:"24"}})],1)],1)],1),i("v-uni-view",{staticClass:"income_mx"},[i("v-uni-view",{staticClass:"income_mx_1"},[e._v("余额")]),i("v-uni-view",{staticClass:"income_mx_2"},[e.userInfo.money?i("v-uni-view",{staticClass:"income_mx_3"},[e._v(e._s(e.userInfo.money)),i("span",[e._v("元")])]):i("v-uni-view",{staticClass:"income_mx_3"},[e._v("0.00"),i("span",[e._v("元")])]),i("v-uni-view",{staticClass:"income_mx_4",on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.ToUrlpage("/mePages/pages/Cashwithdrawal")}}},[e._v("提现")])],1)],1),i("v-uni-view",{staticClass:"income_xj"},[i("v-uni-view",{staticClass:"income_xj1"},[i("v-uni-view",{staticClass:"income_xj2"},[i("v-uni-view",[e._v("已省"),i("v-uni-view",{staticClass:"income_xj3",on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.Toindex("/pages/index/index")}}},[e._v("去抢单"),i("u-icon",{attrs:{name:"arrow-right",color:"#999",size:"24"}})],1)],1),i("v-uni-view",[e.userInfo.all_money?i("v-uni-text",[e._v(e._s(e.userInfo.all_money)+"元")]):i("v-uni-text",[e._v("0元")])],1)],1)],1),i("v-uni-view",{staticClass:"line_1"}),i("v-uni-view",{staticClass:"income_xj1"},[i("v-uni-view",{staticClass:"income_xj2"},[i("v-uni-view",[e._v("已赚"),1==e.mtmemberInfo.is_open?i("v-uni-view",{staticClass:"income_xj3",on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.Toindex("/pages/makemoney/makemoney")}}},[e._v("去赚钱"),i("u-icon",{attrs:{name:"arrow-right",color:"#999",size:"24"}})],1):e._e()],1),i("v-uni-view",[e.userInfo.income_money?i("v-uni-text",[e._v(e._s(e.userInfo.income_money)+"元")]):i("v-uni-text",[e._v("0元")])],1)],1)],1)],1)],1),e._l(e.menuList,(function(a,t){return i("v-uni-view",{key:t,staticClass:"income_wrap"},[i("v-uni-view",{staticClass:"title22"},[i("v-uni-view",{staticClass:"subtitle"},[i("v-uni-view",[e._v(e._s(a.name))])],1)],1),i("v-uni-view",{staticClass:"order_tool_bar"},[i("v-uni-view",{staticClass:"tool_menu"},[i("u-row",{attrs:{gutter:"16"}},e._l(a.menu,(function(a,t){return i("u-col",{key:t,attrs:{span:"3"},on:{click:function(i){arguments[0]=i=e.$handleEvent(i),e.Tomenus(a,t)}}},[i("v-uni-view",{staticClass:"demo-layout"},[i("v-uni-image",{attrs:{src:a.image,mode:"aspectFill"}}),i("v-uni-view",{staticClass:"menu_name"},[e._v(e._s(a.name))])],1)],1)})),1)],1)],1)],1)})),i("v-uni-view",{staticStyle:{height:"120rpx",width:"100%"}})],2),i("u-popup",{attrs:{mode:"center",width:"524","border-radius":"28","mask-close-able":!1},model:{value:e.fensiqun_Show,callback:function(a){e.fensiqun_Show=a},expression:"fensiqun_Show"}},[i("v-uni-view",{staticClass:"tc_wrap"},[i("v-uni-view",{staticClass:"tc_images",staticStyle:{"padding-top":"20rpx",margin:"0 0 0 0"}},[i("v-uni-image",{attrs:{src:e.qr_image.qr_code}})],1),i("v-uni-view",{staticClass:"tc_info"},[i("v-uni-view",[e._v(e._s(e.qr_image.name))]),i("v-uni-view",{staticStyle:{color:"#999"}},[e._v("微信扫一扫或长按识别")])],1),i("v-uni-view",{staticClass:"tc_btn_box"},[i("v-uni-view",{staticClass:"lijipay"},[i("u-button",{attrs:{type:"info",shape:"circle",ripple:!1},on:{click:function(a){arguments[0]=a=e.$handleEvent(a),e.fensiqun_Show=!1}}},[e._v("知道了")])],1)],1)],1)],1)],1)},o=[]}}]);