<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->translate(Yii::$app->language)->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статические страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view box box-primary">
    <div class="box-header">
        <?= Html::a(Yii::t('app', 'Обновить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить эту страницу?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => static function ($model) {
                        /** @var \common\models\Page $model */
                        $model->status === 1 ? $iconClass = 'glyphicon glyphicon-ok'
                            : $iconClass = 'glyphicon glyphicon-minus';

                        return Html::tag('i', '', ['class' => $iconClass]);
                    },
                ],
                'slug',
                [
                    'attribute' => 'is_main',
                    'format' => 'raw',
                    'value' => static function ($model) {
                        /** @var \common\models\Page $model */
                        $model->is_main === 1 ? $iconClass = 'glyphicon glyphicon-ok'
                            : $iconClass = 'glyphicon glyphicon-minus';

                        return Html::tag('i', '', ['class' => $iconClass]);
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
