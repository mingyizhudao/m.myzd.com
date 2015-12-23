<?php
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlHospital = $this->createUrl('hospital/index', array('addBackBtn' => 1));
$urlOverseas = $this->createUrl('overseas/index', array('addBackBtn' => 1));

$furl = $this->createUrl('faculty/view');
$tUrl = $this->createUrl('expertteam/view');
?>

<div id="<?php echo $this->getPageID(); ?>" class="home-page" data-home="true" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-home">    
    <div data-role="content" class="padtop1 bordertop">
        <div class="row mt-fix">
            <ul class="bxslider">

            </ul>
        </div>
        <div class="row register">
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <!--<a data-ajax='false' class="reg-btn btn-lightblue btn-wide" href="<?php echo $this->createUrl('user/register') ?>">用户入口</a>-->
                </div>
                <div class="ui-block-b">
                    <a data-ajax='false' class="reg-btn btn-deepblue btn-wide" href="<?php echo $this->createUrl('doctor/register') ?>">医生入口</a>
                </div>
            </div>
        </div>
        <div class="row">        
            <div data-role="navbar" data-grid="b" class="ui-navbar navbar-dis" role="navigation">   
                <ul class="ui-grid-b">
                    <!--                    <li class="ui-block-a"><a href="" data-transition="slide" class="nav-dis ui-link ui-btn ui-icon-xinxueguan  ui-btn-icon-faculty"><div class="icon-img"></div><div class="faculty-name">心血管</div></a></li>-->

                </ul>
            </div>
        </div>
    </div>   

</div>
<script>
    $(document).ready(function () {
        $(".ui-loader").show();
        $.ajax({
            //url: 'http://mingyizhudao.com/api/appnav1',
            url: "<?php echo $urlApiAppNav1; ?>",
            async: false,
            success: function (data) {
                //bxslider
                teamList = data.teamList;
                //var innerHtml = '<li><a href="#"  data-ajax=false><img src="http://myzd.oss-cn-hangzhou.aliyuncs.com/static%2Fbanner_mingxingtuandui_1170x550.jpg" alt="明星团队" class="img-responsive"></a></li>';
                var innerHtml="";
                for (var i = 0; i < teamList.length; i++) {
                    innerHtml = innerHtml +
                            '<li><a data-ajax=false href="<?php echo $tUrl ?>?id=' + teamList[i].teamId + '"><img src="' +
                            teamList[i].introImageUrl + '" alt="' +
                            teamList[i].teamName + '" class="img-responsive"></a></li>';
                }
                $('.bxslider').html(innerHtml);

                //facultyList
                facultyList = data.facultyList;
                var facultyHtml = '';
                for (var i = 0; i < facultyList.length; i++) {
                    var li_class = '';
                    if (i % 3 === 0) {
                        li_class = 'ui-block-a';
                    }
                    if (i % 3 === 1) {
                        li_class = 'ui-block-b';
                    }
                    if (i % 3 === 2) {
                        li_class = 'ui-block-c';
                    }
                    facultyHtml = facultyHtml +
                            '<li class="' +
                            li_class + '"><a href="<?php echo $furl ?>?id=' + facultyList[i].id + '" data-ajax=false data-transition="slide" class="nav-dis ui-link ui-btn ui-icon-' +
                            facultyList[i].code + ' ui-btn-icon-faculty"><div class="icon-img"></div><div class="faculty-name">' +
                            facultyList[i].name + '</div></a></li>';
                }
                $('.ui-grid-b').html(facultyHtml);

            },
            complete: function () {
                $(".ui-loader").hide();
            }
        });

        $('.bxslider').bxSlider({
            controls: false,
            //pager:false,
            auto: true

        });
    });
</script>