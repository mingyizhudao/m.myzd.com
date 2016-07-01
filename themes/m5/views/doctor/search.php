<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/findDoc.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/findDoc.min.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
$this->setPageTitle('找名医');
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
$urlDoctorView = $this->createAbsoluteUrl('doctor/view', array('id' => ''));
$urlHomeView = $this->createUrl('home/view');
$urlDoctorSearch = $this->createUrl('doctor/search');
$urlSearchDeptName = $this->createAbsoluteUrl('/api/diseasename', array('api' => 7, 'disease_name' => ''));
$this->show_footer = false;
?>
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
        <a onclick="javascript:location.reload()">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<nav id="findDoc_nav" class="header-secondary bg-white">
    <div class="grid w100 color-black font-s16 color-black6">
        <div id="deptSelect" class="col-1 w33 br-gray bb-gray grid middle grayImg">
            <span id="deptTitle" data-dept="" data-cat=""></span><img src="<?php echo $urlResImage; ?>lowerTriangleGray.png">
        </div>
        <div id="diseaseSelect" class="col-1 w33 br-gray bb-gray grid middle grayImg">
            <span id="diseaseTitle" data-disease=""></span><img src="<?php echo $urlResImage; ?>lowerTriangleGray.png">
        </div>
        <div id="citySelect" class="col-1 w33 bb-gray grid middle grayImg">
            <span id="cityTitle" data-city=""></span><img src="<?php echo $urlResImage; ?>lowerTriangleGray.png">
        </div>
    </div>
</nav>
<article id="findDoc_article" class="active" data-scroll="true">
    <div id="docPage">

    </div>
</article>
<script>
    $(document).ready(function () {
        //返回首页
        $homeView = '<?php echo $urlHomeView; ?>';

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
                    $('#deptTitle').attr('data-cat', data.results.catId);
                }
            });
        } else if ('<?php echo $disease_name; ?>' != '') {
            $.ajax({
                url: '<?php echo $urlSearchDeptName; ?>' + '<?php echo $disease_name; ?>',
                success: function (data) {
                    //console.log(data);
                    var subCatName = data.results.subCatName;
                    subCatName = subCatName.length > 4 ? subCatName.substr(0, 3) + '...' : subCatName;
                    $('#deptTitle').html(subCatName);
                    $('#deptTitle').attr('data-dept', data.results.subCatId);
                    $('#deptTitle').attr('data-cat', data.results.catId);
                    var name = data.results.name;
                    name = name.length > 4 ? name.substr(0, 3) + '...' : name;
                    $('#diseaseTitle').html(name);
                    $('#diseaseTitle').attr('data-disease', data.results.id);
                }
            });
        } else {
            $('#deptTitle').html('科室');
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
        } else {
            $('#diseaseTitle').html('疾病');
        }

        //首次进入，更新城市
        if ('<?php echo $city; ?>' == 0) {
            $('#cityTitle').html('全部');
            $('#cityTitle').attr('data-city', 0);
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
            $('#cityTitle').html('地区');
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
        $deptData = '';
        var urlloadDiseaseCategory = '<?php echo $urlDiseasecategory; ?>';
        $.ajax({
            url: urlloadDiseaseCategory,
            success: function (data) {
                $deptData = data;
            }
        });

        //ajax异步加载地区
        var requestCity = '<?php echo $urlCity; ?>?has_team=0&&type=doctor';
        $.ajax({
            url: requestCity,
            success: function (data) {
                $cityData = data;
            }
        });
    });
</script>
