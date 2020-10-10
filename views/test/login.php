<?php


use yii\widgets\ActiveForm;

echo \app\widgets\Alert::widget();

$form=ActiveForm::begin();

echo $form->field($model,'username');
echo $form->field($model,'password');
echo \yii\helpers\Html::submitButton('LOGIN',['class'=>'btn btn-primary']);

ActiveForm::end();