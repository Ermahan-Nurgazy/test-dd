<?php

use yii\db\Migration;

/**
 * Class m250122_162849_seed_users
 */
class m250122_162849_seed_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'email' => 'admin@admin.com',
            'password_hash' =>  Yii::$app->security->generatePasswordHash('qwerty'),
            'auth_key' =>  Yii::$app->security->generateRandomString(),
            'access_token' =>  md5(Yii::$app->security->generateRandomString()),
            'access_token_expire' =>  date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 365)
        ]);

        $this->insert('{{%user}}', [
            'email' => 'test@test.com',
            'password_hash' =>  Yii::$app->security->generatePasswordHash('qwerty'),
            'auth_key' =>  Yii::$app->security->generateRandomString(),
            'access_token' =>  md5(Yii::$app->security->generateRandomString()),
            'access_token_expire' =>  date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 365)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250122_162849_seed_users cannot be reverted.\n";

        return false;
    }
    */
}
