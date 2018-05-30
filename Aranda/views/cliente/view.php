<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

//$this->title = $model->id;
$this->title = 'Detalle del Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    Modal::begin([
        'header' => '<h4>Actualizar Cliente</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);
    echo "<div id='modalContentCliente'></div>";
    Modal::end();

    ?>

    <p>
      <?= Html::button('Update', ['value'=>Url::to(['/cliente/update','id' => $model->id])
          ,'class' => 'btn btn-primary','id'=>'modalButtonCliente']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rfc',
            'razonsocial',
        ],
    ]) ?>

</div>
