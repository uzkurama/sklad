<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$i = 0;

?>
<?php $form = ActiveForm::begin([
    'validateOnChange' => false,
]); ?>
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
        <?= $form->field($model, 'product_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Product::find()->all(), 'id', 'name'), ['prompt' => '']); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'count')->textInput(['type' => 'number']) ?>
    </div>
</div>

<div class="row">
    <?php Pjax::begin(['id' => 'component_row', 'enablePushState' => true])?>
    <?php if((isset($ratio) && !is_null($ratio))):?>
    <?php foreach($ratio as $r):?>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">
                <?= $r->subproduct->name;?>
            </label>
            <input type="number" id="component_<?= $r->id;?>" name="Component[<?= $i;?>][component_value]" value="<?= $r->component_value;?>" class="form-control">
            <input type="hidden" name="Component[<?= $i;?>][component_id]" value="<?= $r->id;?>">
            <input type="hidden" name="Component[<?= $i;?>][component_name]" value="<?= $r->subproduct->name;?>">
            <?php $i++;?>
        </div>
    </div>
    <?php endforeach;?>
    <?php endif;?>
    <?php Pjax::end();?>
</div>


<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'payment')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'expiry_date')->widget(Datepicker::className(), [
            'language' => 'ru',
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'dd-M-yyyy',
            ],
        ]);?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'delivery_price')->textInput(['type' => 'number']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>
    </div>
</div>

<div class="form-group text-right">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php

$client_action = \yii\helpers\Url::to(['client/validate-client']);
$product_action = \yii\helpers\Url::to(['product-ratio/add-components']);
$calculate = \yii\helpers\Url::to(['product-ratio/calculate']);
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
    $.pjax({
        type: 'POST',
        url: '$product_action',
        container: '#component_row',
        data: {
          id: $(this).val(),
        },
        push: false,
        replace: false,
    });
    $(body).resize();
});

$('#rent-count').on('change', function() {
    $.pjax({
        type: 'POST',
        url: '$calculate',
        container: '#component_row',
        data: {
          count: $(this).val(),
          product_id: $('#rent-product_id').val()
        },
        push: false,
        replace: false,
    });
    $(body).resize();
});
JS;

$this->registerJs($js, \yii\web\View::POS_END);

?>
