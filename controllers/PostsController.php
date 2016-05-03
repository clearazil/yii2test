<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Post;
use Yii;

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
        
        return $this->render('edit', [
            'post' => $post,
        ]);
    }

    public function actionUpdate($id)
    {
        $post = Post::find()
            ->where(['id' => $id])
            ->one();

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