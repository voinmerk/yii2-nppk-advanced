<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-nppk-admin',
    'name' => 'APanel NPPK',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'sourceLanguage' => 'ru-RU',
    'language' => 'ru',
    'modules' => [],
    'controllerMap' => [
        'files' => 'jakharbek\filemanager\controllers\FilesController',
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red',
                    /*'skin-blue',
                    'skin-black',
                    'skin-red',
                    'skin-yellow',
                    'skin-purple',
                    'skin-green',
                    'skin-blue-light',
                    'skin-black-light',
                    'skin-red-light',
                    'skin-yellow-light',
                    'skin-purple-light',
                    'skin-green-light'*/
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-admin',
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-admin', 'httpOnly' => true],
            'loginUrl' => ['/auth/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'nppk-admin',
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
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@message',
                    //'sourceLanguage' => \Yii::$app->language,
                    'fileMap' => [
                        'backend'       => 'backend.php',
                        'backend/error' => 'error.php',
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

                'login' => 'auth/login',
                'logout' => 'auth/logout',

                // normal routes for CRUD operations
                '<controller:\w+>' => '<controller>/index',
                '<controller:\w+>/create' => '<controller>/create',
                '<controller:\w+>/<action:view|update|delete>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
