<?php

use yii\db\Schema;

class m171031_060101_inventory extends \yii\db\Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'storage', $tables))  {
          $this->createTable('{{%storage}}', [
              'name' => $this->string(255)->notNull(),
              'PRIMARY KEY ([[name]])',
              ], $tableOptions);
                } else {
          echo "\nTable `".Yii::$app->db->tablePrefix."storage` already exists!\n";
        }


        if (!in_array(Yii::$app->db->tablePrefix.'storage_items', $tables))  {
            $this->createTable('{{%storage_items}}', [
                'id' => $this->primaryKey(),
                'storage' => $this->string(255),
                'zink_no' => $this->string(255),
                'circulation' => $this->string(255),
                'frame_count' => $this->integer(11),
                'zink_count' => $this->integer(11),
                'dimentions' => $this->string(255),
                'one_and_two' => $this->integer(11),
                'color_count' => $this->integer(11),
                'color_5' => $this->string(255),
                'inventory' => $this->string(255),
                'sex' => $this->string(255),
                'date' => $this->datetime(),
                'FOREIGN KEY ([[storage]]) REFERENCES {{%storage}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
            ], $tableOptions);
        } else {
            echo "\nTable `".Yii::$app->db->tablePrefix."storage_items` already exists!\n";
        }
                 
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%storage}}');
        $this->dropTable('{{%storage_items}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
