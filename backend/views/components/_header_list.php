<?php
use yii\helpers\Html;

$fa = new \rmrevin\yii\fontawesome\FontAwesome();

$js = "
$(document).ready(function (){
    var selectedItems = [];

    // copy_selected_items_btn

    $('#copy_selected_items_btn').click(function (){
        selectedItems = selectedItems.concat($('.grid-view').yiiGridView('getSelectedRows'));

        $.ajax({
            url: '" . $action_copy . "',
            type: 'POST',
            data: { selected:selectedItems },
            success: function(res) {
                console.log(res);
            },
            error: function() {
                alert('Error!');
            }
        });

        // console.log(selectedItems); 
    })

    $('#delete_selected_items_btn').click(function (){
        selectedItems = selectedItems.concat($('.grid-view').yiiGridView('getSelectedRows'));

        $.ajax({
            url: '" . $action_delete . "',
            type: 'POST',
            data: { 'selected':selectedItems },
            success: function(res) {
                console.log(res);
            },
            error: function() {
                alert('Error!');
            }
        });

        // console.log(selectedItems); 
    })
})
";

$this->registerJs($js);
?>
<h3 class="box-title"><?= $title ?>
    <?php if(isset($smallTitle)) { ?>
    <small><?= $smallTitle ?></small>
    <?php } ?>
</h3>
<!-- tools box -->
<div class="pull-right box-tools">
    <?= Html::a($fa->icon('plus'), $action_create, ['class' => 'btn btn-success btn-flat', 'data-toogle' => 'tooltip', 'title' => Yii::t('backend', 'Added')]) ?>
    <?= Html::button($fa->icon('files-o'), ['id' => 'copy_selected_items_btn', 'class' => 'btn btn-default btn-flat', 'data-toogle' => 'tooltip', 'title' => Yii::t('yii', 'Copy'), 'data-confirm' => 'Вы уверены, что хотите копировать выбранный(е) элемент(ы)?']) ?>
    <?= Html::button($fa->icon('trash-o'), ['id' => 'delete_selected_items_btn', 'class' => 'btn btn-danger btn-flat', 'data-toogle' => 'tooltip', 'title' => Yii::t('yii', 'Delete'), 'data-confirm' => 'Вы уверены, что хотите удалить выбранный(е) элемент(ы)?']) ?>
</div>
<!-- /. tools -->