<?php
//$idoctor IDoctor
$this->setPageID('pDoctorView');
$this->setPageTitle('名医主刀');
$id = $_GET["id"];
$urlApiDoctorView = $this->createAbsoluteUrl("/api/view", array('model' => 'doctor', 'id' => $id));
?>
<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>"  data-nav-rel="#f-nav-home" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content">
        <div class="page row">
            <section class="page-section">
                <div class="section-body section-docInfo doc-info pb10">

                </div>
            </section>
        </div>

        <div class="page mb20">
            <section class="page-section">
                <div class="section-body section-docDesc">

                </div>
            </section>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".ui-loader").show();
        $.ajax({
            //url: 'http://mingyizhudao.com/api/doctor/' +<?php echo $id; ?>,
            url: "<?php echo $urlApiDoctorView; ?>",
            success: function (data) {
                $doctor = data.doctor;
                setDocInfo($doctor);//设置医生基本信息
                setDocDesc($doctor);//设置医生医院和描述信息
            },
            complete: function () {
                $(".ui-loader").hide();
            }
        });
        //设置医生基本信息
        function setDocInfo($doctor) {
            var innerHtml =
                    '<div class="row"><div class="ui-grid-b"><div class="ui-block-a"></div><div class="ui-block-b"><img class="img100" src="' +
                    $doctor.urlImage + '" alt=""/></div><div class="booking pl20">' +
                    '<a href="<?php echo $this->createUrl('app/enquiry', array('addBackBtn' => 1)); ?>"><span class="btn-booking team-btn">预约</span></a>' +
                    '</div></div><div class="docTags"><div><span class="doc-name mr10">' +
                    $doctor.name + '</span><span class="doc-atitle">' +
                    $doctor.aTitle + '</span></div><div><span class="doc-faculty mr10">' +
                    $doctor.hFaculty + '</span><span class="doc-mtitle">' +
                    $doctor.mTitle + '</span></div></div></div>';
            $(".section-docInfo").html(innerHtml);
        }
        //设置医生医院和描述信息
        function setDocDesc($doctor) {
            var innerHtml =
                    '<div class="row"><div class="header-area"></div><div class=" doc-hospital">执业医院：' +
                    $doctor.hospital + '</div><div class="header-area"></div><div class=" doc-desc">简介：' +
                    $doctor.desc + '</div></div>';
            $(".section-docDesc").html(innerHtml);
        }
    });
</script>