$('#deptSelect').tap(function () {
    var deptName = $('#deptTitle').html();
    var deptId = $('#deptTitle').attr('data-dept');
    var cityName = $('#cityTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var innerPage = '<div id="findDoc_section">' +
            '<header class="bg-green">' +
            '<nav class="left">' +
            '<a href="#" data-icon="previous" data-target="back"></a>' +
            '</nav>' +
            '<h1 class="title">找科室</h1>' +
            '</header>' +
            '<nav id="findDept_nav" class="header-secondary bg-white">' +
            '<div class="grid w100 color-black font-s16 color-black6">' +
            '<div id="deptSelect" data-target="closePopup" class="col-1 w50 br-gray bb-gray grid middle grayImg">' +
            '<span id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="../../themes/m5/images/gray.png">' +
            '</div>' +
            '<div id="citySelect" data-target="closePopup" class="col-1 w50 bb-gray grid middle grayImg">' +
            '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="../../themes/m5/images/gray.png">' +
            '</div>' +
            '</div>' +
            '</nav>' +
            '<article id="findDept_article" class="active" style="position:static;">' + $deptHtml +
            '</article>' +
            '</div>';
    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });

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
                $('#deptTitle').html($deptName);
                $('#deptTitle').attr('data-dept', $deptId);
                $('#cityTitle').html('地区');
                $('#cityTitle').attr('data-disease', '');
                setLocationUrl();
            }
        });
    });
});
$('#citySelect').tap(function () {
    var deptName = $('#deptTitle').html();
    var deptId = $('#deptTitle').attr('data-dept');
    var cityName = $('#cityTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var innerPage = '<div id="findDoc_section">' +
            '<header class="bg-green">' +
            '<nav class="left">' +
            '<a href="#" data-icon="previous" data-target="back"></a>' +
            '</nav>' +
            '<h1 class="title">找科室</h1>' +
            '</header>' +
            '<nav id="findDept_nav" class="header-secondary bg-white">' +
            '<div class="grid w100 color-black font-s16 color-black6">' +
            '<div id="deptSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
            '<span id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="../../themes/m5/images/gray.png">' +
            '</div>' +
            '<div id="citySelect" data-target="closePopup" class="col-1 w33 bb-gray grid middle grayImg">' +
            '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="../../themes/m5/images/gray.png">' +
            '</div>' +
            '</div>' +
            '</nav>' +
            '<article id="findDept_article" class="active" style="position:static;">' + $cityHtml +
            '</article>' +
            '</div>';

    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });

    $('.aCity').click(function () {
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
        $deptId = $('#deptTitle').attr('data-dept');
        $cityId = $(this).attr('data-city');
        $cityName = $(this).html();
        $condition["disease_sub_category"] = $deptId;
        $condition["disease_name"] = '';
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
            urlCondition += "&" + $key + "=" + $condition[$key];
        }
    }
    urlCondition = urlCondition.substring(1);
    urlCondition = "?" + urlCondition;
    var newUrl = $requestHospitalSearch + urlCondition;
    history.pushState(stateObject, title, newUrl);
}

//医院页面
function readyHospital(data) {
    var results = data.results;
    var innerHtml = '<div id="hospitalPage"><div class="pt10"></div><div><ul class="list">';
    if (results) {
        if (results.length > 0) {
            for (var i = 0; i < results.length; i++) {
                innerHtml += '<li class="nextImg">' +
                        '<a href="' + $requestDepartment + '/' + results[i].hp_dept_id + '">' +
                        '<div class="font-s16 color-black">' + results[i].name + '</div>' +
                        '<div class="color-black6">' + results[i].hp_dept_name + '</div>' +
                        '</a>' +
                        '</li>';
            }
        } else {
            innerHtml += '<li>暂无信息</li>';
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