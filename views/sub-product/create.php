<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubProduct */

$this->title = 'Добавить компонент';
$this->params['breadcrumbs'][] = ['label' => 'Компоненты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
