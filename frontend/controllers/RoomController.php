<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use common\models\Room;

/**
 * Site controller
 */
class RoomController extends Controller
{
	public function actionIndex()
	{
		$rooms = Room::getRooms();

		return $this->render('index', compact('rooms'));
	}

	public function actionView($id)
	{
		$room = Room::findOne($id);

		if(Yii::$app->request->isAjax) {
			return $this->renderAjax('ajax_view', compact('room'));
		}

		return $this->render('view', compact('room'));
	}
}