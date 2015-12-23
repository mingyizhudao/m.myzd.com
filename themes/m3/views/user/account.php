<?php
$this->setPageID('pMobile');
$this->setPageTitle('个人中心');
?>

<div id="<?php echo $this->getPageID(); ?>" class="home-page"  data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-account">    
    <div data-role="content" class="padtop1 bordertop">
        <div id="account" class="row">        
            <div class="ui-grid-a account-list pb20">
                <div class="ui-block-a">
                    <div class="borderright">
                        <a href="#">
                            <div class="city"><span>预约单</span></div>
                        </a>
                    </div>
                </div>
                <div class="ui-block-b">
                    <div class="">
                        <a href="#">
                            <div class="city"><span>常用联系人</span></div>
                        </a>
                    </div>
                </div>
                <div class="bordertop clearfix pull-left"></div>
                <div class="ui-block-a">
                    <div class="borderright">
                        <a href="#">
                            <div class="city"><span>设置</span></div>
                        </a>
                    </div>
                </div>
                
                <div class="ui-block-b">
                    <div class="borderleft">
                        <a href="#">
                            <div class="city"><span>联系我们</span></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>   

</div>