<?php
$searchDoc = $this->createUrl("doctor/search");
$searchDept = $this->createUrl("hospital/search");
$urlHomeView = $this->createUrl("home/view");
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlDiseaseName = $this->createAbsoluteUrl('/api/diseasename', array('api' => 7, 'disease_name' => ''));
$urlSearch = $this->createAbsoluteUrl('/api/search', array('name' => ''));
$urlDoctorView = $this->createAbsoluteUrl('doctor/view', array('id' => ''));
$urlHospitalView = $this->createAbsoluteUrl('hospital/view', array('id' => ''));
$urlSearchMore = $this->createUrl('doctor/viewSearchMore');
$this->show_footer = false;
?>
<style>
    #jingle_toast{top:30%;}
</style>
<header id="search_header" class="bg-white">
    <div class="grid w100">
        <div class="col-1 w80 ml15">
            <input id="inputDisease" type="text" name="disease_name" class="w100" placeholder="请输入疾病、医生或医院名称">
            <span class="pr5 emptyImg hide">
                <a id="emptyInput">
                    <img src="<?php echo $urlResImage; ?>close.png" class="w15p">
                </a>
            </span>
        </div>
        <div class="col-1 w20">
            <a href="<?php echo $urlHomeView; ?>" data-target="link">
                <div class="color-green text-center font-s15">取消</div>
            </a>
        </div>
    </div>
</header>
<article id="search_atricle" class="active" data-scroll="true">
    <div>

    </div>
</article>
<script>
    $(document).ready(function () {
        var disease_name = $("input[name='disease_name']").val();
        if (disease_name != '') {
            ajaxPage();
        }

        $("input").keyup(function () {
            disease_name = $("input[name='disease_name']").val();
            if (disease_name == '') {
                $('#search_atricle').html('');
                return;
            }
            ajaxPage();
        });

        function ajaxPage() {
            $.ajax({
                url: '<?php echo $urlSearch; ?>' + disease_name,
                success: function (data) {
                    //console.log(data);
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
                innerHtml += '<div class="">' +
                        '<div class="mt10 pl10 pb2 orangeLine">搜索医生</div>' +
                        '<ul id="doctorList" class="list mt5">';
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
                innerHtml += '</ul></div><div class="bb10-gray"></div>';
            } else {

            }
            //疾病
            if (diseases != undefined) {
                innerHtml += '<div class="">' +
                        '<div class="mt10 pl10 pb2 orangeLine">搜索疾病</div>' +
                        '<ul id="diseaseList" class="list mt5">';
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
                innerHtml += '</ul></div>';
            } else {

            }
            //医院
            if (hospitals != undefined) {
                innerHtml += '<div class="">' +
                        '<div class="mt10 pl10 pb2 orangeLine">搜索医院</div>' +
                        '<ul id="diseaseList" class="list mt5">';
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
                innerHtml += '</ul></div>';
            } else {

            }
            //若无查询到信息
            if (doctors == undefined && diseases == undefined && hospitals == undefined) {
                innerHtml += '<div class="pl15 color-black6 pt5">对不起,暂没有搜索到"' + disease_name + '"的相关信息</div>';
            }

            innerHtml += '</div>';
            $('#search_atricle').html(innerHtml);

            $("#moreDoctor").click(function () {
                //$('#doctorList').html(doctorsData);
                location.href = '<?php echo $urlSearchMore; ?>?name=' + disease_name + '&type=1';
            });

            $("#moreDisease").click(function () {
                //$('#diseaseList').html(diseasesData);
                location.href = '<?php echo $urlSearchMore; ?>?name=' + disease_name + '&type=2';
            });


            $("#moreHospital").click(function () {
                location.href = '<?php echo $urlSearchMore; ?>?name=' + disease_name + '&type=3';
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
                        '<a href="<?php echo $searchDept; ?>?disease=' + diseases[i].id + '&disease_name=' + diseases[i].name + '&page=1">' +
                        '<div class="col-0 moreButton">找科室</div>' +
                        '</a>' +
                        '</div>' +
                        '<div class="col-1 w50 grid">' +
                        '<div class="col-1"></div>' +
                        '<a href="<?php echo $searchDoc; ?>?disease_name=' + diseases[i].name + '&page=1">' +
                        '<div class="col-0 moreButton">找医生</div>' +
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
                        '<a href="<?php echo $urlHospitalView; ?>/' + hospitals[i].id + '">' +
                        '<div>' + colorName + '</div>' +
                        '</a>' +
                        '</li>';
            }
            return innerHtml;
        }
    });
</script>
