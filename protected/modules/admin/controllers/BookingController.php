<?php

class BookingController extends AdminController {

    public $defaultAction = 'list';

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
                'actions' => array('create', 'update', 'delete', 'admin', 'search', 'index', 'view', 'list', 'changeStatus', 'searchResult'),
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
        $criteria->with = array('countFiles', 'bkExpertTeam', 'bkDoctor');
        $dataProvider = new CActiveDataProvider('Booking', array(
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
        //$bookingMgr = new BookingManager();
        //$ibooking = $bookingMgr->loadIBooking($id, array('bkOwner', 'doctorBooked', 'bkFiles', 'countFiles'));
        $apisvc = new ApiViewBooking($id);
        $output = $apisvc->loadApiViewData();

        $bkId = $output->booking->id;
        //salesorders for booking
        $orderList = SalesOrder::model()->getAllByAttributes(array('bk_id' => $bkId, 'bk_type' => StatCode::TRANS_TYPE_BK));
        
        if ($output->status == 'ok') {
            $this->render('view', array(
                'data' => $output,
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
        $this->redirect('index');
        $model = new Booking;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Booking'])) {
            $model->attributes = $_POST['Booking'];
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
        $booking = $this->loadModel($id);
        $form = new BookingFormAdmin();
        $form->initModel($booking->getUserId(), $booking);
        $form->loadData();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BookingFormAdmin'])) {
            $values = $_POST['BookingFormAdmin'];
            $form->attributes = $values;
            if ($form->validate()) {
                $booking->setAttributes($form->getSafeAttributes());

                if ($booking->save() === false) {
                    $form->addErrors($booking->getErrors());
                } else {
                    $this->redirect(array('view', 'id' => $booking->getId()));
                }
            }
            /*
              if ($model->save())
              $this->redirect(array('view', 'id' => $model->id));
             * 
             */
        }

        $this->render('//admin/booking/update', array(
            'model' => $form
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        // update date_deleted.
        $this->loadModel($id)->delete(false);

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('search'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->redirect(array('list'));
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.date_deleted is NULL");
        $criteria->order = "t.date_created DESC";
        $dataProvider = new CActiveDataProvider('Booking', array(
            'criteria' => $criteria
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Searchs all models.
     */
//    public function actionSearch() {
//        $this->layout = $this->viewPath . '/layouts/column1';
//        $model = new Booking('search');
//        $model->unsetAttributes();  // clear any default values
//        $form = new BookingSearchForm();
//
//        $values = array();
//        if (isset($_GET['BookingSearchForm'])) {
//            $values = $_GET['BookingSearchForm'];
//        } else if (isset($_GET['Booking'])) {
//            $values = $_GET['Booking'];
//        }
//        $form->setAttributes($values);
//        $model->setAttributes($values);
//        $this->render('search', array(
//            'model' => $model,
//            'form' => $form,
//        ));
//    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = $this->viewPath . '/layouts/column1';
        $model = new Booking('search');
        $model->unsetAttributes();  // clear any default values
        $form = new BookingSearchForm();
        $values = array();
        if (isset($_GET['BookingSearchForm'])) {
            $values = $_GET['BookingSearchForm'];
        } else if (isset($_GET['Booking'])) {

            $values = $_GET['Booking'];
        }

        $this->render('search', array(
            'model' => $model,
            'form' => $form,
        ));
    }

    public function actionSearch() {
        $this->render('search');
    }

    public function actionSearchResult() {
        $pbSeach = new BookingSearch($_GET);
        $criteria = $pbSeach->criteria;
        $dataProvider = new CActiveDataProvider('Booking', array(
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
        $model->setBkStatus($code);
        $model->update();

        $returnUrl = isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('view', 'id' => $model->id);
        $this->redirect($returnUrl);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Booking the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Booking::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Booking $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'booking-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
