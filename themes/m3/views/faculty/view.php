<?php
// $facultyId  from controller.
$this->setPageID('pFaculty');
$this->setPageTitle("特色科室");

$urlApiFaculty = $this->createAbsoluteUrl("/api/view", array('model' => 'faculty2', 'id' => $facultyId));
$urlLoadDoctorsByDeptId = $this->createUrl('/api/list', array('model' => 'doctor', 'hpdept' => $facultyId));
$tUrl = $this->createUrl('expertteam/view'); //team Url
$dUrl = $this->createUrl('doctor/view'); //doctor Url
?>


<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回" data-nav-rel="#f-nav-hospital">
    <div data-role="content" class="ui-content">
        <div class="page mb20">
            <section class="page-section">
                <div class="section-title">推荐医生</div>
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
                url: "<?php echo $urlLoadDoctorsByDeptId; ?>",
                success: function (data) {
                    $doctors = data.doctors;
                    setExpert($doctors);
                },
                complete: function () {
                    $(".ui-loader").hide();
                }
            });
            //设置精选专家信息
            function setExpert($doctors) {
                innerHtml = "";
                for (var i = 0; i < $doctors.length; i++) {
                    $doctor = $doctors[i];
                    $aTile = $doctor.aTitle === "无" ? "" : $doctor.aTitle;
                    $decs = $doctor.desc ? $doctor.desc : "暂无";
                    innerHtml +=
                            '<div class="doc"><div class="ui-grid-c">' +
                            '<div class="pull-right booking"><a href="<?php echo $this->createUrl('app/enquiry', array('addBackBtn' => 1)); ?>"><span class="btn-booking team-btn">预约</span></a></div>'
                            + '<div class="ui-block-a mr20"><img class="img80" src="' +
                            $doctor.imageUrl + '"/></div><div class="mt10"><div class="introduce"><span class="pr10">' +
                            $doctor.docName + '</span></div><div class="introduce"><span class="expert-mtitle">' +
                            $doctor.mTitle + '</span> | <span class="expert-atitle">' +
                            $aTile + '</span></div><div class="introduce"><span>' +
                            $doctor.hospital + '</span></div></div></div>' +
                            '<div class="doc-introduce"><span>简介:' +
                            $decs
                            + '</span></div></div>' +
                            '<div class="divider"></div>';

                }
                $(".expert-content").html(innerHtml);
            }
        });
    </script>
</div>


