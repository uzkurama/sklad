<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rent */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Аренда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'client_id',
                'format' => 'raw',
                'value' => function($model){
                    return $model->client->last_name.' '.$model->client->first_name;
                }
            ],
            [
                'attribute' => 'product_id',
                'format' => 'raw',
                'value' => function($model){
                    $b = 'Продукт: '.$model->product->name.'<br>';
                    for($i=0; $i<count($model->product_id['components']); $i++){
                        $b .= $model->product_id['components'][$i]["component_name"].': '.$model->product_id['components'][$i]['component_value'].'<br>';
                    }
                    return $b;
                }
            ],
            'price:currency',
            'count',
            'payment:currency',
            'user_id',
            'comments:ntext',
            'expiry_date:date',
            'delivery_price:currency',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
