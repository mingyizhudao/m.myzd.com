<?php

class AdminLoginForm extends CFormModel {

    public $username;
    public $password;
    private $_identity;
    public $verifyCode;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // password needs to be authenticated
            array('password', 'authenticate'),
            // verifyCode needs to be entered correctly
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => 'username',
            'password' => 'password'
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $adminUsername = Yii::app()->params['admin'];
            $adminPassword = Yii::app()->params['adminPassword'];
            if ($adminUsername != $this->username || $adminPassword != $this->encryptPassword($this->password)) {
          //  if ($adminUsername != $this->username || $adminPassword != $this->password) {
                $this->addError('password', 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new AdminIdentity($this->username, $this->encryptPassword($this->password));
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = 0;
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
    }

    protected function encryptPassword($password) {
        return hash('sha256', $password);
    }

}
