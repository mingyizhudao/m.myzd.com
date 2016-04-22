<?php
$searchName = Yii::app()->request->getQuery('name', '');
$type = Yii::app()->request->getQuery('type', '');
$searchDoc = $this->createUrl("doctor/search");
$searchDept = $this->createUrl("hospital/search");
$urlDoctorView = $this->createAbsoluteUrl('doctor/view', array('id' => ''));
$urlHospitalView = $this->createAbsoluteUrl('hospital/view', array('id' => ''));
$urlSearch = $this->createAbsoluteUrl('/api/search', array('name' => ''));
$urlResImage = Yii::app()->theme->baseUrl . '/images/';
$this->show_footer = false;
?>
<style>
    #searchMore_article .orangeLine {
        border-left: 5px solid #F38023;
    }
    #searchMore_article .moreButton {
        padding: 5px;
        border: 1px solid #C6C6C6;
        border-radius: 4px;
        color: #222222;
    }
    article#searchMore_article {
        background-color: #eaeff1;
    }
</style>
<header id="search_header" class="bg-white">
    <div class="grid w100">
        <div class="col-1 w80 ml15">
            <input id="inputSearch" type="text" name="disease_name" class="w100"readOnly="true" >
            <span class="pr5 emptyImg hide">
                <a id="emptyInput">
                    <img src="<?php echo $urlResImage; ?>close.png" class="w15p">
                </a>
            </span>
        </div>
        <div class="col-1 w20">
            <a href="" data-target="back">
                <div class="color-green text-center font-s15">取消</div>
            </a>
        </div>
    </div>
</header>
<article id="searchMore_article" class="active" data-scroll="true">
    <div>

    </div>
