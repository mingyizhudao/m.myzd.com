$('#deptSelect').tap(function () {
    var dept = $('.title').html();
    //滚动距离
    $scrollLength = '';
    var deptName = $('#deptTitle').html();
    var deptId = $('#deptTitle').attr('data-dept');
    $deptId = deptId;
    var cityName = $('#cityTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var innerPage = '<div id="findDoc_section">' +
            '<header id="findDept_header" class="bg-green">' +
            '<nav class="left">' +
            '<a href="' + $homeView + '">' +
            '<div class="pl5">' +
            '<img src="http://static.mingyizhudao.com/146975795218858" class="w11p">' +
            '</div>' +
            '</a>' +
            '</nav>' +
            '<h1 class="title">' + dept +
            '</h1>' +
            '<nav class="right">' +
            '<a onclick="javascript:history.go(0)">' +
            '<img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">' +
            '</a>' +
            '</nav>' +
            '</header>' +
            '<nav id="findDept_nav" class="header-secondary bg-white">' +
            '<div class="grid w100 color-black font-s16 color-black6">' +
            '<div id="deptSelect" data-target="closePopup" class="col-1 w50 br-gray bb-gray grid middle grayImg">' +
            '<span class="color-orange6" id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146735831347598">' +
            '</div>' +
            '<div id="citySelect" data-target="closePopup" class="col-1 w50 bb-gray grid middle grayImg">' +
            '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
            '</div>' +
            '</div>' +
            '</nav>' +
            '<article id="findDept_article" class="active" data-scroll="true" style="position:static;">' + readyDept($diseaseData) +
            '</article>' +
            '</div>';
    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });

    //滚动到此时的二级科室位置
    if ($scrollLength > 6) {
        $("#rightDept").scrollTop(312);
    }

    $('.aDept').click(function () {
        var dataDept = $(this).attr('data-dept');
        $('.aDept').each(function () {
            if (dataDept == $(this).attr('data-dept')) {
                $(this).addClass('bg-white');
            } else {
                $(this).removeClass('bg-white');
            }
        });
        $('.bDept').each(function () {
            if (dataDept == $(this).attr('data-dept')) {
                $(this).removeClass('hide');
            } else {
                $(this).addClass('hide');
            }
        });
    });

    $('.cDept').click(function (e) {
        e.preventDefault();
        $deptId = $(this).attr('data-dept');
        $deptName = $(this).html();
        $condition["disease_sub_category"] = $deptId;
        $condition["disease_name"] = '';
        $condition["city"] = '';
        $condition["page"] = 1;
        var requestUrl = $requestHospital + setUrlCondition() + '&getcount=1';
        J.closePopup();
        J.showMask();
        $.ajax({
            url: requestUrl,
            success: function (data) {
                //console.log(data);
                readyHospital(data);
                $deptName = $deptName.length > 5 ? $deptName.substr(0, 4) + '...' : $deptName;
                $('#deptTitle').html($deptName);
                $('#deptTitle').attr('data-dept', $deptId);
                $('#cityTitle').html('全部');
                $('#cityTitle').attr('data-city', '0');
                setLocationUrl();
                $('#findDept_article').scrollTop(0);
            }
        });
    });
});
function readyDept(data) {
    var results = data.results;
    var innerHtml = '<div class="grid color-black" style="margin-top:93px;">';
    if (results.length > 0) {
        innerHtml += '<div id="rightDept" class="col-1 w50" data-scroll="true" style="max-height:315px;">'
        for (var i = 0; i < results.length; i++) {
            var subCat = results[i].subCat;
            var number = 0;
            if (results[i].id == $innerDeptId) {
                innerHtml += '<ul class="bDept list" data-dept="' + results[i].id + '">';
                if (subCat.length > 0) {
                    for (var j = 0; j < subCat.length; j++) {
                        number++;
                        if ($deptId == subCat[j].id) {
                            $scrollLength = number;
                            innerHtml += '<li class="cDept activeIcon" data-dept="' + subCat[j].id + '">' + subCat[j].name + '</li>';
                        } else {
                            innerHtml += '<li class="cDept" data-dept="' + subCat[j].id + '">' + subCat[j].name + '</li>';
                        }
                    }
                }
                innerHtml += '</ul>';
            }
        }
    }
    innerHtml += '</div></div>';
    return innerHtml;
}
$('#citySelect').tap(function () {
    var dept = $('.title').html();
    var deptName = $('#deptTitle').html();
    var deptId = $('#deptTitle').attr('data-dept');
    var cityName = $('#citySelect').html();
    var cityId = $('#citySelect').attr('data-city');
    var innerPage = '<div id="findDoc_section">' +
            '<header id="findDept_header" class="bg-green">' +
            '<nav class="left">' +
            '<a href="' + $homeView + '">' +
            '<div class="pl5">' +
            '<img src="http://static.mingyizhudao.com/146975795218858" class="w11p">' +
            '</div>' +
            '</a>' +
            '</nav>' +
            '<h1 class="title">' + dept +
            '</h1>' +
            '<nav class="right" data-target="closePopup">' +
            '<a id="citySelect" href="javascript:;">' +
            cityName +
            '</a>' +
            '<div class="col-0 cityImg isSelectedCity"></div>' +
            '</nav>' +
            '</header>' +
            '<article id="findDept_article" class="active" data-scroll="true" style="position:static;">' + readyCity($cityData, cityId) +
            '</article>' +
            '</div>';

    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });

    $('.switchCity').click(function (e) {
        e.preventDefault();
        $deptId = $('#deptTitle').attr('data-dept');
        $cityId = $(this).attr('data-city');
        $cityName = $(this).html();
        $condition["disease_sub_category"] = $deptId;
        $condition["disease_name"] = '';
        $condition["city"] = $cityId;
        $condition["page"] = 1;
        var requestUrl = $requestHospital + setUrlCondition() + '&getcount=1';
        J.closePopup();
        J.showMask();
        $.ajax({
            url: requestUrl,
            success: function (data) {
                //console.log(data);
                readyHospital(data);
                $('#citySelect').html($cityName);
                $('#citySelect').attr('data-city', $cityId);
                setLocationUrl();
                $('#findDept_article').scrollTop(0);
            }
        });
    });
});

