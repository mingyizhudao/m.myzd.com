<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/findHospital.js', CClientScript::POS_END);
?>
<?php
$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list');
//$urlDisease = $this->createAbsoluteUrl('/api/diseasebycategory');
$urlLoadDoctor = $this->createUrl('api/doctor', array('api' => 7, 'pagesize' => 9));
$urlloadDiseaseCategory = $this->createUrl('api/diseasecategory', array('api' => 7));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$city = Yii::app()->request->getQuery('city', '');
$disease = Yii::app()->request->getQuery('disease', '');
$disease_name = Yii::app()->request->getQuery('disease_name', '');
$disease_category = Yii::app()->request->getQuery('disease_category', '');
$disease_sub_category = Yii::app()->request->getQuery('disease_sub_category', '');
$page = Yii::app()->request->getQuery('page', '');

$urlHomeIndex = $this->createUrl('home/index');
$urlHospitalSearch = $this->createUrl('hospital/search');
$urlDepartmentView = $this->createUrl('department/view', array('id' => ''));
$urlCity = $this->createAbsoluteUrl('/api/city');
$urlHospital = $this->createAbsoluteUrl('/api/hospital', array('api' => 7));
$urlDisease = $this->createAbsoluteUrl('/api/diseasename', array('api' => 7));
$urlDiseasecategory = $this->createAbsoluteUrl('/api/diseasecategory', array('api' => 7));
$this->show_footer = false;
?>
<header class="bg-green">
    <nav class="left">
        <a href="<?php echo $urlHomeIndex; ?>" data-icon="previous"></a>
    </nav>
    <h1 class="title">找科室</h1>
</header>
<nav id="findDept_nav" class="header-secondary bg-white">
    <div class="grid w100 color-black font-s16 color-black6">
        <div id="deptSelect" class="col-1 w50 br-gray bb-gray grid middle grayImg">
            <span id="deptTitle" data-dept="">科室</span><img src="<?php echo $urlResImage; ?>gray.png">
        </div>
        <div id="citySelect" class="col-1 w50 bb-gray grid middle grayImg">
            <span id="cityTitle" data-city="">地区</span><img src="<?php echo $urlResImage; ?>gray.png">
        </div>
    </div>
</nav>
<article id="findDept_article" class="active" data-scroll="true">
    <div id="hospitalPage">
    </div>
</article>

<script>
    $(document).ready(function () {
        //请求医生
        $requestHospital = '<?php echo $urlHospital; ?>';
        $requestHospitalSearch = '<?php echo $urlHospitalSearch; ?>';

        $requestDepartment = '<?php echo $urlDepartmentView; ?>';
//            $requestDisease = '<?php //echo $urlDisease;                                                   ?>';

        $condition = new Array();
        $condition["city"] = '<?php echo $city ?>';
        $condition["disease"] = '<?php echo $disease; ?>';
        $condition["disease_name"] = '<?php echo $disease_name; ?>';
        $condition["disease_category"] = '<?php echo $disease_category; ?>';
        $condition["disease_sub_category"] = '<?php echo $disease_sub_category; ?>';
        $condition["page"] = '<?php echo $page == '' ? 1 : $page; ?>';

        //获取医院信息
        J.showMask();
        $.ajax({
            url: '<?php echo $urlHospital; ?>' + setUrlCondition() + '&getcount=1',
            success: function (data) {
                console.log(data);
                readyHospital(data);
                setLocationUrl();
            }
        });

        $deptId = '';
        $deptName = '科室';


        //ajax异步加载科室
        $deptHtml = '';
        var urlloadDiseaseCategory = '/mingyizhudao.com/api/diseasecategory?api/7';
        $.ajax({
            url: urlloadDiseaseCategory,
            success: function (data) {
                console.log(data);
                $deptHtml = readyDept(data);
            }
        });

        //ajax异步加载地区
        $cityHtml = ''
        var requestCity = '<?php echo $urlCity; ?>?has_team=0';
        $.ajax({
            url: requestCity,
            success: function (data) {
                console.log(data);
                $cityHtml = readyCity(data);
            }
        });

        function readyDept(data) {
            var results = data.results;
            var innerHtml = '<div class="grid color-black" style="margin-top:83px;height:315px;">' +
                    '<div id="leftDept" class="col-1 w50" data-scroll="true" style="height:315px;width: 50%;">' +
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
                innerHtml += '</ul></div><div id="rightDept" class="col-1 w50" data-scroll="true" data- style="height:315px;">'
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
            var innerHtml = '<div class="grid color-black" style="margin-top:83px;height:315px;">' +
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
