<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\Banner;
use frontend\models\Category;
use frontend\models\Group;
use frontend\models\Timetable;
use frontend\models\Room;
use frontend\models\Teacher;
use frontend\models\TeacherGroup;

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

        $categories = Category::getCategories();

        return $this->render('index', [
            'banner' => $banner,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays teachers page.
     *
     * @return string
     */
    public function actionTeachers()
    {
        $leaders = Teacher::getCollaboratorsByGroup(1);
        $teachers = Teacher::getCollaboratorsByGroup(2);

        return $this->render('teachers', [
            'leaders' => $leaders,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Displays rooms page.
     *
     * @return string
     */
    public function actionRooms()
    {
        $request = new Yii::$app->request();

        if(!$request->isAjax) {
            $rooms = Room::getRooms();

            return $this->render('rooms', [
                'rooms' => $rooms,
            ]);
        } else {
            $id = $request->get('id');

            $room = Room::getRoomById($id);

            return $this->renderAjax('ajax/rooms', [
                'room' => $room,
            ]);
        }
    }

    /**
     * Displays timetable page.
     *
     * @return string
     */
    public function actionTimetable()
    {
        $request = new Yii::$app->request();

        if(!$request->isAjax) {
            $groups = Group::getGroups();
            $groupCount = Group::getGroupCount();

            return $this->render('timetable', [
                'groups' => $groups,
                'groupCount' => $groupCount,
            ]);
        } else {
            $id = $request->get('id');

            $today = date('Y-m-d');
            $group = Group::getGroupById($id);
            $timetables = Timetable::getTimetablesByGroup($id);

            return $this->renderAjax('ajax/timetable', [
                'group' => $group,
                'today' => $today,
                'timetables' => $timetables,
            ]);
        }
    }
}
