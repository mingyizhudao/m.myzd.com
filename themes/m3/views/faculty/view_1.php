<?php
// $facultyId  from controller.
$this->setPageID('pFaculty');
$this->setPageTitle("特色科室");

$urlApiFaculty = $this->createAbsoluteUrl("/api/view", array('model' => 'faculty2', 'id' => $facultyId));

$tUrl = $this->createUrl('expertteam/view'); //team Url
$dUrl = $this->createUrl('doctor/view'); //doctor Url
?>


<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回" data-nav-rel="#f-nav-huizhen">
    <div data-role="content">
        <div class="row page">
            <section class="page-section">
                <div class="section-title">明星团队</div>
                <div class="section-body team pb10">
                    <div class="doc team-info">

                    </div>
                </div>
            </section>
        </div>

        <div class="row page mb20">
            <section class="page-section">
                <div class="section-title">精选名医</div>
                <div class="section-body expert-content">
                    <div class="doc expert-info">

                    </div>
                    <div class="divider"></div>

                </div>
            </section>
        </div>
    </div><!-- /content -->
    <script>
        $(document).ready(function () {
            $(".ui-loader").show();
            $.ajax({
                //url: 'http://mingyizhudao.com/api/faculty2/' +<?php echo $facultyId; ?>,
                url: "<?php echo $urlApiFaculty; ?>",
                success: function (data) {                    
                    $expertTeams = data.expertTeams;
                    $doctors = data.doctors;
                    setStarTeam($expertTeams);
                    setExpert($doctors);

                },
                complete: function () {
                    $(".ui-loader").hide();
                }
            });
            //设置团队信息
            function setStarTeam($expertTeams) {
                var innerHtml = '';
                for (var i = 0; i < $expertTeams.length; i++) {
                    var $expertTeam = $expertTeams[i];
                    var $disTags = "擅长：";
                    for (var j = 0; j < $expertTeam.disTags.length; j++) {
                        $disTags += "<span>" + $expertTeam.disTags[j] + " </span>";
                    }
                    innerHtml = innerHtml +
                            '<div class="ui-grid-c"><a data-ajax=false href="<?php echo $tUrl ?>?id=' +
                            $expertTeam.teamId + '"><div class="ui-block-a leader-img mt10"><img class="img80" src="' +
                            $expertTeam.teamLeader.imageUrl + '"/></div><div class="ui-block-b"><div class="mt10 text-write team-name">' +
                            $expertTeam.teamName + '</div><div class="text-write team-slogan">' +
                            $expertTeam.slogan + '</div></div></a>' +
                            '<div class="pull-right booking mt10"><a href="<?php echo $this->createUrl('app/enquiry', array('addBackBtn' => 1)); ?>"><span class="btn-booking team-btn">预约</span></a></div>'
                            + '</div><div class="text-write team-disTags">' +
                            $disTags + '</div>';
                }
                $('.team-info').html(innerHtml);
            }
            //设置精选专家信息
            function setExpert($doctors) {
                innerHtml = "";
                for (var i = 0; i < $doctors.length; i++) {
                    $doctor = $doctors[i];
                    innerHtml +=
                            '<div class="doc expert-info"><div class="row"><div class="ui-grid-c">' +
                            '<a data-ajax=false href="<?php echo $dUrl; ?>?id=' + $doctor.id + '">' +
                            '<div class="ui-block-a"><img class="img80" src="' +
                            $doctor.urlImage + '"/></div><div class="ui-block-b mt10 pl10"><div class="introduce"><span class="pr10">' +
                            $doctor.name + '</span><span class="expert-atitle">' +
                            $doctor.aTitle + '</span></div><div class="introduce"><span>' +
                            $doctor.hospital + '</span></div><div class="introduce"><span class="pr10">' +
                            $doctor.hFaculty + '</span><span class="expert-mtitle">' +
                            $doctor.mTitle + '</span></div></div></a>' +
                            '<div class="booking pull-right"><a href="<?php echo $this->createUrl('app/enquiry', array('addBackBtn' => 1)); ?>"><span class="btn btn-booking team-btn">预约</span></a></div>' +
                            '</div></div></div><div class="divider"></div>';

                }
                $(".expert-content").html(innerHtml);
            }
        });
    </script>
</div>


