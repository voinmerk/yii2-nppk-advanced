<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use frontend\models\Post;
use frontend\models\Category;

class BlogController extends Controller
{
	// news
	public function actionIndex()
	{
		$categories = Category::getCategories();
		$posts = Post::getNews();

		return $this->render('index', [
			'posts' => $posts,
			'categories' => $categories,
		]);
	}

	// page
	public function actionView($category)
	{
		$categories = Category::getCategories();
		$posts = Category::find()->where(['slug' => $category])->with('posts')->one()->posts;

		return $this->render('view', [
			'posts' => $posts,
			'categories' => $categories,
		]);
	}
}
