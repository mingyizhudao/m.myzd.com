<?php

class QuestionnaireController extends MobileController {

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('ajaxFinishQuestionnaire', 'questionnaireBookingView', 'questionnaireSearchView', 'questionnaireBookingFinishView', 'beginQuestionnaireView' , 'completeQuestionnaireView','qestionnaireServiceView','view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('view'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAjaxFinishQuestionnaire(){
            $output = array('status' => 'no','errorCode' => '404','errorMsg' =>'MissSession');
            $key = session_id();
            $alive = 86400;
            $questionnaireList = Yii::app()->cache->get($key);
            if(is_array($questionnaireList)){
                foreach ($questionnaireList as $k3=>$v3){
                    if(isset($v3['picture'])){
                            $questionnaire = new Questionnaire();
                            $questionnaire->setAttributes(array('question_id'=>$k3,'answer'=>$v3['answer'],'answer_note'=>$v3['answer_note'] ,'user_host_ip' => Yii::app()->request->userHostAddress), true);
                            $questionnaire->save();
                            $questionnaireId[$k3] = $questionnaire->getId();
                            foreach ($v3['picture'] as $k1=>$v1){
                                $questionnaireFile = new QuestionnaireFile();
                                $questionnaireFile->setAttributes(array(
                                    'questionnaire_id'=>$questionnaireId[$k3],
                                    'file_name'=>$v1['file_name'],
                                    'file_url'=>$v1['file_url'],
                                    'file_size' => $v1['file_size'],
                                    'mime_type' => $v1['mime_type'],
                                    'file_ext'=> $v1['file_ext'],
                                    'remote_domain'=>$v1['remote_domain'],
                                    'remote_file_key'=>$v1['remote_file_key']), true);
                                $questionnaireFile->save();
                                $questionnaireId['picture'][$k1]= $questionnaireFile->getId();
                            }
                    }else{
                             $questionnaire = new Questionnaire();
                             $questionnaire->setAttributes(array('question_id'=>$k3,'answer'=>$v3['answer'],'answer_note'=>$v3['answer_note'] ,'user_host_ip' => Yii::app()->request->userHostAddress), true);
                             $questionnaire->save();
                             $questionnaireId[$k3] = $questionnaire->getId();
                    }
                }
                Yii::app()->cache->delete($key);
                yii::app()->cache->set('res'.$key, $questionnaireId ,$alive);
                $output = array('status' => 'ok','errorCode' => '200','errorMsg' =>'');
            }
        $this->renderJsonOutput($output);
    }
    
   public function actionView($id = 1){
       $key = session_id();
       $unfinished = Yii::app()->cache->get($key);
       $this->render('question_'.$id);
   }
   

   public function actionQuestionnaireBookingView($id = null) {
       $form = new BookQuestionnaireForm();
       if(isset($id)){
           $apiService = new ApiViewDoctorV7($id);
           $output = $apiService->loadApiViewData();
       }else{
           $output = null;
       }
       $this->render('questionnaireBooking',array(
           'data' => $output,
           'model' => $form
       ));
   }
   
   public function actionQuestionnaireSearchView(){
       $this->render("questionnaireSearch");
   }
   
   public function actionQuestionnaireBookingFinishView(){
       $this->render("questionnaireBookingFinish");
   }
   
   public function actionBeginQuestionnaireView(){
       $site = isset($_GET['site']) ? (int) $_GET['site'] : 0;
       $this->recordVendor($site);
       $this->render("beginQuestionnaire");
   }
   
   public function actionCompleteQuestionnaireView(){
       $this->render("completeQuestionnaire");
   }
   
   public function actionQestionnaireServiceView(){
       $this->render("qestionnaireService");
   }
   
}
?>