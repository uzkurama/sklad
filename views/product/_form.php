<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'type_id')->widget(\kartik\select2\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\Type::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'unit_id')->widget(\kartik\select2\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\Unit::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'count')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'ratio')->widget(unclead\multipleinput\MultipleInput::className(), [
            'max' => 99,
            'columns' => [
                [
                    'name'  => 'component_id',
                    'title' => 'Компонент',
                    'type'  => \kartik\select2\Select2::className(),
                    'options' => [
                        'data' => \yii\helpers\Arrayhelper::map(app\models\SubProduct::find()->all(), 'id', 'name'),
                        'options' => [
                            'prompt' => '',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ],
                ],
                [
                    'name' => 'count',
                    'title' => 'Кол-во',
                    'type' => 'textInput',
                    'options' => ['type' => 'number'],
                ],
            ]
        ]);?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
