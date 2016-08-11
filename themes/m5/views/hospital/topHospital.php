<?php
/**
 * $data.
 */
$this->setPageTitle('复旦版中国最佳医院排行榜');
$urlLeaderboard = $this->createAbsoluteUrl('/api/tophospital');
$urlHospitalDetail = $this->createUrl('hospital/view', array('id' => ''));
$this->show_footer = false;
?>

<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <div class="title">医院排行榜</div>
</header>
<article id="topHospital_article" class="active" data-scroll="true">
    <div>
        <div>
            <img src="http://static.mingyizhudao.com/14707325437827" class="w100">
        </div>
        <div class="pl10 pr10 pb50">
            <div class="font-s13 pt20 pb10 font-w800 board-detail">
                <p>
                    "复旦版中国最佳医院排行榜" 是由复旦大学医院管理研究所连续六年发布的中国医院排名权威榜单。榜单综合考虑了学科建设、临床技术、医疗质量、科研水平等因素，汇集了中国医院的顶尖专科，反映了中国医院在该专科领域的临床实力和学术声誉。
                </p>
                <p>
                    自该榜单发布六年来，全国各大医院对排行榜越来越认可，并将其作为医院专科比较评价的依据。同时，榜单也向病人提供了准确的信息，并产生了权威的社会效益。
                </p>
            </div>
            <ul class="board-list">
            </ul>
            <button id="btn-loadMore" class="btn btn-green btn-loadMore mt10 mb10">加载更多</button>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        J.showMask();
        var pageCount = 1;
        getHospitalList(pageCount);
        $("#btn-loadMore").click(function (e) {
            e.preventDefault();
            J.showMask();
            pageCount++;
            getHospitalList(pageCount);
        });
    });

    function getHospitalList(num) {
        $.ajax({
            type: 'get',
            url: '<?php echo $urlLeaderboard; ?>' + '?page=' + num,
            success: function (data) {
                J.hideMask();
                if (data.status == 'ok') {
                    if (data.results != null) {
                        appendList(data.results);
                    }
                } else {
                    J.showToast('加载失败，请重试', 'toast', 1000);
                }
            },
            error: function () {
                J.hideMask();
            }
        });
    }

    function appendList(res) {
        if (res[res.length - 1].sort == 100) {
            $('#btn-loadMore').hide();
            J.showToast('加载完毕', 'toast', 1000);
        }
        var list = '';
        for (var i = 0; i < res.length; i++) {
            var ficon = res[i].sort == 1 ? '<i class="first1"></i>' : '<i class="">' + res[i].sort + '</i>';
            var hasLink = res[i].hospital_id ? '<a class="a-check" href="<?php echo $urlHospitalDetail ?>/' + res[i].hospital_id + '">查看详情 ></a>' : '<a class="a-uncheck" href="javascript:;">敬请期待></a>';
            list += '<li>' +
                    ficon +
                    '<span>' + res[i].hospital_name + '</span>' +
                    hasLink +
                    '</li>';
        }
        $(list).appendTo($('.board-list'));
    }
</script>