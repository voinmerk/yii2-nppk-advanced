<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\Banner;
use frontend\models\Page;
use frontend\models\Menu;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $banner = Banner::getBannerByName('main_slider');

        $categories = Category::getCategories();

        return $this->render('index', [
            'banner' => $banner,
            'categories' => $categories,
        ]);
    }

    public function actionPage($page)
    {
        $this->layout = 'page';
        
        $page = Page::find()->where(['slug' => $page, 'published' => Page::PUBLISHED])->one();

        return $this->render('page', compact('page', 'menu'));
    }
}
