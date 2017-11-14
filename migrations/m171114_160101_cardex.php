<?php

use yii\db\Schema;

class m171114_160101_cardex extends \yii\db\Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'storage_cardex', $tables))  {
          $this->createTable('{{%storage_cardex}}', [
              'id' => $this->primaryKey(),
              'date' => $this->datetime(),
              'description' => $this->string(255),
              'change' => $this->float(),
              'module' => $this->string(255),
              'model' => $this->string(255),
              'uid' => $this->integer(11),
              'username' => $this->string(255),
              'stock' => $this->double(),
              'storage' => $this->string(255),
              'product' => $this->string(255),
              'FOREIGN KEY ([[product]]) REFERENCES {{%storage_product}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
              'FOREIGN KEY ([[storage]]) REFERENCES {{%storage}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
              'FOREIGN KEY ([[uid]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
              ], $tableOptions);
                } else {
          echo "\nTable `".Yii::$app->db->tablePrefix."storage_cardex` already exists!\n";
        }
                 
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%storage_cardex}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
