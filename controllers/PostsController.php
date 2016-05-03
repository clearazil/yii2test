<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Post;
use Yii;
use yii\web\NotFoundHttpException;

class PostsController extends Controller
{
    public function actionIndex()
    {
        $posts = Post::find()->all();

        return $this->render('index', [
            'posts' => $posts,
        ]);
    }

    public function actionEdit($id)
    {
        if(Yii::$app->session->hasFlash('post')) {
            $post = Yii::$app->session->getFlash('post');
        } else {
            $post = Post::find()
                ->where(['id' => $id])
                ->one();    
        }

        if(!Yii::$app->user->can('updatePost', ['post' => $post])) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        return $this->render('edit', [
            'post' => $post,
        ]);
    }

    public function actionUpdate($id)
    {

        $post = Post::find()
            ->where(['id' => $id])
            ->one();

        if(!Yii::$app->user->can('updatePost', ['post' => $post])) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $request = Yii::$app->request;

        $post->attributes = $request->post();

        if ($request->isPost && $post->validate()) {
            $post->save();

            return $this->redirect('/posts/index');
        } else {
            Yii::$app->session->setFlash('post', $post);

            return $this->redirect(['posts/edit', 'id' => $id]);
        }
    }

    public function actionCreate()
    {
        if(!Yii::$app->user->can('createPost')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if(Yii::$app->session->hasFlash('post')) {
            $post = Yii::$app->session->getFlash('post');
        } else {
            $post = new Post;
        }

        return $this->render('create', [
            'post' => $post,
        ]);

    }

    public function actionStore()
    {
        if(!Yii::$app->user->can('createPost')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $request = Yii::$app->request;

        $post = new Post;

        $post->attributes = $request->post();

        if ($request->isPost && $post->validate()) {
            $post->user_id = Yii::$app->user->id;
            $post->save();

            return $this->redirect('/posts/index');
        } else {
            Yii::$app->session->setFlash('post', $post);

            return $this->redirect(['posts/create']);
        }
    }
}