var navTop = '';
var articleTop = '';
var listMargin = 'mt93';
if ($('#myyzDoctor_nav').hasClass('top0p')) {
    navTop = 'top0p';
    articleTop = 'top30p';
    listMargin = 'mt50';
}
$("#deptSelect").tap(function () {
    var urlRootPath = $("#myyzDoctor_header").attr("data-path");
    var urlApi = $("#myyzDoctor_article").attr("data-api");
    var deptId = $("#deptTitle").attr("data-dept");
    var deptName = $("#deptTitle").html();
    var cityId = $("#cityTitle").attr("data-city");
    var cityName = $("#cityTitle").html();
    var innerPage = '<div id="findDoc_section">' +
            '<header id="myyzDoctor_header" class="bg-green">' +
            '<nav class="left">' +
            '<a href="" data-target="back">' +
            '<div class="pl5">' +
            '<img src="' + urlRootPath + '/m5/images/back.png" class="w11p">' +
            '</div>' +
            '</a>' +
            '</nav>' +
            '<h1 class="title">免费术前方案评估</h1>' +
            '</header>' +
            '<nav id="myyzDoctor_nav" class="header-secondary bg-white ' + navTop + '">' +
            '<div class="grid w100 color-black font-s16 color-black6">' +
            '<div id="deptSelect" data-target="closePopup" class="col-1 w50 br-gray bb-gray grid middle grayImg">' +
            '<span id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146364725769364">' +
            '</div>' +
            '<div id="citySelect" data-target="closePopup" class="col-1 w50 bb-gray grid middle grayImg">' +
            '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146364721030297">' +
            '</div>' +
            '</div>' +
            '</nav>' +
            '<article id="myyzDoctor_article" class="active ' + articleTop + '" style="position:static;">' +
            '<div class="' + listMargin + '">' +
            '<ul class="list">' +
            '<li class="dept" data-dept="1">外科</li>' +
            '<li class="dept" data-dept="2">骨科</li>' +
            '<li class="dept" data-dept="3">妇产科</li>' +
            '<li class="dept" data-dept="4">小儿外科</li>' +
            '<li class="dept" data-dept="5">五官科</li>' +
            '<li class="dept" data-dept="6">内科</li>' +
            '</ul>' +
            '</div>' +
            '</article>' +
            '</div>';
    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });
    $('.dept').click(function () {
        var dataDeptId = $(this).attr('data-dept');
        var dataDeptName = $(this).html();
        J.closePopup();
        $.ajax({
            type: "get",
            url: urlApi + "&citys=" + cityId + "&disease_category=" + dataDeptId,
            success: function (data) {
                readyPage(data);
                $("#deptTitle").html(dataDeptName);
                $("#deptTitle").attr("data-dept", dataDeptId);
                $("#cityTitle").html(cityName);
                $("#cityTitle").attr("data-city", cityId);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
$("#citySelect").tap(function () {
    var urlRootPath = $("#myyzDoctor_header").attr("data-path");
    var urlApi = $("#myyzDoctor_article").attr("data-api");
    var deptId = $("#deptTitle").attr("data-dept");
    var deptName = $("#deptTitle").html();
    var cityId = $("#cityTitle").attr("data-city");
    var cityName = $("#cityTitle").html();
    var innerPage = '<div id="findDoc_section">' +
            '<header id="myyzDoctor_header" class="bg-green">' +
            '<nav class="left">' +
            '<a href="" data-target="back">' +
            '<div class="pl5">' +
            '<img src="' + urlRootPath + '/m5/images/back.png" class="w11p">' +
            "</div>" +
            "</a>" +
            "</nav>" +
            '<h1 class="title">免费术前方案评估</h1>' +
            "</header>" +
            '<nav id="myyzDoctor_nav" class="header-secondary bg-white ' + navTop + '">' +
            '<div class="grid w100 color-black font-s16 color-black6">' +
            '<div id="deptSelect" data-target="closePopup" class="col-1 w50 br-gray bb-gray grid middle grayImg">' +
            '<span id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146364721030297">' +
            "</div>" + '<div id="citySelect" data-target="closePopup" class="col-1 w50 bb-gray grid middle grayImg">' +
            '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146364725769364">' +
            "</div>" +
            "</div>" +
            "</nav>" +
            '<article id="myyzDoctor_article" class="active ' + articleTop + '" style="position:static;">' +
            '<div class="' + listMargin + '">' +
            '<ul class="list">' +
            '<li class="city" data-city="1">北京</li>' +
            '<li class="city" data-city="73">上海</li>' +
            '<li class="city" data-city="200">广州</li>' +
            '<li class="city" data-city="254">重庆</li>' +
            '<li class="city" data-city="186">长沙</li>' +
            '<li class="city" data-city="0">其他</li>' +
            "</ul>" +
            "</div>" +
            "</article>" +
            "</div>";
    J.popup({
        html: innerPage,
        pos: "top",
        showCloseBtn: false
    });
    $(".city").click(function () {
        var dataCityId = $(this).attr("data-city");
        var dataCityName = $(this).html();
        J.closePopup();
        $.ajax({
            type: "get",
            url: urlApi + "&citys=" + dataCityId + "&disease_category=" + deptId,
            success: function (data) {
                readyPage(data);
                $("#deptTitle").html(deptName);
                $("#deptTitle").attr("data-dept", deptId);
                $("#cityTitle").html(dataCityName);
                $("#cityTitle").attr("data-city", dataCityId);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});

function readyPage(data) {
    var doctorView = $("#myyzDoctor_article").attr("data-doctorView");
    var innerHtml = '<div class="pt20">';
    if (data.results.page) {
        var doctors = data.results.page[0];
        var pageSize = Math.ceil(doctors.length / 3);
        for (var i = 0; i < pageSize; i++) {
            for (var j = 0; j < 3; j++) {
                var num = i * 3 + j;
                if (num < doctors.length) {
                    var hp_dept_desc = (doctors[num].desc == "" || doctors[num].desc == null) ? "暂无信息" : doctors[num].desc;
                    hp_dept_desc = hp_dept_desc.length > 40 ? hp_dept_desc.substr(0, 40) + "..." : hp_dept_desc;
                    var doctorAtitle = "";
                    if (doctors[num].aTitle != "无") {
                        doctorAtitle = doctors[num].aTitle;
                    }
                    innerHtml += '<div class="mb10 bg-white">' +
                            '<a href="' + doctorView + "/" + doctors[num].id + '" data-target="link">' +
                            '<div class="grid pl15 pr15 pb5 bt-gray2">' +
                            '<div class="col-1 w25 pt10">' +
                            '<div class="w60p h60p br50" style="overflow:hidden;">' +
                            '<img class="imgDoc" src="' + doctors[num].imageUrl + '">' +
                            "</div>" +
                            "</div>" +
                            '<div class="ml10 col-1 w75">' +
                            '<div class="grid">' +
                            '<div class="col-1 color-black2 pt10 font-s16">' + doctors[num].name +
                            '<span class="ml5">' + doctorAtitle +
                            "</span>" +
                            "</div>";
                    if (doctors[num].isContracted == 1) {
                        innerHtml += '<div class="col-0 signIcon mr10 font-s12">签约</div>';
                    }
                    if (doctors[num].isServiceId == 2) {
                        innerHtml += '<div class="col-0 yzIcon font-s12">义诊</div>';
                    }
                    innerHtml += "</div>";
                    if (doctors[num].hpDeptName == null) {
                        innerHtml += '<div class="color-black6">' + doctors[num].mTitle + "</div>";
                    } else {
                        innerHtml += '<div class="color-black6">' + doctors[num].hpDeptName + '<span class="ml5">' + doctors[num].mTitle + "</span></div>";
                    }
                    innerHtml += '<div class="color-black6">' + doctors[num].hpName + "</div>" +
                            "</div>" +
                            "</div>" +
                            "</a>" +
                            '<div class="pl15 pr15 pb10 color-black bb-gray2"><span class="font-w800 color-orange">擅长:</span>' + hp_dept_desc + "</div>" + "</div>";
                }
            }
        }
    } else {
        innerHtml += '<div class="color-white text-center">' +
                '<div class="pt50">' +
                '<img src="http://static.mingyizhudao.com/14630214183611" class="w170p">' +
                "</div>" +
                '<div class="pt10 font-s30 color-gray10">暂无医生</div>' +
                "</div>";
    }
    innerHtml += "</div>";
    J.hideMask();
    $("#myyzDoctor_article").html(innerHtml);
}