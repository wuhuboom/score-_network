(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-search-search"],{"1ddf":function(a,t,i){var e=i("7b80");e.__esModule&&(e=e.default),"string"===typeof e&&(e=[[a.i,e,""]]),e.locals&&(a.exports=e.locals);var o=i("4f06").default;o("5cf7e7bc",e,!0,{sourceMap:!1,shadowMode:!1})},"232b":function(a,t,i){"use strict";i.d(t,"b",(function(){return o})),i.d(t,"c",(function(){return s})),i.d(t,"a",(function(){return e}));var e={uSearch:i("e618").default,uSticky:i("e6c3").default,renDropdownFilter:i("d08d").default,uIcon:i("21cf").default,uLineProgress:i("ed8a").default,uLoadmore:i("dd5b").default},o=function(){var a=this,t=a.$createElement,i=a._self._c||t;return i("v-uni-view",[i("v-uni-view",{staticClass:"Search_box2"},[i("v-uni-view",{staticClass:"Search_wrap"},[i("u-search",{attrs:{placeholder:"寻找好店",height:"80",bgColor:"#F5F4F2",showAction:!1},model:{value:a.keyword,callback:function(t){a.keyword=t},expression:"keyword"}}),i("v-uni-view",{staticClass:"Search_btn",on:{click:function(t){arguments[0]=t=a.$handleEvent(t),a.Tosearch()}}},[a._v("搜索")])],1)],1),i("u-sticky",{attrs:{index:"1","offset-top":"0","h5-nav-height":"0",enable:a.enable}},[i("v-uni-view",{staticClass:"screen_box",on:{click:function(t){arguments[0]=t=a.$handleEvent(t),a.zhiding()}}},[i("ren-dropdown-filter",{ref:"popupRef",attrs:{filterData:a.filterData,defaultIndex:a.defaultIndex},on:{onSelected:function(t){arguments[0]=t=a.$handleEvent(t),a.onSelected.apply(void 0,arguments)},Cancelstatus:function(t){arguments[0]=t=a.$handleEvent(t),a.AvailableChange.apply(void 0,arguments)}}})],1)],1),0!=a.shopsList.length?i("v-uni-view",{staticClass:"shop_list_wrap u-skeleton"},[a._l(a.shopsList,(function(t,e){return i("v-uni-view",{key:e,staticClass:"shops_box u-skeleton-rect",on:{click:function(i){arguments[0]=i=a.$handleEvent(i),a.ToDetails(t,e)}}},[i("v-uni-view",{staticClass:"shops_info_wrap"},[i("v-uni-image",{staticClass:"shops_logo",attrs:{src:t.logo,mode:"aspectFill"}}),i("v-uni-view",{staticClass:"shop_info"},[i("v-uni-text",{staticClass:"shop_name"},[a._v(a._s(t.name))]),i("v-uni-view",{staticClass:"shops_time"},[i("v-uni-view",{staticClass:"shops_time_logo"},[1==t.type?i("v-uni-view",{staticClass:"meituan_icon"},[a._v("美团")]):a._e(),2==t.type?i("v-uni-view",{staticClass:"element_icon"},[a._v("饿了么")]):a._e(),i("v-uni-text",{staticClass:"shops_titme_text"},[a._v("抢单时间："+a._s(t.open_time)+"-"+a._s(t.close_time))])],1),i("v-uni-text",{staticClass:"shops_titme_juli"},[a._v(a._s(t.distance)+"km")])],1),i("v-uni-view",{staticClass:"addres_Box"},[i("u-icon",{attrs:{name:"map",color:"#999",size:"38"}}),i("v-uni-view",{staticClass:"addresInfo"},[a._v(a._s(t.address))])],1)],1)],1),a._l(t.activity,(function(e,o){return i("v-uni-view",{key:o,staticClass:"activityList_box"},[t.activity.length>1?i("v-uni-view",{staticClass:"hd_title"},[i("v-uni-view",{staticClass:"hd_num_box"},[a._v("活动"+a._s(o+1))]),i("v-uni-view",{staticClass:"hd_xian"})],1):a._e(),i("v-uni-view",{staticClass:"qiangdan_time"},[i("v-uni-view",{staticClass:"member_box",class:[e.ady_num==e.total_count||0==t.is_work?"zhihui":""]},[1===a.ifmember?i("v-uni-view",[0==e.minimum_amount?i("v-uni-view",{staticClass:"shops_price_box"},[i("v-uni-view",{staticClass:"jiage"},[i("v-uni-text",{staticClass:"fuhao"},[a._v("￥")]),i("v-uni-text",{staticClass:"jine"},[a._v(a._s(parseFloat(e.member_rebate_amount).toFixed(0)))])],1),i("v-uni-view",{staticClass:"butie_box"},[i("v-uni-view",{staticClass:"butie"},[a._v("会员最高补贴")])],1)],1):a._e(),e.minimum_amount>0?i("v-uni-view",{staticClass:"shops_price_box"},[i("v-uni-view",{staticClass:"jiage"},[i("v-uni-text",{staticClass:"fuhao"},[a._v("￥")]),i("v-uni-text",{staticClass:"jine"},[a._v(a._s(parseFloat(e.member_rebate_amount).toFixed(0)))])],1),i("v-uni-view",{staticClass:"butie_box"},[i("v-uni-view",{staticClass:"butie"},[a._v("会员满"+a._s(e.minimum_amount)+"补"+a._s(e.member_rebate_amount))])],1)],1):a._e()],1):i("v-uni-view",[0==e.minimum_amount?i("v-uni-view",{staticClass:"shops_price_box"},[i("v-uni-view",{staticClass:"jiage"},[i("v-uni-text",{staticClass:"fuhao"},[a._v("￥")]),i("v-uni-text",{staticClass:"jine"},[a._v(a._s(parseFloat(e.member_rebate_amount).toFixed(0)))])],1),i("v-uni-view",{staticClass:"butie_box"},[i("v-uni-view",{staticClass:"butie"},[a._v("会员最高补贴")]),i("v-uni-view",{staticClass:"butie2"},[a._v("非会员最高补贴"+a._s(e.rebate_amount))])],1)],1):a._e(),e.minimum_amount>0?i("v-uni-view",{staticClass:"shops_price_box"},[i("v-uni-view",{staticClass:"jiage"},[i("v-uni-text",{staticClass:"fuhao"},[a._v("￥")]),i("v-uni-text",{staticClass:"jine"},[a._v(a._s(parseFloat(e.member_rebate_amount).toFixed(0)))])],1),i("v-uni-view",{staticClass:"butie_box"},[i("v-uni-view",{staticClass:"butie"},[a._v("会员满"+a._s(e.minimum_amount)+"补"+a._s(e.member_rebate_amount))]),i("v-uni-view",{staticClass:"butie2"},[a._v("非会员满"+a._s(e.minimum_amount)+"补"+a._s(e.rebate_amount))])],1)],1):a._e()],1),i("v-uni-image",{staticClass:"shandian_icon",attrs:{src:"/static/images/shandian_icon.png"}}),i("v-uni-view",{staticClass:"sd_price"},[i("v-uni-view",{staticClass:"shengyu_box"},[0==t.is_work?i("v-uni-text",{staticClass:"qd_text"},[a._v(a._s(t.open_time)+"后开抢")]):i("v-uni-text",{staticClass:"qd_text"},[a._v("抢单")])],1),i("v-uni-view",{staticClass:"jindutiao"},[i("v-uni-view",{staticClass:"jindutiao_Box"},[i("u-line-progress",{attrs:{percent:a.setItemProgress(e),height:"14",round:!0,"active-color":"#FFFFFF","inactive-color":"#ffb95f"}},[i("v-uni-view",{attrs:{slot:"default"},slot:"default"})],1)],1),i("v-uni-view",{staticClass:"shengyu6"},[a._v("剩"+a._s(e.day_num-e.total_count>0?e.day_num-e.total_count:0)+"份")])],1)],1)],1)],1)],1)}))],2)})),i("v-uni-view",[i("u-loadmore",{attrs:{status:a.loadingstatus,"font-size":"24","load-text":a.loadText,"margin-bottom":"40","margin-top":"40"}})],1)],2):0==a.shopsList.length&&0==a.failTimeOutShow?i("v-uni-view",{staticClass:"noData_box"},[i("v-uni-image",{attrs:{src:"/static/images/noData.png",mode:"widthFix"}}),i("v-uni-view",[a._v("暂无店铺")])],1):1==a.failTimeOutShow&&0==a.shopsList.length?i("v-uni-view",{staticClass:"noData_box"},[i("v-uni-image",{attrs:{src:"/static/images/noData.png",mode:"widthFix"}}),i("v-uni-view",{staticClass:"timeOut"},[i("v-uni-view",[a._v("网络好像出问题了")]),i("v-uni-view",{on:{click:function(t){arguments[0]=t=a.$handleEvent(t),a.refurbish()}}},[a._v("立即刷新")])],1)],1):a._e()],1)},s=[]},"61bc":function(a,t,i){"use strict";i.r(t);var e=i("232b"),o=i("9d3d");for(var s in o)["default"].indexOf(s)<0&&function(a){i.d(t,a,(function(){return o[a]}))}(s);i("adc0");var n=i("f0c5"),r=Object(n["a"])(o["default"],e["b"],e["c"],!1,null,"42a36988",null,!1,e["a"],void 0);t["default"]=r.exports},"7b80":function(a,t,i){var e=i("24fb");t=e(!1),t.push([a.i,".meituan_icon[data-v-42a36988]{font-size:%?24?%;background-color:#fdd900;color:#333;border-radius:%?10?%;padding:%?2?% %?10?%;margin-right:%?6?%}.element_icon[data-v-42a36988]{font-size:%?24?%;background-color:#05b6fd;color:#fff;border-radius:%?10?%;padding:%?2?% %?10?%;margin-right:%?6?%}.screen_box[data-v-42a36988]{z-index:9999}.zhihui[data-v-42a36988]{-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%);filter:grayscale(100%);filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1)}.noData_box[data-v-42a36988]{margin-top:0;padding-bottom:%?260?%;text-align:center;color:#999;text-align:center}.noData_box uni-image[data-v-42a36988]{width:%?280?%}.noData_box .timeOut[data-v-42a36988]{font-size:12px;color:#666;margin:0 0 7px;display:flex;align-items:center;justify-content:center}.noData_box .timeOut uni-view[data-v-42a36988]:nth-child(2){color:#00acfd;padding-left:%?10?%}.noData_box .lijipay[data-v-42a36988]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-42a36988]{height:%?70?%!important;line-height:%?70?%!important}.kefu_Box[data-v-42a36988]{position:fixed;z-index:999;bottom:15%;right:0;background-color:#fff;padding:%?10?% %?30?% %?10?% %?10?%;border-radius:%?200?% 0 0 %?200?%;box-shadow:0 0 5px rgba(0,0,0,.1);margin:10px 0 10px 5px}.kefu_Box .kefu_icon[data-v-42a36988]{width:%?70?%;height:%?70?%}.shop_list_wrap[data-v-42a36988]{background-image:linear-gradient(0deg,#f8f4f3,#fff);padding:0 %?22?% 66px %?22?%;position:relative}.shop_list_wrap .u-skeleton[data-v-42a36988]{padding:7px 0;margin:0 0 0 0}.shop_list_wrap .shops_box[data-v-42a36988]{-webkit-animation:dialog-fade-in-data-v-42a36988 .3s linear 1;animation:dialog-fade-in-data-v-42a36988 .3s linear 1;flex-direction:row;background-color:#fff;box-shadow:0 0 8px rgba(248,244,243,.5);margin:5px 5px 10px 5px;padding:%?20?%;border-radius:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap[data-v-42a36988]{display:flex;align-items:flex-start;margin-bottom:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shops_logo[data-v-42a36988]{width:%?168?%;height:%?168?%;border-radius:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info[data-v-42a36988]{flex:1;padding-left:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shop_name[data-v-42a36988]{font-size:%?32?%;font-weight:700;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time[data-v-42a36988]{flex:1;flex-direction:row;display:flex;align-items:center;justify-content:space-between;margin-top:%?20?%;margin-bottom:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo[data-v-42a36988]{display:flex;flex-direction:row;align-items:center}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo .shop_type[data-v-42a36988]{width:%?40?%;height:%?40?%;margin-right:%?10?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo .shops_titme_text[data-v-42a36988]{font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_titme_juli[data-v-42a36988]{font-size:%?24?%;color:#999;justify-content:flex-end}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .addres_Box[data-v-42a36988]{display:flex;align-items:center;font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .addres_Box .addresInfo[data-v-42a36988]{word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.shop_list_wrap .shops_box .activityList_box[data-v-42a36988]{margin-bottom:%?30?%}.shop_list_wrap .shops_box .activityList_box .hd_title[data-v-42a36988]{display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .hd_title .hd_num_box[data-v-42a36988]{background-color:#f3f1f2;border-radius:%?8?%;color:#999;padding:%?4?% %?10?%;font-size:%?24?%}.shop_list_wrap .shops_box .activityList_box .hd_title .hd_xian[data-v-42a36988]{flex:1;height:1px;background-color:#f3f1f2}.shop_list_wrap .shops_box .activityList_box .qiangdan_time[data-v-42a36988]{display:flex;align-items:center;margin:%?20?% 0}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .activity_idx[data-v-42a36988]{width:26%;text-align:center;font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box[data-v-42a36988]{flex-direction:row;align-items:center;display:flex;background-color:#ffedd5;border-radius:%?20?%;padding:%?16?% %?20?%;height:%?100?%;position:relative;flex:1}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box[data-v-42a36988]{flex-direction:row;display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage[data-v-42a36988]{flex-direction:row;display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage .fuhao[data-v-42a36988]{color:#ff611e;font-size:%?26?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage .jine[data-v-42a36988]{color:#ff611e;font-size:%?44?%;font-weight:700}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box[data-v-42a36988]{padding-left:%?16?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box .butie[data-v-42a36988]{color:#ff611e;font-size:%?28?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box .butie2[data-v-42a36988]{color:#ff611e;font-size:%?24?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shandian_icon[data-v-42a36988]{width:%?270?%;height:%?100?%;position:absolute;top:0;right:0}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price[data-v-42a36988]{text-align:center;position:absolute;top:%?16?%;right:0;width:110px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .shengyu_box[data-v-42a36988]{flex-direction:row;display:flex;align-items:center;flex:1;justify-content:center;margin-bottom:%?12?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .shengyu_box .qd_text[data-v-42a36988]{color:#fff;font-size:%?26?%;flex:1;text-align:center;font-weight:700}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao[data-v-42a36988]{flex-direction:row;display:flex;align-items:center;justify-content:center;height:7px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao .jindutiao_Box[data-v-42a36988]{width:%?90?%;position:relative;top:-5px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao .shengyu6[data-v-42a36988]{font-size:%?24?%;padding-left:%?10?%;color:#fff}.shop_list_wrap .shops_box .activityList_box .qiangdan_time[data-v-42a36988]:last-child{margin-bottom:0}.shop_list_wrap .shops_box .activityList_box[data-v-42a36988]:last-child{margin-bottom:0}.nav_wrap[data-v-42a36988]{padding:0 %?30?%;display:flex;align-items:center;justify-content:space-between;flex:1;-webkit-animation:dialog-fade-in-data-v-42a36988 .3s linear 1;animation:dialog-fade-in-data-v-42a36988 .3s linear 1}.nav_wrap .city_screen[data-v-42a36988]{flex-direction:row;display:flex;align-items:center}.nav_wrap .city_screen .city_name[data-v-42a36988]{color:#fff;font-weight:700;margin:0 %?4?%;font-size:%?30?%;flex:1;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;height:%?48?%;line-height:%?48?%}.nav_wrap .city_screen .right_jiao[data-v-42a36988]{position:relative;left:%?-10?%;top:%?2?%}.nav_wrap .city_screen .left_jiao[data-v-42a36988]{position:relative}.nav_wrap .sign_msg[data-v-42a36988]{flex-direction:row;display:flex;align-items:center;margin-left:auto}.nav_wrap .sign_msg .s_icon[data-v-42a36988]{margin:0 %?5?%;width:%?54?%;height:%?54?%;-webkit-animation:dialog-fade-in-data-v-42a36988 .3s linear 1;animation:dialog-fade-in-data-v-42a36988 .3s linear 1}.nav_wrap .sign_msg .s_icon2[data-v-42a36988]{margin:0 %?5?%;width:%?50?%;height:%?50?%;-webkit-animation:dialog-fade-in-data-v-42a36988 .3s linear 1;animation:dialog-fade-in-data-v-42a36988 .3s linear 1}.homt_top_box[data-v-42a36988]{width:%?750?%;height:%?204?%;position:relative}.homt_top_box .homt_top_bg[data-v-42a36988]{width:%?750?%;height:%?450?%}.homt_top_box .homt_top_bg_box[data-v-42a36988]{width:%?750?%;height:%?140?%;background-image:linear-gradient(180deg,#ff9f4a,#fff)}.homt_top_box .Rotation_chart[data-v-42a36988]{padding:%?30?%;width:%?750?%;position:absolute;flex:1;bottom:0;right:0;left:0}.homt_top_box .Rotation_chart .lunbotu_img[data-v-42a36988]{width:%?690?%;-webkit-animation:dialog-fade-in-data-v-42a36988 .3s linear 1;animation:dialog-fade-in-data-v-42a36988 .3s linear 1;height:%?170?%}.Search_box[data-v-42a36988]{padding:%?20?% %?30?% %?10?% %?30?%;flex-direction:row;display:flex;align-items:center}.Search_box .Search_wrap[data-v-42a36988]{position:relative;flex-direction:row;flex:1;display:flex}.Search_box .Search_wrap .Search_btn[data-v-42a36988]{position:absolute;right:%?8?%;top:4px;color:#fff;background-image:linear-gradient(90deg,#ff9619,#ffb930);width:%?100?%;height:%?55?%;text-align:center;line-height:%?55?%;border-radius:%?200?%;font-weight:600}.menu_wrap[data-v-42a36988]{padding:%?10?% %?10?% 0 %?10?%}.menu_wrap .swiper[data-v-42a36988]{height:184px}.menu_wrap .menu_images[data-v-42a36988]{width:44px;height:44px;-webkit-animation:dialog-fade-in-data-v-42a36988 .3s linear 1;animation:dialog-fade-in-data-v-42a36988 .3s linear 1}.menu_wrap .grid-text[data-v-42a36988]{font-size:12px;color:#333;padding:%?10?% 0 0 %?0?%;box-sizing:border-box}.meituan_elmo[data-v-42a36988]{flex-direction:row;display:flex;align-items:center;padding:%?16?% %?30?% 0 %?30?%;position:relative;height:63px;margin-bottom:14px}.meituan_elmo uni-view[data-v-42a36988]:nth-child(1){margin-right:%?10?%}.meituan_elmo uni-view[data-v-42a36988]:nth-child(2){margin-left:%?10?%}.meituan_elmo .meituan_elmo_box[data-v-42a36988]{flex:1;position:relative;background-color:#f7f7f7;border-radius:%?16?%;height:%?110?%}.meituan_elmo .meituan_elmo_box .meituan_img[data-v-42a36988]{width:100%;height:%?110?%;-webkit-animation:dialog-fade-in-data-v-42a36988 .3s linear 1;animation:dialog-fade-in-data-v-42a36988 .3s linear 1}.meituan_elmo .meituan_elmo_box .elmo_img[data-v-42a36988]{width:100%;height:%?110?%;-webkit-animation:dialog-fade-in-data-v-42a36988 .3s linear 1;animation:dialog-fade-in-data-v-42a36988 .3s linear 1}.screen_wrap[data-v-42a36988]{flex-direction:row;display:flex;align-items:center;padding:%?30?%;justify-content:space-between}.screen_wrap .zhpx_box[data-v-42a36988]{flex-direction:row;display:flex;align-items:center;background-color:#fff;padding:%?12?% %?20?%;border-radius:%?10?%;box-shadow:0 0 5px rgba(0,0,0,.09)}.screen_wrap .zhpx_box .zhpx_title[data-v-42a36988]{color:#666;font-size:%?24?%}.screen_wrap .zhpx_box2[data-v-42a36988]{flex-direction:row;display:flex;align-items:center;background-color:#fff;padding:%?12?% %?10?%;border-radius:%?10?%}.screen_wrap .zhpx_box2 .zhpx_title2[data-v-42a36988]{color:#666;font-size:%?24?%;margin-right:%?10?%}@-webkit-keyframes dialog-fade-in-data-v-42a36988{0%{opacity:0}100%{opacity:1}}@keyframes dialog-fade-in-data-v-42a36988{0%{opacity:0}100%{opacity:1}}[data-v-42a36988] .u-sticky{background-color:#fff!important}uni-image[data-v-42a36988]{vertical-align:bottom}.shop_list_wrap[data-v-42a36988]{padding:0 11px 1px 11px!important}.s_page_wrap[data-v-42a36988]{padding:0 %?25?% %?10?% %?25?%}.Search_box2[data-v-42a36988]{padding:%?30?% %?30?% %?14?% %?30?%;flex-direction:row;display:flex;align-items:center;background-color:#fff}.Search_box2 .Search_wrap[data-v-42a36988]{position:relative;flex-direction:row;flex:1;display:flex}.Search_box2 .Search_wrap .Search_btn[data-v-42a36988]{position:absolute;right:%?8?%;top:4px;color:#fff;background-image:linear-gradient(90deg,#ff9619,#ffb930);width:%?150?%;height:%?65?%;text-align:center;line-height:%?65?%;border-radius:%?200?%}",""]),a.exports=t},"9d3d":function(a,t,i){"use strict";i.r(t);var e=i("fc47"),o=i.n(e);for(var s in e)["default"].indexOf(s)<0&&function(a){i.d(t,a,(function(){return e[a]}))}(s);t["default"]=o.a},adc0:function(a,t,i){"use strict";var e=i("1ddf"),o=i.n(e);o.a},fc47:function(a,t,i){"use strict";(function(a){i("7a82");var e=i("4ea4").default;Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,i("d3b7"),i("ddb0"),i("99af"),i("159b"),i("14d9"),i("ac1f"),i("e25e");var o=e(i("d08d")),s={components:{RenDropdownFilter:o.default},data:function(){return{navTitle:"呵惠味",navbackground:{backgroundImage:"linear-gradient(90deg, #FE7B20, #FE7B20)"},ifmember:0,available:!1,keyword:"",enable:!0,shopsList:[],pageSize:1,pageNum:10,loadingstatus:"loading",loadText:{loadmore:"轻轻上拉",loading:"努力加载中",nomore:"实在没有了"},failTimeOutShow:!1,filterData:[[{text:"综合排序",value:1},{text:"实付最少",value:2},{text:"离我最近",value:3},{text:"补贴最多",value:4},{text:"名额最多",value:5}],[{text:"全部平台",value:""},{text:"美团",value:1},{text:"饿了么",value:2}],[{text:"全部品类",value:""}]],defaultIndex:[0,0,0],category_id:"",iforderable:0,order_By:1,shopsType:""}},onPullDownRefresh:function(){var a=this;setTimeout((function(){a.pageSize=1,a.pageNum=10,a.failTimeOutShow=!1,a.GetShopslist(),uni.stopPullDownRefresh()}),1500)},onReachBottom:function(){var a=this;this.loadingstatus="loading",setTimeout((function(){a.pageSize++,a.GetShopslist(),uni.hideNavigationBarLoading()}),500)},onLoad:function(a){this.keyword=a.keys,this.navTitle=a.title||"呵惠味",this.category_id=a.categoryID||"",this.GetShopslist(),this.getfenleiList()},onShow:function(){this.enable=!0,this.Getmember()},onHide:function(){this.enable=!1},methods:{refurbish:function(){this.failTimeOutShow=!1,this.pageSize=1,this.pageNum=10,this.GetShopslist()},Getmember:function(){var a=uni.getStorageSync("userinfo");this.ifmember=a.is_member},GetShopslist:function(){var t=this,i=uni.getStorageSync("lat"),e=uni.getStorageSync("lng");t.$api.Getshopslist({page:t.pageSize,limit:t.pageNum,lat:i,lng:e,keyword:t.keyword,category_id:t.category_id,type:t.shopsType,is_orderable:t.iforderable,order_by:t.order_By}).then((function(a){1!=t.pageSize?0!=a.data.result.length?(t.loadingstatus="loading",t.shopsList=t.shopsList.concat(a.data.result)):t.loadingstatus="nomore":(t.shopsList=a.data.result,t.loadingstatus="loading")})).catch((function(i){i.data?uni.showToast({title:i.data.msg,icon:"none",duration:2e3}):(a("log","请求错误或请求超时",i.errMsg," at pages/search/search.vue:295"),t.shopsList=[],t.failTimeOutShow=!0)}))},getfenleiList:function(){var a=this;a.$api.bwcShopscategory({client:"h5"}).then((function(t){var i=t.data.result;i.forEach((function(t){a.filterData[2].push({text:t.name,value:t.id})}))}))},AvailableChange:function(a){this.$refs.popupRef.tapMask(),1==a?(this.iforderable=1,this.pageSize=1,this.GetShopslist()):0==a&&(this.iforderable=0,this.pageSize=1,this.GetShopslist())},onSelected:function(a){var t=[],i=a;i.forEach((function(a,i){t.push({target:a})})),this.order_By=t[0].target[0].value,this.shopsType=t[1].target[0].value,this.category_id=t[2].target[0].value,this.pageSize=1,this.shopsList=[],this.GetShopslist()},zhiding:function(){uni.createSelectorQuery().select(".shops_box").boundingClientRect((function(a){uni.createSelectorQuery().select(".shop_list_wrap").boundingClientRect((function(t){a&&uni.pageScrollTo({duration:100,scrollTop:a.top+56-t.top})})).exec()})).exec()},setItemProgress:function(a){var t=a.ady_num-a.total_count;return a.ady_num==a.total_count?100:parseInt((a.ady_num-t)/a.ady_num*100)},ToDetails:function(a,t){uni.navigateTo({url:"/pages/newshopDetails/newshopDetails?sid="+a.id})},Tosearch:function(){this.pageSize=1,this.GetShopslist()}}};t.default=s}).call(this,i("0de9")["log"])}}]);