</article>
<script>
    $(document).ready(function () {
        //搜索信息
        var searchName = '<?php echo $searchName; ?>';
        $('#inputSearch').val(searchName);
        //显示类型
        var type = '<?php echo $type; ?>';
        //判断搜索内容
        $.ajax({
            url: '<?php echo $urlSearch; ?>' + searchName,
            success: function (data) {
                console.log(data);
                readyPage(data);
            }
        });

        function readyPage(data) {
            var doctorHtml = '';
            var diseaseHtml = '';
            var hospitalHtml = '';
            var results = data.results;
            var diseases = results.diseases;
            var doctors = results.doctors;
            var hospitals = results.hospitals;
            //医生
            if (doctors != undefined) {
                doctorHtml += '<div class="bg-white pt10">' +
                        '<div class="pl10 pb2 orangeLine">搜索医生</div>' +
                        '<ul id="doctorList" class="list mt5">';
                doctorHtml += readyDoctor(doctors.length, doctors, searchName);
                doctorHtml += '</ul></div><div class="mt20 mb20 text-center">没有更多结果</div>';
            }
            //疾病
            if (diseases != undefined) {
                diseaseHtml += '<div class="bg-white pt10">' +
                        '<div class="pl10 pb2 orangeLine">搜索疾病</div>' +
                        '<ul id="diseaseList" class="list mt5">';
                diseaseHtml += readyDisease(diseases.length, diseases, searchName);
                diseaseHtml += '</ul></div><div class="mt20 mb20 text-center">没有更多结果</div>';
            }
            //医院
            if (hospitals != undefined) {
                hospitalHtml += '<div class="bg-white pt10">' +
                        '<div class="pl10 pb2 orangeLine">搜索疾病</div>' +
                        '<ul id="diseaseList" class="list mt5">';
                hospitalHtml += readyHospital(hospitals.length, hospitals, searchName);
                hospitalHtml += '</ul></div><div class="mt20 mb20 text-center">没有更多结果</div>';
            }
            //console.log(doctorHtml);
            //console.log(diseaseHtml);
            //判断显示医生、疾病或医院
            if (type == 1) {
                $('#searchMore_article').html(doctorHtml);
            } else if (type == 2) {
                $('#searchMore_article').html(diseaseHtml);
            } else if (type == 3) {
                $('#searchMore_article').html(hospitalHtml);
            }
        }

        function readyDoctor(number, doctors, searchName) {
            var innerHtml = '';
            var num = searchName.length;
            for (var i = 0; i < number; i++) {
                //科室为空不显示
                var hpDeptName = doctors[i].hpDeptName == null ? '' : doctors[i].hpDeptName;
                var mTitle = doctors[i].mTitle == null ? '' : doctors[i].mTitle;
                //名字变颜色
                var name = doctors[i].name;
                var colorName = '';
                for (var j = num; j <= name.length; j++) {
                    if (searchName == name.substr(j - num, num)) {
                        colorName = '<span>' + name.substr(0, j - num) + '</span>' + '<span class="color-green">' + name.substr(j - num, num) + '</span>' + '<span>' + name.substr(j) + '</span>';
                    }

                }
                var connect = '';
                if (hpDeptName != '' && mTitle != '') {
                    connect = ',';
                }
                innerHtml += '<li>' +
                        '<a href="<?php echo $urlDoctorView; ?>/' + doctors[i].id + '">' +
                        '<div class="grid">' +
                        '<div class="col-1 w20 vertical-center font-s16">' + colorName + '</div>' +
                        '<div class="col-1 w80">' +
                        '<div>(' + doctors[i].hpName + ')</div>' +
                        '<div class="font-s12 color-gray4">' + hpDeptName + connect + mTitle + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</a>' +
                        '</li>';
            }
            return innerHtml;
        }

        function readyDisease(number, diseases, searchName) {
            var innerHtml = '';
            var num = searchName.length;
            for (var i = 0; i < number; i++) {
                //名字变颜色
                var name = diseases[i].name;
                var colorName = '';
                for (var j = num; j <= name.length; j++) {
                    if (searchName == name.substr(j - num, num)) {
                        colorName = '<span>' + name.substr(0, j - num) + '</span>' + '<span class="color-green">' + name.substr(j - num, num) + '</span>' + '<span>' + name.substr(j) + '</span>';
                    }
                }
                innerHtml += '<li class="grid font-s16">' +
                        '<div class="col-1 w50 vertical-center">' + colorName + '</div>' +
                        '<div class="col-1 w50 grid">' +
                        '<div class="col-1 w50 grid">' +
                        '<div class="col-1"></div>' +
                        '<a href="<?php echo $searchDept; ?>?disease=' + diseases[i].id + '&searchName=' + diseases[i].name + '&page=1">' +
                        '<div class="col-0 moreButton">找科室</div>' +
                        '</a>' +
                        '</div>' +
                        '<div class="col-1 w50 grid">' +
                        '<div class="col-1"></div>' +
                        '<a href="<?php echo $searchDoc; ?>?searchName=' + diseases[i].name + '&page=1">' +
                        '<div class="col-0 moreButton">找医生</div>' +
                        '</a>' +
                        '</div>' +
                        '</div>' +
                        '</li>';
            }
            return innerHtml;
        }

        function readyHospital(number, hospitals, searchName) {
            var innerHtml = '';
            var num = searchName.length;
            for (var i = 0; i < number; i++) {
                //名字变颜色
                var name = hospitals[i].name;
                var colorName = '';
                for (var j = num; j <= name.length; j++) {
                    if (searchName == name.substr(j - num, num)) {
                        colorName = '<span>' + name.substr(0, j - num) + '</span>' + '<span class="color-green">' + name.substr(j - num, num) + '</span>' + '<span>' + name.substr(j) + '</span>';
                    }
                }
                innerHtml += '<li class="font-s16">' +
                        '<a href="<?php echo $urlHospitalView; ?>/' + hospitals[i].id + '">' +
                        '<div>' + colorName + '</div>' +
                        '</a>' +
                        '</li>';
            }
            return innerHtml;
        }
    });
</script>