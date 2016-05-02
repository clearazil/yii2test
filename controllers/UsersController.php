<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\web\NotFoundHttpException;

class UsersController extends Controller
{
    public function actionIndex()
    {
        if(!Yii::$app->user->can('viewUsers')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $users = User::find()->all();

        return $this->render('index', [
            'users' => $users,
        ]);
    }

    public function actionEdit($id)
    {
        if(!Yii::$app->user->can('updateUser')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

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
        if(!Yii::$app->user->can('updateUser')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

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
        if(!Yii::$app->user->can('createUser')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

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
        if(!Yii::$app->user->can('createUser')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $request = Yii::$app->request;

        $user = new User(['scenario' => 'create']);

        $user->attributes = $request->post();

        if ($request->isPost && $user->validate()) {
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($request->post('password'));
            $user->password_repeat = $user->password;
            $user->auth_key = Yii::$app->getSecurity()->generateRandomString();
            $user->access_token = Yii::$app->getSecurity()->generateRandomString();
            $user->save();

            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            $auth->assign($authorRole, $user->getId());

            return $this->redirect('/users/index');
        } else {
            Yii::$app->session->setFlash('user', $user);

            return $this->redirect(['users/create']);
        }
    }
}