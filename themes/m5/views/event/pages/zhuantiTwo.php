<?php
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlBookingDoctor = $this->createAbsoluteUrl('booking/create', array('did' => ''));
$this->show_footer = false;
?>
<?php if ($showHeader == 1) { ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
        <div class="title"></div>
        <nav class="right">
            <a onclick="javascript:history.go(0)">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article id="zhuantiTwo_article" class="active" data-scroll="true">
    <div class="pl15 pr15 mt26">
        <div class="font-s21 color-black5">【预防冬季冠心病发作】名医专家有妙招</div>
        <div class="mt21 font-s12">2015-12-09<span class="color-blue ml7">来源:名医主刀</span></div>
        <div class="mt26 grid">
            <div class="col-0 lineGreen"></div>
            <div class="col-1">专家提醒冠心病患者在冬季应需要做好日常防护</div>
        </div>
        <div class="color-black6">
            <div class="mt16 text-indent-2">临床资料表明，冠心病患者对寒冷刺激特别敏感，主要是由于寒冷刺激可使体表小血管收缩痉挛，诱发冠状动脉内血栓形成;寒冷刺激还可直接引起冠状动脉痉挛，导致心肌缺血、缺氧，诱发心绞痛或急性心肌梗死等。另外，天气寒冷时血流速度减慢，也可间接地引起冠心病发作。因此，专家提醒冠心病患者在冬天应注意以下几点：</div>
            <div class="mt26 color-green font-s16">
                1、慧眼识别冠心病症状
            </div>
            <div class="mt16">
                冠心病有典型与不典型症状之分，劳力诱发或寒冷刺激诱发的胸痛是冠心病的典型症状，需引起患者重视。但有的心绞痛表现在胸部以外，如牙痛、下颌疼痛、咽部紧缩感等，部分还表现为上腹胀痛不适等胃肠道症状，特别是疼痛剧烈时常伴有恶心、呕吐，临床上易误诊为急性胃肠炎、胆囊炎、胰腺炎等。上述不典型症状常使患者掉以轻心，造成医生误诊，从而延误冠心病的诊治。我们必须提高警惕，早防早治。
            </div>
            <div class="mt26 color-green font-s16">
                2、警惕急性冠脉综合症
            </div>
            <div class="mt16">
                急性冠脉综合症包括急性st段抬高心肌梗死、急性非st段抬高心肌梗死和不稳定性心绞痛。其中急性心肌梗死表现为持续、剧烈、难以忍受的胸痛，范围较大，伴濒死感，若症状10～15分钟不缓解，或含服硝酸甘油1片5分钟不缓解，需立即到医院就诊。由于急性心肌梗死导致的死亡多发生在症状出现后的1～2小时，常见死因是心室颤动，所以最好选择救护车转送患者，方便进行心肺复苏，并有利于尽早进行再灌注治疗。
            </div>
            <div class="mt26 color-green font-s16">
                3、生活保健不能少
            </div>
            <div class="mt16">
                冠心病患者除需注意观察、坚持治疗外，还要在日常生活中注意保健。根据气温变化调整着装，保暖御寒;尽量避免室内外温差刺激，不要骤然从温暖的房间进入寒冷的露天空间;增强御寒能力的锻炼，当天气晴朗、气温不太低时，可有意识地增加室外活动，但不宜过早进行晨练。
            </div>
            <div class="mt26 color-green font-s16">
                4、不放过蛛丝马迹
            </div>
            <div class="mt16">
                很多急性心肌梗死的患者在发病前会有不稳定阶段，表现为心绞痛症状发作从无到有，心绞痛症状比以前频繁，持续时间延长，活动能力下降(步行距离缩短，不能胜任体力活动等)，或安静情况下也有心绞痛症状发作。这也就是急性非st段抬高的心肌梗死和不稳定性心绞痛阶段，这个阶段的早期干预有可能避免急性心肌梗死的发生。如出现上述症状，一定要及早就诊。
            </div>
            <div class="mt26 doctorTitle">
                推荐专家
            </div>
            <div class="mt15 border-green">
                <?php if ($showHeader == 1) { ?>
                    <a href="<?php echo $urlBookingDoctor; ?>/88">
                    <?php } ?>
                    <div class="pl10 pt10 pr10 pb15 color-black6">
                        <div class="font-s16">
                            <span class="color-black">许建屏</span>
                            <span class="color-gray3">主任医师</span>
                        </div>
                        <div>阜外心血管病医院</div>
                        <div>
                            <span class="color-green3">擅长:</span>
                            <span>成人心脏病,先天性心脏病</span>
                        </div>
                    </div>
                    <?php if ($showHeader == 1) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="mt15 border-green">
                <?php if ($showHeader == 1) { ?>
                    <a href="<?php echo $urlBookingDoctor; ?>/46">
                    <?php } ?>
                    <div class="pl10 pt10 pr10 pb15 color-black6">
                        <div class="font-s16">
                            <span class="color-black">王良旭</span>
                            <span class="color-gray3">主任医师</span>
                        </div>
                        <div>上海同济大学附属第十人民医院</div>
                        <div>
                            <span class="color-green3">擅长:</span>
                            <span>先天性心脏病,冠心病</span>
                        </div>
                    </div>
                    <?php if ($showHeader == 1) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="mt15 border-green">
                <?php if ($showHeader == 1) { ?>
                    <a href="<?php echo $urlBookingDoctor; ?>/48">
                    <?php } ?>
                    <div class="pl10 pt10 pr10 pb15 color-black6">
                        <div class="font-s16">
                            <span class="color-black">梅举</span>
                            <span class="color-gray3">主任医师</span>
                        </div>
                        <div>上海交通大学医学院附属新华医院</div>
                        <div>
                            <span class="color-green3">擅长:</span>
                            <span>主动脉夹层,腹主动脉瘤</span>
                        </div>
                    </div>
                    <?php if ($showHeader == 1) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="mt15 mb20 border-green">
                <?php if ($showHeader == 1) { ?>
                    <a href="<?php echo $urlBookingDoctor; ?>/135">
                    <?php } ?>
                    <div class="pl10 pt10 pr10 pb15 color-black6">
                        <div class="font-s16">
                            <span class="color-black">刘永民</span>
                            <span class="color-gray3">主任医师</span>
                        </div>
                        <div>首都医科大学附属北京安贞医院</div>
                        <div>
                            <span class="color-green3">擅长:</span>
                            <span>先天性心脏病,冠心病</span>
                        </div>
                    </div>
                    <?php if ($showHeader == 1) { ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</article>