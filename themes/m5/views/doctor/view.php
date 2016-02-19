<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlBookingDoctor = $this->createAbsoluteUrl('booking/create', array('did' => ''));
$doctor = $data->results->doctor;
$navigation = $data->results->navigation;
$honour = $doctor->honour;
$this->show_footer = false;
?>
<header class="bg-green">
    <nav class="left">
        <a href="#" data-icon="previous" data-target="back"></a>
    </nav>
    <h1 class="title"><?php echo $doctor->name; ?>手术预约</h1>
</header>
<article id="bookingDoc_article" class="active" data-scroll="true">
    <div>
        <div class="grid doctorInf">
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
                <div class="mt5 color-gray4"><?php echo $navigation->cate_name; ?><span class="ml10"><?php echo $doctor->mTitle; ?></span></div>
                <div class="mt5 color-black6"><?php echo $doctor->hospitalName; ?></div>
            </div>
            <div class="col-1 grid middle w25 text-right">
                <a href="<?php echo $urlBookingDoctor; ?>/<?php echo $doctor->id; ?>" data-target="link" class="button bg-yellow">预约</a>
            </div>
        </div>
        <?php if (count($doctor->reasons) != 0) { ?>
            <div class="divTJ">
                <div class="bgReason font-s16 color-black mb5 aFontSize">
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
        <div class="divSC">
            <div class="bgSC font-s16 color-black aFontSize">擅长</div>
            <?php
            if (isset($doctor->description)) {
                ?>
                <div class="pl25 mt5 color-black6 bFontSize"><?php echo $doctor->description; ?></div>
                <?php
            } else {
                ?>
                <div class="mt5 color-black6">暂无</div>
                <?php
            }
            ?>
        </div>
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
    </div>
</article>