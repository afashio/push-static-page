<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_lang}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%page}}`
 */
class m191120_141904_create_page_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page_lang}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(250),
            'text' => $this->text(),
            'slug' => $this->string(250)->unique(),
        ]);

        // creates index for column `page_id`
        $this->createIndex(
            '{{%idx-page_lang-page_id}}',
            '{{%page_lang}}',
            'page_id'
        );

        // add foreign key for table `{{%page}}`
        $this->addForeignKey(
            '{{%fk-page_lang-page_id}}',
            '{{%page_lang}}',
            'page_id',
            '{{%page}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%page}}`
        $this->dropForeignKey(
            '{{%fk-page_lang-page_id}}',
            '{{%page_lang}}'
        );

        // drops index for column `page_id`
        $this->dropIndex(
            '{{%idx-page_lang-page_id}}',
            '{{%page_lang}}'
        );

        $this->dropTable('{{%page_lang}}');
    }
}
