<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('backend', 'Profile');
?>
<div class="profile-index">
	<div class="row">
		<div class="col-lg-6">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= Yii::t('backend', 'Change Name') ?></h3>
				</div>

				<?php $form = ActiveForm::begin() ?>
				<div class="box-body table-responsive">

					<?= $form->field($changeName, 'first_name')->textInput() ?>

					<?= $form->field($changeName, 'last_name')->textInput() ?>

				</div>

				<div class="box-footer">
					<?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success btn-flat']); ?>
				</div>
				<?php ActiveForm::end() ?>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= Yii::t('backend', 'Change Password') ?></h3>
				</div>

				<?php $form = ActiveForm::begin() ?>
				<div class="box-body">

					<?= $form->field($changePassword, 'current_password')->passwordInput() ?>

					<?= $form->field($changePassword, 'password')->passwordInput() ?>

					<?= $form->field($changePassword, 'repeat_password')->passwordInput() ?>

				</div>

				<div class="box-footer">
					<?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success btn-flat']); ?>
				</div>
				<?php ActiveForm::end() ?>
			</div>
		</div>
	</div>
</div>
