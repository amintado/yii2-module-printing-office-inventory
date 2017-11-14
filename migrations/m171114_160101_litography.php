<?php

use yii\db\Schema;

class m171114_160101_litography extends \yii\db\Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'storage_litography', $tables))  {
          $this->createTable('{{%storage_litography}}', [
              'id' => $this->primaryKey(),
              'name' => $this->string(255),
              'telephone' => $this->string(255),
              'address' => $this->string(255),
              'descriptions' => $this->text(),
              ], $tableOptions);
                } else {
          echo "\nTable `".Yii::$app->db->tablePrefix."storage_litography` already exists!\n";
        }
                 
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%storage_litography}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
