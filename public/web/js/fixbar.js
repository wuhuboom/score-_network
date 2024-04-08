layui.use(function(){
    var util = layui.util;
    // 自定义固定条
    util.fixbar({
        bars: [{ // 定义可显示的 bar 列表信息 -- v2.8.0 新增
            type: 'home',
            icon: 'layui-icon-home',
        },
        // { // 定义可显示的 bar 列表信息 -- v2.8.0 新增
        //     type: 'orders',
        //     icon: 'layui-icon-list',
        // },
        { // 定义可显示的 bar 列表信息 -- v2.8.0 新增
            type: 'lang',
            // icon: 'layui-icon-service',
            content:lang
        },{ // 定义可显示的 bar 列表信息 -- v2.8.0 新增
            type: 'service',
            icon: 'layui-icon-service',
            // style: 'background-color: #FF5722;'
        }],
        css: {right: 0, bottom: 300},

        on: { // 任意事件 --  v2.8.0 新增
            mouseenter: function (type) {
                if(type=='lang'){
                    var content = lang=='Cn'?'Switch to English':'Switch to Chinese'
                    layer.tips(content, this, {
                        tips: 4,
                        fixed: true
                    });
                }
            },
            mouseleave: function (type) {
                layer.closeAll('tips');
            }
        },
        // 点击事件
        click: function (type) {
            if(type=='home'){
                window.location.href = "/"
            }
            if(type=='orders'){
                window.location.href = "/orders"
            }
            if(type=='service'){
                window.location.href = service_inline
            }
            if(type=='lang'){
                var  origin = window.location.origin
                var  pathname = window.location.pathname
                console.log( lang)
                var l = lang=='Cn'?'En':'Cn'
                window.location.href = origin+pathname+"?lang="+l
            }
        }
    });
});