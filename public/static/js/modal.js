function prompt(title, html, sort, ifroundOff = '0', location = '0') {
    let promptHtml = "";
    promptHtml += `<div class="promptBox display alignCenter location_` + location + `" id="promptSort_` + sort + `">`;
    promptHtml += `<div class="overallShade"></div>`;
    promptHtml += `<div class="promptCont et-02s radius15PX">`;
    if (ifroundOff == "1") promptHtml += `<div class="roundOff radius50P display alignCenter justifyCenter"><i class="icon-cross iconfont"></i></div>`;
    promptHtml += html;
    promptHtml += `</div>`;
    promptHtml += `</div>`;
    $('body').append(promptHtml);
}

function removePrompt(sort) {
    $('#promptSort_' + sort).remove();
    // $('.promptBox').remove();
}

$(document).on("click", ".roundOff", function () {
    $(this).parent().parent('.promptBox').remove();
})

//iconID 1:warning  2:succeed   3:error  4:loding
function toast(title, html, sort, holdTime, iconID) {
    $('.toastBox').remove();
    let toastHtml = "";
    if (iconID == 4) {
        toastHtml += `<div class="toastBox toastStatus` + iconID + `  display alignCenter" id="toastSort_` + sort + `">`;
        toastHtml += `<div class="overallShade"></div>`;
        toastHtml += `<div class="toastCont radius7PX">`;
        toastHtml += `<div class="loader display alignCenter justifyCenter"> <img src="./../images/lodingIcon.svg" alt="" /></div>`;
        toastHtml += `</div>`;
        toastHtml += `</div>`;
    } else {
        toastHtml += `<div class="toastBox toastStatus` + iconID + `  display alignStart" id="toastSort_` + sort + `">`;
        toastHtml += `<div class="overallShade"></div>`;
        toastHtml += `<div class="toastCont bounceInDown et-02s display alignStart">`;
        // toastHtml += `<div class="icon"><i class="iconfont icon-StatusIcon` + iconID + `"></i></div>`;
        toastHtml += `<div class="tipText flex1"><p>` + html + `</p></div>`;
        toastHtml += `</div>`;
        toastHtml += `</div>`;
    }

    $('body').append(toastHtml);
    if (holdTime != "") { removeToast(sort, holdTime) }
};

function removeToast(sort, holdTime = 500) {
    window.setTimeout(function () {
        $('#toastSort_' + sort).remove();
    }, holdTime);
}

// e=0 riseBox ， e=1 slideBox  tx：Title
function UPDownBox(html, idName, e = 0, tx = '', closeTXT) {
    let UPDownBoxHtml = ""
    let effect = e == 0 ? 'riseBox' : 'slideBox'
    UPDownBoxHtml += `<div class="UPDownBox ` + effect + `" id="UPDownBox_` + idName + `">
    <div class="overallShade"></div>
    <div class="container h5MaxWidth">
        <div class="boxTitle display alignCenter justifyEnd">

            <div class="title flex1"><p>`+ tx + `</p></div>

    <div class="closeUPDownBox">`

    if (closeTXT) {
        UPDownBoxHtml += `<p>` + closeTXT + `</p>`
    } else {
        UPDownBoxHtml += `<i class="icon-cross iconfont"></i>`
    }

    UPDownBoxHtml += `</div>
    </div>
        <div class="content">
           `+ html + `
        </div>
    </div>
    </div>`
    $('body').append(UPDownBoxHtml);

    $(document).on("click", ".closeUPDownBox, .cancelBtn", function () {
        console.log($("#UPDownBox_" + idName))
        if (idName) {
            $("#UPDownBox_" + idName).remove();
        } else {
            $(".UPDownBox").remove();
        }
    })
}

// ---/


function pushMessage(tipText, n) {
    let MessageHtml = ""
    MessageHtml += `
        <div class="pushMessage"> 
        <div class="tipText length-limit-10" style="-webkit-line-clamp: `+ n + `;">` + tipText + `</div>       
        </div>
    `
    prompt("", MessageHtml, "pushMessage", '1');
}


function awarding(imgsrc, reward, explain) {
    let awardingHtml = ""
    awardingHtml += `
        <div class="awardingBox">         
            <img src="`+ imgsrc + `" alt="" />   
            <div class="hipe">
                <h3>`+ reward + `</h3>
                <p>`+ explain + `</p>
            </div>
            <div class="actionBar display alignCenter alignStretch justifyCenter"> 
                <div class="take clickBtn_S display alignCenter justifyCenter" onclick="removePrompt('awardingBox')">Take</div>
            </div>
        </div>
    `
    prompt("", awardingHtml, "awardingBox", '0');
}
