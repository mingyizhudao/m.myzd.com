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

//disabledBtn
function disabledBtn(btnSubmit) {
    //J.showMask();
    btnSubmit.attr("disabled", true);
}
//enableBtn
function enableBtn(btnSubmit) {
    //J.hideMask();
    btnSubmit.removeAttr("disabled");
}
//disabledBtn
function disabledBtnAndriod(btnSubmit) {
    $('#loading_popup.loading').show();
    btnSubmit.attr("disabled", true);
}
//enableBtn
function enableBtnAndriod(btnSubmit) {
    $('#loading_popup.loading').hide();
    btnSubmit.attr("disabled", false);
}