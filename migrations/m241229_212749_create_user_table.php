<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m241229_212749_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'access_token' => $this->string(32)->notNull(),
            'access_token_expire' => $this->timestamp()->notNull(),
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
        $this->dropTable('{{%user}}');
    }
}
