<?php
$this->setPageTitle('机器人微创手术');
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
        <div class="title">机器人微创手术</div>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article id="zhuantiRobot_article" class="active" data-scroll="true">
    <div>
        <div>
            <img src="<?php echo $urlResImage; ?>zhuanti/Robot/robotTitle.jpg" class="w100">
        </div>
        <div class="bb-blue mt30"></div>
        <div class="grid mt-12">
            <div class="col-1"></div>
            <div class="col-0 color-blue6 font-s16 bg-white pl10 pr10 font-w800">
                机器人微创手术
            </div>
            <div class="col-1"></div>
        </div>
        <div class="pl10 pr10 pt10">
            <div class="text-indent-2 color-gray7">
                人的大脑素有“生命禁区”之称，一直以来，医生都是通过开颅或框架来确定病灶位置，开展手术。但这些定位方式创伤大，风险高，易造成并发症，给患者带来较大的生理和心理压力。
            </div>
            <div class="text-indent-2 color-blue6">
                新的医疗机器人技术结合放射影像学、计算机图像图形学、机器人学、立体定向技术和神经外科学等众多学科，协助医生实现微创的无框架立体定向手术，为患者燃起新的希望。
            </div>
            <div class="text-indent-2 color-gray7">
                Remebot作为我国18年自主研发的神经外科手术机器人，经历了15年的临床探索和6次产品迭代，先后治愈上万名患者，无论在技术还是应用层面，都处于行业领先地位。
            </div>
            <div class="mt10">
                <img src="<?php echo $urlResImage; ?>zhuanti/Robot/robotImg.png" class="w100">
            </div>
            <div class="grid mt20">
                <div class="col-0 bg-blue3 color-white pl10 pr10 font-w800">
                    走近Remebot医疗机器人
                </div>
                <div class="col-1 titleBlue"></div>
            </div>
            <div class="text-indent-2 mt10">
                Remebot 由“脑”、“眼”、“手”三部分组成。
            </div>
            <div class="text-indent-2">
                计算机及软件系统是“大脑”，手术规划软件负责合成患者头颅的三维模型，方便医生观察病灶，进行手术规划。
            </div>
            <div class="text-indent-2">
                机械臂像“手”，负责定位医生规划的手术位置，精度达到1mm，同时还是多功能手术平台。
            </div>
            <div class="text-indent-2">
                摄像头则像人的“双眼”，可实时捕捉机械臂和患者的位置信息，确保机械臂按手术规划路径运动到指定位置。
            </div>
            <div class="mt10">
                <img src="<?php echo $urlResImage; ?>zhuanti/Robot/robotImg2.png" class="w100">
            </div>
            <div class="grid mt30">
                <div class="col-0 bg-blue3 color-white pl10 pr10 font-w800">
                    六大核心功能
                </div>
                <div class="col-1 titleBlue"></div>
            </div>
            <div class="mt20">
                六大核心功能帮助医生微创、精准、高效地执行手术操作。
            </div>
            <div class="borderLeft mt10 divShadow font-s12">
                <div class="font-w800 pt5">自动三维建模</div>
                <div class="pb5">自动将患者颅部CT/MRI图像合成三维模型，便于医生观察病灶位置，规划手术路径</div>
            </div>
            <div class="borderLeft mt5 divShadow font-s12">
                <div class="font-w800 pt5">立体定向定位</div>
                <div class="pb5">6轴机械臂可360度自由旋转，根据导航准确定位入颅位置，精度达到1mm</div>
            </div>
            <div class="borderLeft mt5 divShadow font-s12">
                <div class="font-w800 pt5">多靶点路径规划</div>
                <div class="pb5">支持8条路径规划，可根据病灶数量规划多个路径，按路径依次手术，互不影响</div>
            </div>
            <div class="borderLeft mt5 divShadow font-s12">
                <div class="font-w800 pt5">多功能手术平台</div>
                <div class="pb5">可搭载十余种微创手术器械，实现活检、抽吸、毁损、移植等手术操作</div>
            </div>
            <div class="borderLeft mt5 divShadow font-s12">
                <div class="font-w800 pt5">标志点精准识别</div>
                <div class="pb5">独特的标志点编码解码设计，操作简单，轻便安全，精准高效</div>
            </div>
            <div class="borderLeft mt5 divShadow font-s12">
                <div class="font-w800 pt5">病灶体积计量</div>
                <div class="pb5">手术规划软件自动计算医生勾勒的病灶体积，供医生手术参考</div>
            </div>
            <div class="grid mt30">
                <div class="col-0 bg-blue3 color-white pl10 pr10 font-w800">
                    与传统手术相比优势显著
                </div>
                <div class="col-1 titleBlue"></div>
            </div>
            <div class="text-indent-2 mt10">
                Remebot 医疗机器人的六大核心功能保障了手术的微创、精准、高效。机器人辅助的手术平均用时仅30分钟，定位精度达到1mm，患者创口小于2mm，住院观察2~3天即可出院。
            </div>
            <div class="mt10">
                <img src="<?php echo $urlResImage; ?>zhuanti/Robot/dataTable.png" class="w100">
            </div>
            <div class="grid mt30">
                <div class="col-0 bg-blue3 color-white pl10 pr10 font-w800">
                    简便的操作流程
                </div>
                <div class="col-1 titleBlue"></div>
            </div>
            <div class="grid mt10">
                <div class="col-1 w60 pr10">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Robot/stepOne.png" class="w100">
                </div>
                <div class="col-1 w40 font-s12">
                    第一步，患者贴上Remebot专用标志点，进行CT/MRI医学影像扫描。<span class="color-blue6 font-w800">手术规划软件会自动合成患者颅部的三维模型和冠状图、矢状图</span>，辅助医生诊断并制定手术方案。
                </div>
            </div>
            <div class="grid mt10">
                <div class="col-1 w60 pr10">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Robot/stepTwo.png" class="w100">
                </div>
                <div class="col-1 w40 font-s12">
                    第二步，医生选择图像，勾勒出病灶的轮廓，<span class="color-blue6 font-w800">手术规划软件实时展示病灶形状、位置及大小。</span>
                </div>
            </div>
            <div class="grid mt20">
                <div class="col-1 w60 pr10">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Robot/stepThree.png" class="w100">
                </div>
                <div class="col-1 w40 font-s12">
                    第三步，医生观察病灶，确定穿刺靶点，<span class="color-blue6 font-w800">然后根据病灶周边的环境选择最佳的入颅角度</span>，完成手术规划。
                </div>
            </div>
            <div class="grid mt20">
                <div class="col-1 w60 pr10">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Robot/stepFour.png" class="w100">
                </div>
                <div class="col-1 w40 font-s12">
                    第四步，<span class="color-blue6 font-w800">手术注册是为了确定脑、眼、手三部分的位置关系</span>，并计算出机械臂的运动路径。其中，机器人注册是摄像头和机械臂建立关系，患者注册则是摄像头与患者建立关系。
                </div>
            </div>
            <div class="grid mt20">
                <div class="col-1 w60 pr10">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Robot/stepFive.png" class="w100">
                </div>
                <div class="col-1 w40 font-s12">
                    第五步，医生在软件上模拟走位，确认无误后机器人走位，标记入颅点。撤离机械臂，对患者进行术前消毒，<span class="color-blue6 font-w800">机器人二次走位锁定入颅点。</span>
                </div>
            </div>
            <div class="grid mt20">
                <div class="col-1 w60 pr10">
                    <img src="<?php echo $urlResImage; ?>zhuanti/Robot/stepSix.png" class="w100">
                </div>
                <div class="col-1 w40 font-s12">
                    最后，<span class="color-blue6 font-w800">医生在机械臂末端安装作为手术操作平台的导向器</span>，用钻头在入颅点开1个2mm以内的小孔，换上适配的手术针，沿导向器将针推送至底部即为手术规划的路径和靶点位置。
                </div>
            </div>
            <div class="mt20">
                看似简短的几步操作，实际上经历了十几年的临床摸索和上万次的手术验证，方达到化繁为简的效果。
            </div>
            <div class="grid mt30">
                <div class="col-0 bg-blue3 color-white pl10 pr10 font-w800">
                    机器人手术的适用症
                </div>
                <div class="col-1 titleBlue"></div>
            </div>
            <div class="mt10 text-indent-2">
                Remebot医疗机器人搭载多功能操作平台，<span class="color-blue6 font-w800">可进行活检、抽吸、毁损、移植、放疗等操作，适用于12类近百种神经外科疾病</span>。下表将其分为功能性和器质性颅脑疾患，涵盖脑出血、脑囊肿、帕金森病、癫痫、三叉神经痛等。
            </div>
            <div class="mt10">
                <img src="<?php echo $urlResImage; ?>zhuanti/Robot/dataTable2.png" class="w100">
            </div>
            <div class="grid mt30">
                <div class="col-0 bg-blue3 color-white pl10 pr10 font-w800">
                    Remebot：18年来不断摸索
                </div>
                <div class="col-1 titleBlue"></div>
            </div>
            <div class="mt10 text-indent-2">
                早在2005年，机器人辅助的无框架定位技术即获得国家认可，进入了北京市定点医保范围。这意味着患者将来不仅可以享受高端技术带来的便利，而且还能极大缓解手术带来的经济压力。
            </div>
            <div class="mt10">
                <img src="<?php echo $urlResImage; ?>zhuanti/Robot/dataTable3.png" class="w100">
            </div>
        </div>
        <div class="bb-blue mt30"></div>
        <div class="grid mt-12">
            <div class="col-1"></div>
            <div class="col-0 color-blue6 font-s16 bg-white pl10 pr10 font-w800">
                相关医生推荐
            </div>
            <div class="col-1"></div>
        </div>
        <div class="grid mt20">
            <div class="col-1"></div>
            <div class="col-0 w80 doctorBg">
                <div class="doctorBorder">
                    <a class="color-black" href="<?php echo $urlDoctorView; ?>/3208">
                        <div class="">
                            <div class="grid pt10">
                                <div class="col-1"></div>
                                <div class="col-0 br50 w60p h60p overflow-hidden">
                                    <img class="" src="http://dr.static.mingyizhudao.com/1708545F08B27EAE7A1B6E40FE6AB599">
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="text-center">
                                <div>
                                    <span class="font-w800">田增民</span>
                                    <span class="color-gray7">主任医师</span>
                                    <span class="color-gray7">教授</span>
                                </div>
                                <div class="color-blue6 pt5">
                                    神经外科
                                </div>
                                <div class="pt5 pb5">
                                    中国人民解放军海军总医院
                                </div>
                            </div>
                            <div class="pl5 pr5 pb10 text-justify">
                                <span class="color-black6">擅长</span>：脑外伤救治、脑肿瘤及功能性疾病等领域的治疗，如机器人辅助脑定位手术、现代立体定向手术临床应用、脑肿瘤内放疗的系列研究、脑内窥镜手术。
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="grid mt20">
            <div class="col-1"></div>
            <div class="col-0 w80 doctorBg">
                <div class="doctorBorder">
                    <a class="color-black" href="<?php echo $urlDoctorView; ?>/3209">
                        <div class="">
                            <div class="grid pt10">
                                <div class="col-1"></div>
                                <div class="col-0 br50 w60p h60p overflow-hidden">
                                    <img class="" src="http://dr.static.mingyizhudao.com/9788AF9D2CA5A3117E37C6E9BE5276F3">
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="text-center">
                                <div>
                                    <span class="font-w800">赵全军</span>
                                    <span class="color-gray7">主任医师</span>
                                    <span class="color-gray7">教授</span>
                                </div>
                                <div class="color-blue6 pt5">
                                    神经外科
                                </div>
                                <div class="pt5 pb5">
                                    中国人民解放军第306医院
                                </div>
                            </div>
                            <div class="pl5 pr5 pb10 text-justify">
                                <span class="color-black6">擅长</span>：1.难治性癫痫的外科治疗，如癫痫、原发性癫痫、继发性癫痫、复杂癫痫发作时的急救措施；2.脑功能性疾病的立体定向手术治疗，如小儿脑瘫、帕金森、扭转痉挛、小脑萎缩、脑出血后遗症、脑梗塞后遗症、肌张力障碍、...
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="grid mt20 mb50">
            <div class="col-1"></div>
            <div class="col-0 w80 doctorBg">
                <div class="doctorBorder">
                    <a class="color-black" href="<?php echo $urlDoctorView; ?>/3207">
                        <div class="">
                            <div class="grid pt10">
                                <div class="col-1"></div>
                                <div class="col-0 br50 w60p h60p overflow-hidden">
                                    <img class="" src="http://dr.static.mingyizhudao.com/6E10EAAA5E9F9AC82B84C55A68D659CA">
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="text-center">
                                <div>
                                    <span class="font-w800">卢旺盛</span>
                                    <span class="color-gray7">主任医师</span>
                                    <span class="color-gray7">副教授</span>
                                </div>
                                <div class="color-blue6 pt5">
                                    神经外科
                                </div>
                                <div class="pt5 pb5">
                                    北京天坛普华医院
                                </div>
                            </div>
                            <div class="pl5 pr5 pb10 text-justify">
                                <span class="color-black6">擅长</span>：1.颅内动脉瘤、脑血管畸形和颈动脉狭窄、颅内动脉狭窄的介入治疗，脑血管病的外科治疗，以及外周血管介入治疗，肿瘤介入治疗，非血管内介入治疗；2.癫痫的外科治疗；脑卒中后遗症、帕金森病、脑瘫及肌张力障碍的...
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</article>