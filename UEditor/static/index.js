// var clientHeight = document.body.clientHeight + 100
// $('.editor-container').css('height', clientHeight)
var uer = UE.getEditor('editor');
var ueHtml = ''; //富文本内容
var URL = 'http://'+window.location.host+'/';


/* 监听标题输入 */
$(document).on("input","#article-title-input",function () {
    var length = $("#article-title-input").val().length;
    $(".article-title-count-text")[0].innerText = length+"/64";
})

/* 深色模式 */
var darkModel = false
$(document).on('click', '.out-dark-mode-btn', function(){
    if(darkModel){
        $(".dark-icon1").removeClass("hide");
        $(".dark-icon2").addClass("hide");
        darkModel=false;
    }
    else{
        $(".dark-icon1").addClass("hide");
        $(".dark-icon2").removeClass("hide");
        darkModel=true;
    }
    darkMode();
})
function darkMode() {
    var iframeView = $('#ueditor_0')[0].contentWindow.document.getElementsByClassName('view')[1];
    if (darkModel) {
        $('body').addClass('dark-mode-body')
        $('#ueditor_0')[0].contentWindow.document.body.style.background="#232323";
        $('#ueditor_0')[0].contentWindow.document.body.style.color="#FFFFFF ";
    } else {
        $('body').removeClass('dark-mode-body')
        $('#ueditor_0')[0].contentWindow.document.body.style.background="#ffffff";
        $('#ueditor_0')[0].contentWindow.document.body.style.color="";
    }
    // darkModel = !darkModel;
}


/* 生成长图 */
$(document).on("click",".btn-save-longImg",function () {
    var ueHtml = uer.getContent();

    if(ueHtml){
        var article_title = $('input[id=article-title-input]').val();
        if(article_title)
        {
            var title_html ='<p style="font-size: 24px;font-weight: 700;height: 50px;line-height: 50px;font-family: mp-quote,-apple-system-font,BlinkMacSystemFont,Helvetica Neue,PingFang SC,Hiragino Sans GB,Microsoft YaHei UI,Microsoft YaHei,Arial,sans-serif">'+article_title+'</p>';
            ueHtml = title_html+ueHtml;
        }
        $(".preview-wrap2")[0].innerHTML = ueHtml;
        $("#print_div").removeClass("hide");
        var el = $(".preview-wrap2")[0];
        console.log(el)
        console.log("高度:"+el.scrollHeight);
        html2canvas(el,{
            allowTaint: false,
            windowHeight:el.scrollHeight,
            windowWidth:el.scrollWidth,
            useCORS:true,
            x:0,
            y:window.pageYOffset
        }).then(function(canvas){
            canvas.style.position="absolute";
            canvas.style.top="10px";
            var width = parseInt(window.screen.width/3);
            canvas.style.left = width+"px";
            $(".preivew-inner2")[0].appendChild(canvas);
            var data = canvas.toDataURL();
            $(".img-down-btn").attr("href",data);

        })
        $(".preview-wrap2").css("display","none");
    }
    else{
        layer.msg("文章内容为空！");
    }
});

/* 保存文章 */
$(document).on('click', '.btn-save-article', function(){

    var ueHtml = uer.getContent();
    var ueText = uer.getContentTxt();
    var article_title = $('input[id=article-title-input]').val();
    var save_type = $('#save_type').val();
    var id = $('#id').val();
    if(ueHtml){
        $.ajax({
            url: URL+'/UEditor/save',
            dataType: 'json',
            timeout:5000, //5秒超时
            type: 'POST',
            data: {id:id,rich_html:ueHtml,only_text:ueText,article_title:article_title,save_type:save_type},
            success: function(json) {
                layer.msg(json.msg);return false;
                //layer.msg(json.msg);
            },
            error: function(response) {
                console.log(response);
            },
            complete:function(xmlHttpRequest,status){
                if(status=='timeout'){
                    layer.msg("请求超时！"); return false;
                    layer.msg("请求超时！");
                }
            }
        });
    }
    else{
        layer.msg("请输入内容");
    }
})

