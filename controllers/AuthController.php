<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

class AuthController extends Controller
{

    /**
     * Login action.
     *
     * @return array|string
     */
    public function actionLogin()
    {
        $data = Yii::$app->request->post();

        if (!isset($data['email']) || !isset($data['password'])) {
            return ['success' => false, 'message' => 'Введите логин и пароль!'];
        }

        $model = new LoginForm();
        $model->email = $data['email'];
        $model->password = $data['password'];

        if ($model->login()) {
            $user = Yii::$app->user->identity;
            return [
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'token' => $user->getAccessToken(),
                    'token_expire' => $user->access_token_expire
                ]
            ];
        }

        return ['success' => false, 'message' => $model->getErrors()];
    }
}