<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use common\models\Banner;
use common\models\Category;

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
        $categories = Category::find()->where(['status' => Category::STATUS_ACTIVE, 'on_home' => 1])->orderBy(['sort_order' => SORT_ASC, 'updated_at' => SORT_DESC])->all();

        return $this->render('index', [
            'banner' => $banner,
            'categories' => $categories,
        ]);
    }
}
