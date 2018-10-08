<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="blog-form box box-primary">
    <?php $form = ActiveForm::begin(['options' => ['class' => '']]); ?>
        <div class="box-body table-responsive">
            <pre><?php // var_dump($blog) ?></pre>

            <?php // echo $form->field($blog, 'fixed')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

            <?php // echo $form->field($blog, 'slug')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($blog, 'template')->dropDownList($blog->getTemplateList()) ?>

            <?php echo $form->field($blog, 'published')->dropDownList($blog->getStatusList()) ?>

            <?php // echo $form->field($blog, 'cut')->dropDownList([0 => 'Обрезать для превью', 1 => 'Не обрезать']) ?>

            <?php echo $form->field($blog, 'blog_menu_id')->dropDownList($blogMenuItem, ['prompt' => Yii::t('backend', 'Selected section...'), 'class' => 'form-control required']) ?>

            <ul class="nav nav-tabs" role="tablist">
                <?php $first = 1; ?>
                <?php foreach($languages as $language) { ?>
                <li role="presentation" class="<?= $first ? 'active' : '' ?>">
                    <a href="#language_<?= $language->id ?>" aria-controls="language_<?= $language->id ?>" role="tab" data-toggle="tab">
                        <?= Html::img('@web/img/language/' . $language->locale . '.png', ['title' => $language->name]) ?> <?= $language->name ?>
                    </a>
                </li>
                <?php $first = 0; ?>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <?php $first = 1; ?>
                <?php foreach($languages as $language) { ?>
                <div role="tabpanel" class="tab-pane <?= $first ? 'active' : '' ?>" id="language_<?= $language->id ?>">
                    <?php $first = 0; ?>
                    <?php echo $form->field($blog, 'name_' . $language->id)->textInput(['maxlength' => true, 'class' => 'form-control required'])->label(Yii::t('backend', 'Name')) ?>

                    <?php echo $form->field($blog, 'description_' . $language->id)->widget(CKEditor::className(),[
                        'editorOptions' => [
                            'preset' => 'standard',
                            'inline' => false,
                        ],
                    ])->label(Yii::t('backend', 'Description')); ?>
                </div>
                <?php } ?>
            </div>

        </div>
        <div class="box-footer">
            <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
