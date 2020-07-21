<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \afashio\pages\models\Page */

$this->title = Yii::t('app', 'Обновить страницу: ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статические страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
