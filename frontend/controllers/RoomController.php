<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\Room;

/**
 * Site controller
 */
class RoomController extends Controller
{
	public function actionIndex()
	{
		$rooms = Room::getRooms();

		$this->render('index', compact('rooms'));
	}
}