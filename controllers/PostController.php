<?php

namespace app\controllers;

use app\models\Post;
use app\models\PostSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PostController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $searchModel->load(Yii::$app->request->get(), '');

        if (!$searchModel->validate()) {
            return false;
        }

        return ['success' => true, 'data' => $searchModel->search()];
    }


    public function actionCreate()
    {
        $data = Yii::$app->request->post();
        $model = new Post();
        if (!$model->load($data, ''))
            return ['success' => false];

        $file = UploadedFile::getInstanceByName('audio_file');
        $model->audio_file = $model->uploadAudioFile($file);

        if (!$model->save())
            return ['success' => false, 'errors' => $model->getErrors()];

        if (!empty($data['tags'])) {
            $tags = json_decode($data['tags']);
            $model->addTags($tags);
        }

        return [
            'success' => true,
            'post' => $model->attributes
        ];
    }


    /**
     * @param int $id
     * @return array
     * @throws NotFoundHttpException
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $model = Post::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("Post not found");
        }
        if ($model->user_id !== Yii::$app->user->id) {
            throw new ForbiddenHttpException("You are not allowed to edit this post");
        }

        $data = Yii::$app->request->post();
        if (!$model->load($data, ''))
            return ['success' => false];

        $file = UploadedFile::getInstanceByName('audio_file');
        if ($file) {
            if ($model->audio_file && file_exists($model->audio_file)) {
                unlink($model->audio_file);
            }
            $model->audio_file = $model->uploadAudioFile($file);
        }

        if (!$model->save())
            return ['success' => false, 'errors' => $model->getErrors()];

        if (!empty($data['tags'])) {
            $tags = json_decode($data['tags']);
            $model->addTags($tags);
        }

        return [
            'success' => true,
            'post' => $model->attributes
        ];
    }

    /**
     * @param int $id
     * @return array
     * @throws NotFoundHttpException
     * @throws ForbiddenHttpException
     */
    public function actionDelete($id)
    {
        $model = Post::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("Post not found");
        }
        if ($model->user_id !== Yii::$app->user->id) {
            throw new ForbiddenHttpException("You are not allowed to delete this post");
        }

        if (!$model->delete())
            return ['success' => false];

        return ['success' => true];
    }

}