<?php
namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\UserGroup]].
 *
 * @see \common\models\UserGroup
 */
class UserGroupQuery extends ActiveQuery
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
     * @return \common\models\UserGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\UserGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
