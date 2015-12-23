<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>

<div id="<?php echo $this->getPageID(); ?>" class="home-page" data-home="true" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-home">  
    <div data-role="content" class="padtop1 bordertop">
        <div id="team-bxslider" class="row mt-fix pt10">
            <div class="page-title"><span>明星专家团队</span></div>
            <ul class="bxslider">
                <?php
                for ($i = 0; $i < count($data['expertteams']); $i++) {
                    $eteam = $data['expertteams'][$i];
                    if($eteam->id==13){continue;}
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
            for ($i = 0; $i < count($data['banners']); $i++) {
                $banners = $data['banners'][$i];
                ?>
                <div class="">
                    <a href="<?php echo $banners->actionUrl; ?>">
                        <img src="<?php echo $banners->imageUrl; ?>"/>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div id="citys" class="row">    
            <div class="page-title"><span>顶级合作医院</span></div>
            <div class="ui-grid-a city-list pb20">
                <?php
                for ($i = 0; $i < count($data['locations']); $i++) {
                    $locations = $data['locations'][$i];
                    if ($i % 2 == 0) {
                        $uiblock = 'ui-block-a';
                    } else {
                        $uiblock = 'ui-block-b';
                    }
                    ?>
                    <div class="<?php echo $uiblock; ?>">
                        <a href="<?php echo $this->createUrl('hospital/index') . "?city=" . $locations->id; ?>">
                            <div class="city"><span><?php echo $locations->name; ?></span></div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>  
    <script>
        $(document).ready(function () {
            $('.bxslider').bxSlider({
                slideWidth: 300,
                minSlides: 3,
                maxSlides: 3,
                moveSlides: 3,
                controls: true,
                slideMargin: 10
            });
        });
    </script>
</div>
