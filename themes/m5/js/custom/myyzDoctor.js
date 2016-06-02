$('#selectDept').tap(function () {
    var urlRootPath = $('#myyzDoctor_header').attr('data-path');
    var urlApi = $('#myyzDoctor_article').attr('data-api');
    var deptId = $('#deptTitle').attr('data-dept');
    var deptName = $('#deptTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var cityName = $('#cityTitle').html();
    var innerPage = '<div id="findDoc_section">' +
            '<header id="myyzDoctor_header" class="bg-green">' +
            '<nav class="left">' +
            '<a href="" data-target="back">' +
            '<div class="pl5">' +
            '<img src="' + urlRootPath + '/m5/images/back.png" class="w11p">' +
            '</div>' +
            '</a>' +
            '</nav>' +
            '<h1 class="title"><span id="deptTitle" data-target="closePopup" data-dept="' + deptId + '">' + deptName + '</span>' +
            '<span class="pl6"><img class="w10p" src="' + urlRootPath + '/m5/images/triangleWhite.png"></span>' +
            '</h1>' +
            '<nav id="selectCity" class="right">' +
            '<div class="grid mt17" data-target="closePopup">' +
            '<div class="font-s16 col-0" id="cityTitle" data-city="' + cityId + '">' + cityName +
            '</div>' +
            '<div class="col-0 cityImg"></div>' +
            '</div>' +
            '</nav>' +
            '</header>' +
            '<article id="myyzDoctor_article" class="active" style="position:static;">' +
            '<div class="mt43">' +
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
            type: 'get',
            url: urlApi + '&citys=' + cityId + '&disease_category=' + dataDeptId,
            success: function (data) {
                //console.log(data);
                readyPage(data);
                $('#deptTitle').html(dataDeptName);
                $('#deptTitle').attr('data-dept', dataDeptId);
                $('#cityTitle').html(cityName);
                $('#cityTitle').attr('data-city', cityId);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
$('#selectCity').tap(function () {
    var urlRootPath = $('#myyzDoctor_header').attr('data-path');
    var urlApi = $('#myyzDoctor_article').attr('data-api');
    var deptId = $('#deptTitle').attr('data-dept');
    var deptName = $('#deptTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var cityName = $('#cityTitle').html();
    var innerPage = '<div id="findDoc_section">' +
            '<header id="myyzDoctor_header" class="bg-green">' +
            '<nav class="left">' +
            '<a href="" data-target="back">' +
            '<div class="pl5">' +
            '<img src="' + urlRootPath + '/m5/images/back.png" class="w11p">' +
            '</div>' +
            '</a>' +
            '</nav>' +
            '<h1 class="title"><span id="deptTitle" data-target="closePopup" data-dept="' + deptId + '">' + deptName + '</span>' +
            '<span class="pl6"><img class="w10p" src="' + urlRootPath + '/m5/images/triangleWhite.png"></span>' +
            '</h1>' +
            '<nav id="selectCity" class="right">' +
            '<div class="grid mt17" data-target="closePopup">' +
            '<div class="font-s16 col-0" id="cityTitle" data-city="' + cityId + '">' + cityName +
            '</div>' +
            '<div class="col-0 cityImg"></div>' +
            '</div>' +
            '</nav>' +
            '</header>' +
            '<article id="myyzDoctor_article" class="active" style="position:static;">' +
            '<div class="mt43">' +
            '<ul class="list">' +
            '<li class="city" data-city="1">北京</li>' +
            '<li class="city" data-city="73">上海</li>' +
            '<li class="city" data-city="200">广州</li>' +
            '<li class="city" data-city="254">重庆</li>' +
            '<li class="city" data-city="186">长沙</li>' +
            '<li class="city" data-city="0">其他</li>' +
            '</ul>' +
            '</div>' +
            '</article>' +
            '</div>';
    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });
    $('.city').click(function () {
        var dataCityId = $(this).attr('data-city');
        var dataCityName = $(this).html();
        J.closePopup();
        $.ajax({
            type: 'get',
            url: urlApi + '&citys=' + dataCityId + '&disease_category=' + deptId,
            success: function (data) {
                //console.log(data);
                readyPage(data);
                $('#deptTitle').html(deptName);
                $('#deptTitle').attr('data-dept', deptId);
                $('#cityTitle').html(dataCityName);
                $('#cityTitle').attr('data-city', dataCityId);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});

function readyPage(data) {
    var doctorView = $('#myyzDoctor_article').attr('data-doctorView');
    var innerHtml = '<div class="pad10">';
    if (data.results.page) {
        var doctors = data.results.page[0];
        var pageSize = Math.ceil(doctors.length / 3);
        for (var i = 0; i < pageSize; i++) {
            innerHtml += '<div class="grid text-center pb10">';
            for (var j = 0; j < 3; j++) {
                var num = i * 3 + j;
                if (num < doctors.length) {
                    var hpDeptName = doctors[num].hpDeptName;
                    var hpName = doctors[num].hpName;
                    if (hpDeptName == null || hpDeptName == '') {
                        hpDeptName = '';
                    }
                    if (hpName == null || hpName == '') {
                        hpName = '';
                    }
                    innerHtml += '<div class="col-1 w33 border-gray br5 ml3 mr3">' +
                            '<a href="' + doctorView + '/' + doctors[num].id + '">' +
                            '<div class="pb10 color-black">' +
                            '<div class="grid pt10">' +
                            '<div class="col-1"></div>' +
                            '<div class="col-0 imgDiv">' +
                            '<img src="' + doctors[num].imageUrl + '">' +
                            '</div>' +
                            '<div class="col-1"></div>' +
                            '</div>' +
                            '<div>' + doctors[num].name + '</div>' +
                            '<div class="font-s12">' + hpDeptName + '</div>' +
                            '<div class="font-s12">' + hpName + '</div>' +
                            '</div>' +
                            '</a>' +
                            '</div>';
                } else {
                    innerHtml += '<div class="col-1 w33 ml3 mr3"></div>';
                }
            }
            innerHtml += '</div>';
        }
    } else {
        innerHtml += '暂无';
    }
    innerHtml += '</div>';
    J.hideMask();
    $('#myyzDoctor_article').html(innerHtml);
}