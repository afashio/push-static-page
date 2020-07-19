<?php

namespace afashio\page\models;

use common\traits\BasicStatusTrait;
use common\traits\ModelTranslationTrait;
use creocoder\translateable\TranslateableBehavior;
use notgosu\yii2\modules\metaTag\components\MetaTagBehavior;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "page".
 *
 * @property int        $id
 * @property int        $status
 * @property int        $sort
 * @property int        $is_main
 * @property string     $slug
 * @property string     $title
 * @property string     $text
 * @mixin TranslateableBehavior
 * @mixin MetaTagBehavior
 * @mixin \rico\yii2images\behaviors\ImageBehave
 * @property PageLang[] $translations
 */
class Page extends \yii\db\ActiveRecord
{
    use BasicStatusTrait;
    use ModelTranslationTrait;

    public $imageFiles;
    public $title;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @param $slug
     *
     * @return \common\models\Page|null
     */
    public static function findBySlug($slug)
    {
        return self::findOne(['slug' => $slug, 'is_main' => 0, 'status' => self::getActiveStatus()]);
    }

    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        $behaviors = [

            'translateable' => [
                'class' => TranslateableBehavior::class,
                'translationAttributes' => ['title', 'text'],
                'translationLanguageAttribute' => 'language',
            ],
            'seo' => [
                'class' => MetaTagBehavior::class,
                'languages' => Language::languageNameArray(),
            ],
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],

        ];

        return array_merge(parent::behaviors(), $behaviors);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'is_main'], 'integer'],
            [['slug'], 'string', 'max' => 150],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Статус'),
            'slug' => Yii::t('app', 'Slug'),
            'is_main' => Yii::t('app', 'Это главная страница'),
            'imageFiles' => Yii::t('app', 'Изображения'),
            'title' => Yii::t('app', 'Название'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(PageLang::class, ['page_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return Url::to(['page/view', 'slug' => $this->slug]);
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->translate()->title;
    }
}
