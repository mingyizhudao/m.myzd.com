<?php

/**
 * $ifaculty IFaculty.
 */
function loadFacultyCssData($code) {
    $data = array(
        'fuchan' => array('icon' => 'm-icon-baby'),
        'gandan' => array('icon' => 'm-icon-liver'),
        'xinxueguan' => array('icon' => 'm-icon-cardio'),
        'buyun' => array('icon' => 'm-icon-fertility'),
        'guke' => array('icon' => 'm-icon-bone'),
        'xiongwaike' => array('icon' => 'm-icon-xiongwaike'),
        'miniaowaike' => array('icon' => 'm-icon-miniaowaike'),
        'shenjingke' => array('icon' => 'm-icon-shenjingke'),
        'zhongliu' => array('icon' => 'm-icon-tumor'),
        'zhengxing' => array('icon' => 'm-icon-cosmetic'),
    );
    if (isset($data[$code])) {
        return $data[$code];
    } else {
        return null;
    }
}

$hospitals = $ifaculty->getHospitals(); // array of IHospital.
$doctors = $ifaculty->getDoctors();     // array of IDoctor.
$cssData = loadFacultyCssData($ifaculty->getCode());


$this->setPageID('pHuizhenByFaculty');
$this->setPageTitle($ifaculty->getName());
//$disList = array_merge($data['disease']['list'], array('其它'));
$disList = $ifaculty->getDiseaseList();
//$resourceUrl = Yii::app()->baseUrl . '/resource/';
$sampleUrl = Yii::app()->theme->baseUrl . '/images/sample/';
$disSubTitle = '疾病分类';
/*
  if (isset($data['disease']['sub_name'])) {
  $disSubTitle = $data['disease']['sub_name'];
  }
 * 
 */
?>

<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回" data-nav-rel="#f-nav-huizhen">
    <div>
        <section class="section-disease <?php echo $cssData['icon']; ?>">
            <div class="dis-info">
                <div class="dis-sub"><?php echo $disSubTitle; ?></div>
                <div class="ui-grid-a dis-list">
                    <?php
                    $uiBlockOptions = array(1 => 'a', 2 => 'b');
                    $index = 1;
                    foreach ($disList as $dis) {
                        if ($index > 6) {
                            break;
                        }
                        $uiBlockClass = 'ui-block-a';
                        if ($index % 2 == 0) {
                            $uiBlockClass = 'ui-block-b';
                        }
                        echo '<div class="' . $uiBlockClass . '"><div class="ui-bar">' . $dis . '</div></div>';
                        $index++;
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="section-hospital">
            <div class="section-title">合作名医来自以下医院</div>
            <ul class="hospital-list" data-role="listview" data-inset="false">
                <?php foreach ($hospitals as $key => &$hospital) { ?>
                    <li class="hospital">
                        <a href="<?php echo $this->createUrl('hospital/view', array('id' => $hospital->getId(), 'ptitle' => $this->getPageTitle())); ?>" data-prefetch="true" data-transition="slide">
                            <?php echo '<img src="' . $hospital->getUrlImage() . '" title="' . $hospital->getName() . '" alt="' . $hospital->getName() . '" />'; ?>                            
                            <div class="h-name"><?php echo $hospital->getName(); ?></div>                            
                            <div class="h-info"><span class="h-class"><?php echo $hospital->getClass(); ?></span><span class="h-type"><?php echo $hospital->getType(); ?></span></div>
                        </a>                       
                    </li>
                <?php } ?>
            </ul>
        </section>

        <section class="section-doctor">   
            <div class="section-title">精选名医</div>
            <ul class="doctor-list" data-role="listview" data-inset="false">
                <?php
                foreach ($doctors as $doctor) {
                    ?>
                    <li class="doctor">
                        <a href="#<?php echo $this->createUrl('doctor/view', array('id' => $doctor->getId(), 'ptitle' => $this->getPageTitle())); ?>" data-transition="slide">
                            <img class="d-avatar my-border-round" src="<?php echo $doctor->getUrlImage(); ?>"/>
                            <div class="d-name"><?php echo $doctor->getName(); ?></div>               
                            <div class="d-hospital"><?php echo $doctor->getHospitalName(); ?></div>
                            <div class="d-faculty"><?php echo $doctor->getHospitalFaculty(); ?></div>
                            <div class="d-title"><?php echo $doctor->getMedicalTitle(); ?></div>
                            <?php
                            if ($doctor->getAcademicTitle() != '') {
                                echo '&nbsp;&nbsp;<div class="d-title">' . $doctor->getAcademicTitle() . '</div>';
                            }
                            ?>
                        </a>          
                    </li>
                <?php } ?>
            </ul>
        </section>
        <section class="banner-contactus mt2">
            <a class="ui-btn btn-success ui-btn-icon-right ui-icon-carat-r" href="<?php echo $this->createUrl('app/enquiry', array('addBackBtn' => 1)); ?>" rel="external" data-transition="slide">立即预约</a>                    
        </section>

    </div><!-- /content -->

</div>