<?php

use yii\db\Schema;

class m171114_160101_people extends \yii\db\Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'storage_peoples', $tables))  {
          $this->createTable('{{%storage_peoples}}', [
              'id' => $this->primaryKey(),
              'name' => $this->string(255),
              'telephone' => $this->string(255),
              'address' => $this->string(255),
              'economic_code' => $this->string(14),
              'description' => $this->text(),
              ], $tableOptions);
                } else {
          echo "\nTable `".Yii::$app->db->tablePrefix."storage_peoples` already exists!\n";
        }
                 
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%storage_peoples}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
