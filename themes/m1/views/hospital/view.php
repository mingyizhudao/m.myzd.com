<?php
//$ihospital IHospital
$this->setPageID('pHospitalView-' . $ihospital->getId());
$this->setPageTitle($ihospital->getName());
/*
  if (isset($_GET['ptitle']) && $_GET['ptitle'] != '') {
  $this->setPageTitle($_GET['ptitle']);
  } else {

  $this->setPageTitle('看名医');
  }
 */
?>

<div id="<?php echo $this->getPageID(); ?>" class="hp-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>"  data-nav-rel="#f-nav-huizhen" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content" class="ui-content">
        <section class="m-panel">
            <div class="m-sub-panel">
                <div class="hp-avatar"><img src="<?php echo $ihospital->getUrlImage(); ?>"></div>
            </div>
            <div class="m-sub-panel">
                <div class="hp-name"><?php echo $ihospital->getName(); ?></div>
            </div>

            <div class="m-sub-panel">
                <div class="hp-class"><?php echo $ihospital->getClass(); ?></div>
                <div class="hp-type"><?php echo $ihospital->getType(); ?></div>
            </div>

            <div class="m-sub-panel">
                <div class="hp-desc m-paragraph"><?php echo $ihospital->getDescription(); ?></div>
            </div>
        </section>
        <section class="banner-contactus mt2">
            <a class="ui-btn btn-success ui-btn-icon-right ui-icon-carat-r" href="<?php echo $this->createUrl('app/enquiry', array('addBackBtn' => 1)); ?>" rel="external" data-transition="slide">立即预约</a>                    
        </section>
    </div>
</div>
