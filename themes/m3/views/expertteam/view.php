<?php
/**
 * $model IExpertTeam.
 */
$this->setPageID('pHospitalIndex');
$this->setPageTitle($model->teamName);
$teamId = $model->teamId;
$teamCode = $model->teamCode;
$urlApiExpertteam = $this->createAbsoluteUrl('/api/view', array('model' => 'expertteam', 'id' => $teamId));
$urlTeamView = $this->createAbsoluteUrl("/api/expertteam", array("id" => $teamCode));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlBooking = $this->createUrl('booking/create', array('tid' => $teamId, 'addBackBtn' => 1));
//var_dump($urlTeamView);exit;
?>

<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-expertteam" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content" id="expertteam">
        <div class="page row">
            <section class="page-section team-header pb20 pt10">
                <div class="section-body">
                    <div class="row doc">

                    </div>
                </div>
            </section>
        </div>
        <!--        <div class="page row">
                    <section class="page-section team-honor pb10">
                        <div class="section-title"><i class="fa fa-flag"></i>&nbsp;&nbsp;专家荣誉</div>
                        <div class="section-body">
                            <ul>
                                <li>上海交通大学医学院附属胸科医院胸外科主任</li>
                                <li>上海交通大学医学院附属胸科医院胸外科主任</li>
                                <li>上海交通大学医学院附属胸科医院胸外科主任</li>
                                <li>上海交通大学医学院附属胸科医院胸外科主任上海交通大学医学院附属胸科医院胸外科主任</li>
                            </ul>
                        </div>
                    </section>
                </div>-->
        <div class="page row">
            <section class="page-section team-introduce pb10">

            </section>
        </div>

        <div class="page row pb40">
            <section class="page-section team-members">

            </section>
        </div>

    </div><!-- /content -->    
    <script>
        $(document).ready(function () {
            $(".ui-loader").show();
            $.ajax({
                //    url:"http://mingyizhudao.com/api/expertteam/"+<?php echo $teamId; ?>,
                url: "<?php echo $urlApiExpertteam; ?>",
                success: function (data) {
                    $expertTeam = data.expertTeam;
                    setTeamHeader($expertTeam);//设置顶部内容
                    setTeamIntroduce($expertTeam);//设置团队介绍
                    //setTeamLeader($expertTeam);//设置leader信息
                    setMembers($expertTeam);//设置团队成员信息
                    //    console.log($expertTeam);
                },
                complete: function () {
                    $(".ui-loader").hide();
                }
            });

            //设置顶部内容
            function setTeamHeader($expertTeam) {
                var innerHtml =
                        '<div class="">' +
                        '<div class="booking"><a href="<?php echo $urlBooking; ?>" data-ajax="false"><span class="btn-booking team-btn">预约</span></a></div>' +
                        '<div class=""><img class="img100" src="' +
                        $expertTeam.teamLeader.urlImage + '"></div><div class="text-center doc-name">' +
                        $expertTeam.teamLeader.name + '</div><div class="doc-title text-center mt5"><span>' +
                        $expertTeam.teamLeader.mTitle + ' | ' +
                        $expertTeam.teamLeader.aTitle + '</span></div></div>';


                $(".team-header>.section-body>.doc").html(innerHtml);
            }
            //设置团队介绍
            function setTeamIntroduce($expertTeam) {
                var innerHtml =
                        '<div class="section-title"><i class="fa fa-star"></i>&nbsp;&nbsp;团队简介</div>' +
                        '<div class="section-body"><div class="eteamdecs">' +
                        $expertTeam.desc
                        + '</div></div>';
                $(".team-introduce").html(innerHtml);
            }

            //设置团队成员信息
            function setMembers($expertTeam) {
                var $members = $expertTeam.members;
                if ($members) {
                    var innerHtml = '<div class="section-title"><i class="fa fa-users"></i>&nbsp;&nbsp; 团队成员</div>' +
                            '<div class="section-body"><div class="member">';
                    for (var i = 0; i < $members.length; i++) {
                        $member = $members[i];
                        $aTile = $member.aTitle === "" ? "" : " | " + $member.aTitle;
                        $decs = $member.desc ? $member.desc : "暂无";
                        innerHtml +=
                                '<div class="doc"><div class="ui-grid-c"><div class="ui-block-a mr20"><img class="img80" src="' +
                                $member.imageUrl + '"/></div><div class="mt10"><div class="introduce"><span class="pr10">' +
                                $member.docName + '</span><span class="expert-mtitle">' +
                                $member.mTitle + '</span><span class="expert-atitle">' +
                                $aTile + '</span></div><div class="introduce"><span>' +
                                $member.hospital + '</span></div><div class="introduce"><span class="pr10">' +
                                $member.hFaculty + '</span></div></div></div>' +
                                '<div class="doc-introduce"><span>简介:' +
                                $decs
                                + '</span></div></div>' +
                                '<div class="dashed mt10 mb10"></div>';
                    }
                    innerHtml += '</div>';
                    $(".team-members").html(innerHtml);
                }
            }
        });
    </script>
</div>
