<?php


namespace app\controllers;


use app\models\Blog;
use app\models\User;
use yii\db\Exception;

class BlogController extends MainController
{

    public function actionIndex($token){
        if(!empty($token)){
        $user=User::findIdentityByAccessToken($token);
        if(!empty($user)) {
            $blog = Blog::find()->asArray()->all();
            if (!empty($blog)) {
                return $blog;
            } else {
                return 'BLOG NOT FOUND';
            }
        }else{
            return 'You need authorization!!!';
        }
    }else{
            return 'You need authorization!!!';
        }
    }



    public function actionCreate($token){
        if(!empty($token)){
        $user=User::findIdentityByAccessToken($token);
        if(!empty($user)) {
        $model=new Blog();
        if(\Yii::$app->request->isPost){
            $model->title=\Yii::$app->request->post('title');
            $model->content=\Yii::$app->request->post('content');
            if($model->validate()){
                if($model->save()){
                    return 'SUCCESS';
                }
            }else{
                return $model->getErrors();
            }
        }
        }else{
            return 'You need authorization!!!';
        }
        }
        else{
                return 'You need authorization!!!';
            }

    }

    public function actionEdit($id,$token){
        if(!empty($token)){
        $user=User::findIdentityByAccessToken($token);
        if(!empty($user)) {
        $blog=Blog::checkEmpty($id);

        if(!empty($blog)){
         return $blog;
        }
        }else{
            return 'You need authorization!!!';
        }
        }
        else{
            return 'You need authorization!!!';
        }
    }

    public function actionUpdate($id,$token){
        if(!empty($token)){
        $user=User::findIdentityByAccessToken($token);
        if(!empty($user)) {
        $blog=Blog::checkEmpty($id);
        if(!empty($blog)){
            if(\Yii::$app->request->isPost){
                $blog->title=\Yii::$app->request->post('title');
                $blog->content=\Yii::$app->request->post('content');
                if($blog->validate()){
                    if($blog->save()){
                        return 'THIS BLOG WAS UPDATED!!!';
                    }
                }else{
                    return $blog->getErrors();
                }
            }
        }
        }else{
            return 'You need authorization!!!';
        }
        }
        else{
            return 'You need authorization!!!';
        }
    }

    public function actionDelete($id,$token){
        if(!empty($token)){
        $user=User::findIdentityByAccessToken($token);
        if(!empty($user)) {
        $blog=Blog::checkEmpty($id);
        if(!empty($blog)){
            if($blog->delete()){
                return 'THIS BLOG WAS DELETED!!!';
            }
        }
        }else{
            return 'You need authorization!!!';
        }
        }
        else{
                return 'You need authorization!!!';
            }


    }








}