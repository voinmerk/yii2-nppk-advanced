<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use frontend\models\Blog;
use frontend\models\BlogMenu;

class BlogController extends Controller
{
	public function actionIndex()
	{
		$request = new Yii::$app->request();

		$id = $request->get('id');
		$page = $request->get('page');

		$blogs = new Blog();

		$model = $blogs->getBlog($id, $page);

		$blog_menu = BlogMenu::getMenu();

		$blog_title = BlogMenu::getMenuById($id);

		if(!count($blog_title)) $blog_title['name'] = Yii::t('frontend', '404: Page not found!');

		//die(var_dump(Blog::find()->with('name')->where(['published' => 1])->all()));

		return $this->render('index', [
			'model' => $model,
			'blog_menu' => $blog_menu,
			'active' => $id,
			'blog_title' => $blog_title,
		]);
	}
}
