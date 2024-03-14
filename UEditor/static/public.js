//编辑器初始化
MU.ueditor = UE.getEditor('editor',{
    elementPathEnabled:false
});
//监听是否全屏
MU.ueditor.addListener('beforefullscreenchange', function (event, isFullScreen) {
    if (!isFullScreen) {
        MU.setTimeout(function () {
            $('#editor .edui-editor-iframeholder').css('width', '100%');
        }, 10);
    }
});
var ue = MU.ueditor;
var clip  = null;
/* 页面加载完成 */
var editorLeft = $('.editor-box')[0].offsetLeft; //富文本区域离左边的距离
$(document).ready(function() {
    console.log(1)
    /* 为元素绑定原生事件 */
    UE.dom.domUtils.on(document.body, "click", function(e) {
        if (!$(e.target).hasClass('text-filter-box') && !$(e.target).parents().hasClass('text-filter-box')) {
            if (!$(e.target).hasClass('ya-article-style-settings') && !$(e.target).parent().hasClass('ya-article-style-settings')) {
                $('.text-filter-box').addClass('hide')
            }
        }
        if ($(e.target).hasClass('edui-editor-imagescale')) {
            if($('.image-enhance-tool-menu').hasClass('hide')){
                cal(e.target)
            }else{
                $('.image-enhance-tool-menu').addClass('hide')
            }
        }else{
            if (!$(e.target).hasClass('image-enhance-tool-menu') && !$(e.target).parents().hasClass(
                'image-enhance-tool-menu')) {
                $('.image-enhance-tool-menu').addClass('hide')
            }
        }
    });

    ue.ready(function () {

        init_data();
        $(".edui-combox-body div").attr("onclick","");
        console.log($(".edui-combox-body div"))
        //字号输入框
        var left = document.getElementById('editor_contents').offsetWidth * 0.2-160;
        //var left = document.getElementsByTagName("body")[0].offsetWidth * 0.2-160;
        $(".edui-for-fontsize")[0].title = "请输入文章标题";
        $(".div-font-size")[0].style.left = left+"px";
        $(".div-font-size")[0].style.top = "66px";
        $(".edui-for-fontsize .edui-arrow").mouseover(function (e) {
            $('body').append('<div id="tooltip"><img class="tooltip-img" style="left:12px;" src="/Static/static/three.png" /><span>字号</span></div>');
            $('#tooltip').css({
                'left': (left+'px'),
                'top': ('2px')
            }).show();
        }).mouseout(function (e) {
            $('#tooltip').remove();
        });
        $(".input-font-size").hover(function (e) {
            $('body').append('<div id="tooltip"><img class="tooltip-img" style="left:12px;top: 86px" src="/Static/static/three.png" /><span>字号</span></div>');
            $('#tooltip').css({
                'left': (left+6+'px'),
                'top': ('2px')
            }).show();
        },function () {
            $('#tooltip').remove();
        })
    })
    /* 监听鼠标聚焦事件 */
    ue.addListener('click',function(e,a){
        $('.text-filter-box').addClass('hide');
        if($("#article-title-input").val()==""){
            $(".article-title-count-text")[0].innerText = "5/64";
            $("#article-title-input").val("未命名图文");
        }
        var px = a.target.style.fontSize;
        if(px!=undefined && px!="")
            $("#font-size-input").val(px);
    })
    /* 监听标题输入框点击 */
    $(document).on("click","#article-title-input",function () {
        if($("#article-title-input").val()=="未命名图文"){
            $(".article-title-count-text")[0].innerText = "0/64";
            $("#article-title-input").val("");
        }
    })
    $("#editor").find("iframe")[0].contentWindow.document.onclick = function () {
        $('.image-enhance-tool-menu').addClass('hide');
    }
    //监听鼠标滑过
    var title_content="";
    $(".edui-button-body").mouseover(function (e) {
        var class_name = e.currentTarget.className;
        var id =  e.currentTarget.id;
        title_content = e.currentTarget.title;
        e.currentTarget.title = "";
        if(/button/.test(id) && title_content==""){
            title_content = e.currentTarget.parentNode.parentNode.title;
            e.currentTarget.parentNode.parentNode.title = "";
        }
        if(title_content){
            var left = 6*title_content.length;
            $('body').append('<div id="tooltip"><img class="tooltip-img" style="left:'+left+'px ;" src="/Static/static/three.png" /><span>'+title_content+'</span></div>');
            var local = e.currentTarget.getBoundingClientRect()
            var currMiddle = e.currentTarget.clientWidth - $('#tooltip').width()
            var currLeft = local.left + (currMiddle/2);
            var currTop = local.top - ($('#tooltip').height()) - 2;
            $('#tooltip').css({
                'left': (currLeft + 'px'),
                'top': (currTop +'px')
            }).show();
        }

    }).mouseout(function (e) {
        var id =  e.currentTarget.id;
        if(/button/.test(id)){
            e.currentTarget.parentNode.parentNode.title = title_content;
        }
        else{
            e.currentTarget.title = title_content;
        }
        $('#tooltip').remove();
    })
});
/*初始化页面，并加载上一次的文章数据*/
function init_data(){

    //富文本标题
    var html =
        '<div class="article-title-wrapper"><div class="article-title-div"><input class="article-title-input" type="text" id="article-title-input" placeholder="请在这里输入标题" maxlength="64" autocomplete="off"> <span class="article-title-count-text">0/64</span></div> </div>'
    //$('#edui1_iframeholder').before(html)
    $('.edui-editor-iframeholder').before(html)
    //违规检测
    var html2 =
        '<div id="editor-bottom-tools-box" class="edui-editor-breadcrumb"><div class="violation-detection-btn" style="width: 100px;margin-left: 20px;cursor:pointer"><img class="icon active" src="https://cdn.yiban.io/web/mpa-web-editor/tools-box_violation-detection-active.4f239e707d20.svg"> 违规检测 </div></div>'
    //$('#edui1_elementpath').before(html2);
    $('.edui-editor-bottombar').before(html2);
    //深色模式，全文过滤
    var html3 = '<div class="right">'+
        '<div class="tool-item out-dark-mode-btn" style="display: inline-block"><img class="icon dark-icon1" src="/Static/static/img/home-ueditor_select-icon.6db44d33ab8a.svg" alt="">'+
        '<img class="icon dark-icon2 hide" src="/Static/static/img/home-ueditor_selected-icon.d1206409f040.png" alt=""><span>深色模式</span>' +
        '</div><div class="vertical-line"></div><div class="ya-article-style-settings"><img class="filter-img" src="/Static/static/img/style-setting.png" /><span class="filter-text">全文过滤</span></div></div>';
    $(".mupiao-toolbar-mediums").append(html3);
    // $.ajax({
    //     url: URL+'/UEditor/getArticle',
    //     dataType: 'json',
    //     timeout:2000, //2秒超时
    //     type: 'POST',
    //     success: function(json) {
    //         console.log($('#id').val());
    //         if(json.code==1 && json.result.length!=0){
    //             var article_html = json.result.rich_html;
    //             var article_title = json.result.article_title;
    //             if(json.result.rich_html!=undefined && json.result.rich_html!=""){
    //                 var length = article_title.length;
    //                 $(".article-title-count-text")[0].innerText = length+"/64";
    //                 $("#article-title-input").val(article_title);
    //                 document.getElementById("copyContent").innerHTML = article_html;
    //             }
    //             else{
    //                 //article_html = '<p><span style="font-size: 12px; color: rgb(178, 178, 178);">在这里直接输入或者粘贴内容</span></p>';
    //             }
    //             copyFunction();
    //             if(!ue.setContent(article_html,false)){
    //                 // window.location.reload();
    //             }
    //         }
    //         // else
    //         // {
    //         //     var article_html = '<p><span style="font-size: 12px; color: rgb(178, 178, 178);">在这里直接输入或者粘贴内容</span></p>';
    //         //     ue.setContent(article_html,false)
    //         // }
    //     },
    //     error: function(response) {
    //         console.log(response);
    //     },
    //     complete:function(xmlHttpRequest,status){
    //         if(status=='timeout'){
    //             alert("请求超时！");
    //         }
    //     }
    // });
}
/* 页面点击事件 */
$(document).click(function(e) {
    /* 点击空白关闭图片编辑弹窗 */
    if (!$(e.target).hasClass('btn-img-editor') && !$(e.target).parents().hasClass('btn-img-editor')) {
        if (!$(e.target).hasClass('edit-picture-panel') && !$(e.target).parents().hasClass('edit-picture-panel')) {
            $('.edit-picture-panel').addClass('hide')

        }
    }

    // if(!$(e.target).hasClass("ya-article-style-settings") && !$(e.target).hasClass("filter-text") &&
    //     !$(e.target).hasClass("filter-img") && !$(e.target).hasClass("check-box") && !$(e.target).hasClass("filter-item")
    //     && !$(e.target).hasClass("check-box-2") && !$(e.target).hasClass("filter-item-text") && !$(e.target).hasClass("operation-list")){
    //     $('.text-filter-box').addClass('hide')
    // }
    if($(e.target).hasClass("dialog-wrap") && !$(e.target).hasClass("hide")){

        var ht='<div class="rich preview-wrap2"></div>';
        $(".preivew-inner2")[0].innerHTML =ht;
        $(e.target).addClass("hide");
    }
    /* 图片编辑-边框-弹窗 */
    if (!$(e.target).hasClass('dropdown-menu') && !$(e.target).parents().hasClass('dropdown-menu')) {
        if (!$(e.target).hasClass('image-border-tool') && !$(e.target).parents().hasClass('image-border-tool')) {
            $('.dropdown-menu').addClass('hide')
        }
    }
})

