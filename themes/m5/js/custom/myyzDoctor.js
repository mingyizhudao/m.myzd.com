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
        urlApi += '';
        $.ajax({
            url: urlApi + '&city=' + cityId + '$disease_category=' + dataDeptId,
            success: function (data) {
                console.log(data);
            }
        });
    });


});