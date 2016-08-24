
$('#deptSelect').tap(function () {
    deptSelect();
});
function checkCityList(){
    if ($cityData.curRes) {
        var cArray = [];
        var cityData = $cityData.results;
        var cityCurData = $cityData.curRes;

        for(var c in cityCurData){
            for(var j=0; j<cityData.length; j++){
                if (cityCurData[c] == cityData[j].id) {
                    cArray.push(cityData[j]);
                }
            }
        }
        return readyCity(cArray,0);
    }else{
        return readyCity($cityData.results,0);
    }
}
function deptSelect() {
    var source = $('#findDoc_nav').attr('data-source');
    var sourceApp = $('#findDoc_nav').attr('data-sourceApp');
    var title = $('.title').html();
    var deptName = $('#deptTitle').html();
    var deptId = $('#deptTitle').attr('data-dept');
    var catId = $('#deptTitle').attr('data-cat');
    var diseaseName = $('#diseaseTitle').html();
    var diseaseId = $('#diseaseTitle').attr('data-disease');
    var cityName = $('#cityTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var innerPage = '<div id="findDoc_section">';
    if (sourceApp == 0) {
        innerPage += '<header class="bg-green">';
        if (source == 0) {
            innerPage += '<nav class="left">' +
                    '<a href="' + $homeView + '">' +
                    '<div class="pl5">' +
                    '<img src="http://static.mingyizhudao.com/146975795218858" class="w11p">' +
                    '</div>' +
                    '</a>' +
                    '</nav>';
        }
        innerPage += '<h1 class="title">' + title + '</h1>' +
                '<nav class="right">' +
                '<a onclick="javascript:history.go(0)">' +
                '<img src="http://static.mingyizhudao.com/146975853464574" class="w24p">' +
                '</a>' +
                '</nav>' +
                '</header>';
    }

    if (source == 0) {
        innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white">' +
                '<div class="grid w100 color-black font-s16 color-black6">' +
                '<div id="deptSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                '<span class="color-orange6" id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146735831347598">' +
                '</div>' +
                '<div id="diseaseSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                '<span id="diseaseTitle" data-disease="' + diseaseId + '">' + diseaseName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                '</div>' +
                '<div id="citySelect" data-target="closePopup" class="col-1 w33 bb-gray grid middle grayImg">' +
                '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                '</div>' +
                '</div>' +
                '</nav>';
    } else {
        if (sourceApp == 1) {
            innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white h94p top0p">';
        } else {
            innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white h94p">';
        }
        innerPage += '<div class="w100">' +
                '<div id="searchBar">' +
                '<div class="searchBtn">请输入你意向的专家</div>' +
                '</div>' +
                '<div class="grid w100 color-black font-s16 color-black6 h50p">' +
                '<div id="deptSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                '<span class="color-orange6" id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146735831347598">' +
                '</div>' +
                '<div id="diseaseSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                '<span id="diseaseTitle" data-disease="' + diseaseId + '">' + diseaseName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                '</div>' +
                '<div id="citySelect" data-target="closePopup" class="col-1 w33 bb-gray grid middle grayImg">' +
                '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</nav>';
    }
    innerPage += '<article id="findDoc_article" class="active" style="position:static;">' + readyDept($deptData, deptId, catId) +
            '</article>' +
            '</div>';

    J.popup({
        html: innerPage,
        pos: 'top',
        showCloseBtn: false
    });

    $('.aDept').click(function (e) {
        e.preventDefault();
        var dataDept = $(this).attr('data-dept');
        $('.aDept').each(function () {
            if (dataDept == $(this).attr('data-dept')) {
                $(this).addClass('activeIcon');
            } else {
                $(this).removeClass('activeIcon');
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

    //c
    $('.cDept').click(function (e) {
        e.preventDefault();
        $deptId = $(this).attr('data-dept');
        $catId = $(this).attr('data-cat');
        $deptName = $(this).html();
        $condition["disease_sub_category"] = $deptId;
        $condition["disease"] = '';
        $condition["disease_name"] = '';
        $condition["city"] = '';
        $condition["page"] = 1;
        var requestUrl = $requestDoc + setUrlCondition() + '&getcount=1';
        J.closePopup();
        J.showMask();
        $.ajax({
            url: requestUrl,
            success: function (data) {
                readyDoc(data);
                $deptName = $deptName.length > 4 ? $deptName.substr(0, 3) + '...' : $deptName;
                $('#deptTitle').html($deptName);
                $('#deptTitle').attr('data-dept', $deptId);
                $('#deptTitle').attr('data-cat', $catId);
                $('#diseaseTitle').html('疾病');
                $('#diseaseTitle').attr('data-disease', '');
                $('#cityTitle').html('全部');
                $('#cityTitle').attr('data-city', '0');
                $cityData.curRes = data.dataCity;
                // checkCityList(data.dataCity);
                setLocationUrl();
                $('#findDoc_article').scrollTop(0);
            }
        });
    });
}

$('#diseaseSelect').tap(function () {
    var source = $('#findDoc_nav').attr('data-source');
    var sourceApp = $('#findDoc_nav').attr('data-sourceApp');
    var title = $('.title').html();
    var deptName = $('#deptTitle').html();
    var deptId = $('#deptTitle').attr('data-dept');
    var diseaseName = $('#diseaseTitle').html();
    var diseaseId = $('#diseaseTitle').attr('data-disease');
    var cityName = $('#cityTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var diseaseHtml = '';

    /*是否选择科室*/
    if (deptId == '') {
        deptSelect();
        return;
    }

    /*ajax异步请求疾病*/
    $.ajax({
        url: $requestDisease + '/' + deptId,
        success: function (data) {
            diseaseHtml = readyDisease(data);
            ajaxPage(diseaseHtml);
        }
    });

    function readyDisease(data) {
        var source = $('#findDoc_nav').attr('data-source');
        var results = data.results;
        if (source == 0) {
            var innerHtml = '<div id="diseaseList" class="grid color-black" data-scroll="true" style="margin-top:93px;height:315px;">' +
                    '<ul class="list w100">';
        } else {
            if (sourceApp == 0) {
                var innerHtml = '<div id="diseaseList" class="grid color-black" data-scroll="true" style="margin-top:137px;height:315px;">' +
                        '<ul class="list w100">';
            } else {
                var innerHtml = '<div id="diseaseList" class="grid color-black" data-scroll="true" style="margin-top:93px;height:315px;">' +
                        '<ul class="list w100">';
            }
        }
        if (results) {
            var disease = results.disease;
            if (disease.length > 0) {
                for (var i = 0; i < disease.length; i++) {
                    if (diseaseId == disease[i].id) {
                        innerHtml += '<li class="aDisease activeIcon" data-disease="' + disease[i].id + '">' + disease[i].name + '</li>';
                    } else {
                        innerHtml += '<li class="aDisease" data-disease="' + disease[i].id + '">' + disease[i].name + '</li>';
                    }
                }
            }
        }
        innerHtml += '</ul></div>';
        return innerHtml;
    }

    function ajaxPage(diseaseHtml) {
        var source = $('#findDoc_nav').attr('data-source');
        var innerPage = '<div id="findDoc_section">';
        if (sourceApp == 0) {
            innerPage += '<header class="bg-green">';
            if (source == 0) {
                innerPage += '<nav class="left">' +
                        '<a href="' + $homeView + '">' +
                        '<div class="pl5">' +
                        '<img src="http://static.mingyizhudao.com/146975795218858" class="w11p">' +
                        '</div>' +
                        '</a>' +
                        '</nav>';
            }
            innerPage += '<h1 class="title">' + title + '</h1>' +
                    '<nav class="right">' +
                    '<a onclick="javascript:history.go(0)">' +
                    '<img src="http://static.mingyizhudao.com/146975853464574" class="w24p">' +
                    '</a>' +
                    '</nav>' +
                    '</header>';
        }

        if (source == 0) {
            innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white">' +
                    '<div class="grid w100 color-black font-s16 color-black6">' +
                    '<div id="deptSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                    '<span id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                    '</div>' +
                    '<div id="diseaseSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                    '<span class="color-orange6" id="diseaseTitle" data-disease="' + diseaseId + '">' + diseaseName + '</span><img src="http://static.mingyizhudao.com/146735831347598">' +
                    '</div>' +
                    '<div id="citySelect" data-target="closePopup" class="col-1 w33 bb-gray grid middle grayImg">' +
                    '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                    '</div>' +
                    '</div>' +
                    '</nav>';
        } else {
            if (sourceApp == 0) {
                innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white h94p">';
            } else {
                innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white h94p top0p">';
            }
            innerPage += '<div class="w100">' +
                    '<div id="searchBar">' +
                    '<div class="searchBtn">请输入你意向的专家</div>' +
                    '</div>' +
                    '<div class="grid w100 color-black font-s16 color-black6 h50p">' +
                    '<div id="deptSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                    '<span id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                    '</div>' +
                    '<div id="diseaseSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                    '<span class="color-orange6" id="diseaseTitle" data-disease="' + diseaseId + '">' + diseaseName + '</span><img src="http://static.mingyizhudao.com/146735831347598">' +
                    '</div>' +
                    '<div id="citySelect" data-target="closePopup" class="col-1 w33 bb-gray grid middle grayImg">' +
                    '<span id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</nav>';
        }
        innerPage += '<article id="findDoc_article" class="active" style="position:static;">' + diseaseHtml +
                '</article>' +
                '</div>';
        J.popup({
            html: innerPage,
            pos: 'top',
            showCloseBtn: false
        });

        //c
        $('.aDisease').click(function (e) {
            e.preventDefault();
            $diseaseNameB = $(this).html();
            $diseaseIdB = $(this).attr('data-disease');
            $deptId = $('#deptTitle').attr('data-dept');
            $deptName = $('#deptTitle').html();
            $condition["disease_name"] = '';
            $condition["city"] = '';
            $condition["disease"] = $diseaseIdB;
            $condition["page"] = 1;
            var requestUrl = $requestDoc + setUrlCondition() + '&getcount=1';
            J.closePopup();
            J.showMask();
            $.ajax({
                url: requestUrl,
                success: function (data) {
                    readyDoc(data);
                    $diseaseNameB = $diseaseNameB.length > 4 ? $diseaseNameB.substr(0, 3) + '...' : $diseaseNameB;
                    $('#deptTitle').html($deptName);
                    $('#diseaseTitle').html($diseaseNameB);
                    $('#diseaseTitle').attr('data-disease', $diseaseIdB);
                    $('#cityTitle').html('全部');
                    $('#cityTitle').attr('data-city', '0');
                    $cityData.curRes = data.dataCity;
                    // checkCityList(data.dataCity);
                    setLocationUrl();
                    $('#findDoc_article').scrollTop(0);
                }
            });
        });
    }
});
$('#citySelect').tap(function () {
    var source = $('#findDoc_nav').attr('data-source');
    var sourceApp = $('#findDoc_nav').attr('data-sourceApp');
    var title = $('.title').html();
    var deptName = $('#deptTitle').html();
    var deptId = $('#deptTitle').attr('data-dept');
    var diseaseName = $('#diseaseTitle').html();
    var diseaseId = $('#diseaseTitle').attr('data-disease');
    var cityName = $('#cityTitle').html();
    var cityId = $('#cityTitle').attr('data-city');
    var innerPage = '<div id="findDoc_section">';
    if (sourceApp == 0) {
        innerPage += '<header class="bg-green">';
        if (source == 0) {
            innerPage += '<nav class="left">' +
                    '<a href="' + $homeView + '">' +
                    '<div class="pl5">' +
                    '<img src="http://static.mingyizhudao.com/146975795218858" class="w11p">' +
                    '</div>' +
                    '</a>' +
                    '</nav>';
        }
        innerPage += '<h1 class="title">' + title + '</h1>' +
                '<nav class="right">' +
                '<a onclick="javascript:history.go(0)">' +
                '<img src="http://static.mingyizhudao.com/146975853464574" class="w24p">' +
                '</a>' +
                '</nav>' +
                '</header>';
    }
    if (source == 0) {
        innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white">' +
                '<div class="grid w100 color-black font-s16 color-black6">' +
                '<div id="deptSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                '<span id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                '</div>' +
                '<div id="diseaseSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                '<span id="diseaseTitle" data-disease="' + diseaseId + '">' + diseaseName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                '</div>' +
                '<div id="citySelect" data-target="closePopup" class="col-1 w33 bb-gray grid middle grayImg">' +
                '<span class="color-orange6" id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146735831347598">' +
                '</div>' +
                '</div>' +
                '</nav>';
    } else {
        if (sourceApp == 0) {
            innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white h94p">';
        } else {
            innerPage += '<nav id="findDoc_nav" class="header-secondary bg-white h94p top0p">';
        }

        innerPage += '<div class="w100">' +
                '<div id="searchBar">' +
                '<div class="searchBtn">请输入你意向的专家</div>' +
                '</div>' +
                '<div class="grid w100 color-black font-s16 color-black6 h50p">' +
                '<div id="deptSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                '<span id="deptTitle" data-dept="' + deptId + '">' + deptName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                '</div>' +
                '<div id="diseaseSelect" data-target="closePopup" class="col-1 w33 br-gray bb-gray grid middle grayImg">' +
                '<span id="diseaseTitle" data-disease="' + diseaseId + '">' + diseaseName + '</span><img src="http://static.mingyizhudao.com/146735870119173">' +
                '</div>' +
                '<div id="citySelect" data-target="closePopup" class="col-1 w33 bb-gray grid middle grayImg">' +
                '<span class="color-orange6" id="cityTitle" data-city="' + cityId + '">' + cityName + '</span><img src="http://static.mingyizhudao.com/146735831347598">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</nav>';
    }

    innerPage += '<article id="findDoc_article" class="active" data-scroll="true" style="position:static;">' + checkCityList() +
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
        $diseaseId = $('#diseaseTitle').attr('data-disease');
        $cityId = $(this).attr('data-city');
        $cityName = $(this).html();
        $condition["disease"] = $diseaseId;
        $condition["disease_name"] = '';
        $condition["city"] = $cityId;
        $condition["page"] = 1;
        var requestUrl = $requestDoc + setUrlCondition() + '&getcount=1';
        J.closePopup();
        J.showMask();
        $.ajax({
            url: requestUrl,
            success: function (data) {
                readyDoc(data);
                $('#cityTitle').html($cityName);
                $('#cityTitle').attr('data-city', $cityId);
                setLocationUrl();
                $('#findDoc_article').scrollTop(0);
            }
        });
    });
});

/*医生页面*/
function readyDoc(data) {
    var source = $('#findDoc_nav').attr('data-source');
    var sourceApp = $('#findDoc_nav').attr('data-sourceApp');
    var results = data.results;
    var innerHtml = '';
    if (source == 0) {
        innerHtml = '<div class="pt20"></div>';
    } else {
        if (sourceApp == 0) {
            innerHtml = '<div class="pt64"></div>';
        } else {
            innerHtml = '<div class="pt20"></div>';
        }
    }
    if (results) {
        if (results.length > 0) {
            for (var i = 0; i < results.length; i++) {
                var btGray = i == 0 ? '' : 'bt-gray2';
                var hp_dept_desc = (results[i].desc == '' || results[i].desc == null) ? '暂无信息' : results[i].desc;
                hp_dept_desc = hp_dept_desc.length > 40 ? hp_dept_desc.substr(0, 40) + '...' : hp_dept_desc;
                innerHtml += '<div>' +
                        '<a href="' + $requestDoctorView + '/id/' + results[i].id + '" data-target="link">' +
                        '<div class="grid pl15 pr15 ' + btGray + '">' +
                        '<div class="col-1 w25 pt10">' +
                        '<div class="w60p h60p br50" style="overflow:hidden;"><img class="imgDoc" alt="'+ results[i].name + results[i].aTitle +'" src="' + results[i].imageUrl + '"></div>';
                var doctorAtitle = '';
                if (results[i].aTitle != '无') {
                    doctorAtitle = results[i].aTitle;
                }
                innerHtml += '</div>' +
                        '<div class="ml10 col-1 w75">' +
                        '<div class="grid">' +
                        '<div class="col-0 pt10 color-black2 font-s16">' + results[i].name + '<span class="ml5">' + doctorAtitle + '</span></div>' +
                        '<div class="col-1 grid"><div class="col-1"></div>';
                if (results[i].isServiceId == 2) {
                    innerHtml += '<div class="col-0 yzIcon font-s12">义诊</div>';
                }
                if (results[i].isContracted == 1) {
                    innerHtml += '<div class="col-0 signIcon ml10 font-s12">签约</div>';
                }
                innerHtml += '</div></div>';
                /*科室为空，则不显示*/
                if (results[i].hpDeptName == "" || results[i].hpDeptName == null) {
                    if (results[i].mTitle == "" || results[i].mTitle == null) {
                        innerHtml += '';
                    } else {
                        innerHtml += '<div class="mt5 color-black6">' + results[i].mTitle + '</div>';
                    }
                } else {
                    if (results[i].mTitle == "" || results[i].mTitle == null) {
                        innerHtml += '<div class="color-black6">' + results[i].hpDeptName + '</div>';
                    } else {
                        innerHtml += '<div class="color-black6">' + results[i].hpDeptName + '<span class="ml5">' + results[i].mTitle + '</span></div>';
                    }
                }
                if (results[i].hpName != "" && results[i].hpName != null) {
                    innerHtml += '<div class="color-black6">' + results[i].hpName + '</div>';
                }
                innerHtml += '</div>' +
                        '</div>' +
                        '</a>';
                innerHtml += '<div class="pl15 pr15 pt5 pb10 color-black bb-gray2">' +
                        '<span class="color-orange font-w800">擅长:</span>' + hp_dept_desc +
                        '</div>' +
                        '<div class="bb10-gray "></div>' +
                        '</div>';

            }
        }
    } else {
        innerHtml += '<div class="pad10 text-center">' +
                            '<div class="pt50">' +
                             '<img src="http://static.mingyizhudao.com/147142891798638" class="w63p">' +
                            '</div>'+
                         '<div class="pt10 color-gray">'+
                         '暂无名医主刀签约专家'+
                         '</div>';
    }
    if (data.dataNum != null) {
        var dataPage = Math.ceil(data.dataNum / 12);
        if (dataPage > 1) {
            innerHtml += '<div class="grid pl15 pr15 pt10 pb10 bb-gray3 bt-gray2"><div class="grid w100">' +
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
                    '</div></div>';
        }
    }
    $('#docPage').html(innerHtml);
    initPage(dataPage);
    J.hideMask();
}

function readyDept(data, deptId, catId) {
    var source = $('#findDoc_nav').attr('data-source');
    var sourceApp = $('#findDoc_nav').attr('data-sourceApp');
    var results = data.results;
    if (source == 0) {
        var innerHtml = '<div class="grid color-black" style="margin-top:93px;height:315px;">' +
                '<div id="highDept" class="col-1 w50" data-scroll="true" style="height:315px;width: 50%;">' +
                '<ul class="list">';
    } else {
        if (sourceApp == 0) {
            var innerHtml = '<div class="grid color-black" style="margin-top:137px;height:315px;">' +
                    '<div id="highDept" class="col-1 w50" data-scroll="true" style="height:315px;width: 50%;">' +
                    '<ul class="list">';
        } else {
            var innerHtml = '<div class="grid color-black" style="margin-top:93px;height:315px;">' +
                    '<div id="highDept" class="col-1 w50" data-scroll="true" style="height:315px;width: 50%;">' +
                    '<ul class="list">';
        }
    }
    if (results.length > 0) {
        for (var i = 0; i < results.length; i++) {
            if (results[i].id == catId) {
                innerHtml += '<li class="aDept activeIcon" data-dept="' + results[i].id + '">' + results[i].name + '</li>';
            } else {
                innerHtml += '<li class="aDept" data-dept="' + results[i].id + '">' + results[i].name + '</li>';
            }
        }
        innerHtml += '</ul></div><div id="secondDept" class="col-1 w50" data-scroll="true" data- style="height:315px;">'
        for (var i = 0; i < results.length; i++) {
            var subCat = results[i].subCat;
            if (results[i].id == catId) {
                innerHtml += '<ul class="bDept list" data-dept="' + results[i].id + '">';
            } else {
                innerHtml += '<ul class="bDept list hide" data-dept="' + results[i].id + '">';
            }
            if (subCat.length > 0) {
                for (var j = 0; j < subCat.length; j++) {
                    if (deptId == subCat[j].id) {
                        innerHtml += '<li class="cDept activeIcon" data-cat="' + results[i].id + '" data-dept="' + subCat[j].id + '">' + subCat[j].name + '</li>';
                    } else {
                        innerHtml += '<li class="cDept" data-cat="' + results[i].id + '" data-dept="' + subCat[j].id + '">' + subCat[j].name + '</li>';
                    }
                }
            }
            innerHtml += '</ul>';
        }
    }
    innerHtml += '</div></div>';
    return innerHtml;
}

function readyCity(data, cityId) {
    var source = $('#findDoc_nav').attr('data-source');
    var sourceApp = $('#findDoc_nav').attr('data-sourceApp');
    var innerHtml = '';
    if (data != '') {
        var results = data;
        if (source == 0) {
            innerHtml += '<div class="grid color-black" style="margin-top:93px;height:315px;">' +
                    '<ul class="list w100">';
        } else {
            if (sourceApp == 0) {
                innerHtml += '<div class="grid color-black" style="margin-top:137px;height:315px;">' +
                        '<ul class="list w100">';
            } else {
                innerHtml += '<div class="grid color-black" style="margin-top:93px;height:315px;">' +
                        '<ul class="list w100">';
            }
        }
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

/*分页*/
function initPage(dataPage) {
    $('#previousPage').tap(function () {
        if ($condition["page"] > 1) {
            $condition["page"] = parseInt($condition["page"]) - 1;
            J.showMask();
            $.ajax({
                url: $requestDoc + setUrlCondition() + '&getcount=1',
                success: function (data) {
                    readyDoc(data);
                    setLocationUrl();
                    $('#findDoc_article').scrollTop(0);
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
                url: $requestDoc + setUrlCondition() + '&getcount=1',
                success: function (data) {
                    readyDoc(data);
                    setLocationUrl();
                    $('#findDoc_article').scrollTop(0);
                }
            });
        } else {
            J.showToast('已是最后一页', '', '1000');
        }
    });
}

/*跳页*/
function changePage() {
    $condition["page"] = $('#selectPage').val();
    $.ajax({
        url: $requestDoc + setUrlCondition() + '&getcount=1',
        success: function (data) {
            readyDoc(data);
            setLocationUrl();
            $('#findDoc_article').scrollTop(0);
        }
    });
}

function setUrlCondition() {
    var urlCondition = "";
    for ($key in $condition) {
        if ($condition[$key] && $condition[$key] !== "") {
            urlCondition += "&" + $key + "=" + $condition[$key];
        }
    }
    return urlCondition;
}

/*更新url*/
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
    var newUrl = $requestDoctorSearch + urlCondition;
    history.pushState(stateObject, title, newUrl);
}