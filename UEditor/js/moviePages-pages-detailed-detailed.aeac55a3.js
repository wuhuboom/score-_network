(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["moviePages-pages-detailed-detailed"],{"0a01":function(t,e,i){"use strict";i.r(e);var n=i("f454"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},"0c7b":function(t,e,i){"use strict";var n=i("de90"),a=i.n(n);a.a},"1cdf":function(t,e,i){"use strict";i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("a9e3"),i("99af"),i("d81d");var n={name:"u-dropdown",props:{activeColor:{type:String,default:"#2979ff"},inactiveColor:{type:String,default:"#606266"},closeOnClickMask:{type:Boolean,default:!0},closeOnClickSelf:{type:Boolean,default:!0},duration:{type:[Number,String],default:300},height:{type:[Number,String],default:80},borderBottom:{type:Boolean,default:!1},titleSize:{type:[Number,String],default:28},borderRadius:{type:[Number,String],default:0},menuIcon:{type:String,default:"arrow-down"},menuIconSize:{type:[Number,String],default:26}},data:function(){return{showDropdown:!0,menuList:[],active:!1,current:99999,contentStyle:{zIndex:-1,opacity:0},highlightIndex:99999,contentHeight:0}},computed:{popupStyle:function(){var t={};return t.transform="translateY(".concat(this.active?0:"-100%",")"),t["transition-duration"]=this.duration/1e3+"s",t.borderRadius="0 0 ".concat(this.$u.addUnit(this.borderRadius)," ").concat(this.$u.addUnit(this.borderRadius)),t}},created:function(){this.children=[]},mounted:function(){this.getContentHeight()},methods:{init:function(){this.menuList=[],this.children.map((function(t){t.init()}))},menuClick:function(t){var e=this;if(!this.menuList[t].disabled)return t===this.current&&this.closeOnClickSelf?(this.close(),void setTimeout((function(){e.children[t].active=!1}),this.duration)):void this.open(t)},open:function(t){this.contentStyle={zIndex:11},this.active=!0,this.current=t,this.children.map((function(e,i){e.active=t==i})),this.$emit("open",this.current)},close:function(){var t=this;this.$emit("close",this.current),this.active=!1,this.current=99999,this.contentStyle["opacity"]=0,setTimeout((function(){t.contentStyle["zIndex"]=-1}),300)},maskClick:function(){this.closeOnClickMask&&this.close()},highlight:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:void 0;this.highlightIndex=void 0!==t?t:99999},getContentHeight:function(){var t=this,e=this.$u.sys().windowHeight;this.$uGetRect(".u-dropdown__menu").then((function(i){t.contentHeight=e-i.bottom}))}}};e.default=n},"1fbc":function(t,e,i){"use strict";var n=i("3788"),a=i.n(n);a.a},"202a":function(t,e,i){"use strict";i.r(e);var n=i("3d70"),a=i("c7ef");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("0c7b");var d=i("f0c5"),l=Object(d["a"])(a["default"],n["b"],n["c"],!1,null,"0dd6e352",null,!1,n["a"],void 0);e["default"]=l.exports},"20ff":function(t,e,i){"use strict";i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return n}));var n={uCellGroup:i("6d71").default,uCellItem:i("4617").default,uIcon:i("21cf").default},a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.active?i("v-uni-view",{staticClass:"u-dropdown-item",on:{touchmove:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e),function(){}.apply(void 0,arguments)},click:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e),function(){}.apply(void 0,arguments)}}},[t.$slots.default||t.$slots.$default?t._t("default"):[i("v-uni-scroll-view",{style:{"max-height":t.$u.addUnit(t.height)},attrs:{"scroll-y":"true"}},[i("v-uni-view",{staticClass:"u-dropdown-item__options"},[i("u-cell-group",t._l(t.options,(function(e,n){return i("u-cell-item",{key:n,attrs:{arrow:!1,title:e.label,"title-style":{color:t.value==e.value?t.activeColor:t.inactiveColor}},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.cellClick(e.value)}}},[t.value==e.value?i("u-icon",{attrs:{name:"checkbox-mark",color:t.activeColor,size:"32"}}):t._e()],1)})),1)],1)],1)]],2):t._e()},o=[]},"223c":function(t,e,i){"use strict";i.r(e);var n=i("20ff"),a=i("5d42");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("8926");var d=i("f0c5"),l=Object(d["a"])(a["default"],n["b"],n["c"],!1,null,"b15e8e0c",null,!1,n["a"],void 0);e["default"]=l.exports},3788:function(t,e,i){var n=i("782f");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("1c51714a",n,!0,{sourceMap:!1,shadowMode:!1})},"39d1":function(t,e,i){"use strict";var n=i("5a6d"),a=i.n(n);a.a},"3d70":function(t,e,i){"use strict";i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return n}));var n={uNavbar:i("790b").default},a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"detailed"},[i("u-navbar",{attrs:{"is-back":!0,"back-icon-color":"#333","title-color":"#333",title:"影片详情",background:t.background,"border-bottom":!0}}),i("v-uni-view",{staticClass:"alltop"},[i("movice-top",{attrs:{value:t.detaileddata}}),i("div",{staticClass:"tab-time-box"},[i("tabs",{attrs:{list:t.listTime,name:"days",height:"40","inactive-color":"#666","active-color":"#F66C3F",timeTab:!0,"is-scroll":!0,current:t.timeCurrent},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.changeTimeTab.apply(void 0,arguments)}}})],1),i("v-uni-view",{},[i("dropdown-group",{attrs:{list:t.searchData,height:600,"is-search":!0},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.changeType.apply(void 0,arguments)},"search-change":function(e){arguments[0]=e=t.$handleEvent(e),t.searchCinema.apply(void 0,arguments)}}})],1)],1),i("v-uni-scroll-view",{staticClass:"detailed-movielist",style:{height:t.boxHeight+"px"},attrs:{"scroll-y":!0,"refresher-triggered":"freshing","refresher-enabled":!1},on:{refresherrefresh:function(e){arguments[0]=e=t.$handleEvent(e),t.refresh(!0)},scrolltolower:function(e){arguments[0]=e=t.$handleEvent(e),t.onreachBottom.apply(void 0,arguments)}}},[t.movielist.length>0?i("v-uni-view",{staticClass:"list-wrap"},[t._l(t.movielist,(function(e,n){return[i("v-uni-view",{key:n+"_0",staticClass:"detailed-minlist",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.movietiao(e)}}},[i("v-uni-view",{staticClass:"detailed-red-box"},[1==e.tp?i("v-uni-view",[t._v("特惠")]):t._e(),i("v-uni-text",[t._v(t._s(e.nm))])],1),i("v-uni-view",{staticClass:"minlist-botm"},[i("v-uni-text",{staticClass:"no-warp-one",staticStyle:{flex:"1"}},[t._v(t._s(e.addr))]),i("v-uni-text",{staticStyle:{"margin-left":"30rpx"}},[t._v(t._s(e.distance)+"km")])],1)],1)]}))],2):t._e(),t.movielist.length<=0&&0==t.loading?i("v-uni-view",{staticClass:"none-cinema-box"},[i("v-uni-image",{attrs:{src:"https://img.alicdn.com/imgextra/i2/3829152210/O1CN01I26bAj1SCE36m7tLp_!!3829152210.png",mode:"widthFix"}})],1):t._e()],1)],1)},o=[]},"4a8c":function(t,e,i){"use strict";i("7a82");var n=i("4ea4").default;Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("a9e3"),i("c740");var a=n(i("c3d6")),o=n(i("223c")),d={data:function(){return{condition:{value1:"0",value2:"",value3:"distance",keyword:""},chooseData:{city:"全城",brand:"品牌",distance:"离我最近"},isshow:!1}},components:{dropdown:a.default,dropdownItem:o.default},props:{list:{type:Object,default:{}},isSearch:{type:Boolean,default:!1},resetData:{type:Boolean,default:!1},height:{type:Number,default:800}},methods:{open:function(){this.$store.commit("setScroll",!1)},close:function(){this.$store.commit("setScroll",!0)},changeType:function(t,e){var i=this.list[e].findIndex((function(e){return e.value==t}));this.chooseData[e]=this.list[e][i].label;var n={value1:this.condition.value1,value2:this.condition.value2,value3:this.condition.value3};this.$emit("change",n)},searchCinema:function(){this.$emit("searchChange",this.condition.keyword)},searchCancel:function(){this.condition.keyword="",this.$emit("searchChange",this.condition.keyword),this.isshow=!1},resetContent:function(){this.condition={value1:"0",value2:"",value3:"distance",keyword:""},this.chooseData={city:"全城",brand:"品牌",distance:"离我最近"}}},watch:{"$store.state.isChangeCondition":function(t,e){console.log(t,e),1==t&&(this.resetContent(),this.$store.commit("setChooseCondition",!1))},resetData:function(t){t&&this.resetContent()}}};e.default=d},"534e":function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,"uni-page-body[data-v-0dd6e352]{background-color:#f7f8fa}body.?%PAGE?%[data-v-0dd6e352]{background-color:#f7f8fa}.alltop[data-v-0dd6e352]{background-color:#fff}.no-warp-one[data-v-0dd6e352]{overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical}.list-wrap[data-v-0dd6e352]{padding:%?25?% 0 0 0}.detailed[data-v-0dd6e352]{position:relative;z-index:1;height:100vh;overflow:hidden}.detailed .tab-time-box[data-v-0dd6e352]{min-height:%?80?%}.detailed[data-v-0dd6e352] ::-webkit-scrollbar{display:none;width:0;height:0}.detailed .detailed-tab[data-v-0dd6e352]{display:flex;width:%?1628?%;overflow:hidden;box-sizing:border-box;white-space:nowrap;padding-bottom:%?16?%}.detailed .detailed-tab .detailed-xuan[data-v-0dd6e352]{display:flex;flex-direction:column;align-items:center;margin-top:%?30?%;padding:0 %?20?%;width:%?148?%;box-sizing:border-box}.detailed .detailed-tab .detailed-xuan uni-view[data-v-0dd6e352]{font-size:%?26?%;color:#000}.detailed .detailed-tab .detailed-xuan .detailed-fen[data-v-0dd6e352]{font-weight:700;color:#f1257f}.detailed .detailed-tab .detailed-xuan uni-text[data-v-0dd6e352]{font-size:%?24?%;color:#b9bbbb;margin-top:%?8?%}.detailed .detailed-tab .tab-heng[data-v-0dd6e352]{width:%?30?%;height:%?6?%;background-color:#f1257f;position:absolute;bottom:%?0?%;transition:all .6s}.detailed .detailed-movielist[data-v-0dd6e352]{border-bottom:%?1?% solid #e5e5e5;box-sizing:border-box}.detailed .detailed-movielist .detailed-minlist[data-v-0dd6e352]{padding:%?25?% %?20?%;width:94%;margin:0 auto 15px;background:#fff;border-radius:10px}.detailed .detailed-movielist .detailed-minlist .detailed-red-box[data-v-0dd6e352]{display:flex;align-items:center}.detailed .detailed-movielist .detailed-minlist .detailed-red-box uni-text[data-v-0dd6e352]{font-size:%?28?%;color:#000}.detailed .detailed-movielist .detailed-minlist .detailed-red-box uni-view[data-v-0dd6e352]{width:%?60?%;height:%?35?%;background-image:linear-gradient(45deg,#56a2ff,#4ccaff);font-size:%?20?%;color:#fff;border-radius:%?8?%;display:flex;justify-content:center;align-items:center;margin-right:%?10?%}.detailed .detailed-movielist .detailed-minlist .minlist-botm[data-v-0dd6e352]{margin-top:%?15?%;display:flex;font-size:%?22?%;color:#bcbcbc}",""]),t.exports=e},"5a6d":function(t,e,i){var n=i("cc6e");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("321274af",n,!0,{sourceMap:!1,shadowMode:!1})},"5d42":function(t,e,i){"use strict";i.r(e);var n=i("acd5"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},"62a2":function(t,e,i){"use strict";i.r(e);var n=i("ad61"),a=i("0a01");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("cb94");var d=i("f0c5"),l=Object(d["a"])(a["default"],n["b"],n["c"],!1,null,"67d51a0a",null,!1,n["a"],void 0);e["default"]=l.exports},"782f":function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,".u-dropdown[data-v-13d3be0e]{flex:1;width:100%;position:relative}.u-dropdown__menu[data-v-13d3be0e]{display:flex;flex-direction:row;position:relative;z-index:11;height:%?80?%}.u-dropdown__menu__item[data-v-13d3be0e]{flex:1;display:flex;flex-direction:row;justify-content:center;align-items:center}.u-dropdown__menu__item__text[data-v-13d3be0e]{font-size:%?28?%;color:#606266}.u-dropdown__menu__item__arrow[data-v-13d3be0e]{margin-left:%?6?%;transition:-webkit-transform .3s;transition:transform .3s;transition:transform .3s,-webkit-transform .3s;align-items:center;display:flex;flex-direction:row}.u-dropdown__menu__item__arrow--rotate[data-v-13d3be0e]{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.u-dropdown__content[data-v-13d3be0e]{position:absolute;z-index:8;width:100%;left:0;bottom:0;overflow:hidden}.u-dropdown__content__mask[data-v-13d3be0e]{position:absolute;z-index:9;background:rgba(0,0,0,.3);width:100%;left:0;top:0;bottom:0}.u-dropdown__content__popup[data-v-13d3be0e]{position:relative;z-index:10;transition:all .3s;-webkit-transform:translate3D(0,-100%,0);transform:translate3D(0,-100%,0);overflow:hidden}",""]),t.exports=e},"80f6":function(t,e,i){"use strict";i.r(e);var n=i("4a8c"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},"81ed":function(t,e,i){"use strict";i.r(e);var n=i("b617"),a=i("80f6");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("39d1");var d=i("f0c5"),l=Object(d["a"])(a["default"],n["b"],n["c"],!1,null,"3635b0bd",null,!1,n["a"],void 0);e["default"]=l.exports},8926:function(t,e,i){"use strict";var n=i("8be8"),a=i.n(n);a.a},"8be8":function(t,e,i){var n=i("cdd6");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("7301cfe6",n,!0,{sourceMap:!1,shadowMode:!1})},9218:function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,".movice-top-style .detailed_main[data-v-67d51a0a]{padding:%?20?%;height:auto;display:flex}.movice-top-style .detailed_main .detailed_left[data-v-67d51a0a]{flex:1}.movice-top-style .detailed_main .detailed_left .detailed_left_h1[data-v-67d51a0a]{font-size:%?38?%;color:#000;font-weight:700}.movice-top-style .detailed_main .detailed_left .detailed_left_type[data-v-67d51a0a]{font-size:%?24?%;color:#666;margin-top:%?20?%}.movice-top-style .detailed_main .detailed_left .detailed_botm[data-v-67d51a0a]{display:flex;margin-top:%?40?%;width:%?350?%;height:%?70?%;background-color:#f4f5f5;padding:%?20?%;border-radius:%?300?%;font-size:%?28?%;box-sizing:border-box;align-items:center;justify-content:center}.movice-top-style .detailed_main .detailed_left .detailed_botm .detailed_heart[data-v-67d51a0a]{flex:1}.movice-top-style .detailed_main .detailed_left .detailed_botm .detailed_heart u-icon[data-v-67d51a0a]{margin-right:%?10?%}.movice-top-style .detailed_main uni-image[data-v-67d51a0a]{width:%?200?%;height:%?270?%;border-radius:%?15?%;border:%?1?% solid #fff}",""]),t.exports=e},a1a3:function(t,e,i){"use strict";i.r(e);var n=i("1cdf"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},acd5:function(t,e,i){"use strict";i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("a9e3"),i("99af"),i("7db0"),i("d3b7"),i("14d9");var n={name:"u-dropdown-item",props:{value:{type:[Number,String,Array],default:""},title:{type:[String,Number],default:""},options:{type:Array,default:function(){return[]}},disabled:{type:Boolean,default:!1},height:{type:[Number,String],default:"auto"}},data:function(){return{active:!1,activeColor:"#2979ff",inactiveColor:"#606266"}},computed:{propsChange:function(){return"".concat(this.title,"-").concat(this.disabled)}},watch:{propsChange:function(t){this.parent&&this.parent.init()},options:function(t){}},created:function(){this.parent=!1},methods:{init:function(){var t=this,e=this.$u.$parent.call(this,"u-dropdown");if(e){this.parent=e,this.activeColor=e.activeColor,this.inactiveColor=e.inactiveColor;var i=e.children.find((function(e){return t===e}));i||e.children.push(this),1==e.children.length&&(this.active=!0),e.menuList.push({title:this.title,disabled:this.disabled})}},cellClick:function(t){this.$emit("input",t),this.parent.close(),this.$emit("change",t)}},mounted:function(){this.init()}};e.default=n},ad61:function(t,e,i){"use strict";i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return n}));var n={uIcon:i("21cf").default},a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"movice-top-style"},[i("v-uni-view",{staticClass:"detailed_main"},[i("v-uni-view",{staticClass:"detailed_left"},[i("v-uni-text",{staticClass:"detailed_left_h1"},[t._v(t._s(t.value.nm||"电影名称"))]),i("v-uni-view",{staticClass:"detailed_left_type"},[t._v(t._s(t._f("shufilter")(t.value.cat||"喜剧"))+"/"+t._s(t.value.dur||120)+"分钟")]),i("v-uni-text",{staticClass:"detailed_left_type",staticStyle:{display:"block"}},[t._v(t._s(t._f("formateDate")(t.value.rt||"2000-01-01","YYYY年MM月DD日"))+"上映")]),i("v-uni-view",{staticClass:"detailed_botm"},[i("v-uni-view",{staticClass:"detailed_heart"},[i("u-icon",{attrs:{name:"heart-fill",color:"#F66C3F",size:"28"}}),i("v-uni-text",[t._v("想看")])],1),i("v-uni-view",{staticClass:"detailed_want"},[i("v-uni-text",{staticStyle:{color:"#F66C3F"}},[t._v(t._s(t._f("trannumber")(t.value.wish||999999)))]),i("v-uni-text",[t._v("人想看")])],1)],1)],1),i("v-uni-image",{attrs:{src:t.value.img}})],1)],1)},o=[]},b617:function(t,e,i){"use strict";i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return a})),i.d(e,"a",(function(){}));var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"dropdown-group-style"},[i("v-uni-view",{staticClass:"detailed_mid "},[0==t.isshow?i("dropdown",{class:{"choose-box":!0,"no-right":!t.isSearch},attrs:{"active-color":"#F66C3F","menu-icon":"arrow-down-fill","menu-icon-size":"16rpx"},on:{open:function(e){arguments[0]=e=t.$handleEvent(e),t.open.apply(void 0,arguments)},close:function(e){arguments[0]=e=t.$handleEvent(e),t.close.apply(void 0,arguments)}}},[i("dropdown-item",{attrs:{height:t.height,options:t.list.city,title:t.chooseData.city},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),function(e){return t.changeType(e,"city")}.apply(void 0,arguments)}},model:{value:t.condition.value1,callback:function(e){t.$set(t.condition,"value1",e)},expression:"condition.value1"}}),i("dropdown-item",{attrs:{height:t.height,options:t.list.brand,title:t.chooseData.brand},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),function(e){return t.changeType(e,"brand")}.apply(void 0,arguments)}},model:{value:t.condition.value2,callback:function(e){t.$set(t.condition,"value2",e)},expression:"condition.value2"}}),i("dropdown-item",{attrs:{height:t.height,options:t.list.distance,title:t.chooseData.distance},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),function(e){return t.changeType(e,"distance")}.apply(void 0,arguments)}},model:{value:t.condition.value3,callback:function(e){t.$set(t.condition,"value3",e)},expression:"condition.value3"}})],1):t._e()],1)],1)},a=[]},c017:function(t,e,i){"use strict";i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return n}));var n={uIcon:i("21cf").default},a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"u-dropdown"},[i("v-uni-view",{staticClass:"u-dropdown__menu",class:{"u-border-bottom":t.borderBottom},staticStyle:{width:"100%"},style:{height:t.$u.addUnit(t.height)}},t._l(t.menuList,(function(e,n){return i("v-uni-view",{key:n,staticClass:"u-dropdown__menu__item",on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.menuClick(n)}}},[i("v-uni-view",{staticClass:"u-flex"},[i("v-uni-text",{staticClass:"u-dropdown__menu__item__text",style:{color:e.disabled?"#c0c4cc":n===t.current||t.highlightIndex==n?t.activeColor:t.inactiveColor,fontSize:t.$u.addUnit(t.titleSize)}},[t._v(t._s(e.title))]),i("v-uni-view",{staticClass:"u-dropdown__menu__item__arrow",class:{"u-dropdown__menu__item__arrow--rotate":n===t.current}},[i("u-icon",{attrs:{"custom-style":{display:"flex"},name:t.menuIcon,size:t.$u.addUnit(t.menuIconSize),color:n===t.current||t.highlightIndex==n?t.activeColor:"#666"}})],1)],1)],1)})),1),i("v-uni-view",{staticClass:"u-dropdown__content",style:[t.contentStyle,{transition:"opacity "+t.duration/1e3+"s linear",top:t.$u.addUnit(t.height),height:t.contentHeight+"px"}],on:{touchmove:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e)},click:function(e){arguments[0]=e=t.$handleEvent(e),t.maskClick.apply(void 0,arguments)}}},[i("v-uni-view",{staticClass:"u-dropdown__content__popup",style:[t.popupStyle],on:{click:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e)}}},[t._t("default")],2),i("v-uni-view",{staticClass:"u-dropdown__content__mask"})],1)],1)},o=[]},c3d6:function(t,e,i){"use strict";i.r(e);var n=i("c017"),a=i("a1a3");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("1fbc");var d=i("f0c5"),l=Object(d["a"])(a["default"],n["b"],n["c"],!1,null,"13d3be0e",null,!1,n["a"],void 0);e["default"]=l.exports},c7ef:function(t,e,i){"use strict";i.r(e);var n=i("e433"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},cb21:function(t,e,i){var n=i("9218");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("6eaf52df",n,!0,{sourceMap:!1,shadowMode:!1})},cb94:function(t,e,i){"use strict";var n=i("cb21"),a=i.n(n);a.a},cc6e:function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,".dropdown-group-style .detailed_mid[data-v-3635b0bd]{position:relative;width:100%}.dropdown-group-style .detailed_mid .detailed_search[data-v-3635b0bd]{box-sizing:border-box;margin-top:%?20?%}",""]),t.exports=e},cdd6:function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,"",""]),t.exports=e},de90:function(t,e,i){var n=i("534e");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("d50bebec",n,!0,{sourceMap:!1,shadowMode:!1})},e433:function(t,e,i){"use strict";i("7a82");var n=i("4ea4").default;Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("14d9"),i("3c65"),i("e9c4"),i("ac1f"),i("5319"),i("99af");var a=n(i("2909")),o=n(i("5530")),d=n(i("439a")),l=n(i("62a2")),s=n(i("81ed")),r={data:function(){return{background:{backgroundImage:"linear-gradient(180deg, #ffffff, #ffffff)"},total:0,loaded:!1,timeCurrent:0,scrollHeight:0,freshing:!1,loading:!1,detaileddata:{},type:0,list:[],condition:{value1:"0",value2:"",value3:"distance",page:0,pagesize:20,keyword:""},boxHeight:"",searchData:{city:[],brand:[{label:"品牌",value:""},{label:"万达影院",value:"万达"},{label:"大地影院",value:"大地"},{label:"卢米埃影院",value:"卢米埃"},{label:"幸福蓝海影院",value:"幸福蓝海"},{label:"横店影城",value:"横店"},{label:"中影国际影城",value:"中影"},{label:"金逸影城",value:"金逸"},{label:"博纳影城",value:"博纳"},{label:"CGV影城",value:"CGV"},{label:"UME国际影城",value:"UME"}],distance:[{label:"离我最近",value:"distance"},{label:"折扣最低",value:"discount"},{label:"价格最低",value:"price"}]},listTime:[],listindex:0,leftlength:60,movieinfo:{date:"",mid:"",lat:"",lng:"",cid:"",rid:"0",s:"",cinemaTitle:"",orders:"discount",offset:0,limit:20},movielist:[],time:""}},components:{tabs:d.default,moviceTop:l.default,dropdownGroup:s.default},onLoad:function(t){this.movieinfo.mid=t.mid},onShow:function(){var t=this;this.movieinfo.cid=this.$store.state.chooseLoc.id||this.$store.state.locCity.id,this.$nextTick((function(){t.getDom()})),this.getRegion(),this.getMoviceDetail(),this.getMoviceTime()},methods:{getmovielist:function(){var t=this;this.loading=!0;var e=(0,o.default)((0,o.default)({},this.movieinfo),{},{lat:this.$store.state.locCity.lat,lng:this.$store.state.locCity.lng,s:this.condition.keyword,rid:this.condition.value1,cinemaTitle:this.condition.value2,orders:this.condition.value3,offset:this.condition.page*this.condition.pagesize,limit:this.condition.pagesize});this.$api.getMovieCinema(e).then((function(e){var i;(i=t.movielist).push.apply(i,(0,a.default)(e.data.result.list.rows)),t.total=e.data.result.list.total,t.freshing=!1,t.loading=!1,uni.hideLoading(),t.total<=t.condition.page*t.condition.pagesize&&(t.loaded=!0),t.condition.page+=1}))},getMoviceDetail:function(){var t=this;this.$api.getMovieDetailed({mid:this.movieinfo.mid,s:1}).then((function(e){t.detaileddata=e.data.result}))},getMoviceTime:function(){var t=this;this.$api.getMovieCinemaDays({mid:this.movieinfo.mid,cid:this.$store.state.chooseLoc.id||this.$store.state.locCity.id}).then((function(e){if(e.data.result.length>0)t.listTime=e.data.result;else{t.listTime=[];for(var i=0;i<3;i++)t.listTime.push({days:t.$common.nowAfterDay(new Date,i,"YYYY-MM-DD")})}t.movieinfo.date=t.listTime[0].days,t.getmovielist()}))},toBack:function(t){this.$common.toBack(t)},changelist:function(t){console.log(t),this.listindex=t,this.leftlength=148*t+60},getRegion:function(){var t=this;this.$api.getRegion({cid:this.$store.state.chooseLoc.id||this.$store.state.locCity.id}).then((function(e){t.searchData.city=e.data.result,t.searchData.city.unshift({cid:t.$store.state.chooseLoc.id||t.$store.state.locCity.id,id:0,name:"全城",rid:0});var i=JSON.stringify(t.searchData.city);i=i.replace(/rid/g,"value"),i=i.replace(/name/g,"label"),t.searchData.city=JSON.parse(i)}))},getDom:function(){var t=this,e=uni.createSelectorQuery().in(this);e.selectAll(".alltop").boundingClientRect((function(e){var i=e[0]?e[0].height:0;t.boxHeight=t.$store.state.windowHeight-i})).exec()},refresh:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;t&&(this.freshing=!0),this.loaded=!1,this.condition.page=0,this.movielist=[],uni.showLoading({title:"加载中"}),this.getmovielist()},onreachBottom:function(){this.loaded||(uni.showLoading({title:"加载中"}),this.getmovielist())},movietiao:function(t){uni.navigateTo({url:"/moviePages/pages/buymovie/buymovie?cid=".concat(t.cid,"&cinemaId=").concat(t.cinemaid,"&mid=").concat(this.movieinfo.mid,"&dates=").concat(this.listTime[this.timeCurrent].days)})},changeTimeTab:function(t){this.timeCurrent=t,this.movieinfo.date=this.listTime[this.timeCurrent].days,this.refresh()},searchCinema:function(t){var e=this;this.condition.keyword=t,this.$common.inputDebounce(this,(function(){e.refresh()}))},changeType:function(t){this.condition=(0,o.default)((0,o.default)({},this.condition),t),this.refresh()}}};e.default=r},f454:function(t,e,i){"use strict";i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={data:function(){return{height:0}},props:{value:{type:Object,default:{}}},mounted:function(){this.height=this.$common.setWidthHeight()}};e.default=n}}]);