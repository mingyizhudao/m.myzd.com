<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.min.js', CClientScript::POS_END);
/**
 * $data.
 */
//var_dump($data);
// 按城市加载医院数据.
$urlHospitalsByCity = $this->createUrl("/api/hospital", array('model' => 'hospital', 'city' => ''));
// api/hospital?city=1&offset=10    加载多10个。
// 医院详情页.
$urlHospitalView = $this->createUrl('/mobile/hospital/view', array('id' => ""));

//var_dump($urlHospitalView);
$this->setPageID('pHospitalIndex');
$this->setPageTitle('推荐医院');
$resourceUrl = Yii::app()->baseUrl . '/resource/hospital/facility/';
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlLoadHospitalsByCity = $this->createAbsoluteUrl('/api/list', array('model' => 'hospital')); // append city.id behind.
?>

<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" <?php echo $this->createPageAttributes(); ?>  back-btn-text="返回" data-nav-rel="#f-nav-hospital">
    <div data-role="content" class="ui-content">
        <div class="hospital-header row">
            <div class="">
                <ul class="bxslider">
                    <?php
                    if ($data->currentLocation) {
                        $cityId = $data->currentLocation->id;
                        $active = "";
                    } else {
                        $cityId = -1;
                        $active = "active";
                    }
                    echo '<li class="slide text-center"><a href="javascript:;" data-city="-1"  class="ui-block-a city text-center ' . $active . '"><span>全部地区</span></a></li>';
                    for ($i = 0; $i < count($data->locations); $i++) {
                        if ($data->locations[$i]->id == $cityId) {
                            echo '<li class="slide text-center"><a href="javascript:;" data-city="' . $data->locations[$i]->id . '" class="ui-block-b active city text-center"><span>' . $data->locations[$i]->name . '</span></a></li>';
                        } else {
                            echo '<li class="slide text-center"><a href="javascript:;" data-city="' . $data->locations[$i]->id . '" class="ui-block-b city text-center"><span>' . $data->locations[$i]->name . '</span></a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="hospital-list row">
            <?php
            if ($data->hospitals) {
                for ($i = 0; $i < count($data->hospitals); $i++) {
                    $hospital = $data->hospitals[$i];
                    ?>
                    <a href="<?php echo $urlHospitalView . '/' . $hospital->id ?>">
                        <div class="ui-grid-b">
                            <div class="ui-block-a text-center">
                                <div><?php echo $hospital->name; ?></div>
                                <div class="mt10 text-yellow"><?php echo $hospital->hpClass; ?></div>
                            </div>
                            <div class="ui-block-b">
                                <img src="<?php echo $hospital->imageUrl; ?>">
                            </div>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.bxslider').bxSlider({
                slideWidth: 100,
                minSlides: 5,
                maxSlides: 10,
                moveSlides: 4,
                slideMargin: 0,
                controls: false,
                infiniteLoop: false
            });
            $(".city").click(function () {
                $cityId = $(this).attr("data-city");
                loadCity($cityId);
                $(".city").removeClass("active");
                $(this).addClass("active");
                setLocalUrl($cityId);
            });
        });
        function loadCity($cityid) {
            if ($cityid < 0) {
                urlLoadCity = "<?php echo $urlHospitalsByCity; ?>";
            } else {
                urlLoadCity = "<?php echo $urlHospitalsByCity; ?>" + $cityid;
            }
            $.ajax({
                url: urlLoadCity,
                success: function (data) {
                    setCityHtml(data.hospitals);
                    //setCityActive(data.currentLocation);
                    //setLocalUrl(data.currentLocation);
                }
            });
        }
        function setCityHtml($hospitals) {
            innerHtml = '';
            if ($hospitals) {
                for (var i = 0; i < $hospitals.length; i++) {
                    $hospital = $hospitals[i];
                    innerHtml +=
                            '<a href="<?php echo $urlHospitalView ?>/' +
                            $hospital.id + '"><div class="ui-grid-b"><div class="ui-block-a text-center"><div>' +
                            $hospital.name + '</div><div class="mt10 text-yellow">' +
                            $hospital.hpClass + '</div></div><div class="ui-block-b"><img src="' +
                            $hospital.imageUrl + '"></div></div></a>';
                }
            }
            $(".hospital-list").html(innerHtml);
        }
        function setCityActive($currentLocation) {
            $(".city").removeClass("active");
            if ($currentLocation) {
                $cityId = $currentLocation.id;
                $(".city").each(function () {
                    var $data_city = $(this).attr("data-city");
                    if ($data_city == $cityId) {
                        $(this).addClass("active");
                    }
                });
            } else {
                $(".city").each(function () {
                    var $data_city = $(this).attr("data-city");
                    if ($data_city == -1) {
                        $(this).addClass("active");
                    }
                });
            }
        }
        function setLocalUrl($cityid) {
            var stateObject = {};
            var title = "";
            var newUrl = "";
            if ($cityid) {
                newUrl = "<?php echo $this->createUrl("hospital/index"); ?>" + "/city/" + $cityid;
            } else {
                newUrl = "<?php echo $this->createUrl("hospital/index"); ?>";
            }
            history.pushState(stateObject, title, newUrl);
        }
    </script>
</div>
