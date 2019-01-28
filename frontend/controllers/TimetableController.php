<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\Group;
use frontend\models\Timetable;

/**
 * Site controller
 */
class TimetableController extends Controller
{
	public function actionIndex()
	{
		$groups = Group::getGroups();
        $groupCount = Group::getGroupCount();
		
		return $this->render('index', compact('groups', 'groupCount'));
	}

	public function actionView($id)
	{
		$today = date('Y-m-d');

        $group = Group::getGroupById($id);
        $timetables = Timetable::getTimetablesByGroup($id);

		return $this->render('view', compact('group', 'today', 'timetables'));
	}

	public function actionAjaxView($id)
	{
		$request = new Yii::$app->request();

		if(!$request->isAjax) {
			throw new BadRequestHttpException(Yii::t('frontend', 'This category does not exist!'));
		}

        $today = date('Y-m-d');

        $group = Group::getGroupById($id);
        $timetables = Timetable::getTimetablesByGroup($id);

		return $this->renderAjax('ajax_view', compact('group', 'today', 'timetables'));
	}
}