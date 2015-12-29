<?php
/**
 * $data.
 */
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1', 'appv' => 15, 'api' => 5));

$urlDiseaseIndex = $this->createUrl('disease/index');
$urlBooking = $this->createUrl('booking/create');
$urlHomeZhiTongChe = $this->createUrl('home/page',array('view'=>'shoushuzhitongche'));
$results = $data->results;
?>
<div id="section_container" class="mb51">
    <section id="main_section" class="active" data-init="true" data-active="home">
        <header class="head-title">
            <div class="title color-green"><?php echo $this->pageTitle; ?></div>
        </header>
        <article id="main_article" class="active" data-scroll="true">
            <div>
                <a href="<?php echo $urlHomeZhiTongChe; ?>">
                    <img class="w100" src="<?php echo $results->banners[0]['imageUrl']; ?>" alt>
                </a>

                <div class="grid pt10 color-white">
                    <div class="col-0 ml10 waike">
                        <a href="<?php echo $urlDiseaseIndex; ?>?id=<?php echo $results->disNavs[0]->id; ?>" data-target="link">
                            <div><?php echo $results->disNavs[0]->name; ?></div>
                        </a>
                    </div>
                    <div class="col-1 ml5 guke mr10">
                        <a href="<?php echo $urlDiseaseIndex; ?>?id=<?php echo $results->disNavs[1]->id; ?>" data-target="link">
                            <div><?php echo $results->disNavs[1]->name; ?></div>
                        </a>
                    </div>
                </div>
                <div class="grid pt5 color-white text18">
                    <div class="col-0 ml10 w60">
                        <div class="grid">
                            <div class="col-0 yanke1">
                                <a href="<?php echo $urlDiseaseIndex; ?>?id=<?php echo $results->disNavs[2]->id; ?>" data-target="link">
                                    <div><?php echo $results->disNavs[2]->name; ?></div>
                                </a>
                            </div>
                            <div class="col-0 bg-white w5p"></div>
                            <div class="col-1 kouqiang1">
                                <a href="<?php echo $urlDiseaseIndex; ?>?id=<?php echo $results->disNavs[3]->id; ?>" data-target="link">
                                    <div><?php echo $results->disNavs[3]->name; ?></div>
                                </a>
                            </div>
                        </div>
                        <div class="grid mt5 ">
                            <div class="col-0 fuke1">
                                <a href="<?php echo $urlDiseaseIndex; ?>?id=<?php echo $results->disNavs[4]->id; ?>" data-target="link">
                                    <div><?php echo $results->disNavs[4]->name; ?></div>
                                </a>
                            </div>
                            <div class="col-0 area-space bg-white w5p"></div>
                            <div class="col-1 xiaoer1">
                                <a href="<?php echo $urlDiseaseIndex; ?>?id=<?php echo $results->disNavs[5]->id; ?>" data-target="link">
                                    <div><?php echo $results->disNavs[5]->name; ?></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 ml5 qita1">
                        <a href="<?php echo $urlDiseaseIndex; ?>?id=<?php echo $results->disNavs[6]->id; ?>" data-target="link">
                            <div><?php echo $results->disNavs[6]->name; ?></div>
                        </a>
                    </div>
                </div>
                <div class="mt20">
                    <div class="bb-black pt10"></div>
                    <div class="list_title mt20 text-center">
                        <span>每周推荐</span>
                    </div>
                    <ul class="list list_border">
                        <?php
                        $doctors = $results->doctors;
                        if (count($doctors)) {
                            for ($i = 0; $i < count($doctors); $i++) {
                                ?>
                                <li>
                                    <div class="grid">
                                        <div class="col-1 w25">
                                            <img class="img80"  src="<?php echo $doctors[$i]->imageUrl; ?>">
                                        </div>
                                        <div class="ml10 col-1 w50">
                                            <div class="team-name mt10 doctor-title"><?php echo $doctors[$i]->name; ?>
                                                <?php
                                                if (($doctors[$i]->hpDeptName != null)||($doctors[$i]->hpDeptName != '')) {
                                                    ?>
                                                    <span class="ml2"><?php echo $doctors[$i]->hpDeptName; ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="team-hospital mt5 color-gray"><span><?php echo $doctors[$i]->mTitle; ?>/<?php echo $doctors[$i]->aTitle; ?></span></div>
                                            <div class="team-slogan mt5 color-black"><?php echo $doctors[$i]->hpName; ?></div>
                                        </div>
                                        <div class="col-1 mt10 w25 text-right">
                                            <a href="<?php echo $urlBooking . '?did=' . $doctors[$i]->id; ?>" data-target="link" class="button reserve_button"  >预约</a>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            echo '<li>暂无推荐</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </article>
    </section>
</div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '<?php echo $urlApiAppNav1; ?>',
            success: function (data) {
                //console.log(data);
            }
        });
    });
</script>
