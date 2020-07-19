<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('app', 'Добавить страницу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статические страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