/* 复制全文 */
$(document).on('click', '.btn-copy-article', function() {
    ueHtml = ue.getContent();
    if(ueHtml){
        ueHtml = ueHtml.replace(/<img[^>]*>/gi,function (matchHtml,a) {
            var src = matchHtml.match(/src=[\'\"]?([^\'\"]*)[\'\"]?/i);
            if(!/http/.test(matchHtml))
                matchHtml = matchHtml.replace(/src=[\'\"]?([^\'\"]*)[\'\"]?/i,"src=\""+URL+src[1]+"\"");
            return matchHtml;
        })
        document.getElementById("copyContent").innerHTML = ueHtml;
        copyFunction();
    }
})

function copyFunction () {
    var el = document.getElementById("copyContent");

    //var el2 = document.getElementById("ueditor_0").contentWindow.document.getElementsByClassName("view")[1];

    var el2 =$("#editor").find("iframe")[0].contentWindow.document.getElementsByClassName("view")[1];
    // debugger;
    clip  = new ClipboardJS('.btn-copy-article', {
        target: function () {
            return el;
        }
    });
    clip.on("success", function (e) {
        document.getElementById("copyContent").innerHTML = "";
        var clipData = e.text?e.text:window.clipboardData;
        if(clipData && clipData!="请在此编写正文..."){
            $('.copy-article').removeClass('hide');
            e.clearSelection()
        }
    });
    clip.on("error", function (e) {
        console.log('复制失败!');
        document.getElementById("copyContent").innerHTML = "";
        e.clearSelection();
    });
};

/*手动输入字号*/
$(document).on("change",'#font-size-input',function (e) {
    var value = e.currentTarget.value;
    ue.execCommand('fontsize', value); //设置字体背景颜色
});
$(document).on("click",".edui-listitem",function(e){
    var value = e.currentTarget.innerText;
    if(/px/.test(value))
        $("#font-size-input").val(value);
})

/* 导入文章-word文档 */
$(document).on("click",".btn-word",function() {
    $('#upload').click();
})
/* 上传文件 */
var file = document.getElementById('upload');
/* word 文件上传导入*/
function uploadFile() {
    var currFile = file.files[0];
    var formData = new FormData();
    formData.append('file', currFile);
    loaddingOpen();
    $.ajax({
        url: URL+'index.php?action=import_word',
        dataType: 'json',
        type: 'POST',
        async: false,
        data: formData,
        processData: false, // 使数据不做处理
        contentType: false, // 不要设置Content-Type请求头
        success: function(data) {
            if (data.code == 1) {
                // alert('上传成功！');
                ueHtml = ue.getContent();
                var new_html = ueHtml+data.msg;
                ue.setContent(new_html);
                loaddingClose();
                var obj = document.getElementById('upload');
                obj.outerHTML = obj.outerHTML;
            }
            else{
                alert(data.msg)
            }
        },
        error: function(response) {
            console.log(response);
        }
    });
}

/* 图片编辑-边框颜色 */
var spectrum = $('#colorSpectrum').spectrum({
    allowEmpty: true,
    color: "#ffffff",
    showInput: true,
    containerClassName: "full-spectrum",
    showInitial: true, //显示初始颜色,提供现在选择的颜色和初始颜色对比
    showPalette: true, //显示选择器面板
    showSelectionPalette: true, //记住选择过的颜色
    showAlpha: true, //显示透明度选择
    maxPaletteSize: 7, //记住选择过的颜色的最大数量
    preferredFormat: "hex",
    cancelText: "取消", //取消按钮,按钮文字
    chooseText: "选择",
    appendTo: '#colorSpectrum',
    palette: [
        ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)", "rgb(153, 153, 153)", "rgb(183, 183, 183)",
            "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(239, 239, 239)", "rgb(243, 243, 243)", "rgb(255, 255, 255)"
        ],
        ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
            "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"
        ],
        ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
            "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
            "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
            "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
            "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
            "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
            "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
            "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
            "rgb(133, 32, 12)", "rgb(153, 0, 0)", "rgb(180, 95, 6)", "rgb(191, 144, 0)", "rgb(56, 118, 29)",
            "rgb(19, 79, 92)", "rgb(17, 85, 204)", "rgb(11, 83, 148)", "rgb(53, 28, 117)", "rgb(116, 27, 71)",
            "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
            "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"
        ]
    ],
    change: function(e) {
        borderColor = e.toRgbString()
        ueHtml = ue.getContent()
        var newHtml = formatRichText(ueHtml, 4, borderColor);
        ue.execCommand('cleardoc');
        $('.border-color .sp-preview-inner').css('background-color', borderColor)
        ue.setContent(newHtml)
        return false;
    }
})
$(document).on("click",'.select-color',function() {
    $("#colorSpectrum").spectrum("show");
    return false
})
/* 文字编辑 */
var spectrum2 = $('#colorSpectrum2').spectrum({
    allowEmpty: true,
    color: "#ffffff",
    showInput: true,
    containerClassName: "full-spectrum",
    showInitial: true, //显示初始颜色,提供现在选择的颜色和初始颜色对比
    showPalette: true, //显示选择器面板
    showSelectionPalette: true, //记住选择过的颜色
    showAlpha: true, //显示透明度选择
    maxPaletteSize: 7, //记住选择过的颜色的最大数量
    preferredFormat: "hex",
    cancelText: "取消", //取消按钮,按钮文字
    chooseText: "选择",
    appendTo: '#colorSpectrum2',
    palette: [
        ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)", "rgb(153, 153, 153)", "rgb(183, 183, 183)",
            "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(239, 239, 239)", "rgb(243, 243, 243)", "rgb(255, 255, 255)"
        ],
        ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
            "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"
        ],
        ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
            "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
            "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
            "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
            "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
            "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
            "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
            "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
            "rgb(133, 32, 12)", "rgb(153, 0, 0)", "rgb(180, 95, 6)", "rgb(191, 144, 0)", "rgb(56, 118, 29)",
            "rgb(19, 79, 92)", "rgb(17, 85, 204)", "rgb(11, 83, 148)", "rgb(53, 28, 117)", "rgb(116, 27, 71)",
            "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
            "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"
        ]
    ],
    change: function(e) {
        var color = e.toRgbString()
        // console.log(color);
        ue.execCommand('selectall');
        ue.execCommand('forecolor', color);
        var ueHtml = ue.getContent();
        newHtml = ueHtml.replace(/color:[^>]*;/gi,"color: "+color+";");
        ue.setContent(newHtml);
    },
    hide: function() {

    }
})
/* 文字编辑 */
$(document).on("click",'.btn-text-editor',function() {
    $("#colorSpectrum2").spectrum("show")
    return false
})

