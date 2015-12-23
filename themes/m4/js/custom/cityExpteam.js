$('#btn_t_ts_expert1').tap(function () {
    var titleName = $('.titleName').html();
    var cityName = $('.cityTitle').html();
    var cityId = $('.cityTitle').attr('data-city');
    var dptName = $('.dptTitle').html();
    var dptId = $('.dptTitle').attr('data-dpt');

    var url = getUrl();

    //取得连接地址
    $urlExpertteam = $('#urlExpertteam').html();
    $urlDoctor = $('#urlDoctor').html();
    J.popup({
        html: '<div class="cityover-list">' +
                '<header class="head-title" style="height:88px;">' +
                '<div class="grid vertical title" style="height:90px;">' +
                '<div class="col-0 h40p color-green">' + titleName +
                '</div>' +
                '<div class="col-1" >' +
                '<div class="grid" >' +
                '<div class="col-0 w50 cityover-btn" style="border:1px solid #19aea5;">' +
                '<a id="btn_t_ts_expert cityTitle" data-target="closePopup" data-city="' + cityId + '">' +
                '<div>' +
                '<span style="color:#19aea5;">' + cityName + '</span>&nbsp' +
                '<img src="../../themes/m4/images/image/team_list.png">' +
                '</div>' +
                '</a>' +
                '</div>' +
                '<div class="col-0 w50 cityover-btn" style="border:1px solid #19aea5;">' +
                '<a class="btn_t_top dptTitle" data-target="closePopup" data-dpt="' + dptId + '">' +
                '<div>' +
                '<span style="color:#19aea5;width:100%">' + dptName + '</span>&nbsp' +
                '<img src="../../themes/m4/images/image/team_list.png">' +
                '</div>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</header>' +
                '<article id="city" class="active">' + $cityHtml +
                '</article>' +
                '</div>',
        pos: 'top',
        showCloseBtn: false
    });
    $(".province").click(function () {
        var id = $(this).attr('data-city');
        $('.province').each(function () {
            if (id == $(this).attr('data-city')) {
                $(this).addClass('bg-white');
            } else {
                $(this).removeClass('bg-white');
            }
        });
        $('.cityList').each(function () {
            if (id == $(this).attr('data-city')) {
                $(this).css('display', 'block');
            } else {
                $(this).css('display', 'none');
            }
        });
    });

    $(".city").click(function (e) {
        e.preventDefault();
        $cityId = $(this).attr("data-city");
        $cityName = $(this).html();
        $dptId = $(".dptTitle").attr("data-dpt");
        var requestUrl = "";
        //明星团队和合作医院不同
        if (titleName == "明星团队") {
            requestUrl = $urlExpertteam + "?appv=15&api=5&city=" + $cityId;
        } else {
            requestUrl = $urlDoctor + "?appv=15&api=4&city=" + $cityId;
        }
        //科室为全部时，不添加cate参数
        if ($dptId != '') {
            requestUrl += "&cate=" + $dptId;
        } else {
            requestUrl += "";
        }
        J.closePopup();
        $.ajax({
            url: requestUrl,
            success: function (data) {
                //console.log(data);
                readyPage(data);
            }
        });
    });
});
