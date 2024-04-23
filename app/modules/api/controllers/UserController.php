<?php

use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;

class UserController extends \yii\rest\Controller
{

    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
            ],

        ];

        $behaviors['authenticator']['class'] = HttpBearerAuth::className();

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'authorization' => ['POST'],
        ];
    }

    public function actionAuthorization()
    {
        $params = Yii::$app->request->post('user');

        $model = new \app\models\LoginForm();

        if ($model->load($params) && $model->login()) {
            return [
                'success' => true,
                'user' => $model->getUser()
            ];
        }

        return [
            'success' => false
        ];
    }

}