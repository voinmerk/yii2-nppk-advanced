<?php
namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\Timetable]].
 *
 * @see \common\models\Timetable
 */
class TimetableQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \common\models\Timetable[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Timetable|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
