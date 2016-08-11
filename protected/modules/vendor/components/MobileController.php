<?php

abstract class MobileController extends WebsiteController {

    public $layout = 'layoutSinglePage';
    public $jqPageId;   //must be unique across all pages in jquery mobile.
    public $pageTitle = '名医主刀';

    public function init() {
		//die('Maintenance, please later');
        //  $this->handleMobileBrowserRedirect();
        //return parent::init();
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
	
	/**
     * Stores user's access info for every request.
     */
    public function storeUserAccessInfo($vendorId = 0, $username = "") {
//         $coreAccess = new AppLog();
        $coreAccess = new AppLogMongo();
        if($vendorId > 0){
            $coreAccess->vendor_id = $vendorId;
        }
        $coreAccess->user_host_ip = Yii::app()->request->getUserHostAddress();
		$coreAccess->username = $username;
        $coreAccess->url = Yii::app()->request->getUrl();
        $coreAccess->url_referrer = Yii::app()->request->getUrlReferrer();
        $coreAccess->user_agent = Yii::app()->request->getUserAgent();
        $coreAccess->user_host = Yii::app()->request->getUserHost();
        $coreAccess->save();
    }

}
