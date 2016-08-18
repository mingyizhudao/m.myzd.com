<?php
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/searchHospital.min.1.0.js', CClientScript::POS_END);
?>
<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$city = Yii::app()->request->getQuery('city', '');
$innerDeptId = Yii::app()->request->getQuery('innerDeptId', '');
$disease = Yii::app()->request->getQuery('disease', '');
$disease_name = Yii::app()->request->getQuery('disease_name', '');
$page = Yii::app()->request->getQuery('page', '');

$urlHomeView = $this->createUrl('home/view');
$urlHospitalSearch = $this->createUrl('hospital/search');
$urlDepartmentView = $this->createUrl('department/view', array('id' => ''));
$urlCity = $this->createAbsoluteUrl('/api/city');
$urlCityName = $this->createAbsoluteUrl('/api/city');
$urlHospital = $this->createAbsoluteUrl('/api/hospital', array('api' => 7));
$urlDiseaseName = $this->createAbsoluteUrl('/api/diseasename', array('api' => 7, 'disease_name' => ''));
$this->show_footer = false;
?>
<header id="searchDept_header" class="bg-green">
    <nav class="left">
        <a href="<?php echo $urlHomeView; ?>">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
        <a>
            <span class="ml20 pb2 br-white"></span>
        </a>
        <a onclick="javascript:history.go(0)">
            <img src="http://static.mingyizhudao.com/146975853464574" class="w24p ml20">
        </a>
    </nav>
    <h1 class="title">
        <span id="deptTitle" class="" data-dept=""></span>
    </h1>
    <nav id="selectCity" class="right">
        <div class="grid mt17">
            <div class="font-s16 col-0" id="cityTitle" data-city="">
                地区
            </div>
            <div class="col-0 cityImg"></div>
        </div>
    </nav>
</header>
<article id="searchDept_article" class="active" data-scroll="true">
    <div id="hospitalPage">
    </div>
</article>

<script>
    $(document).ready(function () {
        //返回首页
        $homeView = '<?php echo $urlHomeView; ?>';

        //请求医生
        $requestHospital = '<?php echo $urlHospital; ?>';
        $requestHospitalSearch = '<?php echo $urlHospitalSearch; ?>';

        $requestDepartment = '<?php echo $urlDepartmentView; ?>';

        $condition = new Array();
        $condition["city"] = '<?php echo $city ?>';
        $condition["disease"] = '<?php echo $disease; ?>';
        $condition["disease_name"] = '';
        $condition["page"] = '<?php echo $page == '' ? 1 : $page; ?>';

        J.showMask();

        //疾病name
        $diseaseName = '<?php echo $disease_name; ?>';

        //首次进入，更新科室
        $.ajax({
            url: '<?php echo $urlDiseaseName; ?>' + $diseaseName,
            success: function (data) {
                //console.log(data);
                $('#deptTitle').html(data.results.subCatName);
                $('#deptTitle').attr('data-dept', data.results.subCatId);
            }
        });

        //首次进入，更新城市
        if ('<?php echo $city ?>' != '') {
            $.ajax({
                url: '<?php echo $urlCityName; ?>/' + '<?php echo $city ?>',
                success: function (data) {
                    //console.log(data);
                    $('#cityTitle').html(data.results.name);
                    $('#cityTitle').attr('data-city', data.results.id);
                }
            });
        }

        //获取医院信息
        $.ajax({
            url: '<?php echo $urlHospital; ?>' + setUrlCondition() + '&getcount=1',
            success: function (data) {
                //console.log(data);
                readyHospital(data);
                $condition["disease_name"] = '<?php echo $disease_name; ?>';
                setLocationUrl();
            }
        });

        //$deptId = readyDeptId;
        //$deptName = readyDeptName;

        //ajax异步加载科室
        //$deptHtml = readyDept(diseaseData);

        //ajax异步加载地区
        $cityHtml = ''
        var requestCity = '<?php echo $urlCity; ?>?has_team=0&type=hospital';
        $.ajax({
            url: requestCity,
            success: function (data) {
                //console.log(data);
                $cityHtml = readyCity(data);
            }
        });

        function readyCity(data) {
            var results = data.results;
            var innerHtml = '<div class="color-black" data-scroll="true" style="margin-top:44px;height:315px;">';
            if (results.length > 0) {
                innerHtml += '<ul class="list" data-city="">';
                for (var i = 0; i < results.length; i++) {
                    innerHtml += '<li class="cCity" data-city="' + results[i].id + '">' + results[i].city + '</li>';
                }
                innerHtml += '</ul>';
            }
            innerHtml += '</div></div>';
            return innerHtml;
        }

    });
</script>
