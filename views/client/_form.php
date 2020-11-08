<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$js = <<< JS
$('#client-type').on('change', function() {
  if($(this).val() == 'yuridik'){
      $('#yuridik').show();
  }
  else{
      $('#yuridik').hide();
  }
});
$('#yuridik').hide();
JS;

$this->registerJs($js, yii\web\View::POS_END);

?>
<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-3">
         <?= $form->field($model, 'type')->dropDownList([ 'jismoniy' => 'Jismoniy', 'yuridik' => 'Yuridik', ], ['prompt' => '']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'phone')->widget(yii\widgets\MaskedInput::className(), [
            'mask' => '(99) 999 99 99',
            'type' => 'phone',
            'id' => 'phone-mask',
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'passport_serial')->widget(yii\widgets\MaskedInput::className(), [
            'mask' => 'AA',
            'id' => 'passport_serial-mask',
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'passport_number')->widget(yii\widgets\MaskedInput::className(), [
            'mask' => '9999999',
            'id' => 'passport_number-mask',
        ]) ?>
    </div>
</div>
<div class="row" id="yuridik">
    <div class="col-md-4">
        <?= $form->field($model, 'org_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'tin')->widget(yii\widgets\MaskedInput::className(), [
            'mask' => '999999999',
            'id' => 'tin-mask',
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'checking_acc')->widget(yii\widgets\MaskedInput::className(), [
            'mask' => '99999999999999999999',
            'id' => 'rs-mask',
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'mfo')->widget(yii\widgets\MaskedInput::className(), [
            'mask' => '99999',
            'id' => 'mfo-mask',
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'comments')->textarea(['rows' => 4]) ?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>

