<style>.department a.ui-link{text-decoration:none;}</style>
<?php
/**
 * $data
 */
//var_dump($data);
// 医院科室详情页面.
$urlHospitalDept = $this->createUrl('/mobile/hospital/dept', array('id' => ''));
$this->setPageID('pHospital' - $data->hospital->id);
$this->setPageTitle($data->hospital->name);
$count_faculty = 0;
if ($data->depts) {
    foreach ($data->depts as $key => $dept) {
        foreach ($dept as $faculty) {
            $count_faculty ++;
        }
    }
}
?>

<div id="<?php echo $this->getPageID(); ?>" class="hp-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>"  data-nav-rel="#f-nav-hospital" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content" class="ui-content">
        <div class="hinfo-header row">
            <?php
            if ($count_faculty > 0) {
                echo "共为您找到 " . $count_faculty . " 个科室";
            }else{
                echo '暂无此医院科室信息';
            }
            
            ?>
        </div>
        <div class="department row">
            <div class="ui-grid-a">
                <div class="ui-block-a text-center">
                    <?php
                    $dataid = 0;
                    if ($data->depts) {
                        foreach ($data->depts as $key => $dept) {
                            $dataid ++;
                            $active = $dataid == 1 ? "active" : "";
                            echo '<a class="dept" href="javascript:;" data-id="' . $dataid . '"><div class="deptname ' . $active . '">' . $key . '</div></a>';
                        }
                    }
                    ?>
                </div>
                <?php if ($data->depts) { ?>
                    <div class="ui-block-b">
                        <?php
                        $id = 0;
                        foreach ($data->depts as $key => $dept) {
                            $id ++;
                            $active = $id == 1 ? "active" : "";
                            echo '<div class="faculty ' . $active . '" id="' . $id . '">';
                            foreach ($dept as $faculty) {
                                echo '<a href="' . $urlHospitalDept .'/' .$faculty->id . '"><div class="facultyname">' . $faculty->name . '</div></a>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $(".dept").click(function () {
                    $dataid = $(this).attr("data-id");
                    $(".deptname").removeClass("active");
                    $(this).find(".deptname").addClass("active");
                    $(".faculty").removeClass("active");
                    $("#" + $dataid).addClass("active");
                });
            });
        </script>
    </div>
</div>

