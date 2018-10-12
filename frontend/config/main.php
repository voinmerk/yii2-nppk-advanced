<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-nppk-public',
    'name' => 'NPPK',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'sourceLanguage' => 'ru',
    'language' => 'ru-RU',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-public',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-public', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'nppk-public',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@message',
                    //'sourceLanguage' => \Yii::$app->language,
                    'fileMap' => [
                        'frontend'       => 'frontend.php',
                        'frontend/error' => 'error.php',
                    ],
                ],
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@message',
                    //'sourceLanguage' => \Yii::$app->language,
                    'fileMap' => [
                        'common'       => 'common.php',
                        'common/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
            /*'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en' => 'en-US', 'ru' => 'ru-RU'],
            'enableDefaultLanguageUrlCode' => true,*/

            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'teachers' => 'site/teachers',

                /*'blog/<id:[\w_-]+>' => 'blog/index',
                'blog' => 'blog/index',*/
                'blog/<post:[\w_-]+>' => 'blog/view',
                'blog' => 'blog/index',

                'rooms/<id:\d+>' => 'site/rooms',
                'rooms' => 'site/rooms',

                'timetable/<id:\d+>' => 'site/timetable',
                'timetable' => 'site/timetable',
            ],
        ],
    ],
    'params' => $params,
];
