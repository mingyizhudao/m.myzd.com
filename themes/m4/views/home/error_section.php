<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.min.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlHospital = $this->createUrl('hospital/index', array('addBackBtn' => 1));
$urlOverseas = $this->createUrl('overseas/index', array('addBackBtn' => 1));

$furl = $this->createUrl('faculty/view');
$tUrl = $this->createUrl('expertteam/view');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>
<div id="section_container">
<!--明星团队-->
		<section id="error_section" class="active" >
			<header class="head-title1">
				<a href="#" data-target="back"><nav data-icon="previous" class="left"></nav></a>
				<div class="title1">预约单</div>
			</header>
			
			<article id="expert_list_article" class="active"  data-scroll="true">
			<form class="input-group color-black ">
					<div class="input-row">
						<label>就诊专家:</label>
						<input type="text" value="许建屏专家团队"  readonly>
					</div>
					<div class="input-row">
						<label>就诊科室:</label>
						<input type="text" value="成人外科"  readonly>
					</div>
					<div class="input-row">
						<label>就诊医院:</label>
						<input type="text" value="阜外心血管病医院"  readonly>
					</div>
					<div class="divider mt20"></div>
					<div class="input-row">
					
						<label>患者姓名</label>
						<input type="text" placeholder="请输入患者姓名">
					</div>
					<div class="input-row pl10 mt10 pb10 " style="color:red;">
					
						姓名不能为空
						
					</div>
					<div class="input-row">
					<div style="margin-left:13px;" class="mt10">意向就诊日期:
					<div>
					<input type="date" style="width:47%;">至<input type="date" style="width:47%;">
					</div>
					
					</div></div>
					<div class="input-row pl10 mt10 pb10 " style="color:red;">
					
						姓名不能为空
						
					</div>
					<div class="divider mt20"></div>
					<div class="input-row">
						<label>病例名称</label>
						<input type="text" >
					</div>
					<div class="input-row pl10 mt10 pb10 " style="color:red;">
					
						姓名不能为空
						
					</div>
					<div class="input-row">
						<label>疾病描述</label>
						<input type="text" >
					</div>
					<div class="input-row pl10 mt10 pb10 " style="color:red;">
					
						姓名不能为空
						
					</div>
					
					
					<div class="login_form">
					<a href="#" class="button block mt10 " id="btn_confirm" style="background-color:#21a59c;">登录</a>
					</div>
				</form>
			</article>
		</section>
    </div>