/* 文章预览 */
$(document).on('click', '.btn-preview-article', function() {
    var ueHtml = uer.getContent();
    if(ueHtml){
        var article_title = $('input[id=article-title-input]').val();
        if(article_title)
        {
            var title_html ='<p style="font-size: 24px;font-weight: 700;height: 50px;line-height: 50px;font-family: mp-quote,-apple-system-font,BlinkMacSystemFont,Helvetica Neue,PingFang SC,Hiragino Sans GB,Microsoft YaHei UI,Microsoft YaHei,Arial,sans-serif">'+article_title+'</p>';
            ueHtml = title_html+ueHtml;
        }
        $.ajax({
            url: URL+'/UEditor/savePreview',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {html_content:ueHtml},
            success: function(data) {
                if (data.code == 1) {
                    layui.use(['admin', 'code', 'helper', 'qrcode'], function (admin, code, helper) {
                        var $ = layui.jquery;
                        $("#qrCode").html('');
                         helper.qrcode($("#qrCode"), data.result.preview_link);
                    })

                    //layui.helper.qrcode($("#qrCode"), 'http://payment.qcq.cc/api/payment/jsapi?order_id=');
                    //$("#qrCode").attr("src",data.result.qrCode_src);
                    $(".copy-btn").attr("data-url",data.result.preview_link);
                    $(".pc-btn").attr("href",data.result.previewPC_link);
                    $(".preview-wrap")[0].innerHTML = ueHtml;
                    $('.priview-article').removeClass('hide');
                }
                else{
                    layer.msg(data.msg)
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
    else
        layer.msg("文章内容为空！");

})

// 预览复制链接
$(document).on("click",".copy-btn",function (e) {
    var url = e.currentTarget.dataset.url;
    if(url && copy(url)){
        // layer.msg()
    }
});
var is_dark=false;
// 预览弹窗更改尺寸
$(document).on("click",".inch-btn",function (e) {
    var size = e.currentTarget.dataset.size;
    $(".btns-container").find("li").each(function (a,b) {
        b.classList.remove("active");
    });
    $(this).addClass("active")
    $(".preview-part").attr("class","preview-part");
    $(".preview-part").addClass(size);
    if(size=="inch58"){
        $("#4_7a5_5").addClass("hide")
        $("#4_7a5_5_black").addClass("hide");
        if(is_dark)
        {
            $("#5_8_black").removeClass("hide");
            $("#5_8").addClass("hide");
        }
        else{
            $("#5_8").removeClass("hide");
            $("#5_8_black").addClass("hide");
        }
    }

})

//预览弹窗深色模式
$(document).on("click",".dark-mode-btn",function(e){
    var imgClass = $(this).find("img")[0].className;
    var cur_size = $(".btns-container .active")[0].dataset.size;
    if(imgClass=="hide"){
        $(".status-span img").removeClass("hide");//使其勾选状态;
        if(cur_size=='inch47' || cur_size=="inch55"){
            $("#4_7a5_5").addClass("hide");
            $("#5_8").addClass("hide");
            $("#5_8_black").addClass("hide");
            $("#4_7a5_5_black").removeClass("hide");
        }
        else{
            $("#4_7a5_5").addClass("hide");
            $("#5_8").addClass("hide");
            $("#5_8_black").removeClass("hide");
            $("#4_7a5_5_black").addClass("hide");
        }
        $(".preview-wrap").css("background","#2f2f2f")
        $(".preview-wrap").css("color","#ffffff");
        is_dark=true;
    }
    else{
        // 非深色
        is_dark = false;
        $(".status-span img").addClass("hide");//去除勾选状态;
        $(".preview-wrap").css("background","#fff")
        $(".preview-wrap").css("color","")
        if(cur_size=='inch47' || cur_size=="inch55"){
            $("#4_7a5_5").removeClass("hide");
            $("#5_8").addClass("hide");
            $("#5_8_black").addClass("hide");
            $("#4_7a5_5_black").addClass("hide");
        }
        else{
            $("#4_7a5_5").addClass("hide");
            $("#5_8").removeClass("hide");
            $("#5_8_black").addClass("hide");
            $("#4_7a5_5_black").addClass("hide");
        }
    }
})

/* 清空/新建 */
$('.btn-clear-all').click(function() {
    $('.clear-all').removeClass('hide');

});

/* 清空/新建-确定 */
$(document).on("click",".btn-clear-all",function () {
    uer.execCommand('cleardoc');
    $("#article-title-input").val("未命名图文");
    $(".article-title-count-text")[0].innerText = "5/64";
    $('.dialog-wrap').addClass('hide');
})



// 导入文章-公众号超链接
$(document).on("click",".btn-link",function() {
    $('.import-link').removeClass('hide');
});
/* 导入超链接文章-确定 */
$(document).on("click",".btn-confirm-link",function () {
    var link_url = $('input[name=importLink]').val();
    $('.import-link').addClass("hide");
    loaddingOpen();
    if(link_url){
        $.ajax({
            url: URL+'/UEditor/articleImportLink',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {link:link_url},
            success: function(json) {
                if (json.code == 200) {
                    ueHtml = uer.getContent();
                    var new_html = ueHtml+json.msg;
                    uer.setContent(new_html);
                    if(json.result.title!=undefined && json.result.title!=""){
                        $("#article-title-input").val(json.result.title);
                        var length = json.result.title.length;
                        $(".article-title-count-text")[0].innerText = length+"/64";
                    }
                    loaddingClose();
                }
                else{
                    layer.msg(json.msg)
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
    else
        layer.msg("请输入链接");
});

/* 图片编辑 */
$(document).on("click",'.btn-img-editor',function() {
    if ($('.edit-picture-panel').hasClass('hide')) {
        $('.edit-picture-panel').removeClass('hide')
    } else {
        $('.edit-picture-panel').addClass('hide')
    }
});


var borderRadius = 0;
var boxShadow = 'none';
var border = 'none';
var borderColor = 'rgb(34,34,34)';
/**
 * 图片编辑 边框添加，阴影，圆角
 * @param {object}  e
 * @param {string|number} type 编辑类型 1：圆角 2：阴影 3：边框
 * @param {string|number} value 值 0：取消 1：减 2：加
 */
function setImgStyle(e,type,value) {
    var setValue = '';
    if (type == 1) {
        if (value == 1) {
            if (borderRadius - 3 >= 0) {
                if (borderRadius + 3 > 52) {
                    $(e).parents('.operator-li').find('div').eq(1).find('.normal').show()
                    $(e).parents('.operator-li').find('div').eq(1).find('.disabled').hide()
                }
                borderRadius = borderRadius - 3
            } else {
                borderRadius = 0
                $(e).parents('.operator-li').find('div').eq(0).find('.normal').hide()
                $(e).parents('.operator-li').find('div').eq(0).find('.disabled').show()
            }
        } else if (value == 2) {
            if (borderRadius == 0) {
                borderRadius = 1
                $(e).parents('.operator-li').find('div').eq(0).find('.normal').show()
                $(e).parents('.operator-li').find('div').eq(0).find('.disabled').hide()
            } else {
                if (borderRadius + 3 > 52) {
                    borderRadius = borderRadius
                    $(e).parents('.operator-li').find('div').eq(1).find('.normal').hide()
                    $(e).parents('.operator-li').find('div').eq(1).find('.disabled').show()
                } else {
                    borderRadius = borderRadius + 3
                }
            }
        } else {
            $('.img-operator-list .operator-li').eq(0).find('div').eq(0).find('.normal').hide()
            $('.img-operator-list .operator-li').eq(0).find('div').eq(0).find('.disabled').show()
            $('.img-operator-list .operator-li').eq(0).find('div').eq(1).find('.normal').show()
            $('.img-operator-list .operator-li').eq(0).find('div').eq(1).find('.disabled').hide()
            borderRadius = 0
        }
        setValue = borderRadius + 'px'
    }
    else if (type == 2) {
        if (value == 1) {
            if (boxShadow + 30 <= 210) {
                if (boxShadow == 0) {
                    $(e).parents('.operator-li').find('div').eq(1).find('.normal').show()
                    $(e).parents('.operator-li').find('div').eq(1).find('.disabled').hide()
                }
                boxShadow = boxShadow + 30
                setValue = 'rgb(' + boxShadow + ',' + boxShadow + ',' + boxShadow + ') 0em 0em 0.5em 0px'
            } else {
                boxShadow = 'none'
                $(e).parents('.operator-li').find('div').eq(0).find('.normal').hide()
                $(e).parents('.operator-li').find('div').eq(0).find('.disabled').show()
                setValue = boxShadow
            }
        } else if (value == 2) {
            if (boxShadow == 'none') {
                boxShadow = 210
                $(e).parents('.operator-li').find('div').eq(0).find('.normal').show();
                $(e).parents('.operator-li').find('div').eq(0).find('.disabled').hide();
            } else if (boxShadow - 30 > 0) {
                boxShadow = boxShadow - 30
            } else {
                boxShadow = 0
                $(e).parents('.operator-li').find('div').eq(1).find('.normal').hide();
                $(e).parents('.operator-li').find('div').eq(1).find('.disabled').show();
            }
            setValue = 'rgb(' + boxShadow + ',' + boxShadow + ',' + boxShadow + ') 0em 0em 0.5em 0px'
        } else {
            $('.img-operator-list .operator-li').eq(1).find('div').eq(0).find('.normal').hide();
            $('.img-operator-list .operator-li').eq(1).find('div').eq(0).find('.disabled').show();
            $('.img-operator-list .operator-li').eq(1).find('div').eq(1).find('.normal').show();
            $('.img-operator-list .operator-li').eq(1).find('div').eq(1).find('.disabled').hide();
            boxShadow = 'none'
            setValue = boxShadow
        }
    }
    else if (type == 3) {
        if (value == 1) {
            if (border - 1 == 0) {
                border = 'none'
                $(e).parents('.operator-li').find('div').eq(0).find('.normal').hide();
                $(e).parents('.operator-li').find('div').eq(0).find('.disabled').show();
                setValue = border
            } else {
                border -= 1
                setValue = border + 'px solid ' + borderColor
            }
        } else if (value == 2) {
            if (border == 'none') {
                border = 1;
                $(e).parents('.operator-li').find('div').eq(0).find('.normal').show();
                $(e).parents('.operator-li').find('div').eq(0).find('.disabled').hide();
                setValue = border + 'px solid ' + borderColor
            } else {
                border += 1;
                setValue = border + 'px solid ' + borderColor
            }
        } else {
            $('.img-operator-list .operator-li').eq(2).find('div').eq(0).find('.normal').hide();
            $('.img-operator-list .operator-li').eq(2).find('div').eq(0).find('.disabled').show();
            $('.img-operator-list .operator-li').eq(2).find('div').eq(1).find('.normal').show();
            $('.img-operator-list .operator-li').eq(2).find('div').eq(1).find('.disabled').hide();
            border = 'none';
            // $('.border-color').css('background-color', 'rgb(255,255,255)')
            setValue = border
        }
    }
    ueHtml = uer.getContent();
    var newHtml = formatRichText(ueHtml, type, setValue);
    uer.execCommand('cleardoc');
    uer.setContent(newHtml);
    return false;
}

/**
 * 右侧图片编辑 全局处理富文本图片
 * @param {string} html 富文本内容
 * @param {string|number} type 1：圆角 2：阴影 3：边框 4：边框颜色
 * @param {string} value 设置值
 * @return {void|string|*} newHtml
 */
function formatRichText(html, type, value) {
    var newHtml = html.replace(/<img[^>]*>/gi, function(match, capture) {
        match = match.replace(/width="[^"]*"/gi, '').replace(/width='[^']*'/gi, '');
        match = match.replace(/height="[^"]*"/gi, '').replace(/height='[^']*'/gi, '');
        var style_match = match.match(/style="[^"]+"/gi);
        var style_match2 = match.match(/style/gi);
        if(style_match==null || style_match2==null){
            match = match.replace(/style="[^"]*"/gi,'')
            match = match.replace(/style/gi,'')
            var src = match.match(/src="[^"]+"/gi);
            match = match.replace(/src="[^"]*"/gi, src[0]+' style=" "')
        }
        match = match.replace(/style="[^"]+"/gi, function(match, capture) {
            var width = match.match(/width:[^;]*;/gi) || '';
            var height = match.match(/height:[^;]*;/gi) || '';
            var borderRadius = match.match(/border-radius:[^;]*;/gi)
            borderRadius = (borderRadius || [])[0] || 'border-radius:0;'
            var boxShadow = match.match(/box-shadow:[^;]*;/gi)
            boxShadow = (boxShadow || [])[0] || 'box-shadow:none;'
            var border = match.match(/border:[^;]*;/gi)
            border = (border || [])[0] || 'border:none;'
            var borderColor = match.match(/border-color:[^;]*;/gi)
            borderColor = (borderColor || [])[0] || 'border-color:rgb(34,34,34);'
            match = 'style="' + width + height + borderRadius + boxShadow + border + borderColor + '"'
            if (type == 1) {
                match = match.replace(/border-radius:[^;]*;/gi, 'border-radius:' + value + ';')
            } else if (type == 2) {
                match = match.replace(/box-shadow:[^;]*;/gi, 'box-shadow:' + value + ';')
            } else if (type == 3) {
                match = match.replace(/border:[^;]*;/gi, 'border:' + value + ';')
            } else if (type == 4) {
                match = match.replace(/border-color:[^;]*;/gi, 'border-color:' + value + ';')
            }
            return match;
        });
        return match;
    });
    return newHtml;
}



/* 违规检测 */
$(document).on('click', '.violation-detection-btn', function() {
    ueHtml = uer.getContent()
    if (!ueHtml) {
        layer.msg('请先添加文章内容')
    } else { //检测
        loaddingOpen();
        var text = uer.getContentTxt(); //获取文本内容
        var article_title = $('input[id=article-title-input]').val(); //文章标题
        $.ajax({
            url: URL+'index.php?action=violation_check',
            dataType: 'json',
            timeout:10000, //10秒超时
            type: 'POST',
            data: {text:text,html:ueHtml,article_title:article_title},
            success: function(json) {
                var res_text = json.data.text_res;
                var res_img = json.data.img_res;
                //显示检测结果
                var html='';
                if(res_text.code==1)
                    html += '<div class="small-title safe">文字检测合规</div>';
                else
                {
                    var data = res_text.data;
                    var text_res_msg="";
                    for(var j=0;j<data.length;j++){
                        text_res_msg += '<span>'+data[j].msg+'</span><br />';
                    }
                    html += '<div class="small-title danger">文字检测'+res_text.msg+'</div><div class="result-describe">'+text_res_msg+'</div>';
                }
                var img_res_msg='';
                for(var i=0;i<res_img.length;i++){
                    var res = res_img[i];
                    if(res.code==0){
                        for(var j=0;j<res.data.length;j++){
                            img_res_msg += '<span>'+res.data[j].msg+'</span><br />';
                        }
                    }
                }
                if(img_res_msg == ''){
                    html += '<div class="small-title safe">图片检测合规</div>';
                }
                else{
                    html += '<div class="small-title danger">图片检测存在不合规</div><div class="result-describe">'+img_res_msg+'</div>';
                }
                $(".check-result")[0].innerHTML = html;
                $(".violation-check-result").removeClass("hide")
                loaddingClose();
            },
            error: function(response) {
                console.log(response);
            },
            complete:function(xmlHttpRequest,status){
                if(status=='timeout'){
                    layer.msg("请求超时！");
                }
            }
        });
    }
})
$(document).on("click",".btn-violation-check",function () {
    $(".violation-check-result").addClass("hide");
})

/* 关闭弹窗 */
$(document).on('click', '.dialog-close', function() {
    $('.dialog-wrap').addClass('hide');
})
/* 复制富文本内容到粘贴板 */
function copy(html) {
    var textArea = document.createElement("textarea");
    textArea.style.position = 'fixed';
    textArea.style.top = '0';
    textArea.style.left = '0';
    textArea.style.width = '2em';
    textArea.style.height = '2em';
    textArea.style.padding = '0';
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
    textArea.style.background = 'transparent';
    textArea.value = html;
    document.body.appendChild(textArea);
    textArea.select();
    if (document.execCommand('copy')) {
        document.execCommand('copy');
        document.body.removeChild(textArea);
        return true
    } else {
        document.body.removeChild(textArea);
        return false
    }

}

/* 弹窗-loadding-开 */
function loaddingOpen(){
    $('.dialog-loadding').removeClass('hide')
}
/* 弹窗-loadding-关 */
function loaddingClose(){
    $('.dialog-loadding').addClass('hide')
}
