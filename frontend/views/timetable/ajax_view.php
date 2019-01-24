<?php 

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div id="custom-content" class="white-popup-block panel panel-primary">
	<?php if($group) { ?>
    <div class="panel-heading">
	    <h1><?= Yii::t('frontend', 'Group Schedule') ?> <?= $group->name ?> <button title="<?= Yii::t('frontend', 'Close (Esc)') ?>" type="button" class="mfp-close pull-right"><i class="fa fa-close"></i></button></h1>
	</div>
	<div class="panel-body timetable">
		<?php if($timetables) { ?>
        <?php $tt = 0; ?>
	    <?php foreach($timetables as $timetable) { ?>
	    <?php $tt++; ?>
	    <?php $date = explode("-", $timetable['date']); ?>
	    <table class="table <?php echo ($timetable['date'] != $today) ? 'table-bordered' : 'active' ?>">
            <tbody>
                <tr>
                    <td rowspan="6" style="width: 30%;">
                        <div class="tt-date">
                            <h3><?= Yii::t('frontend', 'Day_' . ((int)date("w", mktime(0, 0, 0, $date[1], $date[2], $date[0])))); ?></h3>
                            <p><?= $date[2] . ' ' . Yii::t('frontend', 'Month_' . ((int)$date[1] - 1)) ?></p>
                        </div>
                    </td>
                <?php

                $one = 0;

            	foreach($timetable->timetableLessons as $lesson) {
                    if(!$one) {
                    	?>

                    <td width="25px" class="text-center"><?= $lesson->sort_order ?></td>
                    <td width="260px"><?= $lesson->lessonName ?></td>
                    <td width="100px"><?= $lesson->roomName ?></td>
                </tr>
                        <?php

                        $one = 1;
                    } else {
                        ?>

                <tr>
                    <td class="text-center"><?= $lesson->sort_order ?></td>
                    <td><?= $lesson->lessonName ?></td>
                    <td><?= $lesson->roomName ?></td>
                </tr>

                        <?php
                    }
                }

                ?>
                </tr>
            </tbody>
        </table>
        <?php } ?>
        <?php if($tt < 3) { ?>
        <?php while($tt != 3) { ?>
            <?php $tt++; ?>
            <table class="table table-bordered">
                <tbody>
                    <tr height="250">
                        <td rowspan="6" colspan="4" width="700px"><h3 class="tt-error"><i class="fa fa-ban"></i></br><?= Yii::t('frontend', 'Not filled out') ?></h3></td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>
        <?php } ?>
	    <?php } else { ?>
	    <table class="table table-bordered">
            <tbody>
                <tr height="250">
                    <td rowspan="6" colspan="4" width="700px"><h3 class="tt-error"><i class="fa fa-ban"></i></br><?= Yii::t('frontend', 'Not filled out') ?></h3></td>
                </tr>
            </tbody>
        </table>
	    <table class="table table-bordered">
            <tbody>
                <tr height="250">
                    <td rowspan="6" colspan="4" width="700px"><h3 class="tt-error"><i class="fa fa-ban"></i></br><?= Yii::t('frontend', 'Not filled out') ?></h3></td>
                </tr>
            </tbody>
        </table>
	    <table class="table table-bordered">
            <tbody>
                <tr height="250">
                    <td rowspan="6" colspan="4" width="700px"><h3 class="tt-error"><i class="fa fa-ban"></i></br><?= Yii::t('frontend', 'Not filled out') ?></h3></td>
                </tr>
            </tbody>
        </table>
        <?php } ?>
	</div>
	<?php } else { ?>
	<div class="panel-heading">
	    <h1><?= Yii::t('frontend', 'Error') ?> <button title="<?= Yii::t('frontend', 'Close (Esc)') ?>" type="button" class="mfp-close pull-right"><i class="fa fa-close"></i></button></h1>
	</div>
	<div class="panel-body">
	    <div class="alert alert-danger"><?= Yii::t('frontend', 'Unhandled error') ?></div>
	</div>
	<?php } ?>
</div>
