<?php
namespace backend\models;

use yii\db\ActiveQuery;

/**
 * MultilingualQuery class
 */
class MultilingualQuery extends ActiveQuery
{
	use \omgdef\multilingual\MultilingualTrait;
}