<?php
namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\Teacher]].
 *
 * @see \common\models\Teacher
 */
class TeacherQuery extends ActiveQuery
{
    /**
     *  Search data where status is active
     */
    public function active()
    {
        return $this->andWhere(['status' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Teacher[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Teacher|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