/* 计算富文本图片编辑定位 */
function cal(elem) {
    var offsetTop = elem.offsetTop
    if (elem.tagName == 'IMG') {
        offsetTop += 220;
    }
    var clientHeight = elem.clientHeight
    var offsetLeft = elem.offsetLeft
    $('.image-enhance-tool-menu').css('left', offsetLeft + editorLeft + 20)
    $('.image-enhance-tool-menu').css('top', offsetTop + clientHeight + 30)
    $('.image-enhance-tool-menu').removeClass('hide')
}
/* 富文本-图片编辑-裁剪 */
$('.image-cut-tool').click(function() {
    var imgNode = ue.selection.getStart()
    $('.img-tailoring').removeClass('hide')
    $('#img').attr('src', $(imgNode).attr('src'));
    var cropper = new Cropper($('#img')[0], {
        //裁剪框的比例1/1
        aspectRatio: NaN,
        //视图模式
        viewMode: 1, //0，1-,2-,3让图片填满画布
        //开启预览效果
        preview: '.small',
        //拖拽模式
        // dragMode:'crop',//参数：move-可以移动图片和框，crop-拖拽新建框
        dragMode: 'move', //参数：move-可以移动图片和框，crop-拖拽新建框
        //在调整窗口大小时，会重新渲染cropper
        responsive: true,
        //在调整窗口大小时，恢复裁剪区
        restore: true,
        //检查图片是否为跨域图片
        checkCrossOrigin: true,
        //是否开启遮罩，将未选中的地方暗色处理
        modal: true,
        //是否显示裁剪的虚线
        guides: true,
        //将选中的区域亮色处理
        highlight: true, //默认
        //是否显示网格背景
        background: true,
        //裁剪框是否在图片的中心
        center: true,
        //当初始化的时候（是否自动显示裁剪框）.
        autoCrop: true,
        //当初始化时，裁剪框的大小与原图的比例
        autoCropArea: 0.8, //0.8是默认，1是1比1
        //是否允许移动图片
        movable: true, //默认为true
        //是否允许旋转图片(函数调用时)()
        rotatable: true,
        //是否允许翻转图片(问题)
        scalable: true,
        //是否可以缩放图片
        zoomable: true, //false为不能放大缩小
        //是否可以通过触摸的形式来放大图片(手机端)
        zoomOnTouch: true,
        //是否允许用鼠标来放大货缩小图片
        zoomOnWheel: true,
        //设置鼠标控制缩放的比例
        wheelZoomRatio: 0.2,
        //是否可以移动裁剪框
        cropBoxMovable: true, //裁剪框不动，图片动。当movable:true
        //是否可以调整裁剪框的大小，默认true
        cropBoxResizable: true,
        //设置dragMode 是否可以相互切换（条件：双击鼠标可以切换）
        toggleDragModeOnDblclick: true,
        //设置Container的w和h
        minContainerWidth: 0,
        minContainerHeight: 320,
        //设置canvas的w和h
        // canvas太大Container装不下
        minCanvasWidth: 0,
        minCanvasHeight: 0,
        //设置裁剪层
        minCropBoxWidth: 0,
        minCropBoxHeight: 100,
        //一.crop开始-过程-结束的函数
        //1.当插件准备完成时,执行此函数
        ready: function(e) {
            // alert("ready");
        },
        //2.当裁剪框开始移动的时候会执行的函数
        cropstart: function(e) {
            // console.log("start");
        },
        //3.裁剪框移动的时候会执行的函数(每一帧都会调用)
        cropmove: function(e) {
            // console.log("move");
        },
        //3.裁剪框移动结束的时候会执行的函数
        cropend: function(e) {
            // console.log("end");
        },
        //1.在裁剪框发生变化的时候会调用的函数
        crop: function(e) {
            // console.log("cropChange");
        }
    })
    $('.btn-img-tailoring').click(function() {
        var img_res = cropper.getCroppedCanvas({
            imageSmoothingQuality: 'high'
        }).toDataURL('image/png');
        if(img_res){
            //上传图片，返回路径
            $.ajax({
                url: URL+'index.php?action=upload_img',
                dataType: 'json',
                type: 'POST',
                async: false,
                data: {dataImg:img_res},
                success: function(json) {
                    if(json.code==1){
                        $('.img-tailoring').addClass('hide');
                        var html = ue.getContent();

                        html2 = html.replace(/src="[^"]*"/gi,function (match,varlue) {
                            var imgNode = ue.selection.getStart()
                            var src_str= '"'+$(imgNode).attr("src")+'"';
                            var cur_src = match.split("=")[1];
                            if(cur_src == src_str){
                                return  match.replace(/src="[^"]*"/gi,'src="'+json.msg+'"');
                            }
                        });
                        ue.setContent(html2);
                    }
                    else{
                        alert(json.msg);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    })
})
/* 富文本-图片编辑-换图 */
var currImgObj;
$('.image-replace-tool').click(function() {
    var imgNode = ue.selection.getStart()
    currImgObj = imgNode
    $('#upload2').click()
})

/* 富文本-图片编辑-边框 */
$('.image-border-tool').click(function(e) {
    if ($('.dropdown-menu').hasClass('hide')) {
        $('.dropdown-menu').removeClass('hide')
    } else {
        if (!$(e.target).hasClass('dropdown-menu') && !$(e.target).parent().hasClass('dropdown-menu')) {
            $('.dropdown-menu').addClass('hide')
        }
    }
    return false
})
/* 富文本-图片编辑-边框-加 */
$('.image-border-tool .increase-button').click(function() {
    var imgNode = ue.selection.getStart()
    var currStyle = $(imgNode).css('border');
    var border_color = $(imgNode).css('border-color');
    var value = 1
    if (!!currStyle && currStyle != 'none') {
        var arr = currStyle.split(' ')
        for (var i = 0; i < arr.length; i++) {
            if (/px*/.test(arr[i])) {
                value = arr[i].match(/[0-9]*/)
                break;
            }
        }
        value = Number(value) + 1
    }
    $(imgNode).css('border', value + 'px solid');
    $(imgNode).css('border-color', border_color);
    cal(imgNode);
})
/* 富文本-图片编辑-边框-减 */
$('.image-border-tool .decrease-button').click(function() {
    var imgNode = ue.selection.getStart()
    var currStyle = $(imgNode).css('border');
    var border_color = $(imgNode).css('border-color');
    var value = 'none'
    if (!!currStyle && currStyle != 'none') {
        var arr = currStyle.split(' ')
        for (var i = 0; i < arr.length; i++) {
            if (/px*/.test(arr[i])) {
                value = arr[i].match(/[0-9]*/)
                break;
            }
        }
        value = Number(value)
        if (value - 1 >= 0) {
            value = (value - 1) + 'px solid'
        } else {
            value = 'none'
        }
    }
    $(imgNode).css('border', value);
    $(imgNode).css('border-color', border_color);
    cal(imgNode)
})
/*富文本-图片编辑-边框颜色*/
$(".color-picker").click(function () {
    // debugger;
    $("#colorSpectrum3").spectrum("show")
    return false
});
var spectrum3 = $('#colorSpectrum3').spectrum({
    allowEmpty: true,
    color: "#ffffff",
    showInput: true,
    containerClassName: "full-spectrum",
    showInitial: true, //显示初始颜色,提供现在选择的颜色和初始颜色对比
    showPalette: true, //显示选择器面板
    showSelectionPalette: true, //记住选择过的颜色
    showAlpha: true, //显示透明度选择
    maxPaletteSize: 7, //记住选择过的颜色的最大数量
    preferredFormat: "hex",
    cancelText: "取消", //取消按钮,按钮文字
    chooseText: "选择",
    appendTo: '#colorSpectrum3',
    palette: [
        ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)", "rgb(153, 153, 153)", "rgb(183, 183, 183)",
            "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(239, 239, 239)", "rgb(243, 243, 243)", "rgb(255, 255, 255)"
        ],
        ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
            "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"
        ],
        ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
            "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
            "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
            "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
            "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
            "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
            "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
            "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
            "rgb(133, 32, 12)", "rgb(153, 0, 0)", "rgb(180, 95, 6)", "rgb(191, 144, 0)", "rgb(56, 118, 29)",
            "rgb(19, 79, 92)", "rgb(17, 85, 204)", "rgb(11, 83, 148)", "rgb(53, 28, 117)", "rgb(116, 27, 71)",
            "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
            "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"
        ]
    ],
    change: function(e) {
        borderColor = e.toRgbString()
        var imgNode = ue.selection.getStart();
        $(imgNode).css('border-color', borderColor)
        $('.border-color .sp-preview-inner').css('background-color', borderColor);
        return false;
    }
})

