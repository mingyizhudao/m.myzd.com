<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/findDoc.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list');
$urlCity = $this->createAbsoluteUrl('/api/city');
$urlDisease = $this->createAbsoluteUrl('/api/diseasebycategory');
$urlDoctor = $this->createAbsoluteUrl('/api/doctor', array('api' => 7));
$urlDiseasecategory = $this->createAbsoluteUrl('/api/diseasecategory', array('api' => 7));
$urlDeptName = $this->createAbsoluteUrl('/api/subcategory');
$urlDiseaseName = $this->createAbsoluteUrl('/api/disease');
$urlCityName = $this->createAbsoluteUrl('/api/city');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$city = Yii::app()->request->getQuery('city', '');
$disease = Yii::app()->request->getQuery('disease', '');
$disease_name = Yii::app()->request->getQuery('disease_name', '');
$disease_category = Yii::app()->request->getQuery('disease_category', '');
$disease_sub_category = Yii::app()->request->getQuery('disease_sub_category', '');
$page = Yii::app()->request->getQuery('page', '');
$source = Yii::app()->request->getQuery('source', '');
$urlDoctorView = $this->createAbsoluteUrl('doctor/view', array('id' => ''));
$urlHomeView = $this->createUrl('home/view');
$urlDoctorSearch = $this->createUrl('doctor/search');
$this->show_footer = false;
?>
<style>
</style>
<header class="bg-green">
    <nav class="left">
        <a href="<?php echo $urlHomeView; ?>">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">找名医</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<nav id="findDoc_nav" class="header-secondary bg-white">
    <div class="grid w100 color-black font-s16 color-black6">
        <div id="deptSelect" class="col-1 w33 br-gray bb-gray grid middle grayImg">
            <span id="deptTitle" data-dept="">科室</span><img src="<?php echo $urlResImage; ?>gray.png">
        </div>
        <div id="diseaseSelect" class="col-1 w33 br-gray bb-gray grid middle grayImg">
            <span id="diseaseTitle" data-disease="">疾病</span><img src="<?php echo $urlResImage; ?>gray.png">
        </div>
        <div id="citySelect" class="col-1 w33 bb-gray grid middle grayImg">
            <span id="cityTitle" data-city="">地区</span><img src="<?php echo $urlResImage; ?>gray.png">
        </div>
    </div>
</nav>
<article id="findDoc_article" class="active" data-scroll="true">
    <div id="docPage">

    </div>
