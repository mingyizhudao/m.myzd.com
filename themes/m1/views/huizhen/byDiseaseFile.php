<?php
//$dataFile string path.
//$data. get from $dataFile.

require_once($dataFile);

$this->setPageID('pHospitalByDisease');
$this->setPageTitle($data['disease']['name']);
?>

<style>
    .doctor .d-name,.doctor .d-hospital, .hospital .h-class{margin-right:2em;}
</style>

<?php
if ($this->isAjaxRequest() === false) {
   // $this->renderPartial('//layouts/header');
}
?>
<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-nav-rel="#f-nav-1">
    <div data-role="content" class="ui-content">

        <h3 calss="ui-bar">疾病分类。。。</h3>
        <div class="ui-body">xxxxx</div>

        <h3 class="ui-bar">部分合作医院</h3>
        <div class="">
            <ul data-role="listview" data-inset="false" data-theme="a">

                <?php
                foreach ($data['hospital'] as $key => &$hospital) {
                    $hospital['pageId'] = 'pageHospitalH-' . $key;
                    ?>
                    <li class="hospital">
                        <a href="<?php echo $this->createUrl('hospital/view', array('id' => $hospital['id'])); ?>" data-prefetch="true" data-transition="slide">
                            <h3><span class="h-name"><?php echo $hospital['name']; ?></span></h3>
                            <p><span class="h-class"><?php echo $hospital['class']; ?></span><span class="h-type"><?php echo $hospital['type']; ?></span></p>                        
                        </a>                       
                    </li>
                <?php } ?>


            </ul>
        </div>
        <h3 class="ui-bar">部分合作医生</h3>
        <div class="">   
            <ul data-role="listview" data-inset="false" data-theme="a">
                <?php
                foreach ($data['doctor'] as $key => &$doctor) {
                    $doctor['pageId'] = 'pageHospitalD-' . $key;
                    ?>
                    <li class="doctor">
                        <a href="#<?php echo $doctor['pageId']; ?>" data-transition="slide">
                            <img class="d-avatar" src="<?php echo $doctor['avatar']; ?>"/>
                            <h3><span class="d-name"><?php echo $doctor['name']; ?></span> <span class="d-title"><?php echo $doctor['title']; ?></span></h3>               
                            <p><span class="d-hospital"><?php echo $doctor['hospital']; ?></span></p>
                            <p><span class="d-faculty"><?php echo $doctor['faculty']; ?></span></p>

                        </a>          
                    </li>
                <?php } ?>
            </ul>
        </div>

    </div><!-- /content -->

</div>


<?php
if ($this->isAjaxRequest() === false) {
  //  $this->renderPartial('//layouts/footer');
}
?>