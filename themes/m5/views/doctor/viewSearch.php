<?php
$searchDoc = $this->createUrl("doctor/search");
$searchDept = $this->createUrl("hospital/search");
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlDiseaseName = $this->createAbsoluteUrl('/api/diseasename', array('api' => 7, 'disease_name' => ''));
$this->show_footer = false;
?>
<style>
    #jingle_toast{top:30%;}
</style>
<header id="search_header" class="bg-green">
    <nav class="left">
        <a href="#" data-icon="previous" data-target="back"></a>
    </nav>
    <div class="title">
        <input id="inputDisease" type="text" name="disease_name" class="w70" placeholder="请输入疾病名称">
        <span class="pr5 emptyImg hide">
            <a id="emptyInput">
                <img src="<?php echo $urlResImage; ?>close.png" class="w15p">
            </a>
        </span>
        <div class="grid lineDiv">
            <div class="col-0 w15"></div>
            <div class="col-0 w70 borderLine"></div>
            <div class="col-0 w15"></div>
        </div>
    </div>
    <nav class="right mr10">
        <div id="btnSearch">搜索</div>
    </nav>
</header>
<article class="active" data-scroll="true">
    <div>

    </div>
</article>
<script>
    $(document).ready(function () {
        $("input").keyup(function () {
            $('#inputDisease').addClass('w63');
            $('#inputDisease').removeClass('w70');
            $('.emptyImg').removeClass('hide');
        });

        $('#emptyInput').tap(function () {
            $('#inputDisease').val('');
            $('#inputDisease').addClass('w70');
            $('#inputDisease').removeClass('w63');
            $('.emptyImg').addClass('hide');
        });

        $('#btnSearch').tap(function () {
            //根据疾病名称，异步查询全名
            var disease_name = $("input[name='disease_name']").val();
            if (disease_name == '') {
                J.showToast('请输入疾病名称', '', 1000);
                return;
            }
            $.ajax({
                url: '<?php echo $urlDiseaseName; ?>' + disease_name,
                success: function (data) {
                    //console.log(data);
                    var diseaseName = data.results.name;
                    var diseaseId = data.results.id;
                    J.popup({
                        html: '<ul class="list"><li id="searchDoc" class="text-center">找医生</li><li id="searchDept" class="text-center">找科室</li></ul>',
                        pos: 'center'
                    });
                    $('#searchDoc').tap(function () {
                        J.hideMask();
                        location.href = '<?php echo $searchDoc; ?>?disease_name=' + diseaseName + '&page=1';
                    });
                    $('#searchDept').tap(function () {
                        J.hideMask();
                        location.href = '<?php echo $searchDept; ?>?disease=' + diseaseId + '&disease_name=' + diseaseName + '&page=1';
                    });
                }
            });
        });
    });
</script>