</article>
<script>
    $(document).ready(function () {
        //访问来源
        $source = '<?php echo $source; ?>';

        //返回首页
        $homeView = '<?php echo $urlHomeView; ?>'

        //请求医生
        $requestDoc = '<?php echo $urlDoctor; ?>';
        $requestDisease = '<?php echo $urlDisease; ?>';
        $requestDoctorSearch = '<?php echo $urlDoctorSearch; ?>';
        //预约页面
        $requestDoctorView = '<?php echo $urlDoctorView; ?>';

        $condition = new Array();
        $condition["city"] = '<?php echo $city ?>';
        $condition["disease"] = '<?php echo $disease; ?>';
        $condition["disease_name"] = '<?php echo $disease_name; ?>';
        $condition["disease_category"] = '<?php echo $disease_category; ?>';
        $condition["disease_sub_category"] = '<?php echo $disease_sub_category; ?>';
        $condition["page"] = '<?php echo $page == '' ? 1 : $page; ?>';

        //首次进入，更新科室
        if ('<?php echo $disease_sub_category; ?>' != '') {
            $.ajax({
                url: '<?php echo $urlDeptName; ?>/' + '<?php echo $disease_sub_category; ?>',
                success: function (data) {
                    //console.log(data);
                    var deptName = data.results.name;
                    deptName = deptName.length > 4 ? deptName.substr(0, 3) + '...' : deptName;
                    $('#deptTitle').html(deptName);
                    $('#deptTitle').attr('data-dept', data.results.id);
                }
            });
        }


        //首次进入，更新疾病
        if ('<?php echo $disease; ?>' != '') {
            $.ajax({
                url: '<?php echo $urlDiseaseName; ?>/' + '<?php echo $disease; ?>',
                success: function (data) {
                    //console.log(data);
                    var diseaseName = data.disease.name;
                    diseaseName = diseaseName.length > 4 ? diseaseName.substr(0, 3) + '...' : diseaseName;
                    $('#diseaseTitle').html(diseaseName);
                    $('#diseaseTitle').attr('data-disease', data.disease.id);
                }
            });
        }

        //首次进入，更新城市
        if ('<?php echo $city; ?>' != '') {
            $.ajax({
                url: '<?php echo $urlCityName; ?>/' + '<?php echo $city; ?>',
                success: function (data) {
                    //console.log(data);
                    var cityName = data.results.name;
                    cityName = cityName.length > 4 ? cityName.substr(0, 3) + '...' : cityName;
                    $('#cityTitle').html(cityName);
                    $('#cityTitle').attr('data-city', data.results.id);
                }
            });
        }

        var urlAjaxLoadDoctor = '<?php echo $urlDoctor; ?>' + setUrlCondition() + '&getcount=1';
        J.showMask();
        $.ajax({
            url: urlAjaxLoadDoctor,
            success: function (data) {
                //console.log(data);
                readyDoc(data);
                setLocationUrl();
            }
        });

        $deptId = '';
        $deptName = '科室';


        //ajax异步加载科室
        $deptHtml = '';
        var urlloadDiseaseCategory = '<?php echo $urlDiseasecategory; ?>';
        $.ajax({
            url: urlloadDiseaseCategory,
            success: function (data) {
                //console.log(data);
                $deptHtml = readyDept(data);
            }
        });

        //ajax异步加载地区
        $cityHtml = ''
        var requestCity = '<?php echo $urlCity; ?>?has_team=0';
        $.ajax({
            url: requestCity,
            success: function (data) {
                //console.log(data);
                $cityHtml = readyCity(data);
            }
        });

        function readyDept(data) {
            var results = data.results;
            var innerHtml = '<div class="grid color-black" style="margin-top:93px;height:315px;">' +
                    '<div id="highDept" class="col-1 w50" data-scroll="true" style="height:315px;width: 50%;">' +
                    '<ul class="list">';
            if (results.length > 0) {
                for (var i = 0; i < results.length; i++) {
                    //第一个为白色
                    if (i == 0) {
                        innerHtml += '<li class="aDept bg-white" data-dept="' + results[i].id + '">' + results[i].name + '</li>';
                    } else {
                        innerHtml += '<li class="aDept" data-dept="' + results[i].id + '">' + results[i].name + '</li>';
                    }
                }
                innerHtml += '</ul></div><div id="secondDept" class="col-1 w50" data-scroll="true" data- style="height:315px;">'
                for (var i = 0; i < results.length; i++) {
                    var subCat = results[i].subCat;
                    //第一个不隐藏
                    if (i == 0) {
                        innerHtml += '<ul class="bDept list" data-dept="' + results[i].id + '">';
                    } else {
                        innerHtml += '<ul class="bDept list hide" data-dept="' + results[i].id + '">';
                    }
                    if (subCat.length > 0) {
                        for (var j = 0; j < subCat.length; j++) {
                            innerHtml += '<li class="cDept" data-dept="' + subCat[j].id + '">' + subCat[j].name + '</li>';
                        }
                    }
                    innerHtml += '</ul>';
                }
            }
            innerHtml += '</div></div>';
            return innerHtml;
        }

        function readyCity(data) {
            var results = data.results;
            var innerHtml = '<div class="grid color-black" style="margin-top:93px;height:315px;">' +
                    '<div id="leftCity" class="col-1 w50" data-scroll="true" style="height:315px;width: 50%;">' +
                    '<ul class="list">';
            if (results.length > 0) {
                for (var i = 0; i < results.length; i++) {
                    //第一个为白色
                    if (i == 0) {
                        innerHtml += '<li class="aCity bg-white" data-city="' + results[i].id + '">' + results[i].state + '</li>';
                    } else {
                        innerHtml += '<li class="aCity" data-city="' + results[i].id + '">' + results[i].state + '</li>';
                    }
                }
                innerHtml += '</ul></div><div id="rightCity" class="col-1 w50" data-scroll="true" data- style="height:315px;">'
                for (var i = 0; i < results.length; i++) {
                    var subCat = results[i].subCity;
                    //第一个不隐藏
                    if (i == 0) {
                        innerHtml += '<ul class="bCity list" data-city="' + results[i].id + '">';
                    } else {
                        innerHtml += '<ul class="bCity list hide" data-city="' + results[i].id + '">';
                    }
                    if (subCat.length > 0) {
                        for (var j = 0; j < subCat.length; j++) {
                            innerHtml += '<li class="cCity" data-city="' + subCat[j].id + '">' + subCat[j].city + '</li>';
                        }
                    }
                    innerHtml += '</ul>';
                }
            }
            innerHtml += '</div></div>';
            return innerHtml;
        }

    });
</script>
