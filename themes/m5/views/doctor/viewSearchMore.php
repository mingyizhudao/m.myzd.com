<?php
$this->setPageTitle('搜索');
$searchName = Yii::app()->request->getQuery('name', '');
$type = Yii::app()->request->getQuery('type', '');
$searchDoc = $this->createUrl("doctor/search");
$searchDept = $this->createUrl("hospital/search");
$urlDoctorView = $this->createAbsoluteUrl('doctor/view');
$urlHospitalView = $this->createAbsoluteUrl('hospital/view', array('id' => ''));
$urlHomeView = Yii::app()->baseUrl;
$urlStat = $this->createAbsoluteUrl('/api/stat');
$SITE_20 = PatientStatLog::SITE_20;
$SITE_21 = PatientStatLog::SITE_21;
$SITE_22 = PatientStatLog::SITE_22;
$SITE_23 = PatientStatLog::SITE_23;
$urlSearch = $this->createAbsoluteUrl('/api/search', array('name' => ''));
$urlResImage = Yii::app()->theme->baseUrl . '/images/';
$this->show_footer = false;
?>

<header id="searchMore_header" class="bg-white">
    <div class="grid w100">
        <div class="col-0">
            <a href="" data-target="back">
                <div class="pl20 pr15">
                    <img src="http://static.mingyizhudao.com/146570271258952" class="w11p">
                </div>
            </a>
        </div>
        <div class="col-1 w80">
            <?php
            $placeholderText = '';
            if ($type == 1) {
                $placeholderText = '请输入医生姓名';
            } else if ($type == 2) {
                $placeholderText = '请输入疾病名称';
            } else if ($type == 3) {
                $placeholderText = '请输入医院名称';
            }
            ?>
            <input id="inputSearch" type="text" name="search_name" placeholder="<?php echo $placeholderText; ?>" class="w100 noPaddingInput" value="<?php echo $searchName; ?>">
        </div>
        <div class="col-1 w20">
            <a href="<?php echo $urlHomeView; ?>">
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
        ajaxPage(searchName, type);
        //重新搜索
        document.addEventListener('input', function (e) {
            e.preventDefault();
            var search_name = $("input[name='search_name']").val();
            if (search_name == '') {
                $('#searchMore_article').html('');
                return;
            } else if (search_name.match(/[a-zA-Z]/g) != null) {
                return;
            }
            ajaxPage(search_name, type);
        });
    });

    function ajaxPage(searchName, type) {
        $.ajax({
            url: '<?php echo $urlSearch; ?>' + searchName,
            success: function (data) {
                console.log(data);
                readyPage(data, searchName, type);
            }
        });
    }

    function readyPage(data, searchName, type) {
        var doctorHtml = '';
        var diseaseHtml = '';
        var hospitalHtml = '';
        var results = data.results;
        var diseases = results.diseases;
        var doctors = results.doctors;
        var hospitals = results.hospitals;
        //医生
        if (doctors != undefined) {
            doctorHtml += '<div class="bg-white"><div class="pt10">' +
                    '<div class="pl10 pb2 orangeLine">搜索医生</div>' +
                    '<ul id="doctorList" class="list mt5">';
            doctorHtml += readyDoctor(doctors.length, doctors, searchName);
            doctorHtml += '</ul></div><div class="pt20 pb20 text-center">没有更多结果</div></div>';
        } else {
            doctorHtml += '<div class="pl15 color-black6 pt5">对不起,暂没有搜索到"' + searchName + '"的相关信息</div>';
        }
        //疾病
        if (diseases != undefined) {
            diseaseHtml += '<div class="bg-white"><div class="pt10">' +
                    '<div class="pl10 pb2 orangeLine">搜索疾病</div>' +
                    '<ul id="diseaseList" class="list mt5">';
            diseaseHtml += readyDisease(diseases.length, diseases, searchName);
            diseaseHtml += '</ul></div><div class="pt20 pb20 text-center">没有更多结果</div></div>';
        } else {
            diseaseHtml += '<div class="pl15 color-black6 pt5">对不起,暂没有搜索到"' + searchName + '"的相关信息</div>';
        }
        //医院
        if (hospitals != undefined) {
            hospitalHtml += '<div class="bg-white"><div class="pt10">' +
                    '<div class="pl10 pb2 orangeLine">搜索医院</div>' +
                    '<ul id="diseaseList" class="list mt5">';
            hospitalHtml += readyHospital(hospitals.length, hospitals, searchName);
            hospitalHtml += '</ul></div><div class="pt20 pb20 text-center">没有更多结果</div></div>';
        } else {
            hospitalHtml += '<div class="pl15 color-black6 pt5">对不起,暂没有搜索到"' + searchName + '"的相关信息</div>';
        }
        //判断显示医生、疾病或医院
        if (type == 1) {
            $('#searchMore_article').html(doctorHtml);
        } else if (type == 2) {
            $('#searchMore_article').html(diseaseHtml);
        } else if (type == 3) {
            $('#searchMore_article').html(hospitalHtml);
        }

        //点击医生，记录该医生信息
        $('.doctorStat').click(function () {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_23; ?>', 'stat[key_word]': name},
                success: function (data) {

                }
            });
            location.href = '<?php echo $urlDoctorView; ?>/id/' + id;
        });

        //疾病点击找医院，记录疾病信息
        $('.hospitalDiseaseStat').click(function () {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            diseaseStat(name);
            location.href = '<?php echo $searchDept; ?>?disease=' + id + '&disease_name=' + name + '&page=1';
        });

        //疾病点击找医生，记录疾病信息
        $('.doctorDiseaseStat').click(function () {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            diseaseStat(name);
            location.href = '<?php echo $searchDoc; ?>?disease_name=' + name + '&page=1';
        });
        function diseaseStat(name) {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_21; ?>', 'stat[key_word]': name},
                success: function (data) {

                }
            });
        }

        //点击医院，记录该医院信息
        $('.hospitalStat').click(function () {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_22; ?>', 'stat[key_word]': name},
                success: function (data) {

                }
            });
            location.href = '<?php echo $urlHospitalView; ?>/' + id;
        });
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
                    '<a class="doctorStat" href="javascript:;" data-id="' + doctors[i].id + '" data-name="' + doctors[i].name + '">' +
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
                    '<a class="hospitalDiseaseStat" href="javascript:;" data-id="' + diseases[i].id + '" data-name="' + diseases[i].name + '">' +
                    '<div class="col-0 findDept">找医院</div>' +
                    '</a>' +
                    '</div>' +
                    '<div class="col-1 w50 grid">' +
                    '<div class="col-1"></div>' +
                    '<a class="doctorDiseaseStat" href="javascript:;" data-id="' + diseases[i].id + '" data-name="' + diseases[i].name + '">' +
                    '<div class="col-0 findDoctor">找医生</div>' +
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
                    '<a class="hospitalStat" href="javascript:;" data-id="' + hospitals[i].id + '" data-name="' + hospitals[i].name + '">' +
                    '<div>' + colorName + '</div>' +
                    '</a>' +
                    '</li>';
        }
        return innerHtml;
    }
</script>