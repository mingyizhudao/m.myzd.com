<?php
$this->setPageTitle('手术直通车');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$showExpTeamBtn = Yii::app()->request->getQuery("showBtn", 1);
$isShowHeader = Yii::app()->request->getQuery('header', 1);
$this->show_footer = false;
?>
<div id="section_container">
    <section class="active">
        <?php if ($isShowHeader == 1) { ?>
            <header class="head-title1">
                <nav class="left">
                    <a href="#" data-target="back" data-icon="previous"></a>
                </nav>
                <div class="title color-white">
                    <?php echo $this->pageTitle; ?>
                </div>
            </header>
        <?php } ?>
        <article id="zhitongche" class="active" data-scroll="true">
            <div>
                <div class="page-section">
                    <div class="section-body pt10 desc">
                        <div class="text-justify">名医主刀为有手术需求的患者提供的一项快速、便捷、高效、安全的服务。旨在帮助广大有手术需求的患者，第一时间预约全国知名专家，安排入院手术。</div>
                    </div>
                </div>
                <div class="page-section mt20">
                    <div class="section-body">
                        <div class="zhitongche-title pt40 mb20">流 程</div>
                        <div class="step">
                            <div class="grid">
                                <div class="col-0 w48"></div>
                                <div class="col-0 w4 wire"></div>
                                <div class="col-0 w48">
                                    <div class="introduce-title step1">提交资料</div>
                                    <div class="introduce-content bg-right text-justify">用户可以通过我们的微信公众平台、网站APP、邮箱以及人工客服的帮助，提交您的相关资料。</div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="col-0 w48">
                                    <div class="introduce-title pull-right step2">术前会诊</div>
                                    <div class="clearfix"></div>
                                    <div class="introduce-content bg-left text-justify">确认专家的治疗意见和方案，并及时反馈给患者，根据具体病情安排专家面诊。</div>
                                </div>
                                <div class="col-0 w4"></div>
                                <div class="col-0 w48"></div>
                            </div>
                            <div class="grid">
                                <div class="col-0 w48"></div>
                                <div class="col-0 w4"></div>
                                <div class="col-0 w48">
                                    <div class="introduce-title step3">安排手术</div>
                                    <div class="introduce-content bg-right text-justify">根据需求协助进行术前安排，检查完毕后48小时内直通手术室。</div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="col-0 w48">
                                    <div class="introduce-title pull-right step4">术后回访</div>
                                    <div class="clearfix"></div>
                                    <div class="introduce-content bg-left text-justify">挂号随访、安排复诊。</div>
                                </div>
                                <div class="col-0 w4"></div>
                                <div class="col-0 w48"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-section">
                    <div class="section-body">
                        <div class="zhitongche-title pt40 mb20">优 势</div>
                        <div class="long">
                            <div class="grid">
                                <div class="col-0 w48"></div>
                                <div class="col-0 w4"></div>
                                <div class="col-0 w48">
                                    <div class="introduce-title step1">权威专家</div>
                                    <div class="introduce-content text-justify">国内权威顶尖专家一对一服务，不误诊，不拖延，确保看好病。</div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="col-0 w48 mt-20">
                                    <div class="introduce-title pull-right step2">高效便捷</div>
                                    <div class="clearfix"></div>
                                    <div class="introduce-content text-justify">省去床位等候时间，免去奔波代价，由名医主刀顾问高效沟通，检查完毕后48小时直通手术室。</div>
                                </div>
                                <div class="col-0 w4"></div>
                                <div class="col-0 w48"></div>
                            </div>
                            <div class="grid">
                                <div class="col-0 w48"></div>
                                <div class="col-0 w4"></div>
                                <div class="col-0 w48 mt-20">
                                    <div class="introduce-title step3">贴心服务</div>
                                    <div class="introduce-content text-justify">挂号、检查、咨询，一站式安排术后随访，节约时间，减少奔波劳苦。</div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="col-0 w48 mt-20">
                                    <div class="introduce-title pull-right step4">安全保障</div>
                                    <div class="clearfix"></div>
                                    <div class="introduce-content text-justify">顶级专家 权威三甲医院。</div>
                                </div>
                                <div class="col-0 w4"></div>
                                <div class="col-0 w48"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-section">
                    <div class="section-body qa">
                        <div class="zhitongche-title pt20">常见<br/>问题</div>
                        <div>
                            <div class="question">
                                <span class="qtitle">Q1</span>
                                <span>手术直通车的费用</span>
                            </div>
                            <div class="answer">
                                <span class="text-justify">答: 手术产生的费用发生在医院，根据医院标准收取治疗费用（可用医保）。</span>
                            </div>
                        </div>
                        <div>
                            <div class="question">
                                <span class="qtitle">Q2</span>
                                <span>就诊通道是否能比别人更快入院？</span>
                            </div>
                            <div class="answer">
                                <span class="text-justify">答: 通过手术直通车，可以大大缩短专家会诊和病床等待的时间。检查完毕后，48小时直通手术室。</span>
                            </div>
                        </div>
                        <div>
                            <div class="question">
                                <span class="qtitle">Q3</span>
                                <span>我想约的名医这里没有展示怎么办？</span>
                            </div>
                            <div class="answer">
                                <span class="text-justify">答: 可以网上提交预约并注明专家姓名和所在医院科室，我们的工作人员将第一时间为您预约指定专家，6个小时内给您回复。</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
</div>

