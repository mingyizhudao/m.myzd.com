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
            '<article id="hospital_article" class="active" data-scroll="true" style="position:static;">' + readyCity($cityData, cityId) + '</article>';
    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });



    $('.switchCity').click(function (e) {
        e.preventDefault();
        $cityId = $(this).attr('data-city');
        $cityName = $(this).html();
        $condition["city"] = $cityId;
        var requestUrl = $requestHospital + setUrlCondition() + '&getcount=1';
        J.closePopup();
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
    // console.log('123');
    var hospitals = data.hospitals;
    var innerHtml = '<div><div><a href="' + $urlTopHospital + '"><img src="http://static.mingyizhudao.com/146423335398248" class="w100"></a></div>'
    if (hospitals.length > 0) {
        for (var i = 0; i < hospitals.length; i++) {
            innerHtml += '<ul class="list">'+'<li>' +
                    '<a href="' + $requestHospitalView + '/' + hospitals[i].id + '">' +
                    '<div class="pl10">' +
                    '<div class="font-s16 color-black10">' + hospitals[i].name + '</div>' +
                    '<div class="color-black6 pt5"><span class="hpClassBg">' + hospitals[i].hpClass + '<span></div>' +
                    '</div>' +
                    '</a>' +
                    '</li>'+'</ul></div>';
        }
    } else {
        innerHtml +=  '<div class="pad10 text-center">'+
                '<div class="pt50">'+
                '<img src="http://static.mingyizhudao.com/147142841787362" class="w63p">'+
                '</div>'+
                '<div class="pt10 color-gray">'+
                '该地区暂无顶尖医院科室推荐'+
                '</div>' +
                '</div>';
    }
    
    $('#hospital_article').html(innerHtml);
    J.hideMask();
}

function readyCity(data, cityId) {
    var innerHtml = '';
    if (data != '') {
        var results = data.results;
        innerHtml += '<div id="cityList" class="grid color-black" style="margin-top:43px;height:315px;">' +
                '<ul class="list w100">';
        if (cityId == 0) {
            innerHtml += '<li class="switchCity activeIcon" data-city="0">全部</li>';
        } else {
            innerHtml += '<li class="switchCity" data-city="0">全部</li>';
        }
        for (var i = 0; i < results.length; i++) {
            if (cityId == results[i].id) {
                innerHtml += '<li class="switchCity activeIcon" data-city="' + results[i].id + '">' + results[i].city + '</li>';
            } else {
                innerHtml += '<li class="switchCity" data-city="' + results[i].id + '">' + results[i].city + '</li>';
            }
        }
        innerHtml += '</ul></div>';
    }
    return innerHtml;
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
            urlCondition += "/" + $key + "/" + $condition[$key];
        }
    }
    urlCondition = urlCondition.substring(1);
    urlCondition = "/" + urlCondition;
    var newUrl = $requestHospitalIndex + urlCondition;
    history.pushState(stateObject, title, newUrl);
}