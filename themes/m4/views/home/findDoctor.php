<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlHomeFindDoctor = $this->createUrl('home/findDoctor');
$urlFindExpertteamByDiseaseId = $this->createUrl('home/findExpertteamByDiseaseId');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlHomeIndex = $this->createUrl('home/index');
$this->show_footer = false;
?>
<div id="section_container" class="mb0">
    <section id="findexpert_section dpt" class="active" data-dpt="index">
        <header class="head-title">
            <nav class="left">
                <a href="<?php echo $urlHomeIndex; ?>" data-icon="previous" data-target="link" class="color-green"></a>
            </nav>
            <span class="title color-green" >按疾病找名医</span>
        </header>
        <article id="expert_list1_article" class="active">
            <div class="border-green"></div>
            <div class="grid heightList">
                <div class="col-0 find-menu hide">
                    <?php
                    if (count($model) > 0) {
                        for ($i = 0; $i < count($model); $i++) {
                            $height = '';
                            if ($i == (count($model) - 1)) {
                                $height = 'h25';
                            } else {
                                $height = 'h12-5';
                            }
                            ?>
                            <a href="<?php echo $urlHomeFindDoctor; ?>?id=<?php echo $model[$i]->id; ?>" data-target="link">
                                <div class="find-waike grid middle <?php echo $height; ?>" data-dpt="<?php echo $model[$i]->id; ?>">
                                    <span><?php echo $model[$i]->name; ?></span>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    ?>

                </div>

                <?php
                if (count($model)) {
                    for ($i = 0; $i < count($model); $i++) {
                        ?>
                        <div class="col-1 find-list-b dptListAll pb20" data-dpt="<?php echo $i; ?>" data-scroll="true" style="display:none;">
                            <?php
                            $dptData = $model[$i]->subCat;
                            if (count($dptData) > 0) {
                                for ($j = 0; $j < count($dptData); $j++) {
                                    $display = '';
                                    $faIcon = 'fa-caret-right';
                                    if ($j === 0) {
                                        $display = 'display-block';
                                        $faIcon = 'fa-caret-down';
                                    }
                                    ?>
                                    <div class="pt20"></div>
                                    <div class="color-black pl30 find-list-a tog" data-dpt="<?php echo $j; ?>">
                                        <i class="fa <?php echo $faIcon; ?> fa-lg color-green" data-dpt="<?php echo $j; ?>"></i><?php echo $dptData[$j]->name; ?>
                                    </div>
                                    <ul class="color-black sick_list box <?php echo $display; ?>" data-dpt="<?php echo $j; ?>">
                                        <?php
                                        $diseases = $dptData[$j]->diseases;
                                        if (count($diseases)) {
                                            for ($k = 0; $k < count($diseases); $k++) {
                                                ?>
                                                <li><a href="<?php echo $urlFindExpertteamByDiseaseId; ?>?id=<?php echo $diseases[$k]->id; ?>"><?php echo $diseases[$k]->name; ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>		
        </article>
    </section>
</div>
<script>
    $(document).ready(function() {
        J.showMask();

        //设置页面宽度
        var pageHeight = document.body.scrollHeight;
        var height = pageHeight - 44;
        $('.heightList').css('height', height + 'px');
        $('.find-menu').css('height', height + 'px');
        $('.dptListAll').css('height', height + 'px');
        $('.find-menu').removeClass('hide');

        var id = getDptId();
        $('.middle').each(function() {
            if (id == $(this).attr('data-dpt')) {
                $(this).addClass('active');
            }
        });
        $('.dptListAll').each(function() {
            if ((id - 1) == $(this).attr('data-dpt')) {
                $(this).css('display', 'block');
            }
        });
        J.hideMask();
    });

    function getDptId() {
        var id = '';
        var url = window.location.search;
        if (url.indexOf('?') != -1) {
            var str = url.substr(1);
            strs = str.split('&');
            for (var i = 0; i < strs.length; i++) {
                if ((strs[i].split('=')[0]) == 'id') {
                    id = unescape(strs[i].split('=')[1]);
                }
            }
        }
        return id;
    }
    /*展开、收回科室*/
    $(".tog").click(function() {
        var dpt = $(this).attr('data-dpt');
        $('.fa').each(function() {
            if (dpt == $(this).attr('data-dpt')) {
                if ($(this).hasClass('fa-caret-right')) {
                    $(this).removeClass('fa-caret-right');
                    $(this).addClass('fa-caret-down');
                    return;
                }
                if ($(this).hasClass('fa-caret-down')) {
                    $(this).removeClass('fa-caret-down');
                    $(this).addClass('fa-caret-right');
                }
            }
        });
        $('.box').each(function() {
            if (dpt == $(this).attr('data-dpt')) {
                if ($(this).css('display') == 'none') {
                    $(this).addClass('display-block');
                    return;
                }
                if ($(this).css('display') == 'block') {
                    $(this).removeClass('display-block');
                }
            }
        });
    });
</script>