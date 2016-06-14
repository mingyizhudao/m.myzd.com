<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/searchHospital.js?ts=' . time(), CClientScript::POS_END);
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
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
        <a>
            <span class="ml20 pb2 br-white"></span>
        </a>
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png" class="w24p ml20">
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
        var requestCity = '<?php echo $urlCity; ?>?has_team=0';
        $.ajax({
            url: requestCity,
            success: function (data) {
                //console.log(data);
                $cityHtml = readyCity(data);
            }
        });

        function readyCity(data) {
            var results = data.results;
            var innerHtml = '<div class="grid color-black" style="margin-top:43px;height:315px;">' +
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
