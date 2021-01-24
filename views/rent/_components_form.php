<?php

use yii\bootstrap4\Html;

$i = 0;

?>

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