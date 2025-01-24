<?php

use yii\db\Migration;

/**
 * Class m250122_162938_seed_tags
 */
class m250122_162938_seed_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%tag}}', ['name' => 'tag1']);
        $this->insert('{{%tag}}', ['name' => 'tag2']);
        $this->insert('{{%tag}}', ['name' => 'tag3']);
        $this->insert('{{%tag}}', ['name' => 'tag4']);
        $this->insert('{{%tag}}', ['name' => 'tag5']);
        $this->insert('{{%tag}}', ['name' => 'tag6']);
        $this->insert('{{%tag}}', ['name' => 'tag7']);
        $this->insert('{{%tag}}', ['name' => 'tag8']);

        $this->insert('{{%post_tag}}', ['post_id' => 1, 'tag_id' => 1]);
        $this->insert('{{%post_tag}}', ['post_id' => 1, 'tag_id' => 2]);
        $this->insert('{{%post_tag}}', ['post_id' => 2, 'tag_id' => 3]);
        $this->insert('{{%post_tag}}', ['post_id' => 2, 'tag_id' => 4]);
        $this->insert('{{%post_tag}}', ['post_id' => 3, 'tag_id' => 5]);
        $this->insert('{{%post_tag}}', ['post_id' => 3, 'tag_id' => 6]);
        $this->insert('{{%post_tag}}', ['post_id' => 4, 'tag_id' => 7]);
        $this->insert('{{%post_tag}}', ['post_id' => 4, 'tag_id' => 8]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%tag}}');
        $this->delete('{{%post_tag}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250122_162938_seed_tags cannot be reverted.\n";

        return false;
    }
    */
}
