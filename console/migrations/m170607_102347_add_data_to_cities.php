<?php

use yii\db\Migration;

class m170607_102347_add_data_to_cities extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{cities}}', ['name'], [
            ['Moscow'], ['London'], ['Donetsk'], ['New York'], ['Berlin']
        ]);
    }

    public function safeDown()
    {

    }
}
