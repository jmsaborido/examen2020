<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Prestamos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'libro.titulo',
            'lector.nombre',
            'created_at:datetime',
            'devolucion:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {devolver}',
                'buttons' => [
                    'devolver' => function ($url, $model, $key) {
                        return Html::a('Devolver', $url, [
                            'class' => 'btn btn-sm btn-danger',
                            'data-method' => 'POST',
                            'data-confirm' => '¿Está seguro de devolver este préstamo?',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>


</div>
