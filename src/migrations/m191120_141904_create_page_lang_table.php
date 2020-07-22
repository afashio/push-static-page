<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_lang}}`.
 */
class m191120_141904_create_page_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(\afashio\pages\models\PageLang::tableName(), [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(250),
            'text' => $this->text(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(\afashio\pages\models\PageLang::tableName());
    }
}
