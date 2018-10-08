<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use backend\models\Blog;
use backend\models\BlogSearch;
use backend\models\BlogDescription;
use backend\models\BlogMenu;
use backend\models\Language;



/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
     public function beforeAction($action)
     {
         $model = new \backend\models\forms\SearchForm;

         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             $q = \yii\helpers\Html::encode($model->q);

             return $this->redirect(['bot/search', 'q' => $q]);
         }

         return true;
     }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;

        $languages = Language::getLanguages(['id', 'name', 'locale'], false);

        $blog = new Blog();

        if ($request->isPost) {
            if($blog->load($request->post())) {
                if($blog->save()) {
                    exit('error');
                    // return $this->redirect(['view', 'id' => $blog->id]);
                } else {
                    var_dump($blog);
                    exit('hello');
                }
            }
        } else {
            $menuItems = BlogMenu::getMenu();

            $blogMenuItem = ArrayHelper::map($menuItems, 'id', 'name');

            return $this->render('create', [
                'blog' => $blog,
                'blogMenuItem' => $blogMenuItem,
                'languages' => $languages,
            ]);
        }
    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;

        $languages = Language::getLanguages(['id', 'name', 'locale'], false);

        $blog = $this->findModel($id);

        if ($request->isPost) {
            if($blog->load($request->post()) && $blog->save()) {
                return $this->redirect(['view', 'id' => $blog->id]);
            }
        } else {
            $menuItems = BlogMenu::getMenu();

            $blogMenuItem = ArrayHelper::map($menuItems, 'id', 'name');

            return $this->render('update', [
                'blog' => $blog,
                'blogMenuItem' => $blogMenuItem,
                'languages' => $languages,
            ]);
        }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
