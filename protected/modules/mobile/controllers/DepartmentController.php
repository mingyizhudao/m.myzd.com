<?php

class DepartmentController extends MobileController {

    private $model;

    public function actionView($id) {
        $data = HospitalDepartment::model()->getById($id, array('hpDeptHospital'));
        $this->render('view', array(
            'data' => $data
        ));
    }

    public function loadModal($id, $with = null) {
        //if ($this->model === null) {
        $model = HospitalDepartment::model()->getById($id, $with);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        //}
        return $model;
    }

}
