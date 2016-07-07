<?php

class CommentManager {

    public function apiCreateComment(User $user, $values) {
        $output['status'] = 'no';
        $output['errorCode'] = 400;
        $id = $values['id'];

        $model = new Booking();
        $booking = $model->getById($id);
        if($booking && $booking->bk_status == StatCode::BK_STATUS_PATIENT_ACCEPTED){
            $userId = $user['id'];
            $userName = $user['username'];
            $comment = new Comment();
            $comment->setAttributes($values, true);
            $comment->setAttributes(array('bk_type'=>$booking->bk_type,'bk_id'=>$id,'user_id'=>$userId,'user_name'=>$userName,'disease_detail'=>$booking->disease_name), true);
            if ($comment->save()) {
                $booking->bk_status = StatCode::BK_STATUS_DONE;
//                    $updBkStatus=$booking->updateAllByAttributes(array('bk_status'=>'8','date_updated'=>new CDbExpression("NOW()")), array('id'=>$id));
                if($booking->save()){
                    $output['status'] = 'ok';
                    $output['errorCode'] = 200;
                    $output['errorMsg'] = "success";
                    $output['result']['id'] = $comment->getId();
                }else{
                    $output['errorMsg'] = $comment->getFirstErrors();
                }
            } else {
                $output['errorMsg'] = $comment->getFirstErrors();
            }

        }else{
            $output['errorMsg'] = '您没有权限执行此操作';
        }


        return $output;
    }
}
