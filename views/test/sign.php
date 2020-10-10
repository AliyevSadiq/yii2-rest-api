<?php


use yii\widgets\ActiveForm;

$form=ActiveForm::begin();
echo $form->field($model,'first_name');
echo $form->field($model,'surname');
echo $form->field($model,'username');
echo $form->field($model,'email');
echo $form->field($model,'password');
echo \yii\helpers\Html::submitButton('SEND',['class'=>'btn btn-primary']);

ActiveForm::end();