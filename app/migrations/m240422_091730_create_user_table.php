<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m240422_091730_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(20)->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string(60)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'roles' => $this->string()->notNull()->unique(),
        ]);

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'email' => 'admin@mail.ru',
            'password_hash' => \Yii::$app->security->generatePasswordHash('Qwerty'),
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'roles' => 'admin'
        ]);

        $this->insert('{{%user}}', [
            'username' => 'user',
            'email' => 'user@mail.ru',
            'password_hash' => \Yii::$app->security->generatePasswordHash('Qwerty'),
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'roles' => 'user'
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
