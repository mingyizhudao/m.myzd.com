<?php

//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/findHospital.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/findHospital.min.1.3.js', CClientScript::POS_END);
?>
<?php
$this->setPageTitle('【外科】科室推荐,【外科】科室哪家医院好_名医主刀网移动版');
$this->setPageDescription('名医主刀网为您提供国内医院预约手术,医院排行榜,医院大全,医院哪家好等权威信息;助您在第一时间找到好医院,以最快的时间预约医院并安排手术,网上预约手术就看名医主刀网。');
$this->setPageKeywords('【外科】科室哪家医院好');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$city = Yii::app()->request->getQuery('city', '');
$innerDeptId = Yii::app()->request->getQuery('innerDeptId', '');
$disease = Yii::app()->request->getQuery('disease', '');
$disease_name = Yii::app()->request->getQuery('disease_name', '');
$disease_category = Yii::app()->request->getQuery('disease_category', '');
$disease_sub_category = Yii::app()->request->getQuery('disease_sub_category', '');
$page = Yii::app()->request->getQuery('page', '');

$urlHomeView = $this->createUrl('home/view');
$urlHospitalTop = $this->createUrl('hospital/top');
$urlDepartmentView = $this->createUrl('department/view', array('id' => ''));
$urlCity = $this->createAbsoluteUrl('/api/city');
$urlHospital = $this->createAbsoluteUrl('/api/hospital', array('api' => 7));
$urlDiseasecategory = $this->createAbsoluteUrl('/api/diseasecategory', array('api' => 7));
$urlDisease = $this->createAbsoluteUrl('/api/diseasebycategory');
$urlDeptName = $this->createAbsoluteUrl('/api/subcategory');
$urlCityName = $this->createAbsoluteUrl('/api/city');
$this->show_footer = false;
?>

<header id="findDept_header" class="bg-green">
    <nav class="left">
        <a href="<?php echo $urlHomeView; ?>">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">
    </h1>
    <nav class="right">
        <a onclick="javascript:location.reload()">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>
<nav id="findDept_nav" class="header-secondary bg-white">
    <div class="grid w100 color-black font-s16 color-black6">
        <div id="deptSelect" class="col-1 w50 br-gray bb-gray grid middle grayImg">
            <span id="deptTitle" data-dept=""></span><img src="http://static.mingyizhudao.com/146735870119173">
        </div>
        <div id="citySelect" class="col-1 w50 bb-gray grid middle grayImg">
            <span id="cityTitle" data-city=""></span><img src="http://static.mingyizhudao.com/146735870119173">
        </div>
    </div>
</nav>
<article id="findDept_article" class="active pt20" data-scroll="true">
    <div id="hospitalPage">
    </div>
</article>

<script>
    $(document).ready(function () {
        //返回首页
        $homeView = '<?php echo $urlHomeView; ?>';

        $innerDeptId = '<?php echo $innerDeptId; ?>';
        $diseaseData = '';
        $deptHtml = '';
        var urlloadDiseaseCategory = '<?php echo $urlDiseasecategory; ?>';
        $.ajax({
            url: urlloadDiseaseCategory,
            async: false,
            success: function (data) {
                //console.log(data);
                $diseaseData = data;
                var results = data.results;
                if (results.length > 0) {
                    for (var i = 0; i < results.length; i++) {
                        if ($innerDeptId == results[i].id) {
                            $('#findDept_header .title').html(results[i].name);
                        }
                    }
                }
            }
        });

        ready('<?php echo $disease_sub_category; ?>');
        function ready(readyDeptId) {
            //请求医生
            $requestHospital = '<?php echo $urlHospital; ?>';
            $requestHospitalTop = '<?php echo $urlHospitalTop; ?>';

            $requestDepartment = '<?php echo $urlDepartmentView; ?>';

            $condition = new Array();
            $condition["city"] = '<?php echo $city ?>';
            $condition["innerDeptId"] = '<?php echo $innerDeptId; ?>';
            $condition["disease"] = '<?php echo $disease; ?>';
            $condition["disease_name"] = '<?php echo $disease_name; ?>';
            $condition["disease_category"] = '<?php echo $disease_category; ?>';
            $condition["disease_sub_category"] = readyDeptId;
            $condition["page"] = '<?php echo $page == '' ? 1 : $page; ?>';

            //首次进入，更新科室
            if ('<?php echo $disease_sub_category; ?>' != '') {
                $.ajax({
                    url: '<?php echo $urlDeptName; ?>/' + '<?php echo $disease_sub_category; ?>',
                    success: function (data) {
                        //console.log(data);
                        var deptName = data.results.name;
                        //deptName = deptName.length > 4 ? deptName.substr(0, 3) + '...' : deptName;
                        $('#deptTitle').html(deptName);
                        $('#deptTitle').attr('data-dept', data.results.id);
                    }
                });
            }

            //首次进入，更新城市
            if ('<?php echo $city; ?>' == 0) {
                $('#cityTitle').html('全部');
                $('#cityTitle').attr('data-city', '0');
            } else if ('<?php echo $city; ?>' != '') {
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
            } else {
                $('#cityTitle').html('全部');
                $('#cityTitle').attr('data-city', '');
            }

            //获取医院信息
            J.showMask();
            $.ajax({
                url: '<?php echo $urlHospital; ?>' + setUrlCondition() + '&getcount=1',
                success: function (data) {
                    //console.log(data);
                    readyHospital(data);
                    setLocationUrl();
                }
            });

            $deptId = readyDeptId;

            //ajax异步加载地区
            $cityData = '';
            $.ajax({
                url: '<?php echo $urlCity; ?>?has_team=0&type=hospital',
                success: function (data) {
                    $cityData = data;
                }
            });
        }
    });
</script>
