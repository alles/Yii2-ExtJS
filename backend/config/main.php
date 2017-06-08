<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'on beforeSend' => 'backend\controllers\DefaultController::formattingResponseData',
            'charset' => 'UTF-8',
        ],
        'user' => [
            'identityClass' => 'common\models\User'
        ],
        'errorHandler' => [
            'errorAction' => 'default/error',
        ],
        'urlManager' => [
            'enableStrictParsing' => true,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'promo-code',
                    'except' => ['delete', 'view'],
                    'extraPatterns' => [
                        'GET get_discount_info' => 'get-discount-info',
                        'GET activate_discount' => 'activate-discount'
                    ]
                ], [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'city',
                    'only' => ['index'],
                ]
            ],
        ],
    ],
    'params' => $params,
];
