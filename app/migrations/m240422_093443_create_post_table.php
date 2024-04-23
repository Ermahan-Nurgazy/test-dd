<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m240422_093443_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'genre_id' => $this->integer()->notNull()->unique(),
            'title' => $this->string()->notNull()->unique(),
            'description' => 'TEXT',
            'file' => $this->string()->notNull(),
            'date' => $this->string()->notNull(),
            'status' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
