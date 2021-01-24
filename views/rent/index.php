<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Аренда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            'expiry_date:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

</div>
