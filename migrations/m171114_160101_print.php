<?php

use yii\db\Schema;

class m171114_160101_print extends \yii\db\Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'storage_print', $tables))  {
          $this->createTable('{{%storage_print}}', [
              'id' => $this->primaryKey(),
              'storage' => $this->string(255),
              'product' => $this->string(255),
              'zink_number' => $this->string(255),
              'tiraj' => $this->float(),
              'frame_count' => $this->integer(11),
              'zink_count' => $this->integer(11),
              'Dimensions' => $this->string(255),
              'one_two' => $this->integer(11),
              'color_count' => $this->float(),
              'five_color' => $this->string(255),
              'page_count' => $this->float(),
              'date' => $this->datetime(),
              'uid' => $this->integer(11),
              'description' => $this->text(),
              'factor_num' => $this->string(255),
              'litography' => $this->string(11),
              ], $tableOptions);
                } else {
          echo "\nTable `".Yii::$app->db->tablePrefix."storage_print` already exists!\n";
        }
                 
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%storage_print}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
