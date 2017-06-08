<?php

namespace backend\controllers;

use backend\models\PromoCode;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class PromoCodeController extends \yii\rest\ActiveController
{
    public $modelClass = 'backend\models\PromoCode';

    /**
     * Get information about promo code.
     *
     * @param $name string
     * @return array [start_date, end_date, fee, city, status]
     * @throws NotFoundHttpException
     */
    public function actionGetDiscountInfo($name)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::findOne(['name' => $name]);

        if (!isset($model)) {
            throw new NotFoundHttpException('Promo code not found.');
        }

        return [
            'start_date' => $model->start_date,
            'end_date' => $model->end_date,
            'fee' => $model->fee,
            'status' => $model->status
        ];
    }

    /**
     * Activate promo code.
     *
     * @param $name string
     * @param $id_cities integer
     * @return float
     * @throws ServerErrorHttpException
     * @throws NotFoundHttpException
     */
    public function actionActivateDiscount($name, $id_cities)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::findOne(['name' => $name, 'id_cities' => $id_cities]);

        if (isset($model)) {
            $model->status = 'active';
            if ($model->save() === false && !$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to activate discount.');
            }

            return $model->fee;
        } else {
            throw new NotFoundHttpException('Promo code not found.');
        }
    }
}