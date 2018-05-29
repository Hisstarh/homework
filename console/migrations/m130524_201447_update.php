<?php

use yii\db\Migration;

class m130524_201447_update extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }



        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->integer()->notNull()->unique(),
            'place' => $this->string()->notNull(),
            'sell_price' => $this->float()->notNull(),
            'purchase_price' => $this->float()->notNull(),
            'margin' => $this->smallInteger()->Null(),
            'mark' => $this->string()->notNull(),
            'body' => $this->string()->notNull(),
            'drive' => $this->string()->notNull(),
            'model' => $this->string()->notNull(),
            'description' => $this->string()->defaultValue(''),
            'side_left' => $this->boolean()->defaultValue(0),
            'side_front' => $this->boolean()->defaultValue(0),
            'side_top' => $this->boolean()->defaultValue(0),
            'side_right' => $this->boolean()->defaultValue(0),
            'side_rear' => $this->boolean()->defaultValue(0),
            'side_bottom' => $this->boolean()->defaultValue(0),
            'code_manufacturer' => $this->string()->notNull(),
            'optics' => $this->string()->notNull(),
            'delevery_id' => $this->integer()->notNull()->defaultValue(1),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'sit_id' =>$this->integer()->notNull()->defaultValue(1),
            'update_user' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%delevery}}', [
            'id' => $this->primaryKey(),
            'delevery' => $this->string()->notNull()->unique(),
            'owner' => $this->string(32)->notNull(),
            'delevery_date'=> $this->integer()->notNull(),
            'description' => $this->string()->defaultValue(''),
            'sit_id' =>$this->integer()->notNull()->defaultValue(1),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%sit}}', [
            'id' => $this->primaryKey(),
            'sit' => $this->string()->notNull(),
            'owner' => $this->string()->notNull(),
            'adress' => $this->string()->notNull(),
            'margin_on_sit'=>$this->smallInteger()->Null(),
            'priceform_id'=>$this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%priceform}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'seller'=>$this->smallInteger()->Null(),
            'owner'=>$this->smallInteger()->Null(),
            'fond'=>$this->smallInteger()->Null(),
            'programmer'=>$this->smallInteger()->Null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

        ], $tableOptions);

        $this->createIndex('FK_user_role', '{{%user}}', 'role_id');
        $this->addForeignKey(
            'FK_user_role', '{{%user}}', 'role_id', '{{%role}}', 'id', 'CASCADE','RESTRICT'
        );

        $this->createIndex('FK_sit_priceform', '{{%sit}}', 'priceform_id');
        $this->addForeignKey(
            'FK_sit_priceform', '{{%sit}}', 'priceform_id', '{{%priceform}}', 'id', 'CASCADE', 'RESTRICT'
        );

        $this->createIndex('FK_delevery_sit', '{{%delevery}}', 'sit_id');
        $this->addForeignKey(
            'FK_delevery_sit', '{{%delevery}}', 'sit_id', '{{%sit}}', 'id', 'CASCADE', 'RESTRICT'
        );

        $this->createIndex('FK_articles_delevery', '{{%articles}}', 'delevery_id');
        $this->addForeignKey(
            'FK_articles_delevery', '{{%articles}}', 'delevery_id', '{{%sit}}', 'id','CASCADE',  'RESTRICT'
        );

        $this->createIndex('FK_articles_user', '{{%articles}}', 'update_user');
        $this->addForeignKey(
            'FK_articles_user', '{{%articles}}', 'update_user', '{{%user}}', 'id',  'CASCADE','RESTRICT'
        );

        $this->createIndex('FK_articles_user', '{{%articles}}', 'update_user');
        $this->addForeignKey(
            'FK_articles_user', '{{%articles}}', 'update_user', '{{%user}}', 'id',  'CASCADE','RESTRICT'
        );

        $this->createIndex('FK_user_sit', '{{%user}}', 'sit_id');
        $this->addForeignKey(
            'FK_user_sit', '{{%user}}', 'sit_id', '{{%sit}}', 'id', 'CASCADE', 'RESTRICT'
        );
    }

    public function safeDown()
    {


        $this->dropForeignKey(
            'FK_user_role',
            '{{%user}}'
        );
        $this->dropForeignKey(
            'FK_sit_priceform',
            '{{%sit}}'
        );
        $this->dropForeignKey(
            'FK_delevery_sit',
            '{{%delevery}}'
        );
        $this->dropForeignKey(
            'FK_articles_sit',
            '{{%articles}}'
        );
        $this->dropForeignKey(
            'FK_articles_user',
            '{{%articles}}'
        );
        $this->dropForeignKey(
            'FK_articles_delevery',
            '{{%articles}}'
        );
        $this->dropForeignKey(
            'FK_user_sit',
            '{{%user}}'
        );
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%articles}}');
        $this->dropTable('{{%sit}}');
        $this->dropTable('{{%delevery}}');
        $this->dropTable('{{%priceform}}');
        $this->dropTable('{{%role}}');
    }
}