var margin_top=0;
/* 富文本-图片编辑-上移 */
$('.image-move-up-tool').click(function() {
    var imgNode = ue.selection.getStart()
    var parent_node = $(imgNode)[0].parentNode;
    if(parent_node.tagName=="P"){
        var marginTop = parseFloat($(parent_node).css("margin-top"));
        var newMarginTop = marginTop -5;
        $(parent_node).css("margin-top",newMarginTop+"px");
    }
    cal(imgNode);
})
/* 富文本-图片编辑-下移 */
$('.image-move-down-tool').click(function() {
    var imgNode = ue.selection.getStart()
    var parent_node = $(imgNode)[0].parentNode;
    if(parent_node.tagName=="P"){
        var marginTop = parseFloat($(parent_node).css("margin-top"));
        var newMarginTop = marginTop + 5;
        $(parent_node).css("margin-top",newMarginTop+"px");
    }
    cal(imgNode);
})

var reg = /[0-9]*/g
/* 富文本-图片编辑-圆角-加 */
$('.image-border-radius-tool .increase-button').click(function(e) {
    var imgNode = ue.selection.getStart()
    var currStyle = UE.dom.domUtils.getStyle(imgNode, 'border-radius')
    var value = 2
    if (!!currStyle) {
        value = Number(currStyle.match(reg)[0]) + 2
    }
    $(imgNode).css('border-radius', value + 'px')
})
/* 富文本-图片编辑-圆角-减 */
$('.image-border-radius-tool .decrease-button').click(function(e) {
    var imgNode = ue.selection.getStart()
    var currStyle = UE.dom.domUtils.getStyle(imgNode, 'border-radius')
    var value = 0
    if (!!currStyle) {
        var currValue = Number(currStyle.match(reg)[0])
        value = currValue - 2 > 0 ? (currValue - 2) : 0
    }
    $(imgNode).css('border-radius', value + 'px')
})


