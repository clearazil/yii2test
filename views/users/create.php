<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="col-md-6">
    <?php $form = ActiveForm::begin(['action' => Url::to(['users/store'])]); ?>

        <label>Username</label>
        <input class="form-control" type="text" name="username" value="<?= $user->username ?>">
        <p class="text-danger"><?= $user->getFirstError('username') ?></p>

        <label>Password</label>
        <input class="form-control" type="password" name="password" value="">
        <p class="text-danger"><?= $user->getFirstError('password') ?></p>

        <label>Email</label>
        <input class="form-control" type="text" name="email" value="<?= $user->email ?>">
        <p class="text-danger"><?= $user->getFirstError('email') ?></p>

        <input class="btn btn-primary" type="submit" value="Create">

    <?php ActiveForm::end(); ?>

</div>