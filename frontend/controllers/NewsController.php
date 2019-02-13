<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use common\models\News;

/**
 * News controller
 */
class NewsController extends Controller
{
    public function actionIndex()
    {
        $news = News::find()->where(['status' => News::STATUS_ACTIVE])->orderBy(['updated_at' => SORT_DESC])->all();

        return $this->render('index', [
            'news' => $news,
        ]);
    }

    public function actionView($id)
    {
        $new = $this->findModel($id);

        return $this->render('view', [
            'new' => $new,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = News::find()->where(['status' => News::STATUS_ACTIVE, 'slug' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }
}
