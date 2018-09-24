<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="blog-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
        <div class="box-body table-responsive">
            <?php echo $form->field($blog, 'fixed')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

            <?php echo $form->field($blog, 'slug')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($blog, 'template')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($blog, 'published')->dropDownList([0 => 'Не опубликовано', 1 => 'Опубликовано']) ?>

            <?php echo $form->field($blog, 'cut')->dropDownList([0 => 'Обрезать для превью', 1 => 'Не обрезать']) ?>

            <?php echo $form->field($blog, 'blog_menu_id')->dropDownList($blogMenuItem, ['prompt' => 'Выберите категорию...']) ?>

            <ul class="nav nav-tabs" role="tablist">
                <?php $first = 1; ?>
                <?php foreach($languages as $language) { ?>
                <li role="presentation" class="<?= $first ? 'active' : '' ?>"><a href="#language_<?= $language['id'] ?>" aria-controls="language_<?= $language['id'] ?>" role="tab" data-toggle="tab"><?= $language['name'] ?></a></li>
                <?php $first = 0; ?>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <?php $first = 1; ?>
                <?php foreach($languages as $language) { ?>
                <div role="tabpanel" class="tab-pane <?= $first ? 'active' : '' ?>" id="language_<?= $language['id'] ?>">
                    <?php $first = 0; ?>
                    <?php echo $form->field($blogDesc[$language['id']], 'name')->textInput(['maxlength' => true]) ?>

                    <?php echo $form->field($blogDesc[$language['id']], 'description')->widget(CKEditor::className(),[
                        'editorOptions' => [
                            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                        ],
                    ]); ?>
                </div>
                <?php } ?>
            </div>

        </div>
        <div class="box-footer">
            <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
