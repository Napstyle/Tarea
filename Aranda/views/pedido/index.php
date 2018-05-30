<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Crear Producto', ['value'=>Url::to(['/pedido/create'])
            ,'class' => 'btn btn-success','id'=>'modalButtonCliente']) ?>
    </p>

    <?php
    Modal::begin([
        'header' => '<h4>Crear Pedido</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);
    echo "<div id='modalContentCliente'></div>";
    Modal::end();

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha',
            'cliente.rfc',



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
