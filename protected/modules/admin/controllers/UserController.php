<?php

class UserController extends AdminController {

    public $defaultAction = 'listdoctors';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(''),
                'users' => array('*'),
            ),
            /*
              array('allow', // allow authenticated user to perform 'create' and 'update' actions
              'actions' => array('create', 'update'),
              'users' => array('@'),
              ),
             */
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view', 'admin', 'listdoctors', 'verify', 'ajaxUserSearch', 'searchResult', 'search'),
                'users' => array('superbeta'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->redirect(array('listdoctors'));
    }

    /**
     * Lists all models where User.role=2 (医生).
     */
    public function actionListdoctors() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.date_deleted is NULL");
        $criteria->compare('t.role', StatCode::USER_ROLE_DOCTOR);
        $criteria->order = "t.id DESC";
        $criteria->with = array('userDoctorProfile');
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->render('listDoctor', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $with = array('userDoctorProfile', 'userDoctorCerts');
        $model = $this->loadModel($id, $with);
        $this->render('view', array(
            'model' => $model
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
//    public function actionAdmin() {
//        $model = new UserDoctorProfile('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['UserDoctorProfile']))
//            $model->attributes = $_GET['UserDoctorProfile'];
//
//        $this->render('userSearch', array(
//            'model' => $model,
//        ));
//    }

    public function actionVerify($id) {
        $with = array('userDoctorProfile', 'userDoctorCerts');
        $model = $this->loadModel($id, $with);
        $profile = $model['userDoctorProfile'];
        if (isset($profile)) {
            if ($profile->date_verified == NULL) {
                $profile->setVerified();
            } else {
                $profile->unsetVerified();
            }
            $profile->setVerifiedBy(Yii::app()->user->id);
            $profile->update();
        }
        $returnUrl = isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('view', 'id' => $model->id);

        $this->redirect($returnUrl);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $with = null) {
        $model = User::model()->getById($id, $with);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxUserSearch() {
        $userSearch = new ApiViewUserSearch($_GET);
        $data = $userSearch->loadApiViewData();
        $this->renderJsonOutput($data);
    }

    /**
     * 根据条件查询用户
     */
    public function actionAdmin() {
        $this->render('search');
    }

    public function actionSearchResult() {
        $this->headerUTF8();
        $userSearch = new UserSearch($_GET);
        $criteria = $userSearch->criteria;
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));

        $this->renderPartial('searchResult', array(
            'dataProvider' => $dataProvider,
        ));
    }

}
