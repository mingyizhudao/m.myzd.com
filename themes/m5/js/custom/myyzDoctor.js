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
    var innerHtml = '<div>';
    if (data.results.page) {
        var doctors = data.results.page[0];
        var pageSize = Math.ceil(doctors.length / 3);
        for (var i = 0; i < pageSize; i++) {
            for (var j = 0; j < 3; j++) {
                var num = i * 3 + j;
                if (num < doctors.length) {
                    var hp_dept_desc = (doctors[num].desc == '' || doctors[num].desc == null) ? '暂无信息' : doctors[num].desc;
                    hp_dept_desc = hp_dept_desc.length > 40 ? hp_dept_desc.substr(0, 40) + '...' : hp_dept_desc;
                    innerHtml += '<div class="mb10 bg-white">' +
                            '<a href="' + doctorView + '/' + doctors[num].id + '" data-target="link">' +
                            '<div class="grid pl15 pr15 pb10 bb-gray3 bt-gray2">' +
                            '<div class="col-1 w25 pt10">' + '<div class="w60p h60p br50" style="overflow:hidden;">' +
                            '<img class="imgDoc" src="' + doctors[num].imageUrl + '">' +
                            '</div>' +
                            '</div>' +
                            '<div class="ml10 col-1 w75">' +
                            '<div>' +
                            '<div class="color-black2 pt10 font-s16">' + doctors[num].name +
                            '</div>' +
                            '</div>';
                    if (doctors[num].hpDeptName == null) {
                        innerHtml += '<div class="color-black6">' + doctors[num].mTitle + '</div>';
                    } else {
                        innerHtml += '<div class="color-black6">' + doctors[num].hpDeptName + '<span class="ml5">' + doctors[num].mTitle + '</span></div>';
                    }
                    innerHtml += '<div class="color-black6">' + doctors[num].hpName + '</div>' +
                            '</div>' +
                            '</div>' +
                            '</a>' +
                            '<div class="pl15 pr15 pt5 pb10 font-s12 color-black bb-gray2">擅长:' + hp_dept_desc + '</div>' +
                            '</div>';
                }
            }
        }
    } else {
        innerHtml += '<div class="color-white text-center">' +
                '<div class="pt50">' +
                '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/14630214183611" class="w170p">' +
                '</div>' +
                '<div class="pt10 font-s30 color-gray10">暂无医生</div>' +
                '</div>';
    }
    innerHtml += '</div>';
    J.hideMask();
    $('#myyzDoctor_article').html(innerHtml);
}