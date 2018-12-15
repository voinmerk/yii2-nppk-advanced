<?php
namespace frontend\controllers;

use Yii;
use frontend\models\News;

class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $news = News::find()->where(['published' => News::PUBLISHED])->all();

        return $this->render('index', [
            'news' => $news,
        ]);
    }

    public function actionView($id)
    {
        $new = News::find()->where(['publsihed' => News::PUBLSIHED, 'slug' => $id])->one();

        if(!$new) {
            throw new BadRequestHttpException('Указанная вами новость не найдена или не доступна!');
        }

        return $this->render('view', [
            'new' => $new,
        ]);
    }
}
