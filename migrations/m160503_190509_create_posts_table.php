<?php

use yii\db\Migration;

class m160503_190509_create_posts_table extends Migration
{
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'message' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('user_id', 'posts', 'user_id', 'users', 'id', 'cascade');
    }

    public function down()
    {
        $this->dropTable('posts');
    }
}
