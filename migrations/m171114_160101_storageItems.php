<?php

use yii\db\Schema;

class m171114_160101_storageItems extends \yii\db\Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'storage_items', $tables))  {
          $this->createTable('{{%storage_items}}', [
              'id' => $this->primaryKey(),
              'storage' => $this->string(255),
              'product' => $this->string(255),
              'stock' => $this->float(),
              'min_indicator' => $this->float(),
              'max_indicator' => $this->float(),
              'FOREIGN KEY ([[storage]]) REFERENCES {{%storage}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
              'FOREIGN KEY ([[product]]) REFERENCES {{%storage_product}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
              ], $tableOptions);
                } else {
          echo "\nTable `".Yii::$app->db->tablePrefix."storage_items` already exists!\n";
        }
                 
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%storage_items}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
