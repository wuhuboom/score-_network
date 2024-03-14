/**

 @Name：jwt 解码取值
 @Author：Siam
 @Site：

 */

layui.define(['conf','api'], function(exports){
    var $ = layui.$
        ,conf = layui.conf
        ,api = layui.api;

    var siam = {
        get: function(str){
            var token = layui.data(conf.tableName)[conf.tokenName];
            if (token===undefined){
                return null;
            }
            var json =window.atob(decodeURIComponent (token));
            var obj = JSON.parse(json);
            var timestamp = Date.parse(new Date())/1000;
            console.log(obj);
            console.log(obj.nbf);
            console.log(timestamp);
            // 在此之前不可用 nbf-10 兼容客户端时间戳慢了几秒
            if (obj.nbf !== undefined && (obj.nbf - 10) > timestamp){
                throw new Error("not before");
            }
            // 是否已经过期
            if (obj.exp !== undefined && obj.exp < timestamp){
                throw new Error("token exp");
            }
            if ( obj[str] !== undefined){
                return obj[str];
            }
            return obj.data[str];
        },
        getToken: function() {
            let token = layui.data(conf.tableName)[conf.tokenName];
            if (token===undefined){
                return null;
            }
            return token;
        },
        vifAuth: function(auth){
            let AuthList = api;
            AuthList = layui.data('nepadmin').api;
            return AuthList[auth]!==undefined?true:false;

            return true;
            let temAuthList = [];

            if (siam.getLayuiData('auth') !== null ){
                $.each(siam.getLayuiData('auth'), function(index, auth){
                    temAuthList.push(auth.auth_rules);
                });
            }
            let reverse = false;

            // 判断第一个是否为 !
            if (auth[0] === '!'){
                reverse = true;
                auth = auth.substr(1);
            }
            // reverse = true  证明取反  比如!test  有test权限则隐藏 没有test权限则显示
            if (reverse){
                if ( $.inArray(auth, temAuthList) !== -1 ){
                    return false;
                }
            }else{
                if ( !($.inArray(auth, temAuthList) !== -1)  ){
                    return false;
                }
            }
            return true;
        },
        getLayuiData:function(str){
            return layui.data(conf.tableName)[str] ? layui.data(conf.tableName)[str] : null;
        },
        renderAuth:function(){
            $('body').find("[data-siam-auth]").each(function (i) {
                var auth = $(this).attr('data-siam-auth');
                if (siam.vifAuth(auth) === false){
                    //console.log('没有'+auth+'的权限');
                    $(this).remove();
                }else{
                    //console.log('有'+auth+'的权限');
                }
            })
        }
    };

    siam.renderAuth();


    //对外暴露的接口
    exports('siam', siam);
});