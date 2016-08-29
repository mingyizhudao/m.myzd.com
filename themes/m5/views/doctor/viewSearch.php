<?php
$this->setPageTitle('搜索');
$searchDoc = $this->createUrl("doctor/search");
$searchDept = $this->createUrl("hospital/search");
$urlHomeView = Yii::app()->request->hostInfo;
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlDiseaseName = $this->createAbsoluteUrl('/api/diseasename', array('api' => 7, 'disease_name' => ''));
$urlSearch = $this->createAbsoluteUrl('/api/search', array('name' => ''));
$urlStat = $this->createAbsoluteUrl('/api/stat');
//modify by wanglei   有结果进行统计
$SITE_7  = PatientStatLog::SITE_7;
$SITE_20 = PatientStatLog::SITE_20;
$SITE_21 = PatientStatLog::SITE_21;
$SITE_22 = PatientStatLog::SITE_22;
$SITE_23 = PatientStatLog::SITE_23;
$urlDoctorView = $this->createAbsoluteUrl('doctor/view');
$urlHospitalView = $this->createAbsoluteUrl('hospital/view');
$urlSearchMore = $this->createUrl('doctor/viewSearchMore');
$this->show_footer = false;
?>

<style>
    #jingle_toast{top:30%;}
    #search_article{
        background-color: #F9F9F9;
    }
</style>
<header id="search_header" class="bg-white">
    <div class="grid w100">
        <div class="col-1 w80 ml15">
            <input id="inputDisease" type="text" name="disease_name" class="w100" placeholder="请输入疾病、医生或医院名称">
            <span class="pr5 emptyImg hide">
                <a id="emptyInput">
                    <img src="http://static.mingyizhudao.com/146976062142823" class="w15p">
                </a>
            </span>
        </div>
        <div class="col-1 w20">
            <a id='homeView' href="javascript:;" data-target="link">
                <div class="color-green text-center font-s15">取消</div>
            </a>
        </div>
    </div>
</header>
<article id="search_article" class="active" data-scroll="true">
    <div>

    </div>
