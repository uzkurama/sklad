<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-5">
        <?= $form->field($model, 'client_id', ['template' => '{label}{input}{hint}{error}<div class="client_name"></div>'])->widget(\kartik\select2\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\Client::find()->select(['id', 'phone'])->all(), 'id', 'phone'),
            'options' => [
                'placeholder' => 'Выбрать'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
    <div class="col-md-7">
        <?= $form->field($model, 'product_id')->widget(\kartik\select2\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\Product::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>
<div class="row">

</div>

<?= $form->field($model, 'price')->textInput() ?>

<?= $form->field($model, 'count')->textInput() ?>

<?= $form->field($model, 'payment')->textInput() ?>

<?= $form->field($model, 'user_id')->textInput() ?>

<?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>



<?= $form->field($model, 'expiry_date')->textInput() ?>

<?= $form->field($model, 'delivery_price')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php

$client_action = \yii\helpers\Url::to(['client/validate-client']);
$product_action = \yii\helpers\Url::to(['product-ratio/add-components']);
$js = <<< JS
$('#rent-client_id').on('change', function() {
    request = $.ajax({
      type: 'POST',
      url: '$client_action',
      data: {
        id: $(this).val(),
      },
    });
    
    request.done(function (response, textStatus, jqXHR){
        obj = JSON.parse(response);
        text = obj.message;
        status = obj.status;
        name = '';
        if (typeof obj.name !== 'undefined') {
            name = obj.name;
        }
        $('.client_name').text(name+' '+text);
    });
});

$('#rent-product_id').on('change', function() {
    request = $.ajax({
      type: 'POST',
      url: '$product_action',
      data: {
        id: $(this).val(),
      },
    });
    
    request.done(function (response, textStatus, jqXHR){
        obj = JSON.parse(response);
        count = obj.count;
        ratio = obj.ratio;
        console.log(ratio);
        console.log(count);
    });
});
JS;

$this->registerJs($js, \yii\web\View::POS_END);

?>
