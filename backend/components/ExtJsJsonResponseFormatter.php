<?php

namespace backend\components;

use yii\helpers\Json;

class ExtJsJsonResponseFormatter extends \yii\web\JsonResponseFormatter
{
    /**
     * @inheritdoc
     */
    protected function formatJson($response)
    {
        if ($response->data !== null) {
            if (gettype($response->data) === 'string' && strpos($response->data, '<html') !== false) {
                $response->content = $response->data;
            } else {
                $response->getHeaders()->set('Content-Type', 'application/json; charset=UTF-8');
                $options = $this->encodeOptions;
                if ($this->prettyPrint) {
                    $options |= JSON_PRETTY_PRINT;
                }

                $response->data = [
                    'statusCode' => $response->statusCode,
                    'status' => $response->isSuccessful,
                    'data' => $response->data,
                ];

                $response->content = Json::encode($response->data, $options);
            }
        }
    }
}