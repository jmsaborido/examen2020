<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Lectores */
/* @var $form yii\bootstrap4\ActiveForm */

$url = Url::to(['lectores/rellenar']);
$js = <<<EOT
$('#lectores-codpostal_id').on('change', function (ev) {
    var el = $(this);
    var codpostal_id = el.val();
    if (codpostal_id === '') {
        $('#lectores-provincia').empty();
        $('#lectores-poblacion').empty();
        return;
    }
    $.ajax({
        method: 'GET',
        url: '$url',
        data: {
            codpostal_id: codpostal_id
        },
        success: function (data, code, jqXHR) {

            $('#lectores-poblacion').val(data[0]);
            $('#lectores-provincia').val(data[1]);
            $('#lectores-poblacion').trigger('change');
            $('#lectores-provincia').trigger('change');

        }
    });
});
EOT;
$this->registerJs($js);

?>


<div class="create-lectores-form">

    <?php $form = ActiveForm::begin([
        'id' => 'create-lectores-form',
        'enableAjaxValidation' => true,
    ]); ?>
    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poblacion')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'codpostal_id')->textInput() ?>

    <?= $form->field($model, 'fecha_nac')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>