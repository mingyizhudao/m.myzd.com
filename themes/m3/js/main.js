$(document).ready(function () {
    $.mobile.page.prototype.options.domCache = true;
    initPage();
    initHeader();
});


//Update the contents of the toolbars.
$(document).on("pagecontainerchange", function () {

    //handle 'back' btn in header.
    if ($(".ui-page-active").attr("data-add-back-btn") == "true") {
        // console.log(($(".ui-page-active").attr("id")));
        $("[data-role='header'] a.ui-toolbar-back-btn").show();
    } else {
        //console.log("remove");
        $("[data-role='header'] a.ui-toolbar-back-btn").hide();
    }

    initHeader();

    // Remove active class from nav buttons
    $("[data-role='navbar'] a.ui-btn-active").removeClass("ui-btn-active");
    // Add active class to current nav button.
    var navRelId = $(".ui-page-active").jqmData("nav-rel");
    $("[data-role='navbar'] " + navRelId).addClass("ui-btn-active");


    /*
     // Remove active class from nav buttons
     $("[data-role='navbar'] a.ui-btn-active").removeClass("ui-btn-active");
     // Add active class to current nav button.
     $("[data-role='navbar'] a").each(function(){
     if($(this).text()===pageTitle){
     $(this).addClass("ui-btn-active");
     }
     } );
     */
});


function initPage() {
    //$("[data-role='navbar']").navbar();
    $("[data-role='header'],[data-role='footer']").toolbar({
        // theme:"a"
    });
}

function initHeader() {
    // header title.
    var pageTitle = $(".ui-page-active").jqmData("title");
    var isHome = $(".ui-page-active").jqmData("home");

    if (isHome == true) {
        $("[data-role='header']").addClass("home-header");
        //  $("[data-role='header'] .ui-title").text(" ");
    } else {
        $("[data-role='header']").removeClass("home-header");
        // $("[data-role='header'] .ui-title").text(pageTitle);
    }
    $("[data-role='header'] .ui-title").text(pageTitle);

}

function buttonTimerStart(domBtn, timer) {
    timer = timer / 1000 //convert to second.
    var interval = 1000;
    var timerTitle = '秒后重发';
    domBtn.attr("disabled", true);
    domBtn.html(timer + timerTitle);

    timerId = setInterval(function () {
        timer--;
        if (timer > 0) {
            domBtn.html(timer + timerTitle);
        } else {
            clearInterval(timerId);
            timerId = null;
            domBtn.html("重新发送");
            domBtn.attr("disabled", false);
        }
    }, interval);
}

// show jquery.mobile popup
function showErrorPopup(msg, selector, trigger) {
    $(selector).html(msg);
    $(trigger).trigger("click");
}

//disabledBtn
function disabledBtn(btnSubmit) {
    $(".ui-loader").show();
    btnSubmit.attr("disabled", true);
}
//enableBtn
function enableBtn(btnSubmit) {
    $(".ui-loader").hide();
    btnSubmit.attr("disabled", false);
}