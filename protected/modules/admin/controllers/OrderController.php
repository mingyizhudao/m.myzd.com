<?php

class OrderController extends AdminController {

    private $model;
    private $booking;
    private $patientBooking;

    public function filterSalesOrderContext($filterChain) {
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else if (isset($_POST['order']['id'])) {
            $id = $_POST['order']['id'];
        }

        $this->loadModelById($id);

        //complete the running of other filters and execute the requested action.
        $filterChain->run();
    }

    public function filterBkContext($filterChain) {
        $bookingId = null;
        if (isset($_GET['bid'])) {
            $bookingId = $_GET['bid'];
        } else if (isset($_POST['order']['bk_id'])) {
            $bookingId = $_POST['order']['bk_id'];
        }
        $this->loadBookingById($bookingId);

        //complete the running of other filters and execute the requested action.
        $filterChain->run();
    }

    public function filterPbContext($filterChain) {
        $bookingId = null;
        if (isset($_GET['bid'])) {
            $bookingId = $_GET['bid'];
        } else if (isset($_POST['order']['bk_id'])) {
            $bookingId = $_POST['order']['bk_id'];
        }
        $this->loadPatientBookingById($bookingId);

        //complete the running of other filters and execute the requested action.
        $filterChain->run();
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'salesOrderContext + view',
            'bkContext + createBKOrder',
            'pbContext + createPBOrder'
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
                'actions' => array('index', 'create', 'createBKOrder', 'createPBOrder', 'view', 'admin', 'searchResult'),
                'users' => array('superbeta'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $model = $this->model;
        //$model = $this->loadModelById($id);
        $this->render('view', array('model' => $model));
    }

    public function actionCreateBKOrder($bid) {
        //  $booking = Booking::model()->getById($bid);
        $booking = $this->booking;
        $order = new SalesOrder();
        $order->bk_id = $booking->getId();
        $order->bk_type = StatCode::TRANS_TYPE_BK;
        $order->bk_ref_no = $booking->getRefNo();
        $order->user_id = $booking->getUserId();
        //$this->performAjaxValidation($order);

        if (isset($_POST['order'])) {
            $values = $_POST['order'];

            $order->setAmount($values['final_amount']);
            $order->setSubject($values['subject']);
            $order->setDescription($values['description']);
            $order->setIsPaid(0);
            $order->setDateOpen(new CDbExpression('NOW()'));
            $order->createRefNo($booking->ref_no, $booking->id, StatCode::TRANS_TYPE_BK);
            //$order->validate();
            if ($order->save()) {
                $this->redirect(array('view', 'id' => $order->id));
            }
        }

        $this->render('createBKOrder', array(
            'model' => $order
        ));
    }

    public function actionCreatePBOrder($bid) {
        //  $booking = Booking::model()->getById($bid);
        $booking = $this->patientBooking;
        $order = new SalesOrder();
        $order->bk_id = $booking->getId();
        $order->bk_type = StatCode::TRANS_TYPE_PB;
        $order->bk_ref_no = $booking->getRefNo();
        $order->user_id = $booking->getPatientId();
        if ($booking->getTravelType(false) == StatCode::BK_TRAVELTYPE_PATIENT_GO) {
            $order->order_type = SalesOrder::ORDER_TYPE_SERVICE;
            $order->setAmount(1000.00);
        } else if ($booking->getTravelType(false) == StatCode::BK_TRAVELTYPE_DOCTOR_COME) {
            $order->order_type = SalesOrder::ORDER_TYPE_DEPOSIT;
            $order->setAmount(500.00);
        }
        //$this->performAjaxValidation($order);

        if (isset($_POST['order'])) {
            $values = $_POST['order'];
            $order->setAmount($values['final_amount']);
            $order->setSubject($values['subject']);
            $order->setDescription($values['description']);
            $order->setIsPaid(0);
            $order->setDateOpen(new CDbExpression('NOW()'));
            $order->createRefNo($booking->ref_no, $booking->id, StatCode::TRANS_TYPE_PB);
            if ($order->save()) {
                $this->redirect(array('view', 'id' => $order->id));
            }
        }

        $this->render('createPBOrder', array(
            'model' => $order
        ));
    }

    public function loadModelById($id, $with = null) {
        if (is_null($this->model)) {
            $this->model = SalesOrder::model()->getById($id, $with);
            if (is_null($this->model)) {
                throw new CHttpException(404, 'The requested page does not exists.');
            }
        }
    }

    public function loadBookingById($id, $with = null) {
        if (is_null($this->booking)) {
            $this->booking = Booking::model()->getById($id, $with);
            if (is_null($this->booking)) {
                throw new CHttpException(404, 'The requested page does not exists.');
            }
        }
    }

    public function loadPatientBookingById($id, $with = null) {
        if (is_null($this->patientBooking)) {
            $this->patientBooking = PatientBooking::model()->getById($id, $with);
            if (is_null($this->patientBooking)) {
                throw new CHttpException(404, 'The requested page does not exists.');
            }
        }
    }

    public function actionCreate() {
        $model = new SalesOrder;

        if (isset($_POST['SalesOrder'])) {
            $model->attributes = $_POST['SalesOrder'];
            $model->setAmount($model->final_amount);
            $model->setIsPaid(0);
            $model->setDateOpen(new CDbExpression('NOW()'));
//            var_dump($model);exit;
            $model->ref_no = '1'; //pass验证
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

        if (isset($_POST['SalesOrder'])) {
            $model->attributes = $_POST['SalesOrder'];
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
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.date_deleted is NULL");
        $criteria->order = "t.id DESC";
        $dataProvider = new CActiveDataProvider('SalesOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            //  'pageVar' => 'page'
            ),
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
//    public function actionAdmin() {
//        $model = new SalesOrder('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['SalesOrder']))
//            $model->attributes = $_GET['SalesOrder'];
//
//        $this->render('admin', array(
//            'model' => $model,
//        ));
//    }

    public function actionAdmin() {
        $this->render('search');
    }

    public function actionSearchResult() {
        $pbSeach = new SalesOrderSearch($_GET);
        $criteria = $pbSeach->criteria;
        $dataProvider = new CActiveDataProvider('SalesOrder', array(
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
