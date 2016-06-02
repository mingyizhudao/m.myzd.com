<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/findHospital.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/findHospital.min.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
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
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">
    </h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<nav id="findDept_nav" class="header-secondary bg-white">
    <div class="grid w100 color-black font-s16 color-black6">
        <div id="deptSelect" class="col-1 w50 br-gray bb-gray grid middle grayImg">
            <span id="deptTitle" data-dept=""></span><img src="<?php echo $urlResImage; ?>lowerTriangleGray.png">
        </div>
        <div id="citySelect" class="col-1 w50 bb-gray grid middle grayImg">
            <span id="cityTitle" data-city=""></span><img src="<?php echo $urlResImage; ?>lowerTriangleGray.png">
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
            } else {
                $('#cityTitle').html('地区');
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
            $cityHtml = ''
            var requestCity = '<?php echo $urlCity; ?>?has_team=0';
            $.ajax({
                url: requestCity,
                success: function (data) {
                    //console.log(data);
                    $cityHtml = readyCity(data);
                }
            });
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
