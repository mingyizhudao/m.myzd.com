<?php

class QuestionnaireManager {

    public function apiCreateQuestionnaire($values){
        $output = array('status' => 'no', 'errorCode' => '0','errorMsg' =>'0');
        $values['userHostIp'] = Yii::app()->request->userHostAddress;
        if(isset($values['questionnaireNumber']) == false || isset($values['userHostIp']) == false){
            $output = array('status' => 'no', 'errorCode' => '400','errorMsg' =>'Wrong parameters');
            return $output;
        }else{
           $values['questionnaireNumber'] = trim($values['questionnaireNumber']);
           $values['answer'] = trim($values['answer']);
        }
        $key = session_id();
        $alive = '3600';
        $anwerList=Yii::app()->cache->get($key);
        $num= count($anwerList);
        if($values['questionnaireNumber'] == 1 ){
           $num = 1;
        }
        $qustNum = $values['questionnaireNumber'] -1;
        $value = isset($anwerList) ? $anwerList : '';
        if($num >= $qustNum){
// array例：    $values['answer']=array('1'=>array('file_name'=>'aaaaa','file_url'=>'bbbbbbb','file_size' =>'111','mime_type' => '1','file_ext'=>'jia','remote_domain'=>'2334565','remote_file_key'=>null),'2'=>array('file_name'=>'cccc','file_url'=>'ddd','file_size' =>'111','mime_type' => '1','file_ext'=>'jia','remote_domain'=>'2334565','remote_file_key'=>null));
            if(is_array($values['answer'])){
                unset($value[$values['questionnaireNumber']]);
                foreach ($values['answer'] as $k=>$v){
                    $value[$values['questionnaireNumber']][$k]['file_name'] = $v['file_name'];
                    $value[$values['questionnaireNumber']][$k]['file_url'] = $v['file_url'];
                    $value[$values['questionnaireNumber']][$k]['file_size'] =$v['file_size'];
                    $value[$values['questionnaireNumber']][$k]['mime_type'] =$v['mime_type'];
                    $value[$values['questionnaireNumber']][$k]['file_ext'] =$v['file_ext'];
                    $value[$values['questionnaireNumber']][$k]['remote_domain'] =$v['remote_domain'];
                    $value[$values['questionnaireNumber']][$k]['remote_file_key'] =$v['remote_file_key'];
                }
                 yii::app()->cache->set($key, $value ,$alive);
            }else{
                $value[$values['questionnaireNumber']] = $values['answer'];
                yii::app()->cache->set($key, $value ,$alive);
            }   
      
        }else{
//             Yii::app()->cache->delete($key);
            return $output = array('status' => 'no','errorMsg' =>'faile answer');
        }
        return $output = array('status' => 'ok', 'errorCode' => '200','errorMsg' =>'200');
    }
    
    public function apiUploadQuestionnaireFile($values){
         $output = array('status' => 'no', 'errorCode' => '0','errorMsg' =>'0');
         $values['userHostIp'] = Yii::app()->request->userHostAddress;
//   array例：       $values = array('file_name'=>'aaaaa','file_url'=>'bbbbbbb','file_size' =>'111','mime_type' => '1','file_ext'=>'jia','remote_domain'=>'2334565','remote_file_key'=>'1245555','questionnaireNumber'=>'4','file_num'=>'1','userHostIp'=>'127.0.0.1');
         if(isset($values['questionnaireNumber']) == false || isset($values['file_num']) == false || isset($values['userHostIp']) == false){
             $output = array('status' => 'no', 'errorCode' => '400','errorMsg' =>'Wrong parameters');
             return $output;
         }
         $key = session_id();
         $alive = '3600';
         $anwerList=Yii::app()->cache->get($key);
         $num= count($anwerList);
         if($values['questionnaireNumber'] == 1 ){
            $num = 1;
         }
         $qustNum = $values['questionnaireNumber'] -1;
         $value = isset($anwerList) ? $anwerList : '';
         if($num >= $qustNum){
             $value[$values['questionnaireNumber']][$values['file_num']]['file_name'] = $values['file_name'];
             $value[$values['questionnaireNumber']][$values['file_num']]['file_url'] = $values['file_url'];
             $value[$values['questionnaireNumber']][$values['file_num']]['file_size'] = $values['file_size'];
             $value[$values['questionnaireNumber']][$values['file_num']]['mime_type'] = $values['mime_type'];
             $value[$values['questionnaireNumber']][$values['file_num']]['file_ext'] = $values['file_ext'];
             $value[$values['questionnaireNumber']][$values['file_num']]['remote_domain'] = $values['remote_domain'];
             $value[$values['questionnaireNumber']][$values['file_num']]['remote_file_key'] = $values['remote_file_key'];
             yii::app()->cache->set($key, $value ,$alive);
                 
         }else{
//              Yii::app()->cache->delete($key);
             return $output = array('status' => 'no','errorMsg' =>'faile answer');
         }
         
         return $output = array('status' => 'ok');
    }

}
