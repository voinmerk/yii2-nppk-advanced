<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use common\models\User;

/**
 * Profile controller
 */
class ProfileController extends Controller
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
                        'actions' => ['index', 'change-name', 'change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'change-name' => ['POST'],
                    'change-password' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    	$user_id = Yii::$app->user->identity->id;
    	
    	$changeName = User::findOne($user_id);
    	$changePassword = User::findOne($user_id);

        return $this->render('index', compact('changeName', 'changePassword'));
    }

    public function actionChangeName()
    {
    	return $this->redirect(['/profile/index']);
    }

    public function actionChangePassword()
    {
    	return $this->redirect(['/profile/index']);
    }
}
