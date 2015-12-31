<?php
/**
 * $data.
 */
$this->setPageTitle('明星团队');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlExpertteamView = $this->createAbsoluteUrl('/api/list', array('model' => 'expertteam'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlBooking = $this->createUrl('booking/create');
$this->show_footer = false;
?>
<div id="section_container">
    <!--明星团队-->
    <section id="expertteam_section" class="active" data-init="true">
        <header class="head-title1 h80p">
            <nav class="left">
                <a href="#" data-icon="previous" data-target="back"></a>
            </nav>
            <div class="grid vertical title h80p">
                <div class="col-0 h40p color-white titleName"><?php echo $this->pageTitle; ?></div>
                <div class="col-1 bg-white text14">
                    <div class="grid">
                        <div class="col-1 color-green text-left ml10 w80 teamName">

                        </div>
                        <div class="col-1 mr10 text-right w20">
                            <a href="" data-target="link" class="button3 bg-green teamHref">预约</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <article id="expert_list_article" class="active articleHtml"  data-scroll="true">
            <div class="mt40">

            </div>
        </article>
    </section>
</div>
<script>
    $(document).ready(function () {
        J.showMask();
        var id = getExpertteamId();
        var requestUrl = '<?php echo $urlExpertteamView; ?>/' + id + '?api=4';
        $.ajax({
            url: requestUrl,
            success: function (data) {
                //console.log(data);
                readyPage(data);
            }
        });
        J.hideMask();
        function readyPage(data) {
            var leader = data.results.leader;
            var team = data.results.team;
            var members = data.results.members;
            var docFaculty = leader.hFaculty == null ? '' : '<span class="ml10 purple-title">' + leader.hFaculty + '</span>';
            innerHtml = '<div class="mt40 mb20">' +
                    '<div class="mt20 ml10">' +
                    '<div class="mt10 color-black mr10 text-justify">' + team.desc +
                    '</div>' +
                    '<div class="mt10 color-green">擅长手术</div>' +
                    '<div class="mt10 color-black mr10 mb20 text-justify">' + team.goodAt +
                    '</div>' +
                    '</div>' +
                    '<div class="team_divider mb30"></div>' +
                    '<div class="bb-black"></div>' +
                    '<div class="list_title">' +
                    '<span>团队领衔人</span>' +
                    '</div>' +
                    '<div class="grid mt10">' +
                    '<div class="col-0 w100p">' +
                    '<img class="img80" src="' + leader.imageUrl + '">' +
                    '</div>' +
                    '<div class="ml10 col-1">' +
                    '<div class="team-name mt10 doctor-title">' +
                    leader.name + docFaculty +
                    '</div>' +
                    '<div class="team-hospital mt5">' +
                    '<span class="color-gray">' + leader.mTitle + '|' + leader.aTitle + '</span>' +
                    '</div>' +
                    '<div class="team-slogan mt5 color-black">' + leader.hpName +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="color-black ml10 mb10 mt10 honor-mobile-team">' +
                    '<img src="<?php echo $urlResImage ?>image/honor.png">&nbsp;<span>专家荣誉</span>';
            if (leader.honour && leader.honour.length > 0) {
                for (var i = 0; i < leader.honour.length; i++) {
                    innerHtml += '<div>' + (i + 1) + '.' + leader.honour[i] + '</div>';
                }
            }else{
                innerHtml += '<div>暂无荣誉</div>';
            }
            innerHtml += '</div>';
            if (members) {
                innerHtml += '<div class="team_divider mb30"></div>' +
                        '<div class="bb-black"></div>' +
                        '<div class="list_title mb20">' +
                        '<span>团队成员</span>' +
                        '</div>';
                for (var i = 0; i < members.length; i++) {
                    innerHtml += '<div class="team_divider mt10"></div>' +
                            '<div class="grid mt10">' +
                            '<div class="col-0 w100p">' +
                            '<img class="img80"  src="' + members[i].imageUrl + '">' +
                            '</div>' +
                            '<div class="ml10 col-1">' +
                            '<div class="team-name mt10 doctor-title">' + members[i].name + '</div>' +
                            '<div class="team-hospital mt5">' +
                            '<span class="color-gray">' + members[i].mTitle + '</span>' +
                            '</div>' +
                            '<div class="team-slogan mt5 color-black">' + members[i].hpName + '</div>' +
                            '</div>' +
                            '</div>';
                    if (members[i].desc == null) {
                        innerHtml += '<div class="color-black ml10 mt10 mr10 text-justify">擅长:暂无介绍</div>';
                    } else {
                        innerHtml += '<div class="color-black ml10 mt10 mr10 text-justify">擅长:' + members[i].desc + '</div>';
                    }
                }
            }
            innerHtml += '</div>';
            var href = '<?php echo $urlBooking; ?>' + '?tid=' + team.teamId;
            $('.teamHref').attr('href', href);
            $('.teamName').html(team.teamName);
            $('.articleHtml').html(innerHtml);
        }
    });

    function getExpertteamId() {
        var url = window.location.href;
        var id = url.substr(url.lastIndexOf('/') + 1, url.length);
        return id;
    }
</script>































