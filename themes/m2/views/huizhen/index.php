<?php
$this->setPageID('pHuizhen');
$this->setPageTitle('约名医');
$menu = array(
    'shenjingke'=>$this->createUrl('huizhen/byfaculty',array('id'=>'shenjingke')),
    'xiongwaike'=>$this->createUrl('huizhen/byfaculty',array('id'=>'xiongwaike')),
    'miniowaike'=>$this->createUrl('huizhen/byfaculty',array('id'=>'miniowaike')),
    'fuchan' => $this->createUrl('huizhen/byfaculty', array('id' => 'fuchan')),
    'zhengxing' => $this->createUrl('huizhen/byfaculty', array('id' => 'zhengxing')),
    'shen' => $this->createUrl('huizhen/byfaculty', array('id' => 'shen')),
    'fei' => $this->createUrl('huizhen/byfaculty', array('id' => 'fei')),
    'weichang' => $this->createUrl('huizhen/byfaculty', array('id' => 'weichang')),
    'gandan' => $this->createUrl('huizhen/byfaculty', array('id' => 'gandan')),
    'xinxueguan' => $this->createUrl('huizhen/byfaculty', array('id' => 'xinxueguan')),
    'buyun' => $this->createUrl('huizhen/byfaculty', array('id' => 'buyun')),
    'guke' => $this->createUrl('huizhen/byfaculty', array('id' => 'guke')),
    'zhongliu' => $this->createUrl('huizhen/byfaculty', array('id' => 'zhongliu')),
);
?>
<div id="<?php echo $this->getPageID(); ?>" class="home-page" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-huizhen">    
    <div><img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/huizhen01.jpg" /></div>
    <div data-role="content" class="ui-content">

        <div data-role="navbar" data-grid="a" class="ui-navbar navbar-dis" role="navigation">   
            <ul class="ui-grid-a">
                <li class="ui-block-a"><a href="<?php echo $menu['guke']; ?>" data-transition="slide" class="nav-dis ui-link ui-btn ui-icon-bone ui-btn-icon-top">骨科</a></li>
                <li class="ui-block-b"><a href="<?php echo $menu['gandan']; ?>" data-transition="slide" class="nav-dis ui-link ui-btn ui-icon-liver ui-btn-icon-top">肝胆</a></li>
                <li class="ui-block-a"><a href="<?php echo $menu['xinxueguan']; ?>" data-transition="slide" class="nav-dis ui-link ui-btn ui-icon-cardio ui-btn-icon-top">心血管</a></li>
                <li class="ui-block-b"><a href="<?php echo $menu['zhongliu']; ?>" data-transition="slide" class="nav-dis ui-link ui-btn ui-icon-tumor  ui-btn-icon-top">肿瘤</a></li>
                <li class="ui-block-a"><a href="<?php echo $menu['fuchan']; ?>" data-transition="slide" class="nav-dis ui-link ui-icon-baby ui-btn  ui-btn-icon-top">妇产</a></li>
                <li class="ui-block-c"><a href="<?php echo $menu['shenjingke']; ?>" data-transition="slide" class="nav-dis ui-link ui-btn  ui-icon-shenjingke ui-btn-icon-top">神经科</a></li>           
            </ul>
        </div>
    </div>
</div>
