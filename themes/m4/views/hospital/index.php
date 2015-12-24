<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/cityExpteam.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/dept.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('合作医院');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav3', 'appv' => 15, 'api' => 4));

$urlExpertteam = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav2'));
$urlDoctor = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav3'));
$urlCity = $this->createAbsoluteUrl('/api/list', array('model' => 'city'));
$urlHospitalView = $this->createUrl('hospital/view', array('id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>
<div id="section_container" class="mb51">
    <section id="teamhospital_section" data-init="true" class="active" data-active="hospital">
        <header class="head-title h88p">
            <div class="grid vertical title h90p">
                <div class="col-0 h40p color-green titleName"><?php echo $this->pageTitle; ?></div>
                <div class="col-1">
                    <div class="grid" >
                        <div class="col-0 w50 cityover-btn">
                            <a id="btn_t_ts_expert1">
                                <div>
                                    <span class="color-green cityTitle" data-city="1">北京</span>
                                    <img src="<?php echo $urlResImage ?>/image/team_list.png">
                                </div>
                            </a>
                        </div>
                        <div class="col-0 w50 cityover-btn">
                            <a class="btn_t_top">
                                <div>
                                    <span class="color-green dptTitle" data-dpt="0">全部</span>
                                    <img src="<?php echo $urlResImage ?>/image/team_list.png">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <article id="expert_list_article" class="active" data-scroll="true">
            <div>
                <div class="team_divider mt30"> </div>
                <div id="urlExpertteam" class="hide"><?php echo $urlExpertteam; ?></div>
                <div id="urlDoctor" class="hide"><?php echo $urlDoctor; ?></div>
                <ul class="list demo-list ">
                </ul>
            </div>
        </article>
    </section>
</div>
<script>
    $(document).ready(function () {
        J.showMask();
        var requestUrl = '<?php echo $urlApiAppNav1; ?>' + '&city=1';
        $.ajax({
            url: requestUrl,
            success: function (data) {
                //console.log(data);
                readyPage(data);
            }
        });
        J.hideMask();
        $cityId = 1;
        $cityName = '北京';
        $dptId = '';
        $dptName = '全部';

        $cityHtml = '';
        $.ajax({
            url: '<?php echo $urlCity; ?>',
            success: function (data) {
                //console.log(data);
                $cityHtml = readyCity(data);
            }
        });
    });
    function readyPage(data) {
        var hospitals = data.results.hospitals;
        innerHtml = '';
        if (hospitals.length > 0) {
            for (var i = 0; i < hospitals.length; i++) {
                innerHtml += '<li data-icon="next">' +
                        '<a href="<?php echo $urlHospitalView; ?>/' + hospitals[i].id + '" data-target="link">' +
                        '<div class="pl20">' +
                        '<div class="color-black htitle text18">' + hospitals[i].name + '</div>' +
                        '<div class="htitle1 mt10">' + hospitals[i].hpClass + '</div>' +
                        '</div>' +
                        '</a>' +
                        '</li>';
            }
        } else {
            innerHtml += '<li>暂无医院信息</li>';
        }
        $('.cityTitle').attr('data-city', $cityId);
        $('.cityTitle').html($cityName);
        $('.dptTitle').attr('data-dpt', $dptId);
        $('.dptTitle').html($dptName);
        $('.list').html(innerHtml);
    }

    function readyCity(data) {
        var results = data.results;
        innerHtml = '<div class="grid color-black" style="margin-top:42px;height:312px;">' +
                '<div class="col-1 w50 list1-left" style="height:312px;">' +
                '<ul class="list1">';
        if (results.length > 0) {
            for (var i = 0; i < results.length; i++) {
                /*第一个为白色*/
                if (i == 0) {
                    innerHtml += '<li class="province bg-white" data-city="' + results[i].id + '">';
                } else {
                    innerHtml += '<li class="province" data-city="' + results[i].id + '">';
                }

                innerHtml += '<div>' + results[i].state +
                        '</div>' +
                        '</li>';
            }
            innerHtml += '</ul>' +
                    '</div>' +
                    '<div class="col-1 w50 list1-right h312p" data-scroll="true">';
            for (var i = 0; i < results.length; i++) {
                var subCity = results[i].subCity;
                /*第一个不隐藏*/
                if (i == 0) {
                    innerHtml += '<ul class="cityList list1" data-city="' + results[i].id + '">';
                } else {
                    innerHtml += '<ul class="cityList list1" data-city="' + results[i].id + '" style="display:none;">';
                }
                if (subCity.length > 0) {
                    for (var j = 0; j < subCity.length; j++) {
                        innerHtml += '<li>' +
                                '<a data-target="link">' +
                                '<div class="color-black city" data-city="' + subCity[j].id + '">' + subCity[j].city + '</div>' +
                                '</a>' +
                                '</li>';
                    }
                }
                innerHtml += '</ul>';
            }
        }
        innerHtml += '</div></div>';
        return innerHtml;
    }
</script>