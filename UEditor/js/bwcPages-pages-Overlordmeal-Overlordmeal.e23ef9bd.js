(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["bwcPages-pages-Overlordmeal-Overlordmeal"],{"02b8":function(t,e,a){"use strict";a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){}));var i=function(){var t=this.$createElement,e=this._self._c||t;return e("v-uni-view",{staticClass:"u-grid",class:{"u-border-top u-border-left":this.border},style:[this.gridStyle]},[this._t("default")],2)},o=[]},"0f0b":function(t,e,a){"use strict";var i=a("6f9a"),o=a.n(i);o.a},"220c":function(t,e,a){var i=a("e917");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("043d8466",i,!0,{sourceMap:!1,shadowMode:!1})},2303:function(t,e,a){"use strict";a.r(e);var i=a("512e"),o=a.n(i);for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);e["default"]=o.a},"3f09":function(t,e,a){"use strict";a.d(e,"b",(function(){return o})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return i}));var i={uSearch:a("e618").default,uGrid:a("8b4f").default,uGridItem:a("7229").default,uSticky:a("e6c3").default,renDropdownFilter:a("d08d").default,lSvga:a("9f25").default,uIcon:a("21cf").default,uLineProgress:a("ed8a").default,uLoadmore:a("dd5b").default},o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"page_wrap"},[a("v-uni-view",{staticClass:"Search_box2"},[a("v-uni-view",{staticClass:"Search_wrap"},[a("u-search",{attrs:{placeholder:"寻找好店",height:"80",bgColor:"#F5F4F2",showAction:!1},model:{value:t.keyword,callback:function(e){t.keyword=e},expression:"keyword"}}),a("v-uni-view",{staticClass:"Search_btn",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.Tosearch()}}},[t._v("搜索")])],1)],1),a("v-uni-view",{staticClass:"menu_wrap"},[a("u-grid",{attrs:{border:!1,align:"left",col:5}},t._l(t.menuList,(function(e,i){return a("u-grid-item",{key:i,attrs:{"custom-style":t.customStyle},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.Tomenus(e,i)}}},[a("v-uni-image",{staticClass:"menu_images",attrs:{src:e.image}}),a("v-uni-text",{staticClass:"grid-text"},[t._v(t._s(e.name))])],1)})),1)],1),a("u-sticky",{attrs:{index:"1","offset-top":t.offsetTop,"h5-nav-height":0,enable:t.enable}},[a("v-uni-view",{staticClass:"screen_box",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.zhiding()}}},[a("ren-dropdown-filter",{ref:"popupRef",attrs:{filterData:t.filterData,defaultIndex:t.defaultIndex},on:{onSelected:function(e){arguments[0]=e=t.$handleEvent(e),t.onSelected.apply(void 0,arguments)},Cancelstatus:function(e){arguments[0]=e=t.$handleEvent(e),t.AvailableChange.apply(void 0,arguments)}}})],1)],1),t.skeletonLoading?a("v-uni-view",{staticClass:"lanjiazai"},[a("v-uni-view",[a("v-uni-view",{staticClass:"loading_icon"},[a("l-svga",{attrs:{src:t.BestImgUrl+"loading.svga"}})],1),a("v-uni-view",{staticClass:"tag"},[t._v("加载中...")])],1)],1):a("v-uni-view",[0!=t.shopsList.length?a("v-uni-view",{staticClass:"shop_list_wrap u-skeleton"},[t._l(t.shopsList,(function(e,i){return a("v-uni-view",{key:i,staticClass:"shops_box u-skeleton-rect",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),0==e.is_work?t.NoKaiqiang(e,i):t.ToDetails(e,i)}}},[a("v-uni-view",{staticClass:"shops_info_wrap"},[a("v-uni-image",{staticClass:"shops_logo",attrs:{src:e.logo,mode:"aspectFill"}}),a("v-uni-view",{staticClass:"shop_info"},[a("v-uni-text",{staticClass:"shop_name"},[t._v(t._s(e.name))]),a("v-uni-view",{staticClass:"shops_time"},[a("v-uni-view",{staticClass:"shops_time_logo"},[1==e.type?a("v-uni-view",{staticClass:"meituan_icon"},[t._v("美团")]):t._e(),2==e.type?a("v-uni-view",{staticClass:"element_icon"},[t._v("饿了么")]):t._e(),a("v-uni-text",{staticClass:"shops_titme_text"},[t._v("抢单时间："+t._s(e.open_time)+"-"+t._s(e.close_time))])],1),a("v-uni-text",{staticClass:"shops_titme_juli"},[t._v(t._s(e.distance)+"km")])],1),a("v-uni-view",{staticClass:"addres_Box"},[a("u-icon",{attrs:{name:"map",color:"#999",size:"38"}}),a("v-uni-view",{staticClass:"addresInfo"},[t._v(t._s(e.address))])],1)],1)],1),t._l(e.activity,(function(i,o){return a("v-uni-view",{key:o,staticClass:"activityList_box"},[e.activity.length>1?a("v-uni-view",{staticClass:"hd_title"},[a("v-uni-view",{staticClass:"hd_num_box"},[t._v("活动"+t._s(o+1))]),a("v-uni-view",{staticClass:"hd_xian"})],1):t._e(),a("v-uni-view",{staticClass:"qiangdan_time"},[a("v-uni-view",{staticClass:"member_box",class:[i.ady_num==i.total_count||0==e.is_work?"zhihui":""]},[1===t.ifmember?a("v-uni-view",[0==i.minimum_amount?a("v-uni-view",{staticClass:"shops_price_box"},[a("v-uni-view",{staticClass:"jiage"},[a("v-uni-text",{staticClass:"fuhao"},[t._v("￥")]),a("v-uni-text",{staticClass:"jine"},[t._v(t._s(parseFloat(i.member_rebate_amount).toFixed(0)))])],1),a("v-uni-view",{staticClass:"butie_box"},[a("v-uni-view",{staticClass:"butie"},[t._v("会员最高补贴")])],1)],1):t._e(),i.minimum_amount>0?a("v-uni-view",{staticClass:"shops_price_box"},[a("v-uni-view",{staticClass:"jiage"},[a("v-uni-text",{staticClass:"fuhao"},[t._v("￥")]),a("v-uni-text",{staticClass:"jine"},[t._v(t._s(parseFloat(i.member_rebate_amount).toFixed(0)))])],1),a("v-uni-view",{staticClass:"butie_box"},[a("v-uni-view",{staticClass:"butie"},[t._v("会员满"+t._s(i.minimum_amount)+"补"+t._s(i.member_rebate_amount))])],1)],1):t._e()],1):a("v-uni-view",[0==i.minimum_amount?a("v-uni-view",{staticClass:"shops_price_box"},[a("v-uni-view",{staticClass:"jiage"},[a("v-uni-text",{staticClass:"fuhao"},[t._v("￥")]),a("v-uni-text",{staticClass:"jine"},[t._v(t._s(parseFloat(i.member_rebate_amount).toFixed(0)))])],1),a("v-uni-view",{staticClass:"butie_box"},[a("v-uni-view",{staticClass:"butie"},[t._v("会员最高补贴")]),a("v-uni-view",{staticClass:"butie2"},[t._v("非会员最高补贴"+t._s(i.rebate_amount))])],1)],1):t._e(),i.minimum_amount>0?a("v-uni-view",{staticClass:"shops_price_box"},[a("v-uni-view",{staticClass:"jiage"},[a("v-uni-text",{staticClass:"fuhao"},[t._v("￥")]),a("v-uni-text",{staticClass:"jine"},[t._v(t._s(parseFloat(i.member_rebate_amount).toFixed(0)))])],1),a("v-uni-view",{staticClass:"butie_box"},[a("v-uni-view",{staticClass:"butie"},[t._v("会员满"+t._s(i.minimum_amount)+"补"+t._s(i.member_rebate_amount))]),a("v-uni-view",{staticClass:"butie2"},[t._v("非会员满"+t._s(i.minimum_amount)+"补"+t._s(i.rebate_amount))])],1)],1):t._e()],1),a("v-uni-image",{staticClass:"shandian_icon",attrs:{src:t.BestImgUrl+"shandian_icon.png"}}),a("v-uni-view",{staticClass:"sd_price"},[a("v-uni-view",{staticClass:"shengyu_box"},[0==e.is_work?a("v-uni-text",{staticClass:"qd_text"},[t._v(t._s(e.open_time)+"后开抢")]):a("v-uni-text",{staticClass:"qd_text"},[t._v("抢单")])],1),a("v-uni-view",{staticClass:"jindutiao"},[a("v-uni-view",{staticClass:"jindutiao_Box"},[a("u-line-progress",{attrs:{percent:t.setItemProgress(i),height:"14",round:!0,"active-color":"#FFFFFF","inactive-color":"#ffb95f"}},[a("v-uni-view",{attrs:{slot:"default"},slot:"default"})],1)],1),a("v-uni-view",{staticClass:"shengyu6"},[t._v("剩"+t._s(i.day_num-i.total_count>0?i.day_num-i.total_count:0)+"份")])],1)],1)],1)],1)],1)}))],2)})),a("v-uni-view",{staticClass:"chudijiazai"},[a("u-loadmore",{attrs:{"icon-type":"flower",status:t.loadingstatus,"font-size":"24","load-text":t.loadText}}),1==t.Bottomingrefresh?a("v-uni-view",{staticClass:"Bottomingrefresh",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.RefreshBtn()}}},[t._v("立即刷新")]):t._e()],1)],2):0==t.shopsList.length&&0==t.failTimeOutShow?a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:"/static/images/noData.png",mode:"widthFix"}}),a("v-uni-view",[t._v("暂无店铺")])],1):1==t.failTimeOutShow&&0==t.shopsList.length?a("v-uni-view",{staticClass:"noData_box"},[a("v-uni-image",{attrs:{src:"/static/images/Frame33412.png",mode:"widthFix"}}),a("v-uni-view",{staticClass:"timeOut"},[a("v-uni-view",[t._v("网络好像出问题了~")]),a("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.refurbish()}}},[t._v("立即刷新")])],1)],1):t._e()],1)],1)},n=[]},"503a":function(t,e,a){"use strict";a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"u-grid-item",style:{background:t.bgColor,width:t.width},attrs:{"hover-class":t.parentData.hoverClass,"hover-stay-time":200},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.click.apply(void 0,arguments)}}},[a("v-uni-view",{staticClass:"u-grid-item-box",class:[t.parentData.border?"u-border-right u-border-bottom":""],style:[t.customStyle]},[t._t("default")],2)],1)},o=[]},"512e":function(t,e,a){"use strict";a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("a9e3"),a("d81d");var i={name:"u-grid",props:{col:{type:[Number,String],default:3},border:{type:Boolean,default:!0},align:{type:String,default:"left"},hoverClass:{type:String,default:"u-hover-class"}},data:function(){return{index:0}},watch:{parentData:function(){this.children.length&&this.children.map((function(t){"function"==typeof t.updateParentData&&t.updateParentData()}))}},created:function(){this.children=[]},computed:{parentData:function(){return[this.hoverClass,this.col,this.size,this.border]},gridStyle:function(){var t={};switch(this.align){case"left":t.justifyContent="flex-start";break;case"center":t.justifyContent="center";break;case"right":t.justifyContent="flex-end";break;default:t.justifyContent="flex-start"}return t}},methods:{click:function(t){this.$emit("click",t)}}};e.default=i},"5b59":function(t,e,a){"use strict";a.r(e);var i=a("68d1"),o=a.n(i);for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);e["default"]=o.a},"68d1":function(t,e,a){"use strict";(function(t){a("7a82");var i=a("4ea4").default;Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("d3b7"),a("ddb0"),a("99af"),a("159b"),a("14d9"),a("ac1f"),a("e25e");var o=i(a("d08d")),n=getApp(),s={components:{RenDropdownFilter:o.default},data:function(){return{navTitle:"外卖霸王餐",navbackground:{backgroundImage:"linear-gradient(90deg, #FE7B20, #FE7B20)"},ifmember:0,available:!1,keyword:"",enable:!0,menuList:[],shopsList:[],pageSize:1,pageNum:10,skeletonLoading:!0,failTimeOutShow:!1,Bottomingrefresh:!1,loadingstatus:"nomore",loadText:{loadmore:"轻轻上拉",loading:"加载中...",nomore:"没有更多了"},offsetTop:0,chudiLoading:!0,nomoreLoading:!1,BestImgUrl:n.globalData.imgurl,filterData:[[{text:"综合排序",value:1},{text:"实付最少",value:2},{text:"离我最近",value:3},{text:"补贴最多",value:4},{text:"名额最多",value:5}],[{text:"全部平台",value:""},{text:"美团",value:1},{text:"饿了么",value:2}],[{text:"全部品类",value:""}]],defaultIndex:[0,0,0],category_id:"",iforderable:0,order_By:1,shopsType:"",customStyle:{padding:"0 0 20rpx 0"}}},onPullDownRefresh:function(){var t=this;t.pageSize=1,t.pageNum=10,t.skeletonLoading=!0,t.failTimeOutShow=!1,setTimeout((function(){t.GetShopslist(),uni.stopPullDownRefresh()}),1500)},onReachBottom:function(){var t=this;t.loadText.nomore="没有更多了",t.Bottomingrefresh=!1,this.loadingstatus="loading",setTimeout((function(){t.pageSize++,t.GetShopslist(),uni.hideNavigationBarLoading()}),500)},onLoad:function(t){this.keyword=t.keys,this.navTitle=t.title||"外卖霸王餐",this.GetShopslist(),this.getMenuList()},onShow:function(){this.enable=!0,this.Getmember()},onHide:function(){this.enable=!1},onPageScroll:function(t){t.scrollTop>=1?this.offsetTop=-1:this.offsetTop=0},methods:{refurbish:function(){var t=this;t.skeletonLoading=!0,t.loadingstatus="nomore",t.Bottomingrefresh=!1,t.pageSize=1,t.pageNum=10,setTimeout((function(){t.GetShopslist()}),2e3)},RefreshBtn:function(){this.loadingstatus="loading",this.loadText.nomore="没有更多了",this.Bottomingrefresh=!1,this.GetShopslist()},Getmember:function(){var t=uni.getStorageSync("userinfo");this.ifmember=t.is_member},GetShopslist:function(){var e=this,a=uni.getStorageSync("lat"),i=uni.getStorageSync("lng");e.$api.Getshopslist({page:e.pageSize,limit:e.pageNum,lat:a,lng:i,keyword:e.keyword,category_id:e.category_id,type:e.shopsType,is_orderable:e.iforderable,order_by:e.order_By}).then((function(t){e.failTimeOutShow=!1,e.loadText.nomore="没有更多了",e.Bottomingrefresh=!1,setTimeout((function(){1!=e.pageSize?0!=t.data.result.length?(e.loadingstatus="loading",e.shopsList=e.shopsList.concat(t.data.result)):e.loadingstatus="nomore":(e.shopsList=t.data.result,e.loadingstatus="nomore"),e.skeletonLoading=!1}),2e3)})).catch((function(a){a.data?uni.showToast({title:a.data.msg,icon:"none",duration:2e3}):(t("log","请求错误或请求超时",a.errMsg," at bwcPages/pages/Overlordmeal/Overlordmeal.vue:399"),e.skeletonLoading=!1,t("log","读书",e.loadingstatus," at bwcPages/pages/Overlordmeal/Overlordmeal.vue:401"),"loading"==e.loadingstatus?(e.loadingstatus="nomore",e.loadText.nomore="网络好像出问题了~",e.Bottomingrefresh=!0):(e.shopsList=[],e.loadingstatus="loading",e.loadText.nomore="没有更多了",e.Bottomingrefresh=!1,e.failTimeOutShow=!0))}))},AvailableChange:function(t){this.$refs.popupRef.tapMask(),1==t?(this.iforderable=1,this.pageSize=1,this.skeletonLoading=!0,this.chudiLoading=!0,this.nomoreLoading=!1,this.GetShopslist()):0==t&&(this.iforderable=0,this.pageSize=1,this.skeletonLoading=!0,this.chudiLoading=!0,this.nomoreLoading=!1,this.GetShopslist())},onSelected:function(t){var e=[],a=t;a.forEach((function(t,a){e.push({target:t})})),this.order_By=e[0].target[0].value,this.shopsType=e[1].target[0].value,this.category_id=e[2].target[0].value,this.pageSize=1,this.shopsList=[],this.skeletonLoading=!0,this.chudiLoading=!0,this.nomoreLoading=!1,this.GetShopslist()},zhiding:function(){uni.createSelectorQuery().select(".shop_list_wrap").boundingClientRect((function(t){uni.createSelectorQuery().select(".page_wrap").boundingClientRect((function(e){t&&uni.pageScrollTo({duration:100,scrollTop:t.top+244-e.top})})).exec()})).exec()},getMenuList:function(){var t=this;t.$api.bwcShopscategory({client:"h5"}).then((function(e){t.menuList=e.data.result;var a=e.data.result;a.forEach((function(e){t.filterData[2].push({text:e.name,value:e.id})}))}))},Tomenus:function(e,a){t("log","点击了菜单",e,a," at bwcPages/pages/Overlordmeal/Overlordmeal.vue:509"),uni.navigateTo({url:"/typesPages/pages/typepages/typepages?typeid="+e.id+"&title="+e.name})},NoKaiqiang:function(t,e){uni.showToast({title:t.open_time+"后才可以抢单哦",icon:"none",duration:2e3})},ToDetails:function(t){uni.navigateTo({url:"/shopInfoPages/pages/newshopDetails/newshopDetails?sid="+t.id})},Tosearch:function(){this.pageSize=1,this.GetShopslist()},setItemProgress:function(t){var e=t.ady_num-t.total_count;return t.ady_num==t.total_count?100:parseInt((t.ady_num-e)/t.ady_num*100)}}};e.default=s}).call(this,a("0de9")["log"])},"6f9a":function(t,e,a){var i=a("9102");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("e7f6ae12",i,!0,{sourceMap:!1,shadowMode:!1})},7229:function(t,e,a){"use strict";a.r(e);var i=a("503a"),o=a("bd75");for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);a("0f0b");var s=a("f0c5"),r=Object(s["a"])(o["default"],i["b"],i["c"],!1,null,"02c7666e",null,!1,i["a"],void 0);e["default"]=r.exports},"799d":function(t,e,a){"use strict";a.r(e);var i=a("3f09"),o=a("5b59");for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);a("aa27");var s=a("f0c5"),r=Object(s["a"])(o["default"],i["b"],i["c"],!1,null,"df6e91a6",null,!1,i["a"],void 0);e["default"]=r.exports},"8b4f":function(t,e,a){"use strict";a.r(e);var i=a("02b8"),o=a("2303");for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);a("97d2");var s=a("f0c5"),r=Object(s["a"])(o["default"],i["b"],i["c"],!1,null,"00eebdbf",null,!1,i["a"],void 0);e["default"]=r.exports},9102:function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,".u-grid-item[data-v-02c7666e]{box-sizing:border-box;background:#fff;display:flex;flex-direction:row;align-items:center;justify-content:center;position:relative;flex-direction:column}.u-grid-item-hover[data-v-02c7666e]{background:#f7f7f7!important}.u-grid-marker-box[data-v-02c7666e]{position:absolute;display:inline-flex;line-height:0}.u-grid-marker-wrap[data-v-02c7666e]{position:absolute}.u-grid-item-box[data-v-02c7666e]{padding:%?30?% 0;display:flex;flex-direction:row;align-items:center;justify-content:center;flex-direction:column;flex:1;width:100%;height:100%}",""]),t.exports=e},"97d2":function(t,e,a){"use strict";var i=a("220c"),o=a.n(i);o.a},aa27:function(t,e,a){"use strict";var i=a("e31c"),o=a.n(i);o.a},bad6:function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,".nav_bgtu_wrap[data-v-df6e91a6]{position:relative;width:100%;margin-bottom:%?30?%;height:%?524?%}.nav_bgtu_wrap .beijingtu_box[data-v-df6e91a6]{position:absolute;width:100%;left:0;top:0;right:0;margin:0 auto}.nav_bgtu_wrap .beijingtu_box uni-image[data-v-df6e91a6]{width:100%;height:%?524?%}.nav_bgtu_wrap .wenantu_box[data-v-df6e91a6]{position:absolute;width:100%;left:0;bottom:33%;right:0;margin:0 auto;text-align:center}.nav_bgtu_wrap .wenantu_box uni-image[data-v-df6e91a6]{width:%?524?%;height:%?142?%}.nav_bgtu_wrap .gif_btn[data-v-df6e91a6]{position:absolute;left:0;bottom:8.2%;right:0;margin:0 auto;text-align:center}.nav_bgtu_wrap .gif_btn uni-image[data-v-df6e91a6]{width:%?270?%;height:%?80?%}.nav_bgtu_wrap .sousuokuang_box[data-v-df6e91a6]{padding-top:%?150?%;margin:0 auto}.meituan_icon[data-v-df6e91a6]{font-size:%?24?%;background-color:#fdd900;color:#333;border-radius:%?10?%;padding:%?2?% %?10?%;margin-right:%?6?%}.element_icon[data-v-df6e91a6]{font-size:%?24?%;background-color:#05b6fd;color:#fff;border-radius:%?10?%;padding:%?2?% %?10?%;margin-right:%?6?%}.screen_box[data-v-df6e91a6]{z-index:9999}.zhihui[data-v-df6e91a6]{-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%);filter:grayscale(100%);filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1)}.noData_box[data-v-df6e91a6]{margin-top:0;padding-bottom:%?260?%;text-align:center;color:#999;text-align:center}.noData_box uni-image[data-v-df6e91a6]{width:%?280?%}.noData_box .timeOut[data-v-df6e91a6]{font-size:12px;color:#666;margin:0 0 7px;display:flex;align-items:center;justify-content:center}.noData_box .timeOut uni-view[data-v-df6e91a6]:nth-child(2){color:#00acfd;padding-left:%?10?%}.noData_box .lijipay[data-v-df6e91a6]{width:30%;position:relative;margin:0 auto}.noData_box .lijipay .u-size-default[data-v-df6e91a6]{height:%?70?%!important;line-height:%?70?%!important}.kefu_Box[data-v-df6e91a6]{position:fixed;z-index:999;bottom:15%;right:0;background-color:#fff;padding:%?10?% %?30?% %?10?% %?10?%;border-radius:%?200?% 0 0 %?200?%;box-shadow:0 0 5px rgba(0,0,0,.1);margin:10px 0 10px 5px}.kefu_Box .kefu_icon[data-v-df6e91a6]{width:%?70?%;height:%?70?%}.shop_list_wrap[data-v-df6e91a6]{background-image:linear-gradient(0deg,#f8f4f3,#fff);padding:0 %?22?% 66px %?22?%;position:relative}.shop_list_wrap .u-skeleton[data-v-df6e91a6]{padding:7px 0;margin:0 0 0 0}.shop_list_wrap .shops_box[data-v-df6e91a6]{-webkit-animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;flex-direction:row;background-color:#fff;box-shadow:0 0 8px rgba(248,244,243,.5);margin:5px 5px 10px 5px;padding:%?20?%;border-radius:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap[data-v-df6e91a6]{display:flex;align-items:flex-start;margin-bottom:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shops_logo[data-v-df6e91a6]{width:%?168?%;height:%?168?%;border-radius:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info[data-v-df6e91a6]{flex:1;padding-left:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shop_name[data-v-df6e91a6]{font-size:%?32?%;font-weight:700;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time[data-v-df6e91a6]{flex:1;flex-direction:row;display:flex;align-items:center;justify-content:space-between;margin-top:%?20?%;margin-bottom:%?20?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo[data-v-df6e91a6]{display:flex;flex-direction:row;align-items:center}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo .shop_type[data-v-df6e91a6]{width:%?40?%;height:%?40?%;margin-right:%?10?%}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_time_logo .shops_titme_text[data-v-df6e91a6]{font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .shops_time .shops_titme_juli[data-v-df6e91a6]{font-size:%?24?%;color:#999;justify-content:flex-end}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .addres_Box[data-v-df6e91a6]{display:flex;align-items:center;font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .shops_info_wrap .shop_info .addres_Box .addresInfo[data-v-df6e91a6]{word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}.shop_list_wrap .shops_box .activityList_box[data-v-df6e91a6]{margin-bottom:%?30?%}.shop_list_wrap .shops_box .activityList_box .hd_title[data-v-df6e91a6]{display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .hd_title .hd_num_box[data-v-df6e91a6]{background-color:#f3f1f2;border-radius:%?8?%;color:#999;padding:%?4?% %?10?%;font-size:%?24?%}.shop_list_wrap .shops_box .activityList_box .hd_title .hd_xian[data-v-df6e91a6]{flex:1;height:1px;background-color:#f3f1f2}.shop_list_wrap .shops_box .activityList_box .qiangdan_time[data-v-df6e91a6]{display:flex;align-items:center;margin:%?20?% 0}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .activity_idx[data-v-df6e91a6]{width:26%;text-align:center;font-size:%?24?%;color:#999}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box[data-v-df6e91a6]{flex-direction:row;align-items:center;display:flex;background-color:#ffedd5;border-radius:%?20?%;padding:%?16?% %?20?%;height:%?100?%;position:relative;flex:1}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage .fuhao[data-v-df6e91a6]{color:#ff611e;font-size:%?26?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .jiage .jine[data-v-df6e91a6]{color:#ff611e;font-size:%?44?%;font-weight:700}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box[data-v-df6e91a6]{padding-left:%?16?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box .butie[data-v-df6e91a6]{color:#ff611e;font-size:%?28?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shops_price_box .butie_box .butie2[data-v-df6e91a6]{color:#ff611e;font-size:%?24?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .shandian_icon[data-v-df6e91a6]{width:%?270?%;height:%?100?%;position:absolute;top:0;right:0}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price[data-v-df6e91a6]{text-align:center;position:absolute;top:%?16?%;right:0;width:110px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .shengyu_box[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center;flex:1;justify-content:center;margin-bottom:%?12?%}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .shengyu_box .qd_text[data-v-df6e91a6]{color:#fff;font-size:%?26?%;flex:1;text-align:center;font-weight:700}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center;justify-content:center;height:7px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao .jindutiao_Box[data-v-df6e91a6]{width:%?90?%;position:relative;top:-5px}.shop_list_wrap .shops_box .activityList_box .qiangdan_time .member_box .sd_price .jindutiao .shengyu6[data-v-df6e91a6]{font-size:%?24?%;padding-left:%?10?%;color:#fff}.shop_list_wrap .shops_box .activityList_box .qiangdan_time[data-v-df6e91a6]:last-child{margin-bottom:0}.shop_list_wrap .shops_box .activityList_box[data-v-df6e91a6]:last-child{margin-bottom:0}.nav_wrap[data-v-df6e91a6]{padding:0 %?30?%;display:flex;align-items:center;justify-content:space-between;flex:1;-webkit-animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1}.nav_wrap .city_screen[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center}.nav_wrap .city_screen .city_name[data-v-df6e91a6]{color:#fff;font-weight:700;margin:0 %?4?%;font-size:%?30?%;flex:1;word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;height:%?48?%;line-height:%?48?%}.nav_wrap .city_screen .right_jiao[data-v-df6e91a6]{position:relative;left:%?-10?%;top:%?2?%}.nav_wrap .city_screen .left_jiao[data-v-df6e91a6]{position:relative}.nav_wrap .sign_msg[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center;margin-left:auto}.nav_wrap .sign_msg .s_icon[data-v-df6e91a6]{margin:0 %?5?%;width:%?54?%;height:%?54?%;-webkit-animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1}.nav_wrap .sign_msg .s_icon2[data-v-df6e91a6]{margin:0 %?5?%;width:%?50?%;height:%?50?%;-webkit-animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1}.homt_top_box[data-v-df6e91a6]{width:%?750?%;height:%?204?%;position:relative}.homt_top_box .homt_top_bg[data-v-df6e91a6]{width:%?750?%;height:%?450?%}.homt_top_box .homt_top_bg_box[data-v-df6e91a6]{width:%?750?%;height:%?140?%}.homt_top_box .Rotation_chart[data-v-df6e91a6]{padding:%?30?%;width:%?750?%;position:absolute;flex:1;bottom:0;right:0;left:0}.homt_top_box .Rotation_chart .lunbotu_img[data-v-df6e91a6]{width:%?690?%;-webkit-animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;height:%?170?%}.Search_box[data-v-df6e91a6]{padding:%?20?% %?30?% %?20?% %?30?%;flex-direction:row;display:flex;align-items:center}.Search_box .Search_wrap[data-v-df6e91a6]{position:relative;flex-direction:row;flex:1;display:flex}.Search_box .Search_wrap .Search_btn[data-v-df6e91a6]{position:absolute;right:%?8?%;top:4px;color:#fff;background-image:linear-gradient(90deg,#ff9619,#ffb930);width:%?100?%;height:%?55?%;text-align:center;line-height:%?55?%;border-radius:%?200?%;font-weight:600}.menu_wrap[data-v-df6e91a6]{padding:%?10?% %?10?% 0 %?10?%}.menu_wrap .swiper[data-v-df6e91a6]{height:184px}.menu_wrap .menu_images[data-v-df6e91a6]{width:44px;height:44px;-webkit-animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1}.menu_wrap .grid-text[data-v-df6e91a6]{font-size:12px;color:#333;padding:%?10?% 0 0 %?0?%;box-sizing:border-box}.menu_images_gujia[data-v-df6e91a6]{width:44px;height:44px;background-color:#f7f7f7;border-radius:%?16?%}.grid-text-gijia[data-v-df6e91a6]{background-color:#f7f7f7;width:44px;height:10px;text-align:center;border-radius:%?16?%;margin-top:%?10?%}.meituan_elmo[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center;padding:%?16?% %?30?% 0 %?30?%;position:relative;height:63px;margin-bottom:14px}.meituan_elmo uni-view[data-v-df6e91a6]:nth-child(1){margin-right:%?10?%}.meituan_elmo uni-view[data-v-df6e91a6]:nth-child(2){margin-left:%?10?%}.meituan_elmo .meituan_elmo_box[data-v-df6e91a6]{flex:1;position:relative;background-color:#f7f7f7;border-radius:%?16?%;height:%?104?%;display:flex;align-items:center}.meituan_elmo .meituan_elmo_box .qiang_gif[data-v-df6e91a6]{width:%?84?%;height:%?84?%;position:absolute;top:%?12?%;right:%?4?%;z-index:3}.meituan_elmo .meituan_elmo_box .meituan_img[data-v-df6e91a6]{width:100%;height:%?104?%;-webkit-animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1}.meituan_elmo .meituan_elmo_box .elmo_img[data-v-df6e91a6]{width:100%;height:%?104?%;-webkit-animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1;animation:dialog-fade-in-data-v-df6e91a6 .3s linear 1}.screen_wrap[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center;padding:%?30?%;justify-content:space-between}.screen_wrap .zhpx_box[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center;background-color:#fff;padding:%?12?% %?20?%;border-radius:%?10?%;box-shadow:0 0 5px rgba(0,0,0,.09)}.screen_wrap .zhpx_box .zhpx_title[data-v-df6e91a6]{color:#666;font-size:%?24?%}.screen_wrap .zhpx_box2[data-v-df6e91a6]{flex-direction:row;display:flex;align-items:center;background-color:#fff;padding:%?12?% %?10?%;border-radius:%?10?%}.screen_wrap .zhpx_box2 .zhpx_title2[data-v-df6e91a6]{color:#666;font-size:%?24?%;margin-right:%?10?%}@-webkit-keyframes dialog-fade-in-data-v-df6e91a6{0%{opacity:0}100%{opacity:1}}@keyframes dialog-fade-in-data-v-df6e91a6{0%{opacity:0}100%{opacity:1}}[data-v-df6e91a6] .u-sticky{background-color:#fff!important}.lanjiazai[data-v-df6e91a6]{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.noData_box[data-v-df6e91a6]{padding-bottom:0;position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.shop_list_wrap[data-v-df6e91a6]{padding:0 %?20?% %?20?% %?20?%!important}uni-image[data-v-df6e91a6]{vertical-align:bottom}.shandian_icon[data-v-df6e91a6]{width:%?260?%!important}.sd_price[data-v-df6e91a6]{width:112px!important}.s_page_wrap[data-v-df6e91a6]{padding:%?20?% %?25?% %?10?% %?25?%}.Search_box2[data-v-df6e91a6]{padding:%?30?% %?30?% %?30?% %?30?%;flex-direction:row;display:flex;align-items:center;background-color:#fff}.Search_box2 .Search_wrap[data-v-df6e91a6]{position:relative;flex-direction:row;flex:1;display:flex}.Search_box2 .Search_wrap .Search_btn[data-v-df6e91a6]{position:absolute;right:%?8?%;top:4px;color:#fff;background-image:linear-gradient(90deg,#ff9619,#ffb930);width:%?150?%;height:%?65?%;text-align:center;line-height:%?65?%;border-radius:%?200?%}",""]),t.exports=e},bd75:function(t,e,a){"use strict";a.r(e);var i=a("fbba"),o=a.n(i);for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);e["default"]=o.a},e31c:function(t,e,a){var i=a("bad6");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("123c7dfd",i,!0,{sourceMap:!1,shadowMode:!1})},e917:function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,".u-grid[data-v-00eebdbf]{width:100%;display:flex;flex-direction:row;flex-wrap:wrap;align-items:center}",""]),t.exports=e},fbba:function(t,e,a){"use strict";a("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("a9e3"),a("14d9");var i={name:"u-grid-item",props:{bgColor:{type:String,default:"#ffffff"},index:{type:[Number,String],default:""},customStyle:{type:Object,default:function(){return{padding:"30rpx 0"}}}},data:function(){return{parentData:{hoverClass:"",col:3,border:!0}}},created:function(){this.updateParentData(),this.parent.children.push(this)},computed:{width:function(){return 100/Number(this.parentData.col)+"%"}},methods:{updateParentData:function(){this.getParentData("u-grid")},click:function(){this.$emit("click",this.index),this.parent&&this.parent.click(this.index)}}};e.default=i}}]);