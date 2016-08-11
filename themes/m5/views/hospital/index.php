<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/hospitalIndex.min.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/hospitalIndex.min.1.0.js', CClientScript::POS_END);
?>
<?php
$this->setPageTitle('推荐');
$urlHospital = $this->createAbsoluteUrl('/api/hospital', array('api' => 6));
$urlHospitalView = $this->createUrl('hospital/view', array('id' => ''));
$urlCity = $this->createAbsoluteUrl('/api/city');
$urlCityName = $this->createAbsoluteUrl('/api/city');

$urlHospitalIndex = $this->createUrl('hospital/index');
$urlTopHospital = $this->createUrl('hospital/topHospital');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$city = Yii::app()->request->getQuery('city', '');
$page = Yii::app()->request->getQuery('page', '');
?>
<header id="hospital_header" class="bg-green">
    <nav id="selectCity" class="left">
        <div class="grid mt17">
            <div id="cityTitle" class="font-s16 col-0" data-city=""></div>
            <div class="col-0 cityImg"></div>
        </div>
    </nav>
    <h1 class="title">推荐</h1>
</header>
<article id="hospital_article" data-active="hospital_footer" class="active" data-scroll="true">
    <div>

    </div>
</article>
<script>
    $(document).ready(function () {
        $requestHospitalView = '<?php echo $urlHospitalView; ?>';
        $requestHospital = '<?php echo $urlHospital; ?>';
        $requestHospitalIndex = '<?php echo $urlHospitalIndex; ?>';
        $urlTopHospital = '<?php echo $urlTopHospital; ?>';

        $condition = new Array();
        $condition["city"] = '<?php echo $city ?>';
        J.showMask();

        //返回时，更新城市
        if ('<?php echo $city ?>' == 0) {
            $('#cityTitle').html('全部');
            $('#cityTitle').attr('data-city', 0);
        } else if ('<?php echo $city ?>' != 1) {
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
            $('#cityTitle').html('北京');
            $('#cityTitle').attr('data-city', 1);
        }

        $.ajax({
            url: '<?php echo $urlHospital; ?>' + setUrlCondition() + '&getcount=1',
            success: function (data) {
                //console.log(data);
                readyHospital(data);
                setLocationUrl();
            }
        });

        //ajax异步加载城市
        $cityData = '';
        $.ajax({
            url: '<?php echo $urlCity; ?>?has_team=0&type=hospital',
            success: function (data) {
                $cityData = data;
            }
        });
    });
</script>