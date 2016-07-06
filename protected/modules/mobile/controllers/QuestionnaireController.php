<?php

class QuestionnaireController extends MobileController {

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('ajaxFinishQuestionnaire','test'),
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
//             print_r(Yii::app()->cache->get(md5($key)));exit;
            if(is_array($questionnaireList)){
                foreach ($questionnaireList as $k=>$v){
                    if(is_array($v)){
                        $questionnaire = new Questionnaire();
                        $questionnaire->setAttributes(array('question_id'=>$k,'answer'=>null,'user_host_ip' => Yii::app()->request->userHostAddress), true);
                        $questionnaire->save();
                        $questionnaireId[$k] = $questionnaire->getId();
                         foreach ($v as $k1=>$v1){
                             $questionnaireFile = new QuestionnaireFile();
                               $questionnaireFile->setAttributes(array(
                                   'questionnaire_id'=>$questionnaireId[$k],
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
                        $questionnaire->setAttributes(array('question_id'=>$k,'answer'=>$v,'user_host_ip' => Yii::app()->request->userHostAddress), true);
                        $questionnaire->save();
                        $questionnaireId[$k] = $questionnaire->getId();
                    }
                }
                Yii::app()->cache->delete($key);
                yii::app()->cache->set(md5($key), $questionnaireId ,$alive);
                $output = array('status' => 'ok','errorCode' => '200','errorMsg' =>'');
            }
        $this->renderJsonOutput($output);
    }
    
   public function actionView($id = 1){
       $this->render('question_'.$id);
   }
   
   
   
}
?>