<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use frontend\models\Post;
use frontend\models\Category;

class BlogController extends Controller
{
	/**
	 * Display page - Все записи
	 * 
	 * @return $string
	 */
	public function actionIndex()
	{
		$posts = Post::getPosts();
		$categories = Category::getCategories();

		return $this->render('index', compact('posts', 'categories'));
	}

	/**
	 * Display page - Все записи в рубрике
	 * 
	 * @return $string
	 */
	public function actionCategory($category)
	{
		$posts = Category::find()->where(['slug' => $category, 'published' => Category::PUBLISHED])->with('posts')->one()->posts;
		$category = Category::find()->where(['slug' => $category, 'published' => Category::PUBLISHED])->one();
		$categories = Category::getCategories();

		return $this->render('category', compact('categories', 'category', 'posts'));
	}

	/**
	 * Display page - Просмотр записи
	 * 
	 * @return $string
	 */
	public function actionView($category, $post)
	{
		return $this->render('view');
	}

	/**
	 * Display page - Поиск по записям
	 * 
	 * @return $string
	 */
	/*public function actionSearch($text)
	{
		return $this->render('search');
	}*/
}
