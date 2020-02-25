<?php
use yii\bootstrap4\Html;
use yii\widgets\DetailView;

?>

<h3>Hola <?= Html::encode($nombre) ?></h3>

<?= DetailView::widget([
    'model' => $fila,
    'attributes' => [
        'isbn',
        'titulo',
        'num_pags',
    ],
]) ?>

<?= Html::a('Acerca de nosotros', ['site/about'], ['class' => 'btn btn-primary']) ?>
