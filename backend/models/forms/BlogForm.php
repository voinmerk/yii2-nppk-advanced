<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;

/**
 * BlogForm class
 */
class BlogForm extends Model
{
	public $fixed = false;		// dropbox (true, false)
	public $slug;				// textbox
	public $template;			// dropbox (temp list)
	public $published = true; 	// dropbox (true, false)
	public $cut = true;			// dropbox (true, false)
	//public $items;

	public function rules()
	{
		return [];
	}

	public function blog()
	{

	}
}