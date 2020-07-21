<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active">
                <a data-toggle="tab" href="#common" href="#">
                    <?= Yii::t('app', 'Общие') ?>
                </a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" href="#image" href="#">
                    <?= Yii::t('app', 'Галерея'); ?>
                </a>
            </li>
            <? foreach (\common\models\Language::languageList() as $language): ?>
                <li role="presentation"><a data-toggle="tab" href="#<?= $language->slug; ?>"><?= $language->name; ?></a>
                </li>
            <? endforeach; ?>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="common">
                <div class="box-body">
                    <?= $form->field($model, 'slug')->textInput(
                        ['maxlength' => true, 'readonly' => isset($model->id)]
                    ) ?>

                    <?= $form->field($model, 'status')->dropDownList(\common\models\Page::status_list()) ?>

                    <?= $form->field($model, 'is_main')->checkbox() ?>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="image">
                <div class="box-body">
                    <?= $form->field($model, 'imageFiles')->widget(
                        \kartik\file\FileInput::class,
                        [
                            'options' => [
                                'accept' => 'image/*',
                                'multiple' => true,
                            ],
                            'pluginOptions' => [
                                'initialPreview' =>
                                    \common\utils\ImageUtil::getImageUrls($model)
                                ,
                                'initialPreviewConfig' =>
                                    \common\utils\PreviewUtil::getPreviewOptions(
                                        \yii\helpers\Url::to(['site/delete-image']),
                                        $model->getImages()
                                    ),
                                'initialPreviewAsData' => true,
                                'overwriteInitial' => false,
                                'showDrag' => false,
                            ],
                            'pluginEvents' => [
                                'filesorted' => 'function(event, params) { 
                                $.ajax({
                                     url: "'.\yii\helpers\Url::to(['page/update-order']).'",
                                     type: "get",
                                     data: { 
                                     previewId:params.stack[params.newIndex].key, 
                                     oldIndex:params.oldIndex, 
                                     newIndex:params.newIndex, 
                                     stack:params.stack
                                     },
                                     success: function(data){
                                        console.log(data);
                                     },
                                    }).done(function( msg ) {
                                                       // alert( "Data Saved: " + msg );
                                                      });
                                                                        ;

                                }',
                            ],
                        ]
                    ); ?>
                </div>
            </div>

            <? foreach (\common\models\Language::languageList() as $language): ?>
                <div role="tabpanel" class="tab-pane" id="<?= $language->slug; ?>">
                    <div class="box-body">
                        <?= $form->field($model->translate($language->slug), "[$language->slug]title")->textInput(); ?>

                        <?= $form->field($model->translate($language->slug), "[$language->slug]text")->widget(
                            \vova07\imperavi\Widget::class,
                            [
                                'settings' => [
                                    'lang' => Yii::$app->language,
                                    'minHeight' => 200,
                                    'imageUpload' => \yii\helpers\Url::to(['content-image-upload']),
                                    'plugins' => [
                                        'fullscreen',
                                        'imagemanager',
                                    ],
                                ],
                            ]
                        );; ?>

                        <?= \notgosu\yii2\modules\metaTag\widgets\metaTagForm\Widget::widget(
                            ['model' => $model, 'language' => $language->slug]
                        ); ?>
                    </div>
                </div>
            <? endforeach; ?>
            <div class="box-footer">
                <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success btn-flat']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