//更改url
function setLocationUrl() {
    var stateObject = {};
    var title = "";
    var urlCondition = '';
    for ($key in $condition) {
        if ($condition[$key] && $condition[$key] !== "") {
            urlCondition += "-" + $key + "-" + $condition[$key];
        }
    }
    urlCondition = urlCondition.substring(1);
    urlCondition = "-" + urlCondition;
    var newUrl = $requestHospitalTop + urlCondition + '.html';
    history.pushState(stateObject, title, newUrl);
}

//医院页面
function readyHospital(data) {
    var results = data.results;
    var innerHtml = '<div id="hospitalPage"><div><img class="w100" src="http://static.mingyizhudao.com/147063732649923"><ul class="list">';
    if (results) {
        if (results.length > 0) {
            for (var i = 0; i < results.length; i++) {
                innerHtml += '<li class="">' +
                        '<a href="' + $requestDepartment + '/id/' + results[i].hp_dept_id + '">' +
                        '<div class="font-s16 color-black">' + results[i].ShortName + '</div>' +
                        '<div class="color-black6">医院实际科室名称:' + results[i].hp_dept_name + '</div>' +
                        '</a>' +
                        '</li>';
            }
        } else {
            innerHtml += '<div class="pad10 text-center">' +
                            '<div class="pt50">' +
                             '<img src="http://static.mingyizhudao.com/147142841787362" class="w63p">' +
                            '</div>'+
                         '<div class="pt20 color-gray">'+
                         '该地区暂无顶尖医院科室推荐'+
                         '</div>';
        }
    } else {
        innerHtml += '<li>暂无信息</li>';
    }
    if (data.dataNum != null) {
        var dataPage = Math.ceil(data.dataNum / 10);
        if (dataPage > 1) {
            innerHtml += '<li><div class="grid">' +
                    '<div class="col-1 w40">' +
                    '<button id="previousPage" type="button" class="button btn-yellow">上一页</button>' +
                    '</div><div class="col-1 w20">' +
                    '<select id="selectPage" onchange="changePage()">';
            var nowPage = $condition["page"];
            for (var i = 1; i <= dataPage; i++) {
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
    innerHtml += '</ul></div></div>';
    $('#findDept_article').html(innerHtml);
    initPage(dataPage);
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

//分页
function initPage(dataPage) {
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
                    $('#findDept_article').scrollTop(0);
                }
            });
        } else {
            J.showToast('已是第一页', '', '1000');
        }
    });
    $('#nextPage').tap(function () {
        if ($condition["page"] < dataPage) {
            $condition["page"] = parseInt($condition["page"]) + 1;
            J.showMask();
            $.ajax({
                url: $requestHospital + setUrlCondition() + '&getcount=1',
                success: function (data) {
                    //console.log(data);
                    readyHospital(data);
                    setLocationUrl();
                    $('#findDept_article').scrollTop(0);
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
            $('#findDept_article').scrollTop(0);
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