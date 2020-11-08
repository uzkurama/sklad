<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="table-responsive"></div>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'type.name',
                'count',
                'price',
                'unit.name',
                'created_at',
                'updated_at',
            ],
        ]) ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Компонент</th>
                    <th>Кол-во</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratio as $r):?>
                <tr>
                    <td><?= $r->subproduct->name;?></td>
                    <td><?= $r->ratio;?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
