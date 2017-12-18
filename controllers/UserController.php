<?php
/**
 * Created by PhpStorm.
 * User: Debam
 * Date: 12/18/17
 * Time: 10:57 AM
 */

namespace app\controllers;


use app\models\Users;
use yii\rest\ActiveController;
use yii;

class UserController extends ActiveController
{

    public $modelClass = 'app\models\Users';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        return $actions;
    }

    protected function verbs()
    {
        // localhost/android-backend/web/index.php/user/login/
        return [
            'login' => ['POST'],
        ];
    }

    public static function actionLogin(){
        $req = Yii::$app->request->post();
        $u = $req['username'];
        $p = $req['password'];

        $response = [];
        if(Users::validatePassword($u,$p)){
            $response['status'] = '200';
            $response['fullname'] = Users::getFullName($u);
            $response['message'] = 'OK';
        } else{
            $response['status'] = '500';
            $response['message'] = 'Invalid Username/Password';
        }

        return $response;


    }

}