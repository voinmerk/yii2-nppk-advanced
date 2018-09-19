<?php
namespace frontend\widgets;

use Yii;

class Multilanguage extends \yii\bootstrap\Widget
{
    public function index()
    {
        Menu::widget([
          'options' => ['class' => 'nav navbar-nav navbar-right wow fadeInRightBig animated', 'data-wow-duration' => '1s', 'data-wow-delay' => '.5s'],
          'items' => [
            ['label' => Yii::t('app', 'Information'), 'url' => ['blog/index', 'id' => 'news']],
            ['label' => Yii::t('app', 'Timetable'), 'url' => ['site/timetable']],
            ['label' => Yii::t('app', 'Rooms'), 'url' => ['site/rooms']],
            ['label' => Yii::t('app', 'Employees'), 'url' => ['site/teachers']],
          ],
          'activeCssClass' => 'active',
      ]);
    }
}