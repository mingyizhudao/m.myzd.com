$('#selectCity').tap(function (e) {
    e.preventDefault();
    var cityName = $('#cityTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var innerPage = '<header id="hospital_header" class="bg-green">' +
            '<nav id="selectCity" class="left" data-target="closePopup">' +
            '<div class="grid mt17">' +
            '<div id="cityTitle" class="font-s16 col-0" data-city="' + cityId + '">' + cityName + '</div>' +
            '<div class="col-0 cityImg"></div>' +
            '</div>' +
            '</nav>' +
            '<h1 class="title">推荐</h1>' +
            '</header>' +
            '<article id="hospital_article" class="active" style="position:static;">' + $cityHtml + '</article>';

    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });

    $('.aCity').click(function (e) {
        e.preventDefault();
        var dataCity = $(this).attr('data-city');
        $('.aCity').each(function () {
            if (dataCity == $(this).attr('data-city')) {
                $(this).addClass('bg-white');
            } else {
                $(this).removeClass('bg-white');
            }
        });
        $('.bCity').each(function () {
            if (dataCity == $(this).attr('data-city')) {
                $(this).removeClass('hide');
            } else {
                $(this).addClass('hide');
            }
        });
    });

    $('.cCity').click(function (e) {
        e.preventDefault();
        $cityId = $(this).attr('data-city');
        $cityName = $(this).html();
        $condition["city"] = $cityId;
        $condition["page"] = 1;
        setTimeout(function () {
            J.closePopup();
        }, 100);
        var requestUrl = $requestHospital + setUrlCondition() + '&getcount=1';
        J.showMask();
        $.ajax({
            url: requestUrl,
            success: function (data) {
                readyHospital(data);
                $('#cityTitle').html($cityName);
                $('#cityTitle').attr('data-city', $cityId);
                setLocationUrl();
                $('#hospital_article').scrollTop(0);
            }
        });
    });

});

//医院页面
function readyHospital(data) {
    var hospitals = data.hospitals;
    var innerHtml = '<div><div><img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146303131616918" class="w100"></div><ul class="list">';
    if (hospitals.length > 0) {
        for (var i = 0; i < hospitals.length; i++) {
            innerHtml += '<li>' +
                    '<a href="' + $requestHospitalView + '/' + hospitals[i].id + '">' +
                    '<div class="pl10">' +
                    '<div class="font-s16 color-black10">' + hospitals[i].name + '</div>' +
                    '<div class="color-black6 pt3">' + hospitals[i].hpClass + '</div>' +
                    '</div>' +
                    '</a>' +
                    '</li>';
        }
    } else {
        innerHtml += '<li>暂无信息</li>';
    }
    innerHtml += '</ul></div>';
    $('#hospital_article').html(innerHtml);
    J.hideMask();
}

//组合url参数
function setUrlCondition() {
    var urlCondition = "";
    for ($key in $condition) {
        if ($condition[$key] && $condition[$key] !== "") {
            urlCondition += "&" + $key + "=" + $condition[$key];
        }
    }
    return urlCondition;
}

//更改url
function setLocationUrl() {
    var stateObject = {};
    var title = "";
    var urlCondition = '';
    for ($key in $condition) {
        if ($condition[$key] && $condition[$key] !== "") {
            urlCondition += "&" + $key + "=" + $condition[$key];
        }
    }
    urlCondition = urlCondition.substring(1);
    urlCondition = "?" + urlCondition;
    var newUrl = $requestHospitalIndex + urlCondition;
    history.pushState(stateObject, title, newUrl);
}