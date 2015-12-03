<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_describe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_describe')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_add')->textInput() ?>

    <?= $form->field($model, 'date_edit')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>
    <?php if(isset($model->fileImage)) { ?>
    <img src="<?php echo Url::to('@uploadedfilesdir/'.$model->fileImage->name) ?>" />
     <?php } ?>
     <?= $form->field($model, 'fileImage')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


