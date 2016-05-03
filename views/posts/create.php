<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="col-md-6">
    <?php $form = ActiveForm::begin(['action' => Url::to(['posts/store'])]); ?>

        <label>Title</label>
        <input class="form-control" type="text" name="title" value="<?= $post->title ?>">
        <p class="text-danger"><?= $post->getFirstError('title') ?></p>

        <label>Message</label>
        <textarea name="message" class="form-control"><?= $post->message ?></textarea>
        <p class="text-danger"><?= $post->getFirstError('message') ?></p>

        <input class="btn btn-primary" type="submit" value="Create">

    <?php ActiveForm::end(); ?>

</div>