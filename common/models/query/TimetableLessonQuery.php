<?php
namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\TimetableLesson]].
 *
 * @see \common\models\TimetableLesson
 */
class TimetableLessonQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \common\models\TimetableLesson[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\TimetableLesson|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
