<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \afashio\pages\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Статические страницы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Создать страницу'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{items}\n{summary}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'title',
                        'value' => static function ($model) {
                            /** @var \afashio\pages\models\Page $model */

                            return $model->getTitle();
                        },
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'filter' => \afashio\pages\models\Page::status_list(),
                        'value' => static function ($model) {
                            /** @var \afashio\pages\models\Page $model */
                            $model->status === 1 ? $iconClass = 'glyphicon glyphicon-ok'
                                : $iconClass = 'glyphicon glyphicon-minus';

                            return Html::tag('i', '', ['class' => $iconClass]);
                        },
                    ],
                    [
                        'attribute' => 'slug',
                        'format' => 'url',
                        'value' => static function ($model) {
                            /** @var \afashio\pages\models\Page $model */
                            return $model->slug === 'index'
                                ?
                                Yii::$app->params['domainName']
                                :
                                Yii::$app->params['domainName'] . '/' . $model->slug;
                        },
                    ],
                    [
                        'attribute' => 'is_main',
                        'format' => 'raw',
                        'filter' => [
                            'Нет',
                            'Да',
                        ],
                        'value' => static function ($model) {
                            /** @var \afashio\pages\models\Page $model */
                            return $model->is_main === 1 ?
                                Html::tag('i', '', ['class' => 'glyphicon glyphicon-ok'])
                                : '';
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]
        ); ?>
    </div>
</div>
