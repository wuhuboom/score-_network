(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-makemoney-makemoney"],{"0c68":function(t,e,a){"use strict";a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"l-noticBar"},[a("v-uni-view",{staticClass:"marquee"},[a("v-uni-view",{staticClass:"marquee_box",style:{height:t.noticeheight},attrs:{id:"marquee_box"}},[a("v-uni-view",{staticClass:"marquee_list",class:{marquee_top:t.animate}},t._l(t.listCopy,(function(e,i){return a("v-uni-view",{key:i,staticClass:"marquee_View"},[a("v-uni-view",{staticClass:"user_Wrap"},[a("v-uni-view",{staticClass:"user_shouru"},[a("v-uni-image",{attrs:{src:e.avatar}}),a("v-uni-text",{staticClass:"swiText"},[t._v(t._s(e.nickname))]),t._v("今日收入"),a("v-uni-text",[t._v(t._s(e.amount)+"元")])],1)],1)],1)})),1)],1)],1)],1)},n=[]},"285e":function(t,e,a){"use strict";a.r(e);var i=a("31ef"),n=a.n(i);for(var s in i)["default"].indexOf(s)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(s);e["default"]=n.a},"2c05":function(t,e,a){"use strict";a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return s})),a.d(e,"a",(function(){return i}));var i={uTabs:a("25db").default},n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[a("v-uni-view",{staticClass:"my_member_title"},[a("v-uni-image",{attrs:{src:"/static/images/member/Unionl.png",mode:"widthFix"}}),t._v("排行榜"),a("v-uni-image",{attrs:{src:"/static/images/member/Unionr.png",mode:"widthFix"}})],1),a("v-uni-view",{staticClass:"tabs_wrap"},[a("u-tabs",{attrs:{list:t.tabsRlist,"is-scroll":!1,current:t.tabsrcurrent,"bar-width":"134","active-color":"#FF4910","inactive-color":"#999999"},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.tabsRchange.apply(void 0,arguments)}}})],1),a("v-uni-view",{staticClass:"r_list"},[a("v-uni-view",{staticClass:"r_list_title"},[a("v-uni-view",[t._v("排名")]),a("v-uni-view",{staticStyle:{width:"105px"}},[t._v("用户")]),a("v-uni-view",{staticStyle:{width:"105px"}},[t._v("有效推广数")]),a("v-uni-view",[t._v("收入")])],1),t._l(t.Leaderboard,(function(e,i){return a("v-uni-view",{key:i,staticClass:"r_list_box"},[a("v-uni-view",{staticClass:"l_1"},[a("v-uni-text",[t._v(t._s(i+1))]),a("v-uni-image",0==i?{attrs:{src:"/static/images/member/first_icon.png",mode:"widthFix"}}:1==i?{attrs:{src:"/static/images/member/proximeaccessit.png",mode:"widthFix"}}:2==i?{attrs:{src:"/static/images/member/third.png",mode:"widthFix"}}:{attrs:{src:"/static/images/member/Frame1876.png",mode:"widthFix"}})],1),a("v-uni-view",{staticClass:"l_2"},[a("v-uni-view",{staticClass:"u_iamge"},[a("v-uni-image",{attrs:{src:e.avatar}})],1),a("v-uni-view",{staticClass:"u_name"},[t._v(t._s(e.nickname))])],1),a("v-uni-view",{staticClass:"l_3"},[t._v(t._s(e.spread_people_num))]),a("v-uni-view",{staticClass:"l_4"},[t._v(t._s(e.amount)+"元")])],1)}))],2)],1)},s=[]},"2c6c":function(t,e,a){"use strict";a.r(e);var i=a("fe73"),n=a.n(i);for(var s in i)["default"].indexOf(s)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(s);e["default"]=n.a},"311f":function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,".marquee[data-v-17a7797e]{width:100%;display:flex\n  /* position: absolute;\n      bottom: 1rem;\n      left: 0; */}.marquee_box[data-v-17a7797e]{position:relative;width:100%;overflow:hidden}.marquee_list[data-v-17a7797e]{width:100%;display:flex;flex-direction:column}.marquee_top[data-v-17a7797e]{transition:all 1s;margin-top:%?-98?%}.marquee_View[data-v-17a7797e]{width:100%;display:flex}.marquee_View .user_Wrap[data-v-17a7797e]{height:%?85?%;margin:%?15?% auto 0;font-size:%?24?%;color:#fff}.user_shouru[data-v-17a7797e]{display:flex;align-items:center;background-color:rgba(0,0,0,.2);border-radius:%?200?%;height:%?56?%;padding:0 %?10?%}.user_shouru uni-image[data-v-17a7797e]{width:%?40?%;height:%?40?%;border-radius:%?200?%}.user_shouru uni-text[data-v-17a7797e]{margin:0 %?10?%}",""]),t.exports=e},"31ef":function(t,e,a){"use strict";a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={name:"rankingList",props:{},data:function(){return{rankListArry:[],tabsRlist:[{name:"总榜"},{name:"月榜"},{name:"周榜"}],tabsrcurrent:0,Leaderboard:[],types:1}},created:function(){this.getLeaderboard()},methods:{getLeaderboard:function(){var t=this;t.$api.GetLeaderboard({type:t.types,page:1,limit:100}).then((function(e){t.Leaderboard=e.data.result})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},tabsRchange:function(t){this.tabsrcurrent=t,0==t?(this.types=1,this.getLeaderboard()):1==t?(this.types=2,this.getLeaderboard()):2==t&&(this.types=3,this.getLeaderboard())}}};e.default=i},"32c1":function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,"uni-image[data-v-d5e65742]{vertical-align:bottom}.content_box[data-v-d5e65742]{margin-top:%?30?%;padding:%?30?% %?30?% %?160?% %?30?%;border-radius:%?30?% %?30?% 0 0;background-color:#fff;position:relative;box-shadow:0 -4px 12px rgba(0,0,0,.04),0 -4px 12px rgba(0,0,0,.04)}.content_box .lijipay[data-v-d5e65742]{width:100%;margin-top:%?10?%;position:relative}.content_box .lijipay .u-size-default[data-v-d5e65742]{height:%?88?%!important;line-height:%?88?%!important;background-image:linear-gradient(90deg,#fe9400,#ff3d22)!important}.content_box .my_tequan[data-v-d5e65742]{height:73px;margin:%?30?% 0}.content_box .my_tequan .tq_list[data-v-d5e65742]{background-color:#fcf0ed;padding:%?30?%;border-radius:%?20?%;display:flex;align-items:center;justify-content:space-between}.content_box .my_tequan .tq_list .tq_list_item[data-v-d5e65742]{text-align:center;color:#666}.content_box .my_tequan .tq_list .tq_list_item .tq_type_icon[data-v-d5e65742]{font-weight:700;font-size:%?24?%}.content_box .my_tequan .tq_list .tq_list_item .tq_text[data-v-d5e65742]{font-weight:700;margin-top:%?10?%;color:#ff611e;font-size:%?36?%}.content_box .my_tequan .tq_list .tq_list_item .tq_text span[data-v-d5e65742]{font-size:%?24?%;color:#666;position:relative;top:%?-2?%;margin-left:%?2?%}.content_box .my_tequan2 .card_list[data-v-d5e65742]{background-color:#fff;border-radius:%?20?% %?20?% 0 0;display:flex;align-items:center;justify-content:space-between}.content_box .my_tequan2 .card_list .selectA[data-v-d5e65742]{background-image:linear-gradient(270deg,#fa0020,#ff823c)!important;color:#fff}.content_box .my_tequan2 .card_list .card_list_item[data-v-d5e65742]{text-align:center;background-color:#f7f7f7;border-radius:%?14?%;height:%?64?%;line-height:%?64?%;flex:1;margin:0 %?12?% 0 0;position:relative;font-size:%?32?%}.content_box .my_tequan2 .card_list .card_list_item .nianka[data-v-d5e65742]{font-weight:700}.content_box .my_tequan2 .card_list .card_list_item[data-v-d5e65742]:last-child{margin:0!important}.content_box .my_member_title[data-v-d5e65742]{font-weight:700;text-align:center;margin:%?30?% 0 0 0;color:#ff823c;font-size:%?32?%;display:flex;align-items:center;justify-content:center}.content_box .my_member_title uni-image[data-v-d5e65742]{width:%?50?%;height:%?50?%;margin:0 %?20?%}.content_box .leveS1[data-v-d5e65742]{font-weight:700;margin-right:%?20?%;color:#ff4910}.content_box .leveS2[data-v-d5e65742]{font-weight:700;margin-left:%?20?%;color:#ff4910}.content_box .my_tequan3[data-v-d5e65742]{margin-top:%?30?%;padding:0;border-radius:%?20?%}.content_box .my_tequan3 .uni-swiper-tab[data-v-d5e65742]{white-space:nowrap}.content_box .my_tequan3 .scrollx_items[data-v-d5e65742]{text-align:left;display:inline-block;width:100%;box-sizing:border-box;margin:0 %?24?% 0 0}.content_box .my_tequan3 .my_tequan3_item[data-v-d5e65742]{background-image:url(https://h5.hwhsh.com/public/uploads/h5/Group33280.jpg);background-size:100% 100%;padding:%?30?%;border-radius:%?20?% %?20?% 0 0}.content_box .my_tequan3 .my_tequan3_item .gz_title[data-v-d5e65742]{display:flex;align-items:center;justify-content:space-between;margin-bottom:%?30?%}.content_box .my_tequan3 .my_tequan3_item .gz_title uni-view[data-v-d5e65742]:nth-child(1){font-weight:700;font-size:%?28?%}.content_box .my_tequan3 .my_tequan3_item .gz_title uni-view[data-v-d5e65742]:nth-child(2){font-size:%?24?%}.content_box .my_tequan3 .my_tequan3_item .gz_leve[data-v-d5e65742]{display:flex;align-items:center;font-size:%?28?%;color:#666}.content_box .my_tequan3 .dj_info[data-v-d5e65742]{background-color:#f7f7f7;padding:%?20?% %?30?%;border-radius:0 0 %?20?% %?20?%}.content_box .my_tequan3 .dj_info .dj_info_item[data-v-d5e65742]{display:flex;margin:%?14?% 0;align-items:center;justify-content:flex-start;color:#999}.content_box .my_tequan3 .dj_info .dj_info_item uni-view[data-v-d5e65742]:nth-child(1){flex:1}.content_box .my_tequan3 .dj_info .dj_info_item .dj_yuan[data-v-d5e65742]{text-align:left}.content_box .my_tequan3 .dj_info .dj_info_item .dj_yuan span[data-v-d5e65742]{color:#ff4910;font-weight:700}.menmber_card_box[data-v-d5e65742]{height:294px;position:relative}.menmber_card_box .gundong_list[data-v-d5e65742]{position:absolute;top:30%;left:0;right:0;margin:0 auto}.menmber_card_box .guafenzi[data-v-d5e65742]{width:%?500?%;position:absolute;top:%?100?%;z-index:999;margin:0 auto;left:0;right:0}.menmber_card_box .zq_bg[data-v-d5e65742]{width:100%;height:306px}.menmber_card_box .card_wrap[data-v-d5e65742]{position:absolute;height:150px;bottom:4px;background-image:linear-gradient(0deg,#fffae7,#fffae7)!important;width:90%;margin:0 auto;left:0;border-radius:%?30?%;right:0;padding:%?30?%}.menmber_card_box .card_wrap .card_info_box[data-v-d5e65742]{padding:%?10?% %?30?%;width:100%;position:relative;border:1px solid #f6ca1f;border-radius:%?30?%}.menmber_card_box .card_wrap .card_info_box .sanjiao[data-v-d5e65742]{width:%?50?%;height:%?50?%;border-radius:%?10?%;position:absolute;left:0;right:0;bottom:%?-20?%;background-color:#fef5ec;margin:0 auto;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.menmber_card_box .card_wrap .card_info_box .card_info1[data-v-d5e65742]{display:flex;align-items:flex-start;position:relative;width:100%;padding-top:%?20?%}.menmber_card_box .card_wrap .card_info_box .card_info1 .m_name[data-v-d5e65742]{text-align:center;margin:0 auto;background-color:#efe3c1;border-radius:%?14?%;padding:%?14?% %?24?%}.menmber_card_box .card_wrap .card_info_box .card_info1 .m_name uni-view[data-v-d5e65742]:nth-child(1){font-weight:700;font-size:%?34?%;color:#ae872f}.menmber_card_box .card_wrap .card_info_box .card_info1 .m_name uni-view:nth-child(1) span[data-v-d5e65742]{color:#f53d1a}.menmber_card_box .card_wrap .card_info_box .card_info2[data-v-d5e65742]{display:flex;align-items:flex-start;position:relative;width:100%;margin-top:%?36?%;position:relative}.menmber_card_box .card_wrap .card_info_box .card_info2 .tags_box[data-v-d5e65742]{border-radius:%?20?% %?20?% %?20?% %?10?%;padding:%?6?% %?30?%;background-image:linear-gradient(270deg,#fa0020,#ff823c)!important;color:#fff;display:inline-block;position:absolute;top:%?-10?%;right:0;z-index:100;font-size:%?24?%}.menmber_card_box .card_wrap .card_info_box .card_info2 .m_name[data-v-d5e65742]{text-align:center;flex:1}.menmber_card_box .card_wrap .card_info_box .card_info2 .m_name uni-view[data-v-d5e65742]:nth-child(1){font-size:%?32?%;color:#ae872f;display:flex;align-items:center;justify-content:center}.menmber_card_box .card_wrap .card_info_box .card_info2 .m_name uni-view:nth-child(1) span[data-v-d5e65742]{color:#f63d1a;font-size:%?72?%;margin:0 %?14?%;position:relative;top:%?-4?%;font-weight:700}",""]),t.exports=e},"37bf":function(t,e,a){"use strict";a.r(e);var i=a("3dc0"),n=a.n(i);for(var s in i)["default"].indexOf(s)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(s);e["default"]=n.a},"3dc0":function(t,e,a){"use strict";a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i=getApp(),n={name:"makemoneyunit",components:{},data:function(){return{gundonglist:[],BestImgUrl:i.globalData.imgurl,weidenglu_if:!0,tabslist:[],Tabcurrent:0,FenxiangShow:!1,cardList:[{id:"1",name:"我的好友"},{id:"3",name:"排行榜"}],cardListidx:0,one:{},two:{},three:{},four:{},five:{},six:{},seven:{},makemoneydata:{}}},onLoad:function(){},onShow:function(){var t=uni.getStorageSync("token");t?(this.weidenglu_if=!1,this.getguize(),this.getmakemoney()):this.weidenglu_if=!0},onReady:function(){},methods:{dengluTo:function(){uni.navigateTo({url:"/pages/logon/logon"})},getmakemoney:function(){var t=this;t.$api.Getmakemoney({}).then((function(e){t.makemoneydata=e.data.result})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},getguize:function(){var t=this;this.$api.getInvitationRules({page:1}).then((function(e){t.one=e.data.result["1"],t.two=e.data.result["2"],t.three=e.data.result["3"],t.four=e.data.result["4"],t.five=e.data.result["5"],t.six=e.data.result["6"],t.seven=e.data.result["7"]})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},selectCard:function(t,e){this.cardListidx=e},Toguize:function(){uni.navigateTo({url:"/pages/member/Invitationrules"})},openFenx:function(t){this.FenxiangShow=1!=t},ToShareposters:function(){uni.navigateTo({url:"/pages/Shareposters/Shareposters"})},tomix:function(){uni.navigateTo({url:"/pages/cronyList/cronyList"})}}};e.default=n},4555:function(t,e,a){var i=a("311f");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("8138a7b6",i,!0,{sourceMap:!1,shadowMode:!1})},6473:function(t,e,a){"use strict";a.r(e);var i=a("2c05"),n=a("285e");for(var s in n)["default"].indexOf(s)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(s);a("7214");var o=a("f0c5"),r=Object(o["a"])(n["default"],i["b"],i["c"],!1,null,"aff71c68",null,!1,i["a"],void 0);e["default"]=r.exports},"6dfc":function(t,e,a){"use strict";var i=a("ec26"),n=a.n(i);n.a},7214:function(t,e,a){"use strict";var i=a("b56b"),n=a.n(i);n.a},"7d3d":function(t,e,a){"use strict";var i=a("4555"),n=a.n(i);n.a},"826f":function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,"[data-v-aff71c68] .u-tab-bar{position:absolute;bottom:-3px!important}.my_member_title[data-v-aff71c68]{font-weight:700;text-align:center;margin:%?30?% 0 %?16?% 0;color:#ff823c;font-size:%?34?%;display:flex;align-items:center;justify-content:center}.my_member_title uni-image[data-v-aff71c68]{width:%?50?%;height:%?50?%;margin:0 %?20?%}.r_list .r_list_box[data-v-aff71c68]{display:flex;align-items:center;justify-content:space-between;margin:%?50?% 0 0 0}.r_list .r_list_box .l_1[data-v-aff71c68]{position:relative;text-align:center}.r_list .r_list_box .l_1 uni-text[data-v-aff71c68]{position:absolute;left:0;right:0;top:7px;color:#fff;margin:0 auto;z-index:2;font-size:%?24?%}.r_list .r_list_box .l_1 uni-image[data-v-aff71c68]{width:%?48?%}.r_list .r_list_box .l_2[data-v-aff71c68]{display:flex;align-items:center;position:relative;left:-40px;width:84px}.r_list .r_list_box .l_2 .u_iamge[data-v-aff71c68]{width:%?72?%;height:%?72?%;border-radius:%?200?%;margin-right:%?10?%}.r_list .r_list_box .l_2 .u_iamge uni-image[data-v-aff71c68]{width:%?72?%;height:%?72?%;border-radius:%?200?%}.r_list .r_list_box .l_2 .u_name[data-v-aff71c68]{font-weight:700;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.r_list .r_list_box .l_3[data-v-aff71c68]{font-weight:700;text-align:center;display:flex;align-items:center;justify-content:space-around}.r_list .r_list_box .l_4[data-v-aff71c68]{font-weight:700;color:#ff4910}.r_list .r_list_title[data-v-aff71c68]{display:flex;align-items:center;justify-content:space-between;padding:%?20?% 0;border-top:1px solid #f3f3f3;border-bottom:1px solid #f3f3f3}.r_list .r_list_title uni-view[data-v-aff71c68]{color:#999}.r_title[data-v-aff71c68]{text-align:center;margin:%?30?% 0 %?16?% 0}.r_title uni-text[data-v-aff71c68]{font-size:%?36?%;font-weight:700;color:#ff773a}",""]),t.exports=e},"95a4":function(t,e,a){"use strict";a.r(e);var i=a("0c68"),n=a("2c6c");for(var s in n)["default"].indexOf(s)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(s);a("7d3d");var o=a("f0c5"),r=Object(o["a"])(n["default"],i["b"],i["c"],!1,null,"17a7797e",null,!1,i["a"],void 0);e["default"]=r.exports},b56b:function(t,e,a){var i=a("826f");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("8f3515ba",i,!0,{sourceMap:!1,shadowMode:!1})},ec26:function(t,e,a){var i=a("32c1");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("8abd4bc6",i,!0,{sourceMap:!1,shadowMode:!1})},f447:function(t,e,a){"use strict";a.r(e);var i=a("f51c"),n=a("37bf");for(var s in n)["default"].indexOf(s)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(s);a("6dfc");var o=a("f0c5"),r=Object(o["a"])(n["default"],i["b"],i["c"],!1,null,"d5e65742",null,!1,i["a"],void 0);e["default"]=r.exports},f51c:function(t,e,a){"use strict";a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return s})),a.d(e,"a",(function(){return i}));var i={lNoticBar:a("95a4").default,uIcon:a("21cf").default,uButton:a("eeee").default,rankingList:a("6473").default,invitePopup:a("e966").default},n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[t.weidenglu_if?a("v-uni-view",{staticClass:"weidenglu"},[a("v-uni-image",{attrs:{src:"/static/images/noData.png"}}),a("v-uni-view",{staticClass:"tishi"},[t._v("请先进行登录")]),a("v-uni-view",{staticClass:"denglu_btn",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.dengluTo()}}},[t._v("去登录")])],1):a("v-uni-view",[a("v-uni-view",{staticClass:"menmber_card_box"},[a("v-uni-image",{staticClass:"zq_bg",attrs:{src:t.BestImgUrl+"Group33281.jpg",mode:"widthFix"}}),a("v-uni-image",{staticClass:"guafenzi",attrs:{src:t.BestImgUrl+"yaoqingguaf.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"gundong_list"},[a("l-noticBar",{attrs:{showNum:1}})],1),a("v-uni-view",{staticClass:"card_wrap"},[a("v-uni-view",{staticClass:"card_info_box"},[a("v-uni-view",{staticClass:"card_info1"},[a("v-uni-view",{staticClass:"m_name"},[a("v-uni-view",[t._v("邀请1个好友赚"),a("span",[t._v("100+元")])])],1)],1),a("v-uni-view",{staticClass:"card_info2"},[a("v-uni-view",{staticClass:"m_name"},[a("v-uni-view",[t._v("共计"),a("span",[t._v("99999")]),t._v("元/月")])],1)],1)],1)],1)],1),a("v-uni-view",{staticClass:"content_box"},[a("v-uni-view",{staticClass:"my_tequan2"},[a("v-uni-view",{staticClass:"card_list"},t._l(t.cardList,(function(e,i){return a("v-uni-view",{key:i,staticClass:"card_list_item",class:[t.cardListidx==i?"selectA":""],on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.selectCard(e,i)}}},[a("v-uni-view",{staticClass:"nianka"},[t._v(t._s(e.name))])],1)})),1)],1),0==t.cardListidx?a("v-uni-view",[a("v-uni-view",{staticClass:"my_member_title"},[a("v-uni-image",{attrs:{src:"/static/images/member/Unionl.png",mode:"widthFix"}}),t._v("推广规则"),a("v-uni-image",{attrs:{src:"/static/images/member/Unionr.png",mode:"widthFix"}})],1),a("v-uni-view",{staticClass:"my_tequan3"},[a("v-uni-view",{staticClass:"card_list_item scrollx_items"},[a("v-uni-view",{staticClass:"my_tequan3_item"},[a("v-uni-view",{staticClass:"gz_title"},[a("v-uni-view",[t._v("我的等级"),a("span",{staticClass:"leveS1"},[t._v("V"+t._s(t.makemoneydata.level))])]),a("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.Toguize()}}},[t._v("邀请规则"),a("u-icon",{attrs:{name:"arrow-right",color:"#333333",size:"24"}})],1)],1),1==t.makemoneydata.level?a("v-uni-view",{staticClass:"gz_leve"},[a("v-uni-view",[t._v("本月再邀"+t._s(t.two.num-t.makemoneydata.spread_people_num)+"人可升至")]),a("span",{staticClass:"leveS2"},[t._v("V2")])],1):2==t.makemoneydata.level?a("v-uni-view",{staticClass:"gz_leve"},[a("v-uni-view",[t._v("本月再邀"+t._s(t.three.num-t.makemoneydata.spread_people_num)+"人可升至")]),a("span",{staticClass:"leveS2"},[t._v("V3")])],1):3==t.makemoneydata.level?a("v-uni-view",{staticClass:"gz_leve"},[a("v-uni-view",[t._v("本月再邀"+t._s(t.four.num-t.makemoneydata.spread_people_num)+"人可升至")]),a("span",{staticClass:"leveS2"},[t._v("V4")])],1):4==t.makemoneydata.level?a("v-uni-view",{staticClass:"gz_leve"},[a("v-uni-view",[t._v("本月再邀"+t._s(t.five.num-t.makemoneydata.spread_people_num)+"人可升至")]),a("span",{staticClass:"leveS2"},[t._v("V5")])],1):5==t.makemoneydata.level?a("v-uni-view",{staticClass:"gz_leve"},[a("v-uni-view",[t._v("本月再邀"+t._s(t.six.num-t.makemoneydata.spread_people_num)+"人可升至")]),a("span",{staticClass:"leveS2"},[t._v("V6")])],1):6==t.makemoneydata.level?a("v-uni-view",{staticClass:"gz_leve"},[a("v-uni-view",[t._v("本月再邀"+t._s(t.seven.num-t.makemoneydata.spread_people_num)+"人可升至")]),a("span",{staticClass:"leveS2"},[t._v("V7")])],1):7==t.makemoneydata.level?a("v-uni-view",{staticClass:"gz_leve"},[a("v-uni-view",[t._v("你已经达到人生巅峰")]),a("span",{staticClass:"leveS2"},[t._v("不能再升了")])],1):t._e()],1),a("v-uni-view",{staticClass:"dj_info"},[a("v-uni-view",{staticClass:"dj_info_item"},[a("v-uni-view",[t._v("好友完成首单")]),1==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.one.first))]),t._v("元")]):2==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.two.first))]),t._v("元")]):3==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.three.first))]),t._v("元")]):4==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.four.first))]),t._v("元")]):5==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.five.first))]),t._v("元")]):6==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.six.first))]),t._v("元")]):7==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.seven.first))]),t._v("元")]):t._e()],1),a("v-uni-view",{staticClass:"dj_info_item"},[a("v-uni-view",[t._v("好友完成第2单")]),1==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.one.second))]),t._v("元")]):2==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.two.second))]),t._v("元")]):3==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.three.second))]),t._v("元")]):4==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.four.second))]),t._v("元")]):5==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.five.second))]),t._v("元")]):6==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.six.second))]),t._v("元")]):7==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.seven.second))]),t._v("元")]):t._e()],1),a("v-uni-view",{staticClass:"dj_info_item"},[a("v-uni-view",[t._v("好友完成第3单")]),1==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.one.three))]),t._v("元")]):2==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.two.three))]),t._v("元")]):3==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.three.three))]),t._v("元")]):4==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.four.three))]),t._v("元")]):5==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.five.three))]),t._v("元")]):6==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.six.three))]),t._v("元")]):7==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.seven.three))]),t._v("元")]):t._e()],1),a("v-uni-view",{staticClass:"dj_info_item"},[a("v-uni-view",[t._v("好友后续下单")]),1==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.one.four))]),t._v("元")]):2==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.two.four))]),t._v("元")]):3==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.three.four))]),t._v("元")]):4==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.four.four))]),t._v("元")]):5==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.five.four))]),t._v("元")]):6==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.six.four))]),t._v("元")]):7==t.makemoneydata.level?a("v-uni-view",{staticClass:"dj_yuan"},[a("span",[t._v("+"+t._s(t.seven.four))]),t._v("元")]):t._e()],1)],1)],1)],1),a("v-uni-view",{staticClass:"my_tequan"},[a("v-uni-view",{staticClass:"tq_list"},[a("v-uni-view",{staticClass:"tq_list_item"},[a("v-uni-view",{staticClass:"tq_type_icon"},[t._v("已邀请")]),a("v-uni-view",{staticClass:"tq_text",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.tomix()}}},[t._v(t._s(t.makemoneydata.spread_people_num)),a("span",[t._v("人")]),a("u-icon",{attrs:{name:"arrow-right",size:"28",color:"#333"}})],1)],1),a("v-uni-view",{staticClass:"tq_list_item"},[a("v-uni-view",{staticClass:"tq_type_icon"},[t._v("今日邀请收入")]),a("v-uni-view",{staticClass:"tq_text",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.tomix()}}},[t._v(t._s(t.makemoneydata.today_income_money)),a("span",[t._v("元")]),a("u-icon",{attrs:{name:"arrow-right",size:"28",color:"#333"}})],1)],1),a("v-uni-view",{staticClass:"tq_list_item"},[a("v-uni-view",{staticClass:"tq_type_icon"},[t._v("邀请总收入")]),a("v-uni-view",{staticClass:"tq_text",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.tomix()}}},[t._v(t._s(t.makemoneydata.income_money)),a("span",[t._v("元")]),a("u-icon",{attrs:{name:"arrow-right",size:"28",color:"#333"}})],1)],1)],1)],1),a("v-uni-view",{staticClass:"lijipay"},[a("u-button",{attrs:{type:"primary",shape:"circle",ripple:!1},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.ToShareposters()}}},[t._v("立即邀请")])],1)],1):t._e(),1==t.cardListidx?a("v-uni-view",[a("rankingList")],1):t._e()],1)],1),a("invitePopup",{attrs:{fenxiangshow:t.FenxiangShow},on:{backHome:function(e){arguments[0]=e=t.$handleEvent(e),t.openFenx.apply(void 0,arguments)}}})],1)},s=[]},fe73:function(t,e,a){"use strict";a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("a9e3"),a("14d9");var i={props:{showNum:{type:Number,default:1}},data:function(){return{noticeheight:"",animate:!1,listCopy:[]}},created:function(){this.GetPaihagn()},methods:{GetPaihagn:function(){var t=this,e=this;e.$api.GetLeaderboard({type:1,page:1,limit:30}).then((function(a){e.listCopy=a.data.result;var i=t.listCopy.length>t.showNum?t.showNum:t.listCopy.length;t.noticeheight=100*i+"rpx";var n=setInterval((function(){if(t.listCopy.length<t.showNum)clearInterval(n);else{t.listCopy.push(t.listCopy[0]),t.animate=!0;var e=setTimeout((function(){t.listCopy.shift(),t.animate=!1,clearTimeout(e)}),1e3)}}),2e3)})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))}}};e.default=i}}]);