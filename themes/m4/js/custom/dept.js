$('.btn_t_top').tap(function () {
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
                '<div class="col-0 h40p color-green">' +
                titleName +
                '</div>' +
                '<div class="col-1" >' +
                '<div class="grid" >' +
                '<div class="col-0 w50 cityover-btn" style="border:1px solid #19aea5;">' +
                '<a id="btn_t_ts_expert cityTitle" data-target="closePopup" data-city="' + cityId + '">' +
                '<div>' +
                '<span class="color-green">' + cityName + '</span>&nbsp' +
                '<img src="../../themes/m4/images/image/team_list.png">' +
                '</div>' +
                '</a>' +
                '</div>' +
                '<div class="col-0 w50 cityover-btn" style="border:1px solid #19aea5;">' +
                '<a class="btn_t_top dptTitle" data-target="closePopup" data-dpt="' + dptId + '">' +
                '<div>' +
                '<span class="color-green">' + dptName + '</span>&nbsp' +
                '<img src="../../themes/m4/images/image/team_list.png">' +
                '</div>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</header>' +
                '<article id="a1" class="active" data-scroll="true">' +
                '<div>' +
                '<ul class="list1" style="margin-top:42px">' +
                '<li>' +
                '<a data-target="link">' +
                '<div class="dpt color-black" data-dpt="" style="width:100%">全部</div>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a data-target="link">' +
                '<div class="dpt color-black" data-dpt="1" style="width:100%">外科</div>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a data-target="link">' +
                '<div class="dpt color-black" data-dpt="2" style="width:100%">骨科</div>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a data-target="link">' +
                '<div class="dpt color-black" data-dpt="3" style="width:100%">妇产科</div>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a data-target="link">' +
                '<div class="dpt color-black" data-dpt="4" style="width:100%">眼科</div>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a data-target="link">' +
                '<div class="dpt color-black" data-dpt="5" style="width:100%">口腔科</div>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a data-target="link">' +
                '<div class="dpt color-black" data-dpt="6" style="width:100%">小儿外科</div>' +
                '</a>' +
                '</li>' +
                '<li>' +
                '<a data-target="link">' +
                '<div class="dpt color-black" data-dpt="7" style="width:100%">其他</div>' +
                '</a>' +
                '</li>' +
                '</ul>' +
                '</div>' +
                '</article>' +
                '</div>' +
                '<script>' +
                '$(".dpt").click(function (e) {' +
                'e.preventDefault();' +
                '$dptId = $(this).attr("data-dpt");' +
                '$dptName = $(this).html();' +
                '$cityId = $(".cityTitle").attr("data-city");' +
                'var requestUrl="";' +
                'if("' + titleName + '"=="明星团队"){' +
                'requestUrl = "' + $urlExpertteam + '?appv=15&api=5&city=" + $cityId;' +
                '} else {' +
                'requestUrl = "' + $urlDoctor + '?appv=15&api=4&city=" + $cityId;' +
                '}' +
                'if ($dptId != "") {' +
                'requestUrl += "&cate=" + $dptId;' +
                '} else {' +
                'requestUrl += "";' +
                '}' +
                'J.closePopup();' +
                '$.ajax({' +
                'url: requestUrl,' +
                'success: function (data) {' +
                'readyPage(data);' +
                '}' +
                '});' +
                '});' +
                '</script>',
        pos: 'top',
        showCloseBtn: false
    })
});