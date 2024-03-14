var regular_Email = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/;
var regular_Phone = /^\d{9}|\d{10}$/;
var areaCode = '+66';
function jumpLink(u, t) {
    switch (t) {
        case 0:
            window.open(u, "_top", "noreferrer");
            break;
        case 1:
            window.open(u, "_top");
            break;
        case 2:
            window.location.open = u
            break;
        case 3:
            window.location.href = u;
            break;
        case 4:
            window.location.replace(u)
            break;
        default:
            window.location.href = u;
            break;
    }
}

function GetRequest() {
    var url = location.search;
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("?");
        console.log(strs)
        for (var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = decodeURIComponent(strs[i].split("=")[1]);
        }
    }
    return theRequest;
}

function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return (r[2]);
    return null;
}

function isIos() {
    if (window.navigator.userAgent.match(/(iPhone|iPod|ios|iPad)/i)) {
        return true // ios
    } else {
        return false // 其他
    }
}

function isApp() {
    return false;
}

function openInSystemBrowser(url) {
    if (isApp()) {
        if (typeof BSL != "undefined") {
            BSL.OpenBrowser("callbackTemp", "SYS", url);
        } else if (typeof window.parent.BSL != "undefined") {
            window.parent.BSL.OpenBrowser("callbackTemp", "SYS", url);
        } else {
            window.open(url, '_blank')
        }
    } else {
        window.open(url, '_blank')
    }
}

function copyright() {
    var copyright = $("body .app");
    var copyrightHtml = '';
    copyrightHtml += `    
    <div class="trademarkCopyright">
        <div class="trademark">
            <img src="./../images/logo.svg" alt="" />
        </div>
        <div class="copyright">
            <p>© 2021, All rights Reserved.</p>            
        </div>
    </div>
    `
    copyright.append(copyrightHtml);
}

// 金额格式化
const moneyFormat = (num, decimal = 2, split = ',') => {
    /*
        parameter：
        num：格式化目标数字
        decimal：保留几位小数，默认2位
        split：千分位分隔符，默认为,
        moneyFormat(123456789.87654321, 2, ',') // 123,456,789.88
    */
    function thousandFormat(num) {
        const len = num.length
        return len <= 3 ? num : thousandFormat(num.substr(0, len - 3)) + split + num.substr(len - 3, 3)
    }
    if (isFinite(num)) { // num是数字
        if (num === 0) { // 为0
            return num.toFixed(decimal)
        } else { // 非0
            var res = ''
            var dotIndex = String(num).indexOf('.')
            if (dotIndex === -1) { // 整数
                res = thousandFormat(String(num)) + '.' + '0'.repeat(decimal)
            } else { // 非整数
                // js四舍五入 Math.round()：正数时4舍5入，负数时5舍6入
                // Math.round(1.5) = 2
                // Math.round(-1.5) = -1
                // Math.round(-1.6) = -2
                // 保留decimals位小数
                const numStr = String((Math.round(num * Math.pow(10, decimal)) / Math.pow(10, decimal)).toFixed(decimal)) // 四舍五入，然后固定保留2位小数
                const decimals = numStr.slice(dotIndex, dotIndex + decimal + 1) // 截取小数位
                res = thousandFormat(numStr.slice(0, dotIndex)) + decimals
            }
            return res
        }
    } else {
        return num
    }
}

function getfixed_B_H(name) {
    var fixed_B_H = $(name).height() + 10;
    $(".fixed_bottomStance").css({ 'height': fixed_B_H + 'px' })
}

//NAV ScrollTo
function isScrollTo() {
    var header = $(".isScrollTo");
    var offSet = header.offset().top;
    $(window).scroll(function () {
        if ($(window).scrollTop() > offSet) {
            header.removeClass('noColor');
        } else {
            header.addClass('noColor');
        }
    })
}

function timeFormat(d, u) { 
    var timeValue;
    var parsedDate = new Date(d);
    switch (u) {
        case 'y':
            timeValue = parsedDate.getFullYear();
            break;
        case 'm':
            timeValue = parsedDate.getMonth() + 1;
            break;
        case 'd':
            timeValue = parsedDate.timeValue();
            break;
        case 'h':
            timeValue = parsedDate.getHours();
            break;
        case 'min':
            timeValue = parsedDate.getMinutes();
            break;
        case 's':
            timeValue = parsedDate.getSeconds();
            break;
        default:
            console.log('---')
            break;
    }

    return timeValue
}

var count = 180;
var interValObj;
var curCount;

function securityCode(mobile, sms_type) {
    if (curCount > 0) {
        return false
    }

    curCount = count;

    if (!regular_Phone.test(mobile) && ct == 1) {
        toast('', 'Not a valid phone number', 'noCode', 2000, 1);
        return false;
    }

    if (mobile !== "" && sms_type !== "") {
        _api.sendSMS(mobile, sms_type, res => {
            if (res.code === 0) {
                $("#getCode").addClass("parclose");
                $("#getCode p").text(+curCount + "s");
                interValObj = window.setInterval(SetRemainTime, 1000);
                toast('', res.msg, 'noCode', 2000, 2);
            } else {
                toast('', res.msg, 'noCode', 2000, 1);
            }
        });
    } else {
        toast('', 'Fail to send verification code.', 'noCode', 2000, 1);
    }
}

function SetRemainTime() {
    if (curCount === 0) {
        window.clearInterval(interValObj);
        $("#getCode").removeClass("parclose");
        $("#getCode p").text("Send Again");
    } else {
        curCount--;
        $("#getCode p").text(curCount + "s Resend");
    }
}

$(document).ready(function () {
    var headerName = $(document).attr('title');
    $("#header h2").text(headerName);
    $('#areaCode').html(areaCode);
});
