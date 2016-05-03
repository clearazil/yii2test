<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update a user';
        $auth->add($updateUser);

        $viewUsers = $auth->createPermission('viewUsers');
        $viewUsers->description = 'View users';
        $auth->add($viewUsers);

        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update a post';
        $auth->add($updatePost);

        $viewPost = $auth->createPermission('viewPost');
        $viewPost->description = 'View posts';
        $auth->add($viewPost);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createPost);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $viewUsers);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $viewPost);
        $auth->addChild($admin, $user);

        $auth->assign($admin, 1);

        $authorRule = new \app\rbac\AuthorRule;
        $auth->add($authorRule);

        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $authorRule->name;
        $auth->add($updateOwnPost);

        $viewOwnPost = $auth->createPermission('viewOwnPost');
        $viewOwnPost->description = 'View own posts';
        $viewOwnPost->ruleName = $authorRule->name;
        $auth->add($viewOwnPost);

        $auth->addChild($updateOwnPost, $updatePost);
        $auth->addChild($user, $updateOwnPost);
        $auth->addChild($viewOwnPost, $viewPost);
        $auth->addChild($user, $viewOwnPost);
    }
}