<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use frontend\models\BannerImage;
use frontend\models\BlogMenu;
use frontend\models\Group;
use frontend\models\Timetable;
use frontend\models\Room;
use frontend\models\RoomImage;
use frontend\models\Teacher;

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
        $banner = new BannerImage();

        $banners = $banner->getImages();

        $bm = new BlogMenu();

        $blog_menu = $bm->getMenu();

        return $this->render('index', [
            'banners' => $banners,
            'blog_menu' => $blog_menu,
        ]);
    }

    /**
     * Displays teachers page.
     *
     * @return string
     */
    public function actionTeachers()
    {
        $teachers = Teacher::getTeachers();
        $leaders = Teacher::getLeaders();

        return $this->render('teachers', [
            'teachers' => $teachers,
            'leaders' => $leaders,
        ]);
    }

    /**
     * Displays blog page.
     *
     * @return string
     */
    public function actionBlog()
    {
        return $this->render('blog');
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

            //die(var_dump($rooms));

            return $this->render('rooms', [
                'rooms' => $rooms,
            ]);
        } else {
            $id = $request->get('id');

            $rooms = Room::getRoomById($id);
            $rooms_image = RoomImage::getRoomImageById($id);

            return $this->renderAjax('ajax/rooms', [
                'rooms' => $rooms,
                'rooms_image' => $rooms_image,
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

        $group = new Group();

        if(!$request->isAjax) {
            $groups = Group::getGroups();
            
            return $this->render('timetable', [
                'groups' => $groups,
            ]);
        } else {
            $today = date('Y-m-d');

            $id = $request->get('id');

            $groups = $group->getGroupById($id);

            //$timetables = $timetable->getTimetables($id);

            $beta = Timetable::getTimetablesBeta($id);

            return $this->renderAjax('ajax/timetable', [
                'groups' => $groups,
                'today' => $today,
                'timetables' => $beta,
            ]);
        }
    }
}
