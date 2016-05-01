<?php

use yii\db\Migration;

class m160501_201426_alter_users_table extends Migration
{
    public function up()
    {
        $this->addColumn('users', 'created_at', $this->integer()->notNull());
        $this->addColumn('users', 'updated_at', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('users', 'created_at');
        $this->dropColumn('users', 'updated_at');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