/* 富文本-图片编辑-尺寸-加 */
$('.image-scale-tool .increase-button').click(function(e) {
    var imgNode = ue.selection.getStart()
    var rate = (imgNode.width / $(imgNode)[0].parentNode.clientWidth).toFixed(3)
    rate = Number(rate);
    if(rate>=0.97)
    {
        alert("已是最大尺寸！");
    }
    else{
        if (rate + 0.03 <= 1) {
            rate += 0.03
        } else {
            rate = 1
        }

        $(imgNode).css('width', rate * 100 + '%')
        cal(imgNode)
    }
})
/* 富文本-图片编辑-尺寸-减 */
$('.image-scale-tool .decrease-button').click(function(e) {
    var imgNode = ue.selection.getStart()
    var rate = (imgNode.width / $(imgNode)[0].parentNode.clientWidth).toFixed(3)
    rate = Number(rate)
    console.log(rate);
    if(rate<=0.05){
        alert("已是最小尺寸！")
    }
    else{
        if (rate - 0.03 >= 0.05) {
            rate -= 0.03
        } else {
            rate = 0.05
        }
        $(imgNode).css('width', rate * 100 + '%')
        cal(imgNode)
    }

})

/* 富文本-图片编辑-阴影-加 */
$('.image-shadow-tool .increase-button').click(function(e) {
    var imgNode = ue.selection.getStart()
    var currStyle = UE.dom.domUtils.getStyle(imgNode, 'box-shadow')
    var value = 170
    if (!!currStyle && currStyle != 'none') {
        var currValue = currStyle.match(/\([^\)]*\)/)[0]
        currValue = Number(currValue.split(',')[1])
        if (currValue - 30 >= 0) {
            value = currValue - 30
        } else {
            value = 0
        }
    }
    $(imgNode).css('box-shadow', 'rgb(' + value + ',' + value + ',' + value + ') 0em 0em 1em 0px')
})
/* 富文本-图片编辑-阴影-减 */
$('.image-shadow-tool .decrease-button').click(function(e) {
    var imgNode = ue.selection.getStart()
    var currStyle = UE.dom.domUtils.getStyle(imgNode, 'box-shadow')
    var value = 'none'
    if (!!currStyle && currStyle != 'none') {
        var currValue = currStyle.match(/\([^\)]*\)/)[0]
        currValue = Number(currValue.split(',')[1])
        if (currValue + 30 > 170) {
            currValue = currValue
        } else {
            currValue = currValue + 30
            value = 'rgb(' + currValue + ',' + currValue + ',' + currValue + ') 0em 0em 1em 0px'
        }
    }
    $(imgNode).css('box-shadow', value)
})

