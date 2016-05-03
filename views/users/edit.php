<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="col-md-6">
    <?php $form = ActiveForm::begin(['action' => Url::to(['users/update', 'id' => $user->id])]); ?>

        <label>Username</label>
        <input class="form-control" type="text" name="username" value="<?= $user->username ?>">
        <p class="text-danger"><?= $user->getFirstError('username') ?></p>

        <label>Email</label>
        <input class="form-control" type="text" name="email" value="<?= $user->email ?>">
        <p class="text-danger"><?= $user->getFirstError('email') ?></p>

        <input class="btn btn-primary" type="submit" value="Update">

    <?php ActiveForm::end(); ?>

</div>