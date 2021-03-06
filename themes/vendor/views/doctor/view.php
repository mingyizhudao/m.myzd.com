<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlBookingDoctor = $this->createAbsoluteUrl('booking/create', array('did' => ''));
$source = Yii::app()->request->getQuery('source', '');
$doctor = $data->results->doctor;
$honour = $doctor->honour;
$this->show_footer = false;
?>
<style>
    .header-secondary {
        height: auto;
        line-height: 1.5;
    }
</style>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title"><?php echo $doctor->name; ?>手术预约</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>
<nav id="bookingDoc_nav" class="header-secondary">
    <div class="grid doctorInf w100 text-left">
        <div class="col-1 w25">
            <div class="imgDiv">
                <img class="imgDoc" src="<?php echo $doctor->imageUrl; ?>">
            </div>
        </div>
        <div class="ml10 col-1 w50">
            <div class="mt10 font-s16 color-black3"><?php echo $doctor->name; ?>
                <span class="ml10"><?php
                    if ($doctor->aTitle == '无') {
                        echo '';
                    } else {
                        echo $doctor->aTitle;
                    }
                    ?></span></div>
            <?php if ($doctor->hpDeptName == '') {
                ?>
                <div class="mt5 color-gray4"><?php echo $doctor->mTitle; ?></div>
                <?php
            } else {
                ?>
                <div class="mt5 color-gray4"><?php echo $doctor->hpDeptName; ?><span class="ml10"><?php echo $doctor->mTitle; ?></span></div>
            <?php }
            ?>

            <div class="mt5 color-black6 font-s14"><?php echo $doctor->hospitalName; ?></div>
        </div>
        <div class="col-1 grid middle w25 text-right font-s16">
            <?php if ($source == 1) { ?>
                <a href = "<?php echo $urlBookingDoctor; ?>/<?php echo $doctor->id; ?>?source=<?php echo $source; ?>" data-target = "link" class = "button bg-yellow">预约</a>
            <?php } else { ?>
                <a href = "<?php echo $urlBookingDoctor; ?>/<?php echo $doctor->id; ?>" data-target = "link" class = "button bg-yellow">预约</a>
            <?php } ?>
        </div>
    </div>
</nav>
<article id="bookingDoc_article" class="" data-scroll="true">
    <div>
        <?php if (count($doctor->reasons) != 0) { ?>
            <div class="divTJ">
                <div class="bgReason font-s16 color-black pb5 mb5 aFontSize">
                    推荐理由
                </div>
                <?php
                for ($i = 0; $i < count($doctor->reasons); $i++) {
                    ?>
                    <div class="bgStars color-black6 bFontSize">
                        <?php echo $doctor->reasons[$i]; ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php } ?>
        <?php
        if (isset($doctor->description) && (trim($doctor->description) != '')) {
            ?>
            <div class="divSC">
                <div class="bgSC font-s16 color-black aFontSize">擅长</div>
                <div class="pl25 mt5 color-black6 bFontSize"><?php echo $doctor->description; ?></div>
            </div>
            <?php
        }
        ?>
        <?php if (isset($honour) && !is_null($honour)) { ?>
            <div class="divHonor">
                <div class="bgHonor font-s16 color-black mb5 aFontSize">
                    荣誉
                </div>
                <?php
                for ($i = 0; $i < count($honour); $i++) {
                    ?>
                    <div class="bgStars color-black6 bFontSize">
                        <?php echo $honour[$i]; ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php } ?>
        <?php if (isset($doctor->careerExp) && !is_null($doctor->careerExp)) { ?>
            <div class="divCareer">
                <div class="bgCareer">
                    <div class="font-s16 color-black mb5 aFontSize">执业经历</div>
                    <div class="color-black6 bFontSize"><?php echo $doctor->careerExp; ?></div>
                </div>
            </div>
        <?php } ?>
        <div class="mb10"></div>
    </div>
</article>
<script>
    $(document).ready(function () {
        var height = $('#bookingDoc_nav').height() - 30;
        $('#bookingDoc_article').css({"margin-top": height + "px"});
        $('#bookingDoc_article').addClass('active');
    });
</script>