/* 富文本-图片编辑-顺时针旋转 */
$(".clockwise-btn").click(function () {
    var imgNode = ue.selection.getStart();
    var deg = $(imgNode)[0].style.transform;
    var num_arr = deg.match(/[0-9]/g);
    var  char = deg.match(/-/g);//减号
    var num=0;
    if(num_arr && num_arr.length==1){
        num = parseInt(num_arr[0]);
    }
    else if(num_arr && num_arr.length == 2){
        num = parseInt(num_arr[0])*10 +parseInt(num_arr[1])
    }
    else if(num_arr && num_arr.length == 3){
        num = parseInt(num_arr[0])*100 +parseInt(num_arr[1])*10+parseInt(num_arr[2]);
    }
    if(char)
        num = -num;
    num += 10;
    if(num>360){
        num = num%360;
    }
    $(imgNode).css("transform","rotate("+num+"deg)")
});
/* 富文本-图片编辑-逆时针旋转 */
$(".anticlockwise-btn ").click(function () {
    var imgNode = ue.selection.getStart();
    var deg = $(imgNode)[0].style.transform;
    var num_arr = deg.match(/[0-9]/g);
    var  char = deg.match(/-/g);//减号
    var num=0;
    if(num_arr && num_arr.length==1){
        num = parseInt(num_arr[0]);
    }
    else if(num_arr && num_arr.length == 2){
        num = parseInt(num_arr[0])*10 +parseInt(num_arr[1])
    }
    else if(num_arr && num_arr.length == 3){
        num = parseInt(num_arr[0])*100 +parseInt(num_arr[1])*10+parseInt(num_arr[2]);
    }
    if(char)
        num = -num;
    num -= 10;
    if(num<-360){
        num = num%360;
    }
    $(imgNode).css("transform","rotate("+num+"deg)")
});

