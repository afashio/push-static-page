<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m191120_141420_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'status' => $this->integer(1),
            'is_main' => $this->integer(1)->defaultValue(0),
            'slug' => $this->string(250)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
}
