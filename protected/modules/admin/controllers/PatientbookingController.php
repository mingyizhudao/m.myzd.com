<?php

class PatientbookingController extends AdminController {

    public $defaultAction = 'list';
    public $bid;

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
                'actions' => array('create', 'update', 'delete', 'admin', 'search', 'index', 'view', 'list', 'changeStatus', 'relateDoctor', 'relate', 'searchResult'),
                'users' => array('superbeta'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionList() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.date_deleted is NULL");
        $criteria->order = "t.id DESC";
        $criteria->with = array('pbCreator' => array('with' => 'userDoctorProfile'), 'pbPatient' => array('with' => ''));
        $dataProvider = new CActiveDataProvider('PatientBooking', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->render('list', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $apisvc = new ApiViewPatientBooking($id);
        $output = $apisvc->loadApiViewData();

        $pbId = $output->booking->id;
        $pbModel = PatientBooking::model()->getById($pbId);
        $userDoctorModel = UserDoctorProfile::model()->getByAttributes(array('user_id' => $pbModel->doctor_id));

        //salesorder for patientBooking
        $orderList = SalesOrder::model()->getAllByAttributes(array('bk_id' => $pbId, 'bk_type' => StatCode::TRANS_TYPE_PB));

        if ($output->status == 'ok') {
            $this->render('view', array(
                'data' => $output,
                'userDoctor' => $userDoctorModel,
                'orderList' => $orderList,
            ));
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new PatientBooking;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PatientBooking'])) {
            $model->attributes = $_POST['PatientBooking'];
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

        if (isset($_POST['PatientBooking'])) {
            $model->attributes = $_POST['PatientBooking'];
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
     * Lists all models.
     */
    public function actionIndex() {
        $this->redirect(array('list'));

        $dataProvider = new CActiveDataProvider('PatientBooking');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->render('admin');
    }
    
    public function actionSearch() {
        $this->render('search');
    }

    public function actionSearchResult() {
        $pbSeach = new PatientBookingSearch($_GET);
        $criteria = $pbSeach->criteria;
        $dataProvider = new CActiveDataProvider('PatientBooking', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->renderPartial('searchResult', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /*
     * 更改状态
     */

    public function actionChangeStatus($id, $code) {
        $model = $this->loadModel($id);
        $model->setStatus($code);
        $model->update();

        $returnUrl = isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('view', 'id' => $model->id);
        $this->redirect($returnUrl);
    }

    /*
     * 预约关联医生doctorProfile.user_id
     */

    public function actionRelateDoctor($bid) {
//        $model = $this->loadModel($bid);
        $this->bid = $bid;
        $model = new UserDoctorProfile('search');
        $model->unsetAttributes();
        if (isset($_GET['UserDoctorProfile']))
            $model->attributes = $_GET['UserDoctorProfile'];

        $this->render('relateDoctor', array(
            'model' => $model,
            'bid' => $bid,
        ));
    }

    public function actionRelate($bid, $userid, $name) {
        $this->headerUTF8();
        if (isset($bid) && isset($userid) && isset($name)) {
            $model = $this->loadModel($bid);
            $model->setDoctorId($userid);
            $model->setDoctorName($name);
            if ($model->save()) {
                $user = User::model()->getById($userid);
                $sendMgs = new SmsManager();
                $data = new stdClass();
                $data->refno = $model->getRefNo();
                $data->id = $model->getId();
                $sendMgs->sendSmsBookingAssignDoctor($user->username, $data);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        throw new CHttpException(404, 'The requested page does not exist.');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PatientBooking the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PatientBooking::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PatientBooking $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'patient-booking-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
