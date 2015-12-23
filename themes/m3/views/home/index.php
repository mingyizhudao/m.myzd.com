<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.min.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlHospital = $this->createUrl('hospital/index', array('addBackBtn' => 1));
$urlOverseas = $this->createUrl('overseas/index', array('addBackBtn' => 1));

$furl = $this->createUrl('faculty/view');
$tUrl = $this->createUrl('expertteam/view');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>

<div id="<?php echo $this->getPageID(); ?>" class="home-page" data-home="true" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-home">  
    <div data-role="content" class="padtop1 bordertop">
        <div id="team-bxslider" class="row mt-fix pt10">
            <div class="page-title"><span>明星专家团队</span></div>
            <ul class="bxslider">
                <?php
                $expCount = count($data->expertteams) > 15 ? 15 : count($data->expertteams);
                for ($i = 0; $i < $expCount; $i++) {
                    $eteam = $data->expertteams[$i];
                    if ($eteam->id == 13) {
                        continue;
                    }
                    ?>
                    <li class="slide">
                        <a href="<?php echo $this->createUrl('expertteam/view', array('id' => $eteam->id)); ?>">
                            <div><img src="<?php echo $eteam->imageUrl; ?>"/></div>
                            <div class="mt5"><?php echo $eteam->name; ?></div>
                            <div class="faculty"><?php echo $eteam->hpDept; ?></div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div id="home-zhitongche" class="row mt10 pb10"> 
            <?php
            for ($i = 0; $i < count($data->banners); $i++) {
                $banners = $data->banners[$i];
                ?>
                <div class="">
                    <a href="<?php echo $banners->actionUrl; ?>">
                        <img src="<?php echo $banners->imageUrl; ?>"/>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div id="citys" class="row">    
            <div class="page-title"><span>推荐医院</span></div>
            <div class="ui-grid-a city-list pb20">
                <?php
                for ($i = 0; $i < count($data->locations); $i++) {
                    $location = $data->locations[$i];
                    if ($i % 2 == 0) {
                        $uiblock = 'ui-block-a';
                    } else {
                        $uiblock = 'ui-block-b';
                    }
                    ?>
                    <div class="<?php echo $uiblock; ?>">
                        <a href="<?php echo $this->createUrl('hospital/index', array('city' => $location->id)); ?>" data-ajax="false" >
                            <div class="cityimage"><img src="<?php echo $location->imageUrl; ?>"/></div>
                            <div class="city"><span><?php echo $location->name; ?>></span></div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>  
        <?php
        if ($this->showBrowserModeMenu()) {
            $this->renderPartial('//layouts/footerMenu');
        }
        ?>
    </div>     
    <script>
        $(document).ready(function () {
            $('.bxslider').bxSlider({
                slideWidth: 300,
                minSlides: 3,
                maxSlides: 3,
                moveSlides: 3,
                slideMargin: 10,
                controls: false
            });
        });
    </script>
</div>
