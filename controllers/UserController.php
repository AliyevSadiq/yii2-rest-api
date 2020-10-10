<?php


namespace app\controllers;



use app\models\LoginForm;
use app\models\User;
use yii\web\Controller;
use yii\web\Response;






class UserController extends MainController
{

    public function actionSign(){

        $model=new User();
        if(\Yii::$app->request->isPost ){
            $model->first_name=\Yii::$app->request->post('first_name');
            $model->surname=\Yii::$app->request->post('surname');
            $model->email=\Yii::$app->request->post('email');
            $model->username=\Yii::$app->request->post('username');


            $model->password=\Yii::$app->getSecurity()
                ->generatePasswordHash(\Yii::$app->request->post('password'));

            if($model->validate() && $model->save()){
                return true;
            }else{

                return $model->getErrors();

            }
        }


    }

    public function actionLogin(){

        $model=new LoginForm();
        if(\Yii::$app->request->isPost){
            $model->username=\Yii::$app->request->post('username');
            $model->password=\Yii::$app->request->post('password');
            if($model->login()){
                $user=User::findOne($model->getUser()->id);
                if(empty($user->access_token)) {
                    $token = substr(\Yii::$app->getSecurity()->generateRandomString(), 0, 20);
                    $user->access_token = $token;
                    if ($user->save()) {
                        return $user->access_token;
                    }
                }else{
                    return $user->access_token;
                }
            }
        }
    }


    public function actionLogout($token){

       $user=User::findOne(['access_token'=>$token]);

       $user->access_token='';
      if($user->save(false)) {
          return $user->access_token;
      }else{
          return $user->getErrors();
      }
    }


    public function actionCheckAuth($token){
        $user=User::findIdentityByAccessToken($token);
        if(!empty($user)){
            return true;
        }else{
            return false;

        }
    }






}