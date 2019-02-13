<?php
namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\User]].
 *
 * @see \common\models\User
 */
class UserQuery extends ActiveQuery
{
    /**
     *  Search user where status is active
     */
    public function active()
    {
        return $this->andWhere(['status' => 10]);
    }

    /**
     *  Search user where status is banned
     */
    public function banned()
    {
        return $this->andWhere(['status' => 0]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
