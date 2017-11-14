<?php

use yii\db\Schema;

class m171114_160101_storage extends \yii\db\Migration
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
                 
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%storage}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
