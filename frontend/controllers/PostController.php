<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use common\models\Post;
use common\models\Category;

/**
 * Post controller
 */
class PostController extends Controller
{
	public function actionIndex()
	{
		// Список категорий для меню
		$categories = Category::find()->where(['status' => Category::STATUS_ACTIVE])->all();

		// Список всех доступных записей
		$posts = Post::find()->where(['status' => Post::STATUS_ACTIVE])->orderBy(['updated_at' => SORT_DESC])->all();

		return $this->render('index', [
			'categories' => $categories,
			'posts' => $posts,
		]);
	}

	public function actionCategory($category)
	{
		// Список категорий для меню
		$categories = Category::find()->where(['status' => Category::STATUS_ACTIVE])->all();

		// Текущая категория
		$category = Category::find()->where(['slug' => $category, 'status' => Category::STATUS_ACTIVE])->one();

		if(!$category) {
			throw new NotFoundHttpException('Запрашиваемая страница не существует.');
		}

		// Список записей по выбранной категории
		$posts = $category->posts;

		return $this->render('category', [
			'categories' => $categories,
			'category' => $category,
			'posts' => $posts,
		]);
	}

	public function actionView($category, $post)
	{
		// Список категорий для меню
		$categories = Category::find()->where(['status' => Category::STATUS_ACTIVE])->all();

		// Текущая категория
		$category = Category::find()->where(['slug' => $category, 'status' => Category::STATUS_ACTIVE])->one();

		if(!$category) {
			throw new NotFoundHttpException('Запрашиваемая страница не существует.');
		}

		// Текущая запись
		$post = Post::find()->where(['status' => Post::STATUS_ACTIVE])->one();

		if(!$post) {
			throw new NotFoundHttpException('Запрашиваемая страница не существует.');
		}

		return $this->render('view', [
			'categories' => $categories,
			'category' => $category,
			'post' => $post,
		]);
	}
}