//请求URL
layui.define(['jquery'], function (exports) {
    var $ = layui.jquery
    var api = {};

    $.ajaxSettings.async = false
    var token = layui.data('nepadmin')['token']

    $.ajax({
        type: "POST",
        url:  '/admin/auths/getApiList',
        data:{},
        headers:{'Token':token},
        processData: false,
        // beforeSend: function (xhr) {
        //     xhr.setRequestHeader("Token", layui.data['token']);
        // },
        success: function (data) {
            api = data.result
            layui.data('nepadmin', {
                key: 'api'
                ,value: data.result
            });
        }
    });
    // $.post("/admin/auths/getApiList", [], function(result) {
    //     api = result.result
    // },"json");
    $.ajaxSettings.async = true;
    exports('api',api)
    // exports('api', {
    //     Index: 'index/index',
    //     login: 'login/login',
    //     updatePassword:'login/updatePassword',
    //     getMenu: 'auths/get_menu',
    //     getGoods: 'json/goods.js',
    //     //数据统计
    //     getTodayChart: 'chart/getTodayChart',
    //     getArticleRank: 'chart/getArticleRank',
    //     getDayChart:'chart/getDayChart',
    //     getMonthChart:'chart/getMonthChart',
    //     getTableChart:'chart/getTableChart',
    //     // 权限管理
    //     getAuthList: 'auths/get_tree_list',
    //     saveAuthList: 'auths/save_tree_list',
    //     addAuth: 'auths/add',
    //     getAllAuth: 'auths/getAll',
    //     // 角色管理
    //     addRole: 'roles/add',
    //     getAllRole: 'roles/getAll',
    //     getRoleInfo: 'roles/getOne',
    //     ediRole: 'roles/update',
    //     delRole: 'roles/delete',
    //     // 系统管理
    //     clearCache: 'system/clearCache',
    //     showCache: 'system/showCache',
    //     //轮播图管理
    //     getBannerList:'banner/lists',
    //     addBanner:'banner/add',
    //     editBanner:'banner/edit',
    //     delBanner:'banner/del',
    //     getAllBanner:'banner/all',
    //     impBanner:'banner/imp',
    //
    //     //用户管理
    //     getSalesmanList:'salesman/lists',
    //     addSalesman:'salesman/add',
    //     editSalesman:'salesman/edit',
    //     delSalesman:'salesman/del',
    //     uploadSalesman:'salesman/upload',
    //     getAllSalesman:'salesman/all',
    //
    //     //全部作者
    //     getAllAdmins:'admins/all',
    //     getAdminsList:'admins/lists',
    //     addAdmins:'admins/add',
    //     editAdmins:'admins/edit',
    //     delAdmins:'admins/del',
    //     getMyInfo:'admins/info',
    //     bindAgent:'admins/bindAgent',
    //
    //     //课程管理
    //     getArticleList:'article/lists',
    //     addArticle:'article/add',
    //     editArticle:'article/edit',
    //     delArticle:'article/del',
    //     doArticleStatus:'article/doStatus',
    //     getArticle:'article/getVideo',
    //     getAllArticle:'article/getAll',
    //     sortArticle:'article/sortArticle',
    //     //课程视频管理
    //     getVideoList:'video/lists',
    //     addVideo:'video/add',
    //     editVideo:'video/edit',
    //     delVideo:'video/del',
    //     sortVideo:'video/sortVideo',
    //     doVideoStatus:'video/doStatus',
    //     //课程评论
    //     getCommentList:'comment/lists',
    //     addComment:'comment/add',
    //     editComment:'comment/edit',
    //     delComment:'comment/del',
    //     doCommentStatus:'comment/doStatus',
    //     replyComment:'comment/reply',
    //
    //     //试题管理
    //     getSubjectList:'subject/lists',
    //     addSubject:'subject/add',
    //     editSubject:'subject/edit',
    //     delSubject:'subject/del',
    //     doSubjectStatus:'subject/doStatus',
    //     //试题管理
    //     getPaperList:'paper/lists',
    //     addPaper:'paper/add',
    //     editPaper:'paper/edit',
    //     delPaper:'paper/del',
    //     getMyPaperSubject:'paper/getMyPaperSubject',
    //     getPaperSubject:'paper/getPaperSubject',
    //     addPaperSubject:'paper/addSubject',
    //     sortPaperSubject:'paper/sortSubject',
    //     delPaperSubject:'paper/delSubject',
    //     getAllPaper:'paper/getAll',
    //     //考试管理
    //     getExamList:'exam/lists',
    //     addExam:'exam/add',
    //     editExam:'exam/edit',
    //     delExam:'exam/del',
    //     getExamSubject:'exam/getExamSubject',
    //
    //
    //
    //
    //     //订单管理
    //     getOrderList:'order/lists',
    //     getOrderDetails:'order/details',
    //     delOrder:'order/del',
    //     sendOrder:'order/send',
    //     finishOrder:'order/finish',
    //     refundOrder:'order/refund',
    //
    //     //公告管理
    //     getNoticeList:'notice/lists',
    //     addNotice:'notice/add',
    //     editNotice:'notice/edit',
    //     delNotice:'notice/del',
    //
    //     //系统配置
    //     getSystem:'system/getSystem',
    //     saveSystem:'system/saveSystem',
    //     saveEmail:'system/saveEmail',
    //     sendMessageTest:'system/sendMessageTest',
    //     //链路最终
    //     getTracker:'tracker/lists',
    //     //邮件消息管理
    //     getMessage:'message/lists',
    //     sendMessage:'message/send',
    //     //订单异步通知消息
    //     getNotify:'notify/lists',
    //     sendNotify:'notify/send',
    // });
});