<?php
//$idoctor IDoctor
$this->setPageID('pDoctorView-' . $idoctor->getId());
$this->setPageTitle('看名医 - ' . $idoctor->getName());
?>


<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>"  data-nav-rel="#f-nav-huizhen" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content" class="ui-content">
        <section class="m-panel">
            <div class="m-sub-panel">
                <div class="media">
                    <span class="pull-left">
                        <img class="dr-avatar media-object my-border-round" src="<?php echo $idoctor->getUrlImage(); ?>" />                    
                    </span>
                    <div class="dr-info">
                        <div class="dr-name"><?php echo $idoctor->getName(); ?></div>                  
                        <div class="dr-title my-label my-label-blue"><?php echo $idoctor->getMedicalTitle(); ?></div>
                        <?php
                        if ($idoctor->getAcademicTitle() != '') {
                            echo '&nbsp;&nbsp;<div class="d-title my-label my-label-blue">' . $idoctor->getAcademicTitle() . '</div>';
                        }
                        ?>
                    </div>

                </div>
            </div>
            
            <div class="m-sub-panel">
                <div class="dr-hospital"><?php echo $idoctor->getHospitalName(); ?></div>  
                <div class="dr-faculty m-text-light mt1"><?php echo $idoctor->getHospitalFaculty(); ?></div> 
            </div>

            <div class="m-sub-panel">
                <div class="dr-desc m-paragraph"><?php echo $idoctor->getDescription(); ?></div>
            </div>
        </section>
        <section class="banner-contactus mt2">
            <a class="ui-btn btn-success ui-btn-icon-right ui-icon-carat-r" href="<?php echo $this->createUrl('app/enquiry', array('addBackBtn' => 1)); ?>" rel="external" data-transition="slide">立即预约</a>                    
        </section>
    </div>
</div>