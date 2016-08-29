<?php

abstract class MobileController extends WebsiteController {

    public $layout = 'layoutSinglePage';
    public $jqPageId;   //must be unique across all pages in jquery mobile.
    public $pageTitle = '三甲医院手术预约,专家,主任医生手术,床位预约_名医主刀网移动版';
    public $pageKeywords = '预约手术,专家手术,名医主刀网';
    public $pageDescription = '名医随时有,手术不再难!名医主刀汇聚国内外顶级名医和床位资源,利用互联网技术实现医患精准匹配,帮助广大患者在第一时间预约到名医专家进行主刀治疗-www.mingyizhudao.com';

    public function init() {
        //  $this->handleMobileBrowserRedirect();
        return parent::init();
    }

    public function getHomeUrl() {
        return $this->createUrl('home/index');
    }

    public function setPageID($pid) {
        $this->jqPageId = $pid;
    }

    public function getPageID() {
        return $this->jqPageId;
    }

    public function setPageTitle($title, $siteName = false) {
        parent::setPageTitle($title, $siteName);
    }

    public function getPageTitle() {
        return $this->pageTitle;
    }

    public function setPageKeywords($keywords, $siteName = false) {
        parent::setPageKeywords($keywords, $siteName);
    }

    public function getPageKeywords() {
        return $this->pageKeywords;
    }

    public function setPageDescription($description, $siteName = false) {
        parent::setPageDescription($description, $siteName);
    }

    public function getPageDescription() {
        return $this->pageDescription;
    }

    public function showBrowserModeMenu() {
        if ($this->id == 'home') {
            if (isset($_GET['bm'])) {
                return $_GET['bm'] == 1;
            } else if (isset($_POST['bm'])) {
                return $_POST['bm'] == 1;
            } else {
                return $this->isAjaxRequest() === false;
            }
        } else {
            return false;
        }
    }

    public function showActionBar() {
        return ($this->isUserAgentApp() === false);
    }

    public function renderActionBar() {
        if ($this->showActionBar()) {
            $this->renderPartial('//layouts/actionbar');
        }
    }

    public function createPageAttributes($returnString = true) {
        $data = array();
        if (isset($_GET['addBackBtn']) && $_GET['addBackBtn'] == 1) {
            $data['data-add-back-btn'] = 'true';
        }
        if (isset($_GET['backBtnText'])) {
            $data['data-back-btn-text'] = $_GET['backBtnText'];
        }
        if ($returnString) {
            $ret = '';
            foreach ($data as $key => $value) {
                $ret.=$key . '=' . $value . ' ';
            }
            return $ret;
        } else {
            return $data;
        }
    }

    public function actionValiCaptcha() {
        $output = array('status' => 'no');
        if (strcmp($_REQUEST['co_code'], Yii::app()->session['code']) != 0) {
            $output['status'] = 'no';
            $output['error'] = '图形验证码错误';
        } else {
            $output['status'] = 'ok';
        }
        $this->renderJsonOutput($output);
    }

    //获取验证码
    public function actionGetCaptcha() {
        $captcha = new CaptchaManage;
        $captcha->showImg();
    }

}
