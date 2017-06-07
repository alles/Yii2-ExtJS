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
            'format' => 'extjs',
            'formatters' => [
                'extjs' => 'backend\components\ExtJsJsonResponseFormatter'
            ],
            'charset' => 'UTF-8',
        ],
        'user' => [
            'identityClass' => 'common\models\User'
        ],
        'urlManager' => [
            'enableStrictParsing' => true,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [[
                'class' => 'yii\rest\UrlRule',
                'controller' => 'promo-code',
                'except' => ['delete', 'view'],
                'extraPatterns' => [
                    'GET get_discount_info' => 'get-discount-info',
                    'GET activate_discount' => 'activate-discount'
                ]
            ]],
        ],
    ],
    'params' => $params,
];
