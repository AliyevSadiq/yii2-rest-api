<?php


namespace app\controllers;



use app\models\LoginForm;
use app\models\User;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionSign(){
    $model=new User();
    if($model->load(\Yii::$app->request->post()) && $model->validate()){
        $user_params=\Yii::$app->request->post('User');
        $model->password=\Yii::$app->getSecurity()->generatePasswordHash($user_params['password']);
        if($model->save()){
            $model->password='';
            return $this->redirect('login');
        }else{
            echo '<pre>';
            print_r($model->getErrors());
            echo '</pre>';
        }
    }
    return $this->render('sign',compact('model'));
   }



    public function actionLogin(){

        $model=new LoginForm();
        if($model->load(\Yii::$app->request->post()) && $model->login()){
            \Yii::$app->session->setFlash('success','SUCCESS');
            return  $this->refresh();
        }



        return $this->render('login',compact('model'));
    }




}