<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')-> widget(
      DatePicker::className(),[
        'inline'=> false,
        'clientOptions'=>[
          'autoclose'=>true,
          'format'=>'dd-mm-yyyy'
        ]
      ]); ?>

    <?= $form->field($model, 'clienteid')->dropDownList($clients) ?>

    <?= $form->field($model2, 'cantidad')-> widget (
      TouchSpin::className(),[
    'name' => 'volume',
    'options' => ['placeholder' => 'Cantidad'],
    'pluginOptions' => ['step' => 1]
]); ?>

    <?= $form->field($model2, 'precio')->textInput() ?>

    <?= $form->field($model2, 'productoid')->dropDownList($productos) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
