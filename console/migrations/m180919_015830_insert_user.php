<?php

use yii\db\Migration;

/**
 * Class m180919_015830_insert_user
 */
class m180919_015830_insert_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users', [
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123123'),
            'email' => 'admin@localhost',
            'status' => '10',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180919_015830_insert_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180919_015830_insert_user cannot be reverted.\n";

        return false;
    }
    */
}
