<?php
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlDoctorView = $this->createAbsoluteUrl('doctor/view', array('id' => ''));
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
        <div class="title">专题</div>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article id="zhuantiXinxg_article" class="active" data-scroll="true">
    <div class="">
        <div>
            <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/xinxgImg.png" class="w100">
        </div>
        <div class="titleBg font-s16 text-center color-blue7 font-w800">
            双11熬夜秒杀，警惕心血管疾病突发!
        </div>
        <div class="pl10 pr10">
            <div class="color-black9">
                <div class="text-indent-2 mt10 text-justify">
                    双十一是个特殊的日子，不仅仅是光棍节，更是网购狂欢节。很多人已经在心里暗暗倒数双十一的到来，准备一过午夜0点就加入“抢杀大军”。中国医师协会心脏内科医师会员、上海远大心胸医院心内科主任孟庆智提醒，熬夜购物有风险，熬夜秒杀要警惕心血管疾病突发。
                </div>
                <div class="text-indent-2 mt10 text-justify">
                    很多人以为心血管疾病只会发生在老年人身上，随着发病人群的普及，疾病已经呈低龄化发展。对现在的年轻人而言，因不规律的生活习惯、饮食方式、长期熬夜等，会引发皮肤病、内分泌失调、心血管疾病等疾病，其中以心血管疾病最为严重。
                </div>
            </div>
            <div class="lineBg mt30"></div>
            <div class="grid">
                <div class="col-1"></div>
                <div class="col-0 text-center color-blue7 bg-white mt-13 font-s15 font-w800">
                    为什么熬夜后会突发心血管疾病?
                </div>
                <div class="col-1"></div>
            </div>
            <div class="text-indent-2 mt10 text-justify">
                常见的心血管疾病有心绞痛、心肌梗塞、冠心病、先心病等。熬夜诱发的心血管疾病中，心肌梗死、心绞痛的情况比较多，如果不及时抢救，则可能导致猝死。很多患者病发前没有任何征兆，让人防不胜防熬夜产生的后果因人而异，因为每个人的身体条件、生活环境、基因等状况不同。
            </div>
            <div class="grid mt10 color-black6">
                <div class="col-1 w60 font-s12  text-justify">
                    即使身体健康的人，长期熬夜尤其是久坐不动，加上睡眠低于6小时，都可能诱发心血管疾病。熬夜会导致神经内分泌改变，血管收缩功能障碍和血管内皮损伤，使脂质沉积在血管里，最终诱发心绞痛、心律失常等。
                </div>
                <div class="col-1 grid w40 pl5 pr5">
                    <div class="col-1"></div>
                    <div class="col-0 max-w125p text-center">
                        <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/girl.png">
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="lineBg mt30"></div>
            <div class="grid">
                <div class="col-1"></div>
                <div class="col-0 text-center color-blue7 bg-white mt-13 font-s15 font-w800">
                    怎样预防心脑血管疾病突发
                </div>
                <div class="col-1"></div>
            </div>
            <div class="grid mt10">
                <div class="col-0 bg-yellow4 pl5 pr5">
                    (1)"魔鬼时间" 慎起居
                </div>
                <div class="col-1"></div>
            </div>
            <div class="mt10 text-justify">
                <span class="color-green7">上午6时～12时</span>被医学家喻为是心脑血管病的“魔鬼时间”，70%～80%的心脑血管病猝发都在此时。因此，<span class="color-green7">锻炼要避开这段时间</span>。
            </div>
            <div class="mt10">
                <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/reasonOne.png" class="w100">
            </div>
            <div class="grid mt10">
                <div class="col-0 bg-yellow4 pl5 pr5">
                    (2)饮食清淡，红黄绿白黑搭配好
                </div>
                <div class="col-1"></div>
            </div>
            <div class="grid font-s12 mt10">
                <div class="col-0">
                    <div><span class="color-green7">红</span>指<span class="color-green7">葡萄酒</span>，每日50～100ml;</div>
                    <div><span class="color-green7">黄</span>指<span class="color-green7">西红柿、胡萝卜</span>，每日1小碟;</div>
                    <div><span class="color-green7">绿</span>指<span class="color-green7">青菜</span>，每日适量;</div>
                    <div><span class="color-green7">白</span>指<span class="color-green7">燕麦粉</span>等，每日50g;</div>
                    <div><span class="color-green7">黑</span>指<span class="color-green7">黑木耳、黑芝麻</span>，每日5～10g。</div>
                    <div>此外，每天喝<span class="color-green7">牛奶250g</span>，</div>
                    <div>吃<span class="color-green7">鸡蛋</span>每周不超过<span class="color-green7">4个</span>。</div>
                </div>
                <div class="col-1 grid text-center">
                    <div class="col-1"></div>
                    <div class="col-0 max-w128p">
                        <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/reasonTwo.png">
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="grid mt10">
                <div class="col-0 bg-yellow4 pl5 pr5">
                    (3)中老年人最好住在城区
                </div>
                <div class="col-1"></div>
            </div>
            <div class="mt10 text-justify">
                中老年人最好住在城区，以免发病时离大医院远而耽误抢救。
            </div>
            <div class=" text-justify">
                有心脏病的中老年人则应减少出行，尽量避免在拥挤的环境中活动。要特别注意的是，老人单独外出时，身边要带些必备药物，如硝酸甘油、速效救心丸，以及能迅速联系到家人的电话号码。
            </div>
            <div class="grid mt10">
                <div class="col-0 bg-yellow4 pl5 pr5">
                    (4)经常给自己减压
                </div>
                <div class="col-1"></div>
            </div>
            <div class="mt10 text-justify">
                “输了健康，赢了世界又如何?”最近，日本神户大学博士韩白衣推出的新书中提到了这一观点。对中年人来说，尤其不要给自己过大的工作压力。工作以外的时间，要强迫自己完全放松下来，抽空可以和家人去旅游。
            </div>
            <div class="lineBg mt30"></div>
            <div class="grid">
                <div class="col-1"></div>
                <div class="col-0 text-center color-blue7 bg-white mt-13 font-s15 font-w800">
                    把握急救10分钟
                </div>
                <div class="col-1"></div>
            </div>
            <div class="grid mt10">
                <div class="col-1 w50">
                    <div>1、急救第一步:</div>
                    <div class="font-w800 pl24">判断意识</div>
                    <div>拍双肩，唤双耳，搭脉搏，10秒钟完成。</div>
                </div>
                <div class="col-1 w50 pl5">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/stepOne.png">
                </div>
            </div>
            <div class="grid mt10">
                <div class="col-1 w50">
                    <div>2、急救第二步:</div>
                    <div class="font-w800 pl24">呼叫（120）</div>
                </div>
                <div class="col-1 w50 pl5">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/stepTwo.png">
                </div>
            </div>
            <div class="grid mt10">
                <div class="col-1 w50">
                    <div>3、急救第三步:</div>
                    <div class="font-w800 pl24">摆放仰卧体位</div>
                </div>
                <div class="col-1 w50 pl5">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/stepThree.png">
                </div>
            </div>
            <div class="grid mt10">
                <div class="col-1 w50">
                    <div>4、急救第四步:</div>
                    <div class="font-w800 pl24">胸外按压30次</div>
                    <div class="font-w800 pl24">(儿童15次)</div>
                    <div>位置：胸部正中，</div>
                    <div class="pl45">两乳头连线中点</div>
                    <div>力度：按下去至少5cm</div>
                    <div>频率：至少100次/分钟</div>
                </div>
                <div class="col-1 w50 pl5">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/stepFour.png">
                </div>
            </div>
            <div class="grid mt10">
                <div class="col-1 w50">
                    <div>5、急救第五步:</div>
                    <div class="font-w800 pl24">开放气道</div>
                    <div>(仰头举额法)</div>
                </div>
                <div class="col-1 w50 pl5">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/stepFive.png">
                </div>
            </div>
            <div class="grid mt10">
                <div class="col-1 w50">
                    <div>6、急救第六步:</div>
                    <div class="font-w800 pl24">人工吹气2次</div>
                    <div class="font-w800 pl24">(儿童1次)</div>
                    <div>捏鼻，口包口，吹气。</div>
                </div>
                <div class="col-1 w50 pl5">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Xinxg/stepSix.png">
                </div>
            </div>
            <div class="lineBg mt30"></div>
            <div class="grid">
                <div class="col-1"></div>
                <div class="col-0 text-center color-blue7 bg-white mt-13 font-s15 font-w800">
                    心血管特色手术
                </div>
                <div class="col-1"></div>
            </div>
            <div class="grid mt10">
                <div class="col-1"></div>
                <div class="col-0 bg-yellow4 font-w800 pl10 pr10">
                    冠状动脉旁路移植术 (CABG)
                </div>
                <div class="col-1"></div>
            </div>
            <div class="border-grayD mt10 pad5 text-justify">
                冠状动脉搭桥手术是用患者一条其他部位的血管绕过阻塞冠状动脉供应血液的区域。分流手术可以使用患者腿部静脉，还可以使用患者的乳房内动脉。这种手术可以让由于血管阻塞而影响心肌的血液供应恢复正常。
            </div>
            <div class="grid mt10">
                <div class="col-1"></div>
                <div class="col-0 bg-yellow4 font-w800 pl10 pr10">
                    心脏支架手术
                </div>
                <div class="col-1"></div>
            </div>
            <div class="border-grayD mt10 pad5 text-justify">
                心脏支架手术，是最近20年来心脏动脉阻塞的新技术。简单的说，心脏支架手术治疗的过程是穿刺血管，使导管在血管中前行，到达冠状动脉开口处，用特殊的传送系统将支架输送到需要安放的部位，放置、撤出导管，结束手术。
            </div>
            <div class="lineBg mt30"></div>
            <div class="grid">
                <div class="col-1"></div>
                <div class="col-0 text-center color-blue7 bg-white mt-13 font-s15 font-w800">
                    相关医生推荐
                </div>
                <div class="col-1"></div>
            </div>
            <div class="grid mt20">
                <div class="col-1"></div>
                <div class="col-0 w80 border-gray">
                    <a class="color-black" href="<?php echo $urlDoctorView; ?>/88">
                        <div class="">
                            <div class="grid pt10">
                                <div class="col-1"></div>
                                <div class="col-0 br50 w60p h60p overflow-hidden">
                                    <img class="" src="http://mingyizhudao.com/resource/doctor/avatar/xujianping.jpg">
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="pull-right signDoctor"></div>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <div>
                                    <span class="font-w800">许建屏</span>
                                    <span class="color-gray7">主任医师</span>
                                    <span class="color-gray7">教授</span>
                                </div>
                                <div class="color-blue6 pt5 font-s12">
                                    北京阜外医院
                                </div>
                                <div class="pt5 pb5">
                                    心血管外科国内前三甲
                                </div>
                            </div>
                            <div class="pull-right robotDoctor"></div>
                            <div class="pl5 pr5 pb10 text-justify">
                                <span class="font-w800">许建屏教授心血管明星专家团队：</span>由北京阜外心外科成人中心主任许建屏教授领衔，心胸外科主任医师高峰、副主任医师陈雷博士联袂组成。旨在打造国内顶级的心血管疾病专家团队，依托阜外医院和安贞医院雄厚的心血管诊疗平台，为全国的心血管疾病患者提供最专业、最权威、最可靠的医疗服务。
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="grid mt20 mb50">
                <div class="col-1"></div>
                <div class="col-0 w80 border-gray">
                    <a class="color-black" href="<?php echo $urlDoctorView; ?>/2906">
                        <div class="">
                            <div class="grid pt10">
                                <div class="col-1"></div>
                                <div class="col-0 br50 w60p h60p overflow-hidden">
                                    <img class="" src="http://mingyizhudao.com/resource/doctor/avatar/02906.jpg">
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="pull-right signDoctor"></div>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <div>
                                    <span class="font-w800">傅剑华</span>
                                    <span class="color-gray7">主任医师</span>
                                    <span class="color-gray7">教授</span>
                                </div>
                                <div class="color-blue6 pt5 font-s12">
                                    中山大学附属肿瘤医院
                                </div>
                                <div class="pt5 pb5">
                                    华南知名胸外科专家
                                </div>
                            </div>
                            <div class="pull-right robotDoctor"></div>
                            <div class="pl5 pr5 pb10 text-justify">
                                <span class="font-w800">傅剑华专家团队：</span>由广州中山大学附属肿瘤医院心胸外科的傅剑华教授领衔，主要擅长于食管癌、肺癌及胸部肿瘤复杂的外科手术治疗及胸腔镜微创治疗，对食管癌/肺癌的综合治疗、胸部肿瘤非血管介入手术、早期食管癌内镜微创手术等有深人的研究。
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
</article>