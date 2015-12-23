<?php
//$data = array(
//    'disease' => array(
//        'name' => '',
//        'list' => array()
//        'icon'=>'',
//    ),
//    'hospital' => array(),
//    'doctor' => array()
//);


$this->setPageID('pHospitalByDisease');
$this->setPageTitle($data['disease']['name']);
$disList = array_merge($data['disease']['list'], array('其它'));
//$resourceUrl = Yii::app()->baseUrl . '/resource/';
$sampleUrl = Yii::app()->theme->baseUrl . '/images/sample/';
$disSub = '疾病分类';
if (isset($data['disease']['sub_name'])) {
    $disSub = $data['disease']['sub_name'];
}
//$hImageUrl = $sampleUrl . 'h01.jpg';
?>

<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回" data-nav-rel="#f-nav-huizhen">
    <div>
        <section class="section-disease <?php echo $data['disease']['icon']; ?>">
            <div class="dis-info">
                <div class="dis-sub"><?php echo $disSub; ?></div>
                <div class="ui-grid-a dis-list">
                    <?php
                    $uiBlockOptions = array(1 => 'a', 2 => 'b');
                    $index = 1;
                    foreach ($disList as $dis) {
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
                <?php
                foreach ($data['hospital'] as $key => &$hospital) {
                    //$hospital['pageId'] = 'pageHospitalH-' . $key;
                    ?>
                    <li class="hospital">
                        <a href="<?php echo $this->createUrl('hospital/view', array('id' => $hospital->id, 'ptitle' => $this->getPageTitle())); ?>" data-prefetch="true" data-transition="slide">
                            <?php echo '<img src="' . $hospital->getAbsUrlAvatar() . '" title="' . $hospital->name . '" alt="' . $hospital->name . '" />'; ?>                            
                            <div class="h-name"><?php echo $hospital->name; ?></div>
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
                foreach ($data['doctor'] as $key => &$doctor) {
                    ?>
                    <li class="doctor">
                        <a href="#<?php echo $this->createUrl('doctor/view', array('id' => $doctor->id, 'ptitle' => $this->getPageTitle())); ?>" data-transition="slide">
                            <img class="d-avatar my-border-round" src="<?php echo $doctor->getAbsUrlAvatar(); ?>"/>
                            <div class="d-name"><?php echo $doctor->fullname; ?></div>               
                            <div class="d-hospital"><?php echo $doctor->getHospitalName(); ?></div>
                            <div class="d-faculty"><?php echo $doctor->getFaculty(); ?></div>
                            <div class="d-title"><?php echo $doctor->getTitle(); ?></div>
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