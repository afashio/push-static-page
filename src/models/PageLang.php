<?php

namespace afashio\pages\models;

use \Yii;

/**
 * This is the model class for table "page_lang".
 *
 * @property int $id
 * @property int $page_id
 * @property string $language
 * @property string $title
 * @property string $text
 *
 * @property Page $page
 */
class PageLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'page_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['page_id'], 'integer'],
            [['text'], 'string'],
            [['language'], 'string', 'max' => 6],
            [['title'], 'string', 'max' => 250],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::class, 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'page_id' => Yii::t('app', 'Page ID'),
            'language' => Yii::t('app', 'Language'),
            'title' => Yii::t('app', 'Название'),
            'text' => Yii::t('app', 'Текст'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }
}
