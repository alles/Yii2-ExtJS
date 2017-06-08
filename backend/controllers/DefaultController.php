<?php

namespace backend\controllers;

class DefaultController extends \yii\rest\Controller
{
    /**
     * Return formatted error
     *
     * @return array [name string, message string, code int]
     */
    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return [
                'name' => $exception->getName(),
                'message' => $exception->getMessage(),
                'code' => $exception->statusCode,
            ];
        }
    }

    /**
     * Formatting response
     *
     * @return array [statusCode int, status bool, data array]
     */
    public static function formattingResponseData()
    {
        $exceptModule = ['gii', 'debug'];
        foreach ($exceptModule as $module) {
            $pos = strpos(\Yii::$app->request->url, '/' . $module);
            if ($pos !== false) return;
        }

        $res = \Yii::$app->response;

        $res->format = $res::FORMAT_JSON;
        $data = [
            'statusCode' => $res->statusCode,
            'status' => $res->isSuccessful,
            'data' => [],
        ];
        if ($res->data !== null) $data['data'] = $res->data;

        $res->data = $data;
    }


}