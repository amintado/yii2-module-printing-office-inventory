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


        if (!in_array(Yii::$app->db->tablePrefix.'storage_cardex', $tables))  {
            $this->createTable('{{%storage_cardex}}', [
                'id' => $this->primaryKey(),
                'date' => $this->datetime(),
                'description' => $this->string(255),
                'factor' => $this->integer(11),
                'input' => $this->float(),
                'export' => $this->float(),
                'remaining' => $this->float(),
                'mode' => $this->integer(11),
                'chap' => $this->integer(11),
            ], $tableOptions);
        } else {
            echo "\nTable `".Yii::$app->db->tablePrefix."storage_cardex` already exists!\n";
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
            ], $tableOptions);
        } else {
            echo "\nTable `".Yii::$app->db->tablePrefix."storage_print` already exists!\n";
        }

        if (!in_array(Yii::$app->db->tablePrefix.'storage_product', $tables))  {
            $this->createTable('{{%storage_product}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string(255),
                'descrition' => $this->text(),
            ], $tableOptions);
        } else {
            echo "\nTable `".Yii::$app->db->tablePrefix."storage_product` already exists!\n";
        }
    }







    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%storage}}');
        $this->dropTable('{{%storage_items}}');
        $this->dropTable('{{%storage_cardex}}');
        $this->dropTable('{{%storage_peoples}}');
        $this->dropTable('{{%storage_print}}');
        $this->dropTable('{{%storage_product}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
