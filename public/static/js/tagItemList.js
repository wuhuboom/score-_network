(function () {

    $("body").on("click", '.tagNav-a', function () {
        var moveX = $(this).position().left + $(this).parent().scrollLeft();
        var pageX = document.documentElement.clientWidth;
        var blockWidth = $(this).width();
        var left = moveX - (pageX / 2) + (blockWidth / 2);
        $(".tagNav-list").animate({
            scrollLeft: left,
        });
        // $(this).addClass("selected").siblings().removeClass("selected");
        $(".tagNav-a").removeClass("selected");
        $(this).addClass("selected");
    });


    $("#tagNav .tagNav-list>div").each(function (index) {
        $(this).click(function () {
            $(".activate_list").removeClass("activate_list");
            $("#typeList>div").eq(index).addClass("activate_list");
            sessionStorage.setItem("tagNavStamp_Home", index);
        });
    });


})();
