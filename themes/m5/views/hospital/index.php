<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/hospitalIndex.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/hospitalIndex.min.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
$urlHospital = $this->createAbsoluteUrl('/api/hospital', array('api' => 6));
$urlHospitalView = $this->createUrl('hospital/view', array('id' => ''));
$urlCity = $this->createAbsoluteUrl('/api/city');
$urlCityName = $this->createAbsoluteUrl('/api/city');

$urlHospitalIndex = $this->createUrl('hospital/index');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$city = Yii::app()->request->getQuery('city', '');
$page = Yii::app()->request->getQuery('page', '');
?>
<header id="hospital_header" class="bg-green">
    <nav id="selectCity" class="left">
        <div class="grid mt17">
            <div id="cityTitle" class="font-s16 col-0" data-city="1"></div>
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

        $condition = new Array();
        $condition["city"] = '<?php echo $city ?>';
        J.showMask();

        //返回时，更新城市
        if ('<?php echo $city ?>' != 1) {
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
        $.ajax({
            url: '<?php echo $urlCity; ?>?has_team=0',
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