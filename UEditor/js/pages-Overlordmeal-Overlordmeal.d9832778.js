(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-Overlordmeal-Overlordmeal"],{"02b8":function(t,i,e){"use strict";e.d(i,"b",(function(){return a})),e.d(i,"c",(function(){return o})),e.d(i,"a",(function(){}));var a=function(){var t=this.$createElement,i=this._self._c||t;return i("v-uni-view",{staticClass:"u-grid",class:{"u-border-top u-border-left":this.border},style:[this.gridStyle]},[this._t("default")],2)},o=[]},"0f0b":function(t,i,e){"use strict";var a=e("6f9a"),o=e.n(a);o.a},"220c":function(t,i,e){var a=e("e917");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var o=e("4f06").default;o("043d8466",a,!0,{sourceMap:!1,shadowMode:!1})},2303:function(t,i,e){"use strict";e.r(i);var a=e("512e"),o=e.n(a);for(var n in a)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(n);i["default"]=o.a},"24c2":function(t,i,e){"use strict";(function(t){e("7a82");var a=e("4ea4").default;Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,e("d3b7"),e("ddb0"),e("99af"),e("159b"),e("14d9"),e("ac1f"),e("e25e");var o=a(e("d08d")),n={components:{RenDropdownFilter:o.default},data:function(){return{navTitle:"外卖霸王餐",navbackground:{backgroundImage:"linear-gradient(90deg, #FE7B20, #FE7B20)"},ifmember:0,available:!1,keyword:"",enable:!0,menuList:[],shopsList:[],pageSize:1,pageNum:10,chudiLoading:!0,nomoreLoading:!1,filterData:[[{text:"综合排序",value:1},{text:"实付最少",value:2},{text:"离我最近",value:3},{text:"补贴最多",value:4},{text:"名额最多",value:5}],[{text:"全部平台",value:""},{text:"美团",value:1},{text:"饿了么",value:2}],[{text:"全部品类",value:""}]],defaultIndex:[0,0,0],category_id:"",iforderable:0,order_By:1,shopsType:"",customStyle:{padding:"0 0 20rpx 0"}}},onPullDownRefresh:function(){var t=this;setTimeout((function(){t.pageSize=1,t.GetShopslist(),uni.stopPullDownRefresh()}),1500)},onReachBottom:function(){var t=this;setTimeout((function(){t.pageSize++,t.GetShopslist(),uni.hideNavigationBarLoading()}),500)},onLoad:function(t){this.keyword=t.keys,this.navTitle=t.title||"外卖霸王餐",this.GetShopslist(),this.getMenuList()},onShow:function(){this.enable=!0,this.Getmember()},onHide:function(){this.enable=!1},methods:{Getmember:function(){var t=uni.getStorageSync("userinfo");this.ifmember=t.is_member},GetShopslist:function(){var t=this,i=uni.getStorageSync("lat"),e=uni.getStorageSync("lng");t.$api.Getshopslist({page:t.pageSize,limit:t.pageNum,lat:i,lng:e,keyword:t.keyword,category_id:t.category_id,type:t.shopsType,is_orderable:t.iforderable,order_by:t.order_By}).then((function(i){1!=t.pageSize?0!=i.data.result.length?t.shopsList=t.shopsList.concat(i.data.result):(t.chudiLoading=!1,t.nomoreLoading=!0):t.shopsList=i.data.result})).catch((function(t){uni.showToast({title:t.data.msg,icon:"none",duration:2e3})}))},AvailableChange:function(t){this.$refs.popupRef.tapMask(),1==t?(this.iforderable=1,this.pageSize=1,this.chudiLoading=!0,this.nomoreLoading=!1,this.GetShopslist()):0==t&&(this.iforderable=0,this.pageSize=1,this.chudiLoading=!0,this.nomoreLoading=!1,this.GetShopslist())},onSelected:function(t){var i=[],e=t;e.forEach((function(t,e){i.push({target:t})})),this.order_By=i[0].target[0].value,this.shopsType=i[1].target[0].value,this.category_id=i[2].target[0].value,this.pageSize=1,this.shopsList=[],this.chudiLoading=!0,this.nomoreLoading=!1,this.GetShopslist()},zhiding:function(){uni.createSelectorQuery().select(".shops_box").boundingClientRect((function(t){uni.createSelectorQuery().select(".shop_list_wrap").boundingClientRect((function(i){t&&uni.pageScrollTo({duration:100,scrollTop:t.top+160-i.top})})).exec()})).exec()},getMenuList:function(){var t=this;t.$api.bwcShopscategory({client:"h5"}).then((function(i){t.menuList=i.data.result;var e=i.data.result;e.forEach((function(i){t.filterData[2].push({text:i.name,value:i.id})}))}))},Tomenus:function(i,e){t("log","点击了菜单",i,e," at pages/Overlordmeal/Overlordmeal.vue:388"),uni.navigateTo({url:"/pages/typepages/typepages?typeid="+i.id+"&title="+i.name})},NoKaiqiang:function(t,i){uni.showToast({title:t.open_time+"后才可以抢单哦",icon:"none",duration:2e3})},ToDetails:function(t){uni.navigateTo({url:"/pages/newshopDetails/newshopDetails?sid="+t.id})},Tosearch:function(){this.pageSize=1,this.GetShopslist()},setItemProgress:function(t){var i=t.ady_num-t.total_count;return t.ady_num==t.total_count?100:parseInt((t.ady_num-i)/t.ady_num*100)}}};i.default=n}).call(this,e("0de9")["log"])},"503a":function(t,i,e){"use strict";e.d(i,"b",(function(){return a})),e.d(i,"c",(function(){return o})),e.d(i,"a",(function(){}));var a=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",{staticClass:"u-grid-item",style:{background:t.bgColor,width:t.width},attrs:{"hover-class":t.parentData.hoverClass,"hover-stay-time":200},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.click.apply(void 0,arguments)}}},[e("v-uni-view",{staticClass:"u-grid-item-box",class:[t.parentData.border?"u-border-right u-border-bottom":""],style:[t.customStyle]},[t._t("default")],2)],1)},o=[]},"512e":function(t,i,e){"use strict";e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,e("a9e3"),e("d81d");var a={name:"u-grid",props:{col:{type:[Number,String],default:3},border:{type:Boolean,default:!0},align:{type:String,default:"left"},hoverClass:{type:String,default:"u-hover-class"}},data:function(){return{index:0}},watch:{parentData:function(){this.children.length&&this.children.map((function(t){"function"==typeof t.updateParentData&&t.updateParentData()}))}},created:function(){this.children=[]},computed:{parentData:function(){return[this.hoverClass,this.col,this.size,this.border]},gridStyle:function(){var t={};switch(this.align){case"left":t.justifyContent="flex-start";break;case"center":t.justifyContent="center";break;case"right":t.justifyContent="flex-end";break;default:t.justifyContent="flex-start"}return t}},methods:{click:function(t){this.$emit("click",t)}}};i.default=a},"623b":function(t,i,e){"use strict";e.d(i,"b",(function(){return o})),e.d(i,"c",(function(){return n})),e.d(i,"a",(function(){return a}));var a={uSearch:e("e618").default,uGrid:e("8b4f").default,uGridItem:e("7229").default,uSticky:e("e6c3").default,renDropdownFilter:e("d08d").default,uIcon:e("21cf").default,uLineProgress:e("ed8a").default,uLoading:e("b3e9").default,uLoadmore:e("dd5b").default},o=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",[e("v-uni-view",{staticClass:"Search_box2"},[e("v-uni-view",{staticClass:"Search_wrap"},[e("u-search",{attrs:{placeholder:"寻找好店",height:"80",bgColor:"#F5F4F2",showAction:!1},model:{value:t.keyword,callback:function(i){t.keyword=i},expression:"keyword"}}),e("v-uni-view",{staticClass:"Search_btn",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.Tosearch()}}},[t._v("搜索")])],1)],1),e("v-uni-view",{staticClass:"menu_wrap"},[e("u-grid",{attrs:{border:!1,align:"left",col:5}},t._l(t.menuList,(function(i,a){return e("u-grid-item",{key:a,attrs:{"custom-style":t.customStyle},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.Tomenus(i,a)}}},[e("v-uni-image",{staticClass:"menu_images",attrs:{src:i.image}}),e("v-uni-text",{staticClass:"grid-text"},[t._v(t._s(i.name))])],1)})),1)],1),e("u-sticky",{attrs:{index:"1","offset-top":"0","h5-nav-height":"0",enable:t.enable}},[e("v-uni-view",{staticClass:"screen_box",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.zhiding()}}},[e("ren-dropdown-filter",{ref:"popupRef",attrs:{filterData:t.filterData,defaultIndex:t.defaultIndex},on:{onSelected:function(i){arguments[0]=i=t.$handleEvent(i),t.onSelected.apply(void 0,arguments)},Cancelstatus:function(i){arguments[0]=i=t.$handleEvent(i),t.AvailableChange.apply(void 0,arguments)}}})],1)],1),0!=t.shopsList.length?e("v-uni-view",{staticClass:"shop_list_wrap u-skeleton"},[t._l(t.shopsList,(function(i,a){return e("v-uni-view",{key:a,staticClass:"shops_box u-skeleton-rect",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),0==i.is_work?t.NoKaiqiang(i,a):t.ToDetails(i,a)}}},[e("v-uni-view",{staticClass:"shops_info_wrap"},[e("v-uni-image",{staticClass:"shops_logo",attrs:{src:i.logo,mode:"aspectFill"}}),e("v-uni-view",{staticClass:"shop_info"},[e("v-uni-text",{staticClass:"shop_name"},[t._v(t._s(i.name))]),e("v-uni-view",{staticClass:"shops_time"},[e("v-uni-view",{staticClass:"shops_time_logo"},[1==i.type?e("v-uni-view",{staticClass:"meituan_icon"},[t._v("美团")]):t._e(),2==i.type?e("v-uni-view",{staticClass:"element_icon"},[t._v("饿了么")]):t._e(),e("v-uni-text",{staticClass:"shops_titme_text"},[t._v("抢单时间："+t._s(i.open_time)+"-"+t._s(i.close_time))])],1),e("v-uni-text",{staticClass:"shops_titme_juli"},[t._v(t._s(i.distance)+"km")])],1),e("v-uni-view",{staticClass:"addres_Box"},[e("u-icon",{attrs:{name:"map",color:"#999",size:"38"}}),e("v-uni-view",{staticClass:"addresInfo"},[t._v(t._s(i.address))])],1)],1)],1),t._l(i.activity,(function(a,o){return e("v-uni-view",{key:o,staticClass:"activityList_box"},[i.activity.length>1?e("v-uni-view",{staticClass:"hd_title"},[e("v-uni-view",{staticClass:"hd_num_box"},[t._v("活动"+t._s(o+1))]),e("v-uni-view",{staticClass:"hd_xian"})],1):t._e(),e("v-uni-view",{staticClass:"qiangdan_time"},[e("v-uni-view",{staticClass:"member_box",class:[a.ady_num==a.total_count||0==i.is_work?"zhihui":""]},[1===t.ifmember?e("v-uni-view",[0==a.minimum_amount?e("v-uni-view",{staticClass:"shops_price_box"},[e("v-uni-view",{staticClass:"jiage"},[e("v-uni-text",{staticClass:"fuhao"},[t._v("￥")]),e("v-uni-text",{staticClass:"jine"},[t._v(t._s(parseFloat(a.member_rebate_amount).toFixed(0)))])],1),e("v-uni-view",{staticClass:"butie_box"},[e("v-uni-view",{staticClass:"butie"},[t._v("会员最高补贴")])],1)],1):t._e(),a.minimum_amount>0?e("v-uni-view",{staticClass:"shops_price_box"},[e("v-uni-view",{staticClass:"jiage"},[e("v-uni-text",{staticClass:"fuhao"},[t._v("￥")]),e("v-uni-text",{staticClass:"jine"},[t._v(t._s(parseFloat(a.member_rebate_amount).toFixed(0)))])],1),e("v-uni-view",{staticClass:"butie_box"},[e("v-uni-view",{staticClass:"butie"},[t._v("会员满"+t._s(a.minimum_amount)+"补"+t._s(a.member_rebate_amount))])],1)],1):t._e()],1):e("v-uni-view",[0==a.minimum_amount?e("v-uni-view",{staticClass:"shops_price_box"},[e("v-uni-view",{staticClass:"jiage"},[e("v-uni-text",{staticClass:"fuhao"},[t._v("￥")]),e("v-uni-text",{staticClass:"jine"},[t._v(t._s(parseFloat(a.member_rebate_amount).toFixed(0)))])],1),e("v-uni-view",{staticClass:"butie_box"},[e("v-uni-view",{staticClass:"butie"},[t._v("会员最高补贴")]),e("v-uni-view",{staticClass:"butie2"},[t._v("非会员最高补贴"+t._s(a.rebate_amount))])],1)],1):t._e(),a.minimum_amount>0?e("v-uni-view",{staticClass:"shops_price_box"},[e("v-uni-view",{staticClass:"jiage"},[e("v-uni-text",{staticClass:"fuhao"},[t._v("￥")]),e("v-uni-text",{staticClass:"jine"},[t._v(t._s(parseFloat(a.member_rebate_amount).toFixed(0)))])],1),e("v-uni-view",{staticClass:"butie_box"},[e("v-uni-view",{staticClass:"butie"},[t._v("会员满"+t._s(a.minimum_amount)+"补"+t._s(a.member_rebate_amount))]),e("v-uni-view",{staticClass:"butie2"},[t._v("非会员满"+t._s(a.minimum_amount)+"补"+t._s(a.rebate_amount))])],1)],1):t._e()],1),e("v-uni-image",{staticClass:"shandian_icon",attrs:{src:"/static/images/shandian_icon.png"}}),e("v-uni-view",{staticClass:"sd_price"},[e("v-uni-view",{staticClass:"shengyu_box"},[0==i.is_work?e("v-uni-text",{staticClass:"qd_text"},[t._v(t._s(i.open_time)+"后开抢")]):e("v-uni-text",{staticClass:"qd_text"},[t._v("抢单")])],1),e("v-uni-view",{staticClass:"jindutiao"},[e("v-uni-view",{staticClass:"jindutiao_Box"},[e("u-line-progress",{attrs:{percent:t.setItemProgress(a),height:"14",round:!0,"active-color":"#FFFFFF","inactive-color":"#ffb95f"}},[e("v-uni-view",{attrs:{slot:"default"},slot:"default"})],1)],1),e("v-uni-view",{staticClass:"shengyu6"},[t._v("剩"+t._s(a.day_num-a.total_count>0?a.day_num-a.total_count:0)+"份")])],1)],1)],1)],1)],1)}))],2)})),t.chudiLoading?e("v-uni-view",{staticClass:"chudijiazai"},[e("u-loading",{attrs:{show:t.chudiLoading,color:"#FFB930"}}),e("v-uni-view",{staticClass:"tag"},[t._v("加载中...")])],1):t._e(),t.nomoreLoading?e("v-uni-view",{staticClass:"nomoreTotal"},[e("u-loadmore",{attrs:{status:"nomore",color:"#999","font-size":"24"}})],1):t._e()],2):e("v-uni-view",{staticClass:"noData_box"},[e("v-uni-image",{attrs:{src:"/static/images/noData.png",mode:"widthFix"}}),e("v-uni-view",[t._v("暂无店铺")])],1),e("v-uni-view",{staticStyle:{height:"1rpx"}})],1)},n=[]},"6f9a":function(t,i,e){var a=e("9102");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var o=e("4f06").default;o("e7f6ae12",a,!0,{sourceMap:!1,shadowMode:!1})},7229:function(t,i,e){"use strict";e.r(i);var a=e("503a"),o=e("bd75");for(var n in o)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return o[t]}))}(n);e("0f0b");var s=e("f0c5"),r=Object(s["a"])(o["default"],a["b"],a["c"],!1,null,"02c7666e",null,!1,a["a"],void 0);i["default"]=r.exports},7906:function(t,i,e){var a=e("b6f6");a.__esModule&&(a=a.default),"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var o=e("4f06").default;o("b1bbf2d2",a,!0,{sourceMap:!1,shadowMode:!1})},"8b4f":function(t,i,e){"use strict";e.r(i);var a=e("02b8"),o=e("2303");for(var n in o)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return o[t]}))}(n);e("97d2");var s=e("f0c5"),r=Object(s["a"])(o["default"],a["b"],a["c"],!1,null,"00eebdbf",null,!1,a["a"],void 0);i["default"]=r.exports},9102:function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,".u-grid-item[data-v-02c7666e]{box-sizing:border-box;background:#fff;display:flex;flex-direction:row;align-items:center;justify-content:center;position:relative;flex-direction:column}.u-grid-item-hover[data-v-02c7666e]{background:#f7f7f7!important}.u-grid-marker-box[data-v-02c7666e]{position:absolute;display:inline-flex;line-height:0}.u-grid-marker-wrap[data-v-02c7666e]{position:absolute}.u-grid-item-box[data-v-02c7666e]{padding:%?30?% 0;display:flex;flex-direction:row;align-items:center;justify-content:center;flex-direction:column;flex:1;width:100%;height:100%}",""]),t.exports=i},"97d2":function(t,i,e){"use strict";var a=e("220c"),o=e.n(a);o.a},"9de4":function(t,i,e){"use strict";var a=e("7906"),o=e.n(a);o.a},b6f6:function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,".meituan_icon[data-v-00724bc6]{font-size:%?24?%;background-color:#fdd900;color:#333;border-radius:%?10?%;padding:%?2?% %?10?%;margin-right:%?6?%}.element_icon[data-v-00724bc6]{font-size:%?24?%;background-color:#05b6fd;color:#fff;border-radius:%?10?%;padding:%?2?% %?10?%;margin-right:%?6?%}.screen_box[data-v-00724bc6]{z-index:9999}.zhihui[data-v-00724bc6]{-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%);filter:grayscale(100%);filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1)}.noData_box[data-v-00724bc6]{margin-top:0;text-align:center;color:#999}.noData_box uni-image[data-v-00724bc6]{width:%?280?%}.noData_box .lijipay[data-v-00724bc6]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-00724bc6]{height:%?70?%!important;line-height:%?70?%!important}.kefu_Box[data-v-00724bc6]{position:fixed;z-index:999;bottom:15%;right:0;background-color:#fff;padding:%?10?% %?30?% %?10?% %?10?%;border-radius:%?200?% 0 0 %?200?%;box-shadow:0 0 5px rgba(0,0,0,.1);margin:10px 0 10px 5px}.kefu_Box .kefu_icon[data-v-00724bc6]{width:%?70?%;height:%?70?%}.shop_list_wrap[data-v-00724bc6]{background-image:linear-gradient(0deg,#f8f4f3,#fff);padding:0 %?22?% 66px %?22?%;position:relative}.shop_list_wrap .u-skeleton[data-v-00724bc6]{padding:7px 0;margin:0 0 0 0}.shop_list_wrap .shops_box[data-v-00724bc6]{-webkit-animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;flex-direction:row;background-color:#fff;box-shadow:0 0 8px rgba(248,244,243,.5);margin:5px 5px 10px 5px;padding:%?20?%;border-radius:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap[data-v-00724bc6]{display:flex;align-items:flex-start;margin-bottom:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shops_logo[data-v-00724bc6]{width:%?168?%;height:%?168?%;border-radius:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info[data-v-00724bc6]{flex:1;padding-left:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shop_name[data-v-00724bc6]{font-size:%?32?%;font-weight:700;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time[data-v-00724bc6]{flex:1;flex-direction:row;display:flex;align-items:center;justify-content:space-between;margin-top:%?20?%;margin-bottom:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo[data-v-00724bc6]{display:flex;flex-direction:row;align-items:center}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo .shop_type[data-v-00724bc6]{width:%?40?%;height:%?40?%;margin-right:%?10?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo .shops_titme_text[data-v-00724bc6]{font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_titme_juli[data-v-00724bc6]{font-size:%?24?%;color:#999;justify-content:flex-end}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .addres_Box[data-v-00724bc6]{display:flex;align-items:center;font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .addres_Box .addresInfo[data-v-00724bc6]{word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.shop_list_wrap .shops_box .activityList_box[data-v-00724bc6]{margin-bottom:%?30?%}.shop_list_wrap .shops_box .activityList_box .hd_title[data-v-00724bc6]{display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .hd_title .hd_num_box[data-v-00724bc6]{background-color:#f3f1f2;border-radius:%?8?%;color:#999;padding:%?4?% %?10?%;font-size:%?24?%}.shop_list_wrap .shops_box .activityList_box .hd_title .hd_xian[data-v-00724bc6]{flex:1;height:1px;background-color:#f3f1f2}.shop_list_wrap .shops_box .activityList_box .qiangdan_time[data-v-00724bc6]{display:flex;align-items:center;margin:%?20?% 0}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .activity_idx[data-v-00724bc6]{width:26%;text-align:center;font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box[data-v-00724bc6]{flex-direction:row;align-items:center;display:flex;background-color:#ffedd5;border-radius:%?20?%;padding:%?16?% %?20?%;height:%?100?%;position:relative;flex:1}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage .fuhao[data-v-00724bc6]{color:#ff611e;font-size:%?26?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage .jine[data-v-00724bc6]{color:#ff611e;font-size:%?44?%;font-weight:700}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box[data-v-00724bc6]{padding-left:%?16?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box .butie[data-v-00724bc6]{color:#ff611e;font-size:%?28?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box .butie2[data-v-00724bc6]{color:#ff611e;font-size:%?24?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shandian_icon[data-v-00724bc6]{width:%?270?%;height:%?100?%;position:absolute;top:0;right:0}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price[data-v-00724bc6]{text-align:center;position:absolute;top:%?16?%;right:0;width:110px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .shengyu_box[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center;flex:1;justify-content:center;margin-bottom:%?12?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .shengyu_box .qd_text[data-v-00724bc6]{color:#fff;font-size:%?26?%;flex:1;text-align:center;font-weight:700}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center;justify-content:center;height:7px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao .jindutiao_Box[data-v-00724bc6]{width:%?90?%;position:relative;top:-5px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao .shengyu6[data-v-00724bc6]{font-size:%?24?%;padding-left:%?10?%;color:#fff}.shop_list_wrap .shops_box .activityList_box .qiangdan_time[data-v-00724bc6]:last-child{margin-bottom:0}.shop_list_wrap .shops_box .activityList_box[data-v-00724bc6]:last-child{margin-bottom:0}.nav_wrap[data-v-00724bc6]{padding:0 %?30?%;display:flex;align-items:center;justify-content:space-between;flex:1;-webkit-animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;animation:dialog-fade-in-data-v-00724bc6 .3s linear 1}.nav_wrap .city_screen[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center}.nav_wrap .city_screen .city_name[data-v-00724bc6]{color:#fff;font-weight:700;margin:0 %?4?%;font-size:%?30?%;flex:1;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;height:%?48?%;line-height:%?48?%}.nav_wrap .city_screen .right_jiao[data-v-00724bc6]{position:relative;left:%?-10?%;top:%?2?%}.nav_wrap .city_screen .left_jiao[data-v-00724bc6]{position:relative}.nav_wrap .sign_msg[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center;margin-left:auto}.nav_wrap .sign_msg .s_icon[data-v-00724bc6]{margin:0 %?5?%;width:%?54?%;height:%?54?%;-webkit-animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;animation:dialog-fade-in-data-v-00724bc6 .3s linear 1}.nav_wrap .sign_msg .s_icon2[data-v-00724bc6]{margin:0 %?5?%;width:%?50?%;height:%?50?%;-webkit-animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;animation:dialog-fade-in-data-v-00724bc6 .3s linear 1}.homt_top_box[data-v-00724bc6]{width:%?750?%;height:%?204?%;position:relative}.homt_top_box .homt_top_bg[data-v-00724bc6]{width:%?750?%;height:%?450?%}.homt_top_box .homt_top_bg_box[data-v-00724bc6]{width:%?750?%;height:%?140?%;background-image:linear-gradient(180deg,#ff9f4a,#fff)}.homt_top_box .Rotation_chart[data-v-00724bc6]{padding:%?30?%;width:%?750?%;position:absolute;flex:1;bottom:0;right:0;left:0}.homt_top_box .Rotation_chart .lunbotu_img[data-v-00724bc6]{width:%?690?%;-webkit-animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;height:%?170?%}.Search_box[data-v-00724bc6]{padding:%?20?% %?30?% %?10?% %?30?%;flex-direction:row;display:flex;align-items:center}.Search_box .Search_wrap[data-v-00724bc6]{position:relative;flex-direction:row;flex:1;display:flex}.Search_box .Search_wrap .Search_btn[data-v-00724bc6]{position:absolute;right:%?8?%;top:4px;color:#fff;background-image:linear-gradient(90deg,#ff9619,#ffb930);width:%?100?%;height:%?55?%;text-align:center;line-height:%?55?%;border-radius:%?200?%;font-weight:600}.menu_wrap[data-v-00724bc6]{padding:%?10?% %?10?% 0 %?10?%}.menu_wrap .swiper[data-v-00724bc6]{height:184px}.menu_wrap .menu_images[data-v-00724bc6]{width:44px;height:44px;-webkit-animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;animation:dialog-fade-in-data-v-00724bc6 .3s linear 1}.menu_wrap .grid-text[data-v-00724bc6]{font-size:12px;color:#333;padding:%?10?% 0 0 %?0?%;box-sizing:border-box}.meituan_elmo[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center;padding:%?16?% %?30?% 0 %?30?%;position:relative;height:63px;margin-bottom:14px}.meituan_elmo uni-view[data-v-00724bc6]:nth-child(1){margin-right:%?10?%}.meituan_elmo uni-view[data-v-00724bc6]:nth-child(2){margin-left:%?10?%}.meituan_elmo .meituan_elmo_box[data-v-00724bc6]{flex:1;position:relative;background-color:#f7f7f7;border-radius:%?16?%;height:%?110?%}.meituan_elmo .meituan_elmo_box .meituan_img[data-v-00724bc6]{width:100%;height:%?110?%;-webkit-animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;animation:dialog-fade-in-data-v-00724bc6 .3s linear 1}.meituan_elmo .meituan_elmo_box .elmo_img[data-v-00724bc6]{width:100%;height:%?110?%;-webkit-animation:dialog-fade-in-data-v-00724bc6 .3s linear 1;animation:dialog-fade-in-data-v-00724bc6 .3s linear 1}.screen_wrap[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center;padding:%?30?%;justify-content:space-between}.screen_wrap .zhpx_box[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center;background-color:#fff;padding:%?12?% %?20?%;border-radius:%?10?%;box-shadow:0 0 5px rgba(0,0,0,.09)}.screen_wrap .zhpx_box .zhpx_title[data-v-00724bc6]{color:#666;font-size:%?24?%}.screen_wrap .zhpx_box2[data-v-00724bc6]{flex-direction:row;display:flex;align-items:center;background-color:#fff;padding:%?12?% %?10?%;border-radius:%?10?%}.screen_wrap .zhpx_box2 .zhpx_title2[data-v-00724bc6]{color:#666;font-size:%?24?%;margin-right:%?10?%}@-webkit-keyframes dialog-fade-in-data-v-00724bc6{0%{opacity:0}100%{opacity:1}}@keyframes dialog-fade-in-data-v-00724bc6{0%{opacity:0}100%{opacity:1}}[data-v-00724bc6] .u-sticky{background-color:#fff!important}.shop_list_wrap[data-v-00724bc6]{padding:0 %?20?% %?20?% %?20?%!important}.chudijiazai[data-v-00724bc6]{display:flex;align-items:center;justify-content:center;height:calc(10vh - 50px);color:#999;font-size:%?24?%}.chudijiazai .tag[data-v-00724bc6]{padding-left:%?10?%}uni-image[data-v-00724bc6]{vertical-align:bottom}.shandian_icon[data-v-00724bc6]{width:%?260?%!important}.sd_price[data-v-00724bc6]{width:112px!important}.s_page_wrap[data-v-00724bc6]{padding:%?20?% %?25?% %?10?% %?25?%}.Search_box2[data-v-00724bc6]{padding:%?30?% %?30?% %?30?% %?30?%;flex-direction:row;display:flex;align-items:center;background-color:#fff}.Search_box2 .Search_wrap[data-v-00724bc6]{position:relative;flex-direction:row;flex:1;display:flex}.Search_box2 .Search_wrap .Search_btn[data-v-00724bc6]{position:absolute;right:%?8?%;top:4px;color:#fff;background-image:linear-gradient(90deg,#ff9619,#ffb930);width:%?150?%;height:%?65?%;text-align:center;line-height:%?65?%;border-radius:%?200?%}",""]),t.exports=i},bd75:function(t,i,e){"use strict";e.r(i);var a=e("fbba"),o=e.n(a);for(var n in a)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(n);i["default"]=o.a},dca1:function(t,i,e){"use strict";e.r(i);var a=e("623b"),o=e("f286");for(var n in o)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return o[t]}))}(n);e("9de4");var s=e("f0c5"),r=Object(s["a"])(o["default"],a["b"],a["c"],!1,null,"00724bc6",null,!1,a["a"],void 0);i["default"]=r.exports},e917:function(t,i,e){var a=e("24fb");i=a(!1),i.push([t.i,".u-grid[data-v-00eebdbf]{width:100%;display:flex;flex-direction:row;flex-wrap:wrap;align-items:center}",""]),t.exports=i},f286:function(t,i,e){"use strict";e.r(i);var a=e("24c2"),o=e.n(a);for(var n in a)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(n);i["default"]=o.a},fbba:function(t,i,e){"use strict";e("7a82"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0,e("a9e3"),e("14d9");var a={name:"u-grid-item",props:{bgColor:{type:String,default:"#ffffff"},index:{type:[Number,String],default:""},customStyle:{type:Object,default:function(){return{padding:"30rpx 0"}}}},data:function(){return{parentData:{hoverClass:"",col:3,border:!0}}},created:function(){this.updateParentData(),this.parent.children.push(this)},computed:{width:function(){return 100/Number(this.parentData.col)+"%"}},methods:{updateParentData:function(){this.getParentData("u-grid")},click:function(){this.$emit("click",this.index),this.parent&&this.parent.click(this.index)}}};i.default=a}}]);