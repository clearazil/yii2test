<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $users = User::find()->all();



        return $this->render('index', [
            'users' => $users,
        ]);
    }

    public function actionEdit($id)
    {
        if(Yii::$app->session->hasFlash('user')) {
            $user = Yii::$app->session->getFlash('user');
        } else {
            $user = User::find()
                ->where(['id' => $id])
                ->one();    
        }
        
        return $this->render('edit', [
            'user' => $user,
        ]);
    }

    public function actionUpdate($id)
    {
        $user = User::find()
            ->where(['id' => $id])
            ->one();

        $request = Yii::$app->request;


        $user->attributes = $request->post();

        if ($request->isPost && $user->validate()) {
            $user->save();

            return $this->redirect('/users/index');
        } else {
            Yii::$app->session->setFlash('user', $user);

            return $this->redirect(['users/edit', 'id' => $id]);
        }
    }

    public function actionCreate()
    {
        if(Yii::$app->session->hasFlash('user')) {
            $user = Yii::$app->session->getFlash('user');
        } else {
            $user = new User;
        }

        return $this->render('create', [
            'user' => $user,
        ]);

    }

    public function actionStore()
    {
        $request = Yii::$app->request;

        $user = new User;

        $user->attributes = $request->post();

        if ($request->isPost && $user->validate()) {
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($request->post('password'));
            $user->auth_key = Yii::$app->getSecurity()->generateRandomString();
            $user->access_token = Yii::$app->getSecurity()->generateRandomString();
            $user->save();

            return $this->redirect('/users/index');
        } else {
            Yii::$app->session->setFlash('user', $user);

            return $this->redirect(['users/create']);
        }
    }
}