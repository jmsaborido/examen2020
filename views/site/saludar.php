<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($saludarForm, 'nombre') ?>
    <?= $form->field($saludarForm, 'telefono') ?>
    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end() ?>
