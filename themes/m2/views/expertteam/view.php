<?php
/**
 * $model IExpertTeam.
 */
$this->setPageID('pHospitalIndex');
$this->setPageTitle('专家团队');
$teamId = $model->teamId;
$teamCode = $model->teamCode;
$urlApiExpertteam = $this->createAbsoluteUrl('/api/view', array('model' => 'expertteam', 'id' => $teamId));

//$teamCode = $_GET["id"];
$teamIdList = array(
    'team-xujianping' => '1',
    'team-liuyuewu' => '2',
    'team-zhusiquan' => '3',
    'team-luhai' => '4',
    'team-zhangdong' => '5',
    'team-guochuanbin' => '6',
    'team-gujin' => '7',
    'team-wangxuehao' => '8',
    'team-miaoyi' => '9',
    'team-liujiayin' => '10',
    'team-gongxiaoming' => '11',
    'team-lishiting' => '12',
    'team-shiweijin' => '13',
    'team-xuqiwu' => '14',
    'team-songdonglei' => '15',
    'team-guohui' => '16',
);


$urlTeamView = $this->createAbsoluteUrl("/api/expertteam", array("id" =>$teamCode));
//var_dump($urlTeamView);exit;
?>

<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-expertteam" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content">
        <div class="page row">
            <section class="page-section team-header">
                <div class="section-body">
                    <div class="row doc">

                    </div>
                </div>
            </section>
        </div>
        <div class="page pt76 row">
            <section class="page-section team-introduce pb10">
                <div class="section-body">

                </div>
            </section>
        </div>
        <div class="page row mb20">
            <section class="page-section team-leader">
                <div class="section-title">团队队长</div>
                <div class="section-body">

                </div>
            </section>
        </div>
        <div class="page row mb20">
            <section class="page-section team-members">

            </section>
        </div>
        <div id="team-detail">
            <?php
            $this->renderPartial("details/" . $teamCode);
            /*
              $html = '/team-introduce/' . $id . '.html';
              include($html);
             */
            ?>
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
                    setTeamHeader($expertTeam);//设置顶部悬浮框内容
                    setTeamIntroduce($expertTeam);//设置团队介绍
                    setTeamLeader($expertTeam);//设置leader信息
                    setMembers($expertTeam);//设置团队成员信息
                    //    console.log($expertTeam);
                },
                complete: function () {
                    $(".ui-loader").hide();
                }
            });

            //设置顶部悬浮框内容
            function setTeamHeader($expertTeam) {
                var innerHtml =
                        '<div class="ui-grid-c"><div class="ui-block-a leader-img"><img class="img60" src="' +
                        $expertTeam.teamLeader.urlImage + '"></div><div class="ui-block-b"><div class="team-name"><span>' +
                        $expertTeam.teamName + '</span></div><div class="team-slogan"><span>' +
                        $expertTeam.slogan + '</span></div></div>' +
                        '<div class="pull-right booking"><a href="<?php echo $this->createUrl('app/enquiry', array('addBackBtn' => 1)); ?>"><span class="btn-booking team-btn">预约</span></a></div></div>';


                $(".team-header>.section-body>.doc").html(innerHtml);
            }
            //设置团队介绍
            function setTeamIntroduce($expertTeam) {
                var innerHtml =
                        '<div class="team-hospital">' +
                        $expertTeam.hospital + '</div>' +
                        '<div class="">团队介绍: ' +
                        $expertTeam.desc
                        + '</div>';
                $(".team-introduce>.section-body").html(innerHtml);
            }
            //设置leader信息
            function setTeamLeader($expertTeam) {
                var $leader = $expertTeam.teamLeader;
                var innerHtml =
                        '<div class="row doc"><div class="ui-grid-c"><div class="ui-block-a mr20"><img class="img80" src="' +
                        $leader.imageUrl + '"/></div><div class="mt10"><div class="introduce"><span class="pr10">' +
                        $leader.docName + '</span><span class="expert-atitle">' +
                        $leader.aTitle + '</span></div><div class="introduce"><span>' +
                        $leader.hospital + '</span></div><div class="introduce"><span class="pr10">' +
                        $leader.hFaculty + '</span><span class="expert-mtitle">' +
                        $leader.mTitle + '</span></div></div></div></div>' +
                        '<div class="doc-introduce"><span>简介:' +
                        $leader.desc
                        + '</span></div>';
                $(".team-leader>.section-body").html(innerHtml);
            }
            //设置团队成员信息
            function setMembers($expertTeam) {
                var $members = $expertTeam.members;
                if ($members) {
                    var innerHtml = '<div class="section-title">团队成员</div>';
                    for (var i = 0; i < $members.length; i++) {
                        $member = $members[i];
                        $aTile = $member.aTitle === "无" ? "" : $member.aTitle;
                        innerHtml +=
                                '<div class="section-body"><div class="member"><div class="row doc"><div class="ui-grid-c"><div class="ui-block-a mr20"><img class="img80" src="' +
                                $member.imageUrl + '"/></div><div class="mt10"><div class="introduce"><span class="pr10">' +
                                $member.docName + '</span><span class="expert-atitle">' +
                                $aTile + '</span></div><div class="introduce"><span>' +
                                $member.hospital + '</span></div><div class="introduce"><span class="pr10">' +
                                $member.hFaculty + '</span><span class="expert-mtitle">' +
                                $member.mTitle + '</span></div></div></div></div>' +
                                '<div class="doc-introduce"><span>简介:' +
                                $member.desc
                                + '</span></div></div>' +
                                '<div class="divider"></div>';
                    }
                    innerHtml += '</div>';
                    $(".team-members").html(innerHtml);
                }
            }
        });
    </script>
</div>
