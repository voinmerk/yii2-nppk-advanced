<?php

namespace backend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use common\models\Banner;
use common\models\BannerSearch;
use common\models\BannerCaption;

use backend\base\Model;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // var_dump($dataProvider);exit;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Timetable;
        $modelCaptions = [new BannerCaption];

        if ($model->load(Yii::$app->request->post())) {

            $modelCaptions = Model::createMultiple(BannerCaption::className());
            Model::loadMultiple($modelCaptions, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelCaptions) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelCaptions as $caption) {
                            $caption->banner_id = $model->id;
                            if (! ($flag = $caption->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        
                        Yii::$app->session->setFlash('success', 'Расписание на <strong>"' . $model->date . '"</strong>, для группы <strong>"' . $model->group->name . '"</strong> успено добавлено.');
                        
                        return $this->redirect(['index']);

                        //return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelCaptions' => (empty($modelCaptions)) ? [new BannerCaption] : $modelCaptions
        ]);
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelCaptions = $model->bannerCaptions;

        if(!$modelCaptions) $modelCaptions = [new BannerCaption];

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelCaptions, 'id', 'id');
            $modelCaptions = Model::createMultiple(BannerCaption::className(), $modelCaptions);
            Model::loadMultiple($modelCaptions, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelCaptions, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelCaptions) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            BannerCaption::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelCaptions as $caption) {
                            $caption->banner_id = $model->id;
                            if (! ($flag = $caption->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    } else {
                        exit;
                    }
                    if ($flag) {
                        $transaction->commit();

                        Yii::$app->session->setFlash('success', Yii::t('backend', 'Измненения сохранены!'));

                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            } else {
                exit;
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelCaptions' => (empty($modelCaptions)) ? [new BannerCaption] : $modelCaptions
        ]);
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $name = $model->name;

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Record  <strong>"{name}"</strong> deleted successfully.', ['name' => $name]));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::find()->with(['bannerCaptions'])->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
