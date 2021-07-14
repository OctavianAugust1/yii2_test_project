<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\models\Post;
use app\models\PostFrontendSearch;
use yii\db\Connection;

class PostController extends Controller
{
	public function actionIndex()
	{
        $searchModel = new PostFrontendSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
			'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
		// $posts = Post::getPosts();
		// return $this->render('index', ['posts' => $posts]);
	}
	public function actionView($id)
	{
		$post = Post::find()->where(['id' => $id])->one();
		if ($post) {
			return $this->render('view', ['model' => $post]);
		}
		throw new \yii\web\NotFoundHttpException('Пост не найден');
	}
}