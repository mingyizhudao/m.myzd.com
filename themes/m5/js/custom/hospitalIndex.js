$('#selectCity').tap(function (e) {
    e.preventDefault();
    var cityName = $('#cityTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var innerPage = '<header id="hospital_header" class="bg-green">' +
            '<nav class="left">' +
            '<a onclick="javascript:history.go(0)">' +
            '<img src="../../themes/m5/images/refresh.png"  class="w24p">' +
            '</a>' +
            '</nav>' +
            '<h1 class="title">推荐医院</h1>' +
            '<nav id="selectCity" class="right" data-target="closePopup">' +
            '<div class="grid mt17">' +
            '<div id="cityTitle" class="font-s16 col-0" data-city="' + cityId + '">' + cityName + '</div>' +
            '<div class="col-0 cityImg"></div>' +
            '</div>' +
            '</nav>' +
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
                //console.log(data);
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
    var innerHtml = '<div><div><img src="../../themes/m5/images/hospital.png" class="w100"></div><ul class="list">';
    if (hospitals.length > 0) {
        for (var i = 0; i < hospitals.length; i++) {
            innerHtml += '<li class="nextImg">' +
                    '<a href="' + $requestHospitalView + '/' + hospitals[i].id + '">' +
                    '<div class="font-s16 color-black">' + hospitals[i].name + '</div>' +
                    '<div class="color-black6">' + hospitals[i].hpClass + '</div>' +
                    '</a>' +
                    '</li>';
        }
    } else {
        innerHtml += '<li>暂无信息</li>';
    }
    if (data.count != null) {
        var count = Math.ceil(data.count / 10);
        if (count > 1) {
            innerHtml += '<li><div class="grid">' +
                    '<div class="col-1 w40">' +
                    '<button id="previousPage" type="button" class="button btn-yellow">上一页</button>' +
                    '</div><div class="col-1 w20">' +
                    '<select id="selectPage" onchange="changePage()">';
            var nowPage = $condition["page"];
            for (var i = 1; i <= count; i++) {
                if (nowPage == i) {
                    innerHtml += '<option id="quickPage" value="' + i + '" selected = "selected">' + i + '</option>';
                } else {
                    innerHtml += '<option id="quickPage" value="' + i + '">' + i + '</option>';
                }
            }
            innerHtml += '</select>' +
                    '</div>' +
                    '<div class="col-1 w40">' +
                    '<button id="nextPage" type="button" class="button btn-yellow">下一页</button>' +
                    '</div>' +
                    '</div></li>';
        }
    }
    innerHtml += '</ul></div>';
    $('#hospital_article').html(innerHtml);
    initPage(count);
    J.hideMask();
}

//分页
function initPage(count) {
    $('#previousPage').tap(function () {
        if ($condition["page"] > 1) {
            $condition["page"] = parseInt($condition["page"]) - 1;
            J.showMask();
            $.ajax({
                url: $requestHospital + setUrlCondition() + '&getcount=1',
                success: function (data) {
                    //console.log(data);
                    readyHospital(data);
                    setLocationUrl();
                    $('#hospital_article').scrollTop(0);
                }
            });
        } else {
            J.showToast('已是第一页', '', '1000');
        }
    });
    $('#nextPage').tap(function () {
        if ($condition["page"] < count) {
            $condition["page"] = parseInt($condition["page"]) + 1;
            J.showMask();
            $.ajax({
                url: $requestHospital + setUrlCondition() + '&getcount=1',
                success: function (data) {
                    //console.log(data);
                    readyHospital(data);
                    setLocationUrl();
                    $('#hospital_article').scrollTop(0);
                }
            });
        } else {
            J.showToast('已是最后一页', '', '1000');
        }
    });
}

//跳页
function changePage() {
    $condition["page"] = $('#selectPage').val();
    J.showMask();
    $.ajax({
        url: $requestHospital + setUrlCondition() + '&getcount=1',
        success: function (data) {
            //console.log(data);
            readyHospital(data);
            setLocationUrl();
            $('#hospital_article').scrollTop(0);
        }
    });
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