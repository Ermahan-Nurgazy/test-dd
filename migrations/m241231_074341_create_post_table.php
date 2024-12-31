<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m241231_074341_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'audio_file' => $this->string()->notNull(),
            'status' => $this->boolean(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()
        ]);
        $this->addForeignKey('fk_post_user', 'post', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_user', 'post');
        $this->dropTable('{{%post}}');
    }
}
