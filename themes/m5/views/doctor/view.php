<?php
$this->setPageTitle('医生详情');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlBookingDoctor = $this->createAbsoluteUrl('booking/create', array('did' => ''));
$isCommonweal = Yii::app()->request->getQuery('is_commonweal', '0');
$source = Yii::app()->request->getQuery('source', '0');
$sourceApp = Yii::app()->request->getQuery('app', '0');
$urlQuestionnaireBookingView = $this->createAbsoluteUrl('questionnaire/questionnaireBookingView', array('id' => ''));
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
<?php
if ($sourceApp == 0) {
    ?>
    <header id="bookingDoc_header" class="headerBg">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
        <?php
        if ($doctor->aTitle == '无') {
            $doctorAtitle = '';
        } else {
            $doctorAtitle = $doctor->aTitle;
        }
        ?>
        <h1 class="title"><?php echo $doctor->name . $doctorAtitle; ?></h1>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
    <?php
}
?>
<footer>
    <button id="btnSubmit" type="button" class="button btn-yellow font-s16 state-pedding">预约</button>
</footer>
<article id="bookingDoc_article" class="active" data-scroll="true">
    <div>
        <div class="color-white doctorBg pb10 pt10">
            <div class="grid">
                <div class="col-1 w50"></div>
                <div class="col-0 imgDiv">
                    <img class="imgDoc" src="<?php echo $doctor->imageUrl; ?>">
                </div>
                <div class="col-1 w50">
                    <?php
                    if ($source == 0) {
                        if ($doctor->isExpteam == 1) {
                            ?>
                            <div class="grid pb10">
                                <div class="col-1"></div>
                                <div class="col-0 signIcon">
                                    签约专家
                                </div>
                            </div>
                            <?php
                        }
                        if ($doctor->isServiceId == 2) {
                            ?>
                            <div class="grid">
                                <div class="col-1"></div>
                                <div class="col-0 yzIcon">
                                    义诊专家
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="grid pb10">
                            <div class="col-1"></div>
                            <div class="col-0 signIcon">
                                0元面诊
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="text-center pt10">
                <?php
                if ($doctor->hpDeptName == '') {
                    echo $doctor->mTitle;
                } else {
                    ?>
                    <?php echo $doctor->hpDeptName; ?><span class="ml10"><?php echo $doctor->mTitle; ?></span>
                <?php }
                ?>
            </div>
            <div class="text-center">
                <?php echo $doctor->hospitalName; ?>
            </div>
        </div>
        <?php
        $comment = '';
        if (isset($data->results->comment) && (count($data->results->comment) > 1)) {
            $comment = $data->results->comment;
        }
        ?>
        <div class="grid text-center bg-white">
            <div id="showDoctorDetail" class="col-1 w50 pad10 bb2-green color-green10">
                医生信息
            </div>
            <div id="showCommentList" class="col-1 w50 pad10">
                评价<?php echo $comment == '' ? 0 : count($comment); ?>
            </div>
        </div>
        <div id="commentList" class="hide">
            <?php
            if ($comment != '') {
                for ($i = 0; $i < count($comment); $i++) {
                    if ($i == 0) {
                        $btGray = '';
                    } else {
                        $btGray = 'bt-gray';
                    }
                    ?>
                    <div class="pad10 <?php echo $btGray; ?>">
                        <div class="grid">
                            <div class="col-0 h40p w40p">
                                <img src="<?php echo $urlResImage; ?>headImg.png">
                            </div>
                            <div class="col-1 pl10">
                                <div class="color-orange"><?php echo $comment[$i]->user_name; ?></div>
                                <div>
                                    <span><img src='<?php echo $urlResImage; ?>starFill.png' class='w10p'></span>
                                    <span><img src='<?php echo $urlResImage; ?>starFill.png' class='w10p'></span>
                                    <span><img src='<?php echo $urlResImage; ?>starFill.png' class='w10p'></span>
                                    <span><img src='<?php echo $urlResImage; ?>starFill.png' class='w10p'></span>
                                    <span><img src='<?php echo $urlResImage; ?>starFill.png' class='w10p'></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <?php
                            $commentText = $comment[$i]->comment_text;
                            if (mb_strlen($commentText) > 150) {
                                $showComment = mb_substr($commentText, 0, 53, 'utf-8');
                                echo '<div class="cutComment">' . $showComment . '...</div>';
                                echo '<div class="commentText hide">' . $commentText . '</div>';
                            } else {
                                echo '<div>' . $commentText . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="pad10 text-center">' .
                '<div class="pt50">' .
                '<img src="' . $urlResImage . 'evaluate.png" class="w63p">' .
                '</div>' .
                '<div class="pt20 color-gray">' .
                '该医生暂无患者评价' .
                '</div>' .
                '</div>';
            }
            ?>
        </div>
        <div id="doctorDetail" class="bg-white">
            <?php
            if (isset($doctor->description) && (trim($doctor->description) != '')) {
                ?>
                <div class="pl10 pr10 pt10">
                    <div class="color-orange">擅长</div>
                    <div class="mt5 color-black6 bFontSize"><?php echo $doctor->description; ?></div>
                </div>
                <?php
            }
            ?>
            <div id="moreDetail" class="pad10">
                <?php if (count($doctor->reasons) != 0) { ?>
                    <div class="bt-gray pt10 pb10">
                        <div class="color-orange mb5">
                            推荐理由
                        </div>
                        <?php
                        for ($i = 0; $i < count($doctor->reasons); $i++) {
                            ?>
                            <div class="color-black6">
                                <?php echo $doctor->reasons[$i]; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                <?php } ?>
                <?php if (isset($honour) && !is_null($honour)) { ?>
                    <div class="bt-gray pt10 pb10">
                        <div class="color-orange mb5">
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
                    <div class="bt-gray pt10">
                        <div class="">
                            <div class="color-orange mb5">执业经历</div>
                            <div class="color-black6"><?php echo $doctor->careerExp; ?></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        //详情展开、收缩
        $('#showDoctorDetail').click(function () {
            $('#showCommentList').removeClass('bb2-green');
            $('#showCommentList').removeClass('color-green10');
            $('#showDoctorDetail').addClass('bb2-green');
            $('#showDoctorDetail').addClass('color-green10');
            $('#commentList').addClass('hide');
            $('#doctorDetail').removeClass('hide');
            $('#bookingDoc_article').scrollTop(0);
        });
        $('#showCommentList').click(function () {
            $('#showDoctorDetail').removeClass('bb2-green');
            $('#showDoctorDetail').removeClass('color-green10');
            $('#showCommentList').addClass('bb2-green');
            $('#showCommentList').addClass('color-green10');
            $('#doctorDetail').addClass('hide');
            $('#commentList').removeClass('hide');
            $('#bookingDoc_article').scrollTop(0);
        });
        $('.cutComment').click(function () {
            $(this).addClass('hide');
            $(this).next('.commentText').removeClass('hide');
        });
        $('.commentText').click(function () {
            $(this).addClass('hide');
            $(this).prev('.cutComment').removeClass('hide');
        });
        $('#btnSubmit').click(function () {
            if ('<?php echo $source == 0; ?>') {
                if ('<?php echo $isCommonweal; ?>' == 0) {
                    location.href = '<?php echo $urlBookingDoctor; ?>' + '/<?php echo $doctor->id; ?>';
                } else {
                    location.href = '<?php echo $urlBookingDoctor; ?>' + '/<?php echo $doctor->id; ?>/is_commonweal/1';
                }
            } else {
                if ('<?php echo $sourceApp == 0; ?>') {
                    location.href = '<?php echo $urlQuestionnaireBookingView; ?>' + '/<?php echo $doctor->id; ?>';
                } else {
                    location.href = '<?php echo $urlQuestionnaireBookingView; ?>' + '/<?php echo $doctor->id; ?>/app/1';
                }
            }
        });
    });
</script>