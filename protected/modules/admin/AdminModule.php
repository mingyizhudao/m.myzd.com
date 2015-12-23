<?php

class AdminModule extends CWebModule {

    /**
     * @var string the password that can be used to access AdminModule.
     * If this property is set false, then AdminModule can be accessed without password
     * (DO NOT DO THIS UNLESS YOU KNOW THE CONSEQUENCE!!!)
     */
    public $username;
    public $password;

    /**
     * @var array the IP filters that specify which IP addresses are allowed to access AdminModule.
     * Each array element represents a single filter. A filter can be either an IP address
     * or an address with wildcard (e.g. 192.168.0.*) to represent a network segment.
     * If you want to allow all IPs to access admin, you may set this property to be false
     * (DO NOT DO THIS UNLESS YOU KNOW THE CONSEQUENCE!!!)
     * The default value is array('127.0.0.1', '::1'), which means AdminModule can only be accessed
     * on the localhost.
     */
    public $ipFilters = array('127.0.0.1', '::1');

    public function init() {
        Yii::setPathOfAlias('admin', dirname(__FILE__));
        Yii::app()->setComponents(array(
            /*
              'errorHandler' => array(
              'class' => 'CErrorHandler',
              'errorAction' => $this->getId() . '/home/error',
              ),
             */
            'user' => array(
                'class' => 'AdminWebUser',
                'stateKeyPrefix' => '_admin',
                'loginUrl' => Yii::app()->createUrl($this->getId() . '/home/login'),
            ),
            'widgetFactory' => array(
                'class' => 'CWidgetFactory',
                'widgets' => array()
            )
                ), false);
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
        
        $this->setTheme('admin');
        $this->defaultController = 'home';
        return parent::init();
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $route = $controller->id . '/' . $action->id;
            if (!$this->allowIp(Yii::app()->request->userHostAddress) && $route !== 'home/error') {
                throw new CHttpException(403, "You are not allowed to access this page.");
            }
            $publicPages = array(
                'home/login',
                'home/error',
                'home/captcha',
            );
            if ($this->password !== false && Yii::app()->user->isGuest && !in_array($route, $publicPages)) {
                Yii::app()->user->loginRequired();
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks to see if the user IP is allowed by {@link ipFilters}.
     * @param string $ip the user IP
     * @return boolean whether the user IP is allowed by {@link ipFilters}.
     */
    protected function allowIp($ip) {
        return true;

        if (empty($this->ipFilters)) {
            return true;
        }
        foreach ($this->ipFilters as $filter) {
            if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos))) {
                return true;
            }
        }
        return false;
    }

    private function setTheme($theme, $setViewPath = true) {
        // set theme.
        Yii::app()->theme = $theme;
        // set theme url & path.
        Yii::app()->themeManager->setBaseUrl(Yii::app()->theme->baseUrl);
        Yii::app()->themeManager->setBasePath(Yii::app()->theme->basePath);
        // set module viewPath.
        if ($setViewPath) {
            $this->setViewPath(Yii::app()->theme->basePath . '/views');
        }
    }

}
