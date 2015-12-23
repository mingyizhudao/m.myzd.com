<?php
/**
 * $data.
 */
//var_dump($data);
// $facultyId  from controller.
$this->setPageID('pFaculty');
$this->setPageTitle($data->dept->name);
$urlBooking = $this->createUrl('booking/create', array('addBackBtn' => 1));
//$enquiryUrl = $this->createUrl('home/enquiry', array('addBackBtn' => 1));
?>


<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回" data-nav-rel="#f-nav-hospital">
    <div data-role="content" class="ui-content">
        <div class="page mb20">
            <section class="page-section">
                <div class="section-body expert-content pt10 pb40">
                    <?php
                    if ($data->doctors) {
                        for ($i = 0; $i < count($data->doctors); $i++) {
                            $doc = $data->doctors[$i];
                            ?>
                            <div class="doc">
                                <div class="ui-grid-c">
                                    <div class="pull-right booking">
                                        <a href="<?php echo $urlBooking.'?did='.$doc->id; ?>" data-ajax="false"><span class="btn-booking team-btn">预约</span></a>
                                    </div>
                                    <div class="ui-block-a mr20">
                                        <img class="img80" src="<?php echo $doc->imageUrl; ?>">
                                    </div>
                                    <div class="mt10">
                                        <div class="introduce">
                                            <span class="pr10"><?php echo $doc->name; ?></span>
                                        </div>
                                        <div class="introduce">
                                            <span class="expert-mtitle"><?php echo $doc->mTitle; ?></span> | <span class="expert-atitle"><?php echo $doc->aTitle; ?></span>
                                        </div>
                                        <div class="introduce">
                                            <span class="hpname"><?php echo $data->dept->hpName; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="doc-introduce">
                                    <span class="long-title">擅长 : </span><span><?php echo $doc->desc; ?></span>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <?php
                        }
                    }
                    ?>


                </div>
            </section>
        </div>
    </div><!-- /content -->

</div>