/* 展开关闭全文过滤 */
$(document).on("click",".ya-article-style-settings",function (e) {
    var className = $(".text-filter-box")[0].className;
    if(className == "text-filter-box hide")
        $(".text-filter-box").removeClass("hide");
    else
        $(".text-filter-box").addClass("hide");
});

/* 全文过滤-复选框点击 */
var filterArr = []
$(document).on('click', '.text-filter-box .operation-list li', function(){
    var index = $(this).index();
    if($(this).find('.check-box').hasClass('checked-icon')){
        for(var i = 0; i < filterArr.length; i++){
            if(filterArr[i] == index){
                filterArr.splice(i, 1)
                break;
            }
        }
        $(this).find('.check-box').removeClass('checked-icon')
    }else{
        filterArr.push(index)
        $(this).find('.check-box').addClass('checked-icon')
    }
})
/* 全文过滤-单选框点击 */
var radio = [{isSelect:0,type:null},{isSelect:0,type:null},{isSelect:0,type:null}];
$(document).on('click', '.text-filter-box .radio-item', function(e){
    var index = parseInt(e.currentTarget.dataset.index);//0=>文字对齐，1=>图片浮动，2=>符号转换
    var type = parseInt(e.currentTarget.dataset.type);
    if($(this).find('.check-box-2').hasClass('checked')){
        radio[index].isSelect = 0;
        radio[index].type = null;
        $(this).find('.check-box-2').removeClass('checked')
    }else{
        //选中
        radio[index].isSelect = 1;
        radio[index].type = type;
        $(this).parent().find('.check-box-2').removeClass('checked')
        $(this).find('.check-box-2').addClass('checked')
    }
    console.log(radio);
})
/* 全文过滤-全文执行 */
$(document).on('click', '.text-filter-box .btn-text-filter', function(){
    ueHtml = ue.getContent();
    var is_clear_color = false; //是否全文清除颜色
    var is_text_align = false; //是否全文调整文字对齐
    var text_align = ""; //文字对齐
    if(!!ueHtml){
        var newHtml = ueHtml;
        var newStyle = ''
        var regArr = [/<p\b[^<>]*>.*?<\/p>/gi, /<a\b[^<>]*>.*?<\/p>/gi, /<span\b[^<>]*>.*?<\/span>/gi, /<div\b[^<>]*>.*?<\/div>/gi, /<button\b[^<>]*>.*?<\/button>/gi]
        for(var i = 0; i < filterArr.length; i++){
            if(filterArr[i] == 0){//合并空行
                // newHtml = newHtml.replace(/<p><br\/><\/p>/g,"");
                newHtml = newHtml.replace(/<p[^>]*>.*?<\/p>/gi, function(match, capture) {
                    if(/<br\/>/.test(match)){
                        match = match.replace(/<p[^>]*>.*?<\/p>/gi,"");
                    }
                    return match
                })

            }
            if(filterArr[i] == 1){//清除缩进
                for(var j = 0; j < regArr.length; j++){
                    newHtml = newHtml.replace(regArr[j], function(match, capture) {
                        match = match.replace(/style="[^"]+"/gi, function(match, capture) {
                            match = match.replace(/text-indent:[^;]*;/gi, '')
                            return match
                        })
                        return match
                    })
                }
            }
            if(filterArr[i] == 2){//清除字号
                for(var j = 0; j < regArr.length; j++){
                    newHtml = newHtml.replace(regArr[j], function(match, capture) {
                        match = match.replace(/style="[^"]+"/gi, function(match, capture) {
                            match = match.replace(/font-size:[^;]*;/gi, '');
                            return match
                        })
                        return match
                    })
                }
            }
            if(filterArr[i] == 3){//清除字体
                for(var j = 0; j < regArr.length; j++){
                    newHtml = newHtml.replace(regArr[j], function(match, capture) {
                        match = match.replace(/style="[^"]+"/gi, function(match, capture) {
                            match = match.replace(/font-family:[^;]*;/gi, '')
                            return match
                        })
                        return match
                    })
                }
            }
            if(filterArr[i] == 4){//清除粗体
                for(var j = 0; j < regArr.length; j++){
                    newHtml = newHtml.replace(regArr[j], function(match, capture) {
                        match = match.replace(/style="[^"]+"/gi, function(match, capture) {
                            match = match.replace(/font-weight:[^;]*;/gi, '')
                            return match
                        })
                        return match
                    })
                }
                newHtml = newHtml.replace(/<strong[^>]*>/gi, '');
                newHtml = newHtml.replace(/<\/strong[^>]*>/gi, '');
            }
            if(filterArr[i] == 5){//清除颜色
                is_clear_color = true;
                newHtml = newHtml.replace(/color:[^>]*;/gi,"color: rgb(0,0,0);")
            }
            if(filterArr[i] == 6){//清除图片
                newHtml = newHtml.replace(/<img[^>]*>/gi, '');
            }
            // if(filterArr[i] == 7){//清除图片链接
            //
            // }
            // if(filterArr[i] == 8){//清除小程序链接

            // }
        }
        if(radio[0].isSelect){//文字对齐
            if(radio[0].type == 0){//左对齐
                newStyle = 'text-align: left;';
            }else if(radio[0].type == 1){//居中
                newStyle = 'text-align: center;';
            }else if(radio[0].type == 2){//右对齐
                newStyle = 'text-align: right;';
            }
            for(var j = 0; j < regArr.length; j++){
                newHtml = newHtml.replace(regArr[j], function(match, capture) {
                    if(!/<img[^>]*>/gi.test(match)){ //如果不是图片标签
                        if(/style="[^"]+"/gi.test(match)){
                            match = match.replace(/style="[^"]+"/gi, function(match, capture) {
                                match = match.replace(/text-align:[^;]*;/gi, '')
                                match = match.slice(0, -1) + newStyle + match.slice(-1)
                                return match
                            })
                        }
                        else{
                            match =  match.replace(/<p>/,'<p style="'+newStyle+'">')
                        }
                    }
                    return match
                })
            }
        }
        if(radio[1].isSelect){//图片浮动
            if(radio[1].type == 0){//左对齐
                newStyle = 'text-align: left;'
            }else if(radio[1].type == 1){//居中
                newStyle = 'text-align: center;'
            }else if(radio[1].type == 2){//右对齐
                newStyle = 'text-align: right;'
            }
            for(var j = 0; j < regArr.length; j++){
                newHtml = newHtml.replace(regArr[j], function(match, capture) {
                    if(/<img[^>]*>/gi.test(match)){ //如果是图片
                        if(/style="[^"]+"/gi.test(match)){
                            match = match.replace(/style="[^"]+"/gi, function(match, capture) {
                                match = match.replace(/text-align:[^;]*;/gi, '')
                                match = match.slice(0, -1) + newStyle + match.slice(-1)
                                return match
                            })
                        }
                        else{
                            match =  match.replace(/<p>/,'<p style="'+newStyle+'">')
                        }
                    }
                    return match
                })
            }
        }
        if(radio[2].isSelect){//符号转换
            for(var j = 0; j < regArr.length; j++){
                newHtml = newHtml.replace(regArr[j], function(match, capture) {
                    var str_arr = match.match(/>[^*]+</gi);
                    if(str_arr){
                        var text_arr1 = str_arr[0].split(">");
                        var text_arr2 = text_arr1[1]?text_arr1[1].split("<"):"";
                        var text = text_arr2[0]?text_arr2[0]:""; //文本内容

                        var new_text = "";
                        if(text && radio[2].type==0){
                            //全角转半角
                            new_text = ToCDB(text);
                        }
                        else if(text && radio[2].type==1){
                            var text_half = text.match(/[a-zA-Z][\x21-\x2f\x3a-\x40\x5b-\x60\x7B-\x7F]/) //匹配半角英文字符
                            new_text = ToDBC(text);
                        }
                        if(new_text)
                            match = match.replace(/>[^*]+</gi,">"+new_text+"<");
                    }
                    return match
                })
            }
        }
        ue.setContent(newHtml)
        // if(is_clear_color){
        //     ue.execCommand('selectall');
        //     ue.execCommand('forecolor', "rgb(0,0,0)");
        // }
        $(".text-filter-box").addClass("hide");
    }
})
/* 半角转全角 */
function ToDBC(txtstring) {
    var tmp = "";
    for (var i = 0; i < txtstring.length; i++) {
        if (txtstring.charCodeAt(i) == 32) {
            tmp = tmp + String.fromCharCode(12288);
        }else if (txtstring.charCodeAt(i) < 127) {
            tmp = tmp + String.fromCharCode(txtstring.charCodeAt(i) + 65248);
        }
    }
    return tmp;
}
/* 全角转半角 */
function ToCDB(str) {
    var tmp = "";
    for (var i = 0; i < str.length; i++) {
        if (str.charCodeAt(i) > 65248 && str.charCodeAt(i) < 65375) {
            tmp += String.fromCharCode(str.charCodeAt(i) - 65248);
        }
        else {
            tmp += String.fromCharCode(str.charCodeAt(i));
        }
    }
    return tmp
}
