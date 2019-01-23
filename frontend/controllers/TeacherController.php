<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\Teacher;
use frontend\models\TeacherGroup;

/**
 * Site controller
 */
class TeacherController extends Controller
{
	public function actionIndex()
	{
		$leaders = Teacher::getCollaboratorsByGroup(1);
        $teachers = Teacher::getCollaboratorsByGroup(2);

        return $this->render('index', compact('leaders', 'teachers'));
	}

	public function actionView($id)
	{
		$teacher = Teacher::find()->where(['id' => $id, 'published' => Teacher::PUBLISHED])->one();

		if(Yii::$app->request->isAjax) {
			// throw new BadRequestHttpException(Yii::t('frontend', 'This category does not exist!'));

			return $this->renderAjax('ajax_view', compact('teacher'));
		}

		return $this->render('view', compact('teacher'));
	}
}