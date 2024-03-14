let footerNavJson = [
    { linkType: "0", iconSrc: "", icon: "icon-trend-up", title: "บ้าน", url: "./index.html?ip=home", className: "homeNav", nameAttr: "home" },
    { linkType: "0", iconSrc: "", icon: "icon-message-text", title: "กระดานข้อความ", url: "./index.html?ip=forum", className: "MBoardNav", nameAttr: "forum" },
    { linkType: "0", iconSrc: "", icon: "icon-ticket", title: "คำเชิญ", url: "./index.html?ip=invite", className: "inviteNav", nameAttr: "invite" },

    // { linkType: "0", iconSrc: "", icon: "icon-crowdfunding", title: "Task", url: "./index.html?ip=taskHall", className: "taskHallNav", nameAttr: "taskHall" },
    { linkType: "0", iconSrc: "", icon: "icon-medal", title: "ห้องโถงภารกิจ", url: "./index.html?ip=taskHall", className: "taskHallNav", nameAttr: "taskHall" },
    { linkType: "0", iconSrc: "", icon: "icon-money-safe", title: "บัญชี", url: "./index.html?ip=account", className: "accountNav", nameAttr: "account" },
]
var navUrlName = ''
$(document).ready(function () {
    var footerNav = $("body.indexPage");
    var footerNavBoxHtml = '';
    var footerNavHtml = '';
    $.each(footerNavJson, function (index, item) {
        footerNavHtml += `<li name=` + item.nameAttr + ` class="flex1 ` + item.className + `" onclick="locationPage('` + item.nameAttr + `')">`

        footerNavHtml += `
        <div class="">
            <div class="icon display alignCenter justifyCenter">        
                <i class="iconfont `+ item.icon + `"></i>
            </div>
            <p>` + item.title + `</p>
        </div>`
        footerNavHtml += `</li>`;
    });
    footerNavBoxHtml += `<footer class="footer h5MaxWidth" id="footer">
        <div class="footer-nav">
            <div>
                <ul class="display alignCenter">` + footerNavHtml + `</ul>    
            </div>      
        </div>
    </footer>`
    footerNav.append(footerNavBoxHtml);
    navUrlName = sessionStorage.getItem('navSessionName')
    locationPage(navUrlName)
});

function locationPage(navName) {
    navName = navName ? navName : 'home';
    sessionStorage.setItem("navSessionName", navName);
    navName = navName ? navName : 'home';
    $('.footer-nav ul li').removeClass("active");
    $(".footer-nav [name=" + navName + "]").addClass("active");
    const renderIframe = `<iframe id="iframe" src="./pages/` + navName + `.html" frameborder="0" width="100%"></iframe>`
    $("#iframeBox").html(renderIframe)
    $("#iframe").attr("height", $(window).height())
    //$('#iframeBox').attr('src', './' + navName + '.html?v=1.4');
    // $(window.parent.document).find("#iframeBox").attr("src", './' + navName + '.html?v=1.4');
    // document.title = navName;

}