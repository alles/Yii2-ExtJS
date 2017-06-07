<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('if not exists {{%cities}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('if not exists {{%promo_codes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'fee' => $this->decimal(10,2)->defaultValue(0),
            'start_date' => $this->dateTime()->notNull(),
            'end_date' => $this->dateTime()->notNull(),
            'id_cities' => $this->integer()->notNull(),
            'status' => 'enum("active", "inactive") not null default "inactive"',

            'FOREIGN KEY (id_cities) REFERENCES {{%cities}} (id)',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%promo_codes}}');
        $this->dropTable('{{%cities}}');
    }
}
