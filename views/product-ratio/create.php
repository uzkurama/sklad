<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductRatio */

$this->title = 'Create Product Ratio';
$this->params['breadcrumbs'][] = ['label' => 'Product Ratios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-ratio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