</article>
<script>
    var firstpage=0;
    $(document).ready(function () {
        var disease_name = $("input[name='disease_name']").val();
        if (disease_name != '') {
            ajaxPage(0);
        }

        document.addEventListener('input', function (e) {
            e.preventDefault();
            disease_name = $("input[name='disease_name']").val();
            if (disease_name == '') {
                $('#search_article').html('');
                return;
            } else if (disease_name.match(/[a-zA-Z]/g) != null) {
                return;
            }
           
            ajaxPage(1);
        });

        //点击取消时，记录搜索框中的词
        $('#homeView').click(function () {
            inputStat();
            window.history.go(-1);
        });
        function inputStat() {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_20; ?>', 'stat[key_word]': $("input[name='disease_name']").val()},
                success: function (data) {

                }
            });
        }
        function searchdataStat(){
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_7; ?>', 'stat[key_word]':'搜索结果页展示'},
                success: function (data) {

                }
            });
        }
        function ajaxPage(a) {
            $.ajax({
                url: '<?php echo $urlSearch; ?>' + disease_name,
                success: function (data) {
                    if(a==1){
                        if(data.results && firstpage==0){
                           searchdataStat();
                           firstpage=1;
                         }
                    }
                    readyPage(data, disease_name);
                }
            });
        }

        function readyPage(data, disease_name) {
            //暂存所有医生信息
            //var doctorsData = '';
            //暂存所有疾病信息
            //var diseasesData = '';

            var results = data.results;
            var innerHtml = '<div class="color-black8">';
            var doctors = results.doctors;
            var diseases = results.diseases;
            var hospitals = results.hospitals;
            //医生
            if (doctors != undefined) {
                innerHtml += '<div class="pt10 bg-white">' +
                        '<div class="pl10 pb2 orangeLine">搜索医生</div>' +
                        '<ul id="doctorList" class="list pt5">';
                var number = doctors.length > 3 ? 3 : doctors.length;
                innerHtml += readyDoctor(number, doctors, disease_name);
                if (doctors.length > 3) {
                    //doctorsData = readyDoctor(doctors.length, doctors, disease_name);
                    innerHtml += '<li id="moreDoctor" class="font-s16 pl5">' +
                            '<div class="grid pl5">' +
                            '<div class="col-1 w33"></div>' +
                            '<div class="col-1 w33 text-center">搜索更多</div>' +
                            '<div class="col-1 w33 text-right color-black6">共' + doctors.length + '条</div>' +
                            '</div>' +
                            '</li>';
                }
                innerHtml += '</ul></div><div class="pt10"></div>';
            } else {

            }
            //疾病
            if (diseases != undefined) {
                innerHtml += '<div class="pt10 bg-white">' +
                        '<div class="mt10 pl10 pb2 orangeLine">搜索疾病</div>' +
                        '<ul id="diseaseList" class="list pt5">';
                var number = diseases.length > 3 ? 3 : diseases.length;
                innerHtml += readyDisease(number, diseases, disease_name);
                if (diseases.length > 3) {
                    //diseasesData = readyDisease(diseases.length, diseases, disease_name);
                    innerHtml += '<li id="moreDisease" class="font-s16 pl5">' +
                            '<div class="grid pl5">' +
                            '<div class="col-1 w33"></div>' +
                            '<div class="col-1 w33 text-center">搜索更多</div>' +
                            '<div class="col-1 w33 text-right color-black6">共' + diseases.length + '条</div>' +
                            '</div>' +
                            '</li>';
                }
                innerHtml += '</ul></div><div class="pt10"></div>';
            } else {

            }
            //医院
            if (hospitals != undefined) {
                innerHtml += '<div class="pt10 bg-white">' +
                        '<div class="mt10 pl10 pb2 orangeLine">搜索医院</div>' +
                        '<ul id="diseaseList" class="list pt5">';
                var number = hospitals.length > 3 ? 3 : hospitals.length;
                innerHtml += readyHospital(number, hospitals, disease_name);
                if (hospitals.length > 3) {
                    //diseasesData = readyDisease(diseases.length, diseases, disease_name);
                    innerHtml += '<li id="moreHospital" class="font-s16 pl5">' +
                            '<div class="grid pl5">' +
                            '<div class="col-1 w33"></div>' +
                            '<div class="col-1 w33 text-center">搜索更多</div>' +
                            '<div class="col-1 w33 text-right color-black6">共' + hospitals.length + '条</div>' +
                            '</div>' +
                            '</li>';
                }
                innerHtml += '</ul></div><div class="pt10"></div>';
            } else {

            }
            //若无查询到信息
            if (doctors == undefined && diseases == undefined && hospitals == undefined) {
                innerHtml +='<div class="pad10 text-center">'+ 
                          ' <div class="pt50">'+
                            '<img src="http://static.mingyizhudao.com/147148658317831" class="w63p">'+
                           ' </div>'+
                         '<div class="pt10 color-gray">'+
                         '暂无搜索信息'+
                         '</div>';
            }
            else{
                
           }
            innerHtml += '</div>';
            $('#search_article').html(innerHtml);

            $("#moreDoctor").click(function () {
                inputStat();
                location.href = '<?php echo $urlSearchMore; ?>/name/' + disease_name + '/type/1';
            });

            $("#moreDisease").click(function () {
                inputStat();
                location.href = '<?php echo $urlSearchMore; ?>/name/' + disease_name + '/type/2';
            });


            $("#moreHospital").click(function () {
                inputStat();
                location.href = '<?php echo $urlSearchMore; ?>/name/' + disease_name + '/type/3';
            });

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
                location.href = '<?php echo $searchDept; ?>/disease/' + id + '/disease_name/' + name + '/page/1';
            });

            //疾病点击找医生，记录疾病信息
            $('.doctorDiseaseStat').click(function () {
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                diseaseStat(name);
                location.href = '<?php echo $searchDoc; ?>/disease_name/' + name + '/page/1';
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
                location.href = '<?php echo $urlHospitalView; ?>/id/' + id;
            });
        }

        function readyDoctor(number, doctors, disease_name) {
            var innerHtml = '';
            var num = disease_name.length;
            for (var i = 0; i < number; i++) {
                //科室为空不显示
                var hpDeptName = doctors[i].hpDeptName == null ? '' : doctors[i].hpDeptName;
                var mTitle = doctors[i].mTitle == null ? '' : doctors[i].mTitle;
                //名字变颜色
                var name = doctors[i].name;
                var colorName = '';
                for (var j = num; j <= name.length; j++) {
                    if (disease_name == name.substr(j - num, num)) {
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

        function readyDisease(number, diseases, disease_name) {
            var innerHtml = '';
            var num = disease_name.length;
            for (var i = 0; i < number; i++) {
                //名字变颜色
                var name = diseases[i].name;
                var colorName = '';
                for (var j = num; j <= name.length; j++) {
                    if (disease_name == name.substr(j - num, num)) {
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

        function readyHospital(number, hospitals, hospital_name) {
            var innerHtml = '';
            var num = hospital_name.length;
            for (var i = 0; i < number; i++) {
                //名字变颜色
                var name = hospitals[i].name;
                var colorName = '';
                for (var j = num; j <= name.length; j++) {
                    if (hospital_name == name.substr(j - num, num)) {
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
    });
</script>
