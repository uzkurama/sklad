<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rent */

$this->title = 'Создать аренду';
$this->params['breadcrumbs'][] = ['label' => 'Аренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
