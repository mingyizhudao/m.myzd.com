<?php

class CommentController extends MobileController {

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('ajaxAddComment','test'),
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

    public function filterUserContext($filterChain) {
        $user = $this->loadUser();
        if (is_null($user)) {
            $redirectUrl = $this->createUrl('user/login');
            $currentUrl = $this->getCurrentRequestUrl();
            $redirectUrl.='?returnUrl=' . $currentUrl;
            $this->redirect($redirectUrl);
        }
        $filterChain->run();
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'userContext + create',
        );
    }

    public function actionView() {
        $this->render("review");
    }
    
    /**
     * 添加评价
     */
    public function actionAjaxAddComment(){
        $output = array('status' => 'no');
        if (isset($_POST['comment'])) {
            //给form赋值
            $values = $_POST['comment'];
        $user = $this->getCurrentUser();
        $id=154;
        $booking = new Booking();
        $bookingInfo = $booking->getById($id);
        $bookType=$bookingInfo->bk_type;
        $userId=$user->id;
        $userName=$user->username;
        print_r($user);exit;
        }
        /*if (isset($_POST['comment'])) {
            //给form赋值
            $values = $_POST['comment'];
            $form = new CommentForm();
            $form->setAttributes($values, true);
            $form->initModel();
            //数据校验之后再检测验证码
            $form->validate();
            //form数据校验
            if ($form->hasErrors() === false) {
                $comment = new Comment();
                $comment->setAttributes($form->attributes, true);
                $comment->setIsCorporate();
                if ($comment->save()) {
                    $output['status'] = 'ok';
                    $output['comment']['id'] = $comment->getId();
                } else {
                    $output['errors'] = $comment->getErrors();
                }
            } else {
                $output['errors'] = $form->getErrors();
            }
        }
        $this->renderJsonOutput($output);*/
    }
    
    public function actionTest(){
        $this->render("review");
    }
}
?>