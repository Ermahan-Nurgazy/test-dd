<?php

use yii\db\Migration;

/**
 * Class m250122_162918_seed_posts
 */
class m250122_162918_seed_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%post}}', [
            'user_id' => 1,
            'title' =>  'Post 1',
            'description' =>  'Description 1',
            'audio_file' =>  'default/file.mp3',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->insert('{{%post}}', [
            'user_id' => 1,
            'title' =>  'Post 2',
            'description' =>  'Description 2',
            'audio_file' =>  'default/file.mp3',
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->insert('{{%post}}', [
            'user_id' => 2,
            'title' =>  'Post 3',
            'description' =>  'Description 3',
            'audio_file' =>  'default/file.mp3',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->insert('{{%post}}', [
            'user_id' => 2,
            'title' =>  'Post 4',
            'description' =>  'Description 4',
            'audio_file' =>  'default/file.mp3',
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%post}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250122_162918_seed_posts cannot be reverted.\n";

        return false;
    }
    */
}
