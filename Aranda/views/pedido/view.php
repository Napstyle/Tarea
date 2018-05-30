<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    Modal::begin([
        'header' => '<h4>Actualizar Pedido</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);
    echo "<div id='modalContentCliente'></div>";
    Modal::end();

    ?>

    <p>
      <?= Html::button('Update', ['value'=>Url::to(['/pedido/update','id' => $model->id])
          ,'class' => 'btn btn-primary','id'=>'modalButtonCliente']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?=



    DetailView::widget([
        'model' =>$model,
        'attributes' => [
            'id',
            'fecha',
            'cliente.rfc',

        ]



    ]),

    DetailView::widget([
        'model' =>$model2,
        'attributes' => [
            'cantidad',
            'precio',
            'producto.nombrep',

        ]



    ])
    ?>


</div>
