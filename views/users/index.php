<?php

use yii\helpers\Url;

?>

<table class="table">
    <tbody>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php foreach($users as $user): ?>
            <tr>
                <td><a href="<?= Url::to(['users/edit', 'id' => $user->id]) ?>"><?= $user->id ?></a></td>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php  ?>