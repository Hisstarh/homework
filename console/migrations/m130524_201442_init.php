<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'sit_id' =>$this->integer()->notNull(),
            'role_id'=>$this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

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
            'left_right' => $this->integer()->defaultValue(0),
            'front_rear' => $this->integer()->defaultValue(0),
            'top_bottom' => $this->integer()->defaultValue(0),
            'code_manufacturer' => $this->string()->notNull(),
            'optics' => $this->string()->notNull(),
            'delevery_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'sit_id' =>$this->integer()->notNull(),
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
            'sit_id' =>$this->integer()->notNull(),
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
            'FK_user_role', '{{%user}}', 'role_id', '{{%role}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_sit_priceform', '{{%sit}}', 'priceform_id');
        $this->addForeignKey(
            'FK_sit_priceform', '{{%sit}}', 'priceform_id', '{{%priceform}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_delevery_sit', '{{%delevery}}', 'sit_id');
        $this->addForeignKey(
            'FK_delevery_sit', '{{%delevery}}', 'sit_id', '{{%sit}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_articles_sit', '{{%articles}}', 'sit_id');
        $this->addForeignKey(
            'FK_articles_sit', '{{%articles}}', 'sit_id', '{{%sit}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_articles_user', '{{%articles}}', 'update_user');
        $this->addForeignKey(
            'FK_articles_user', '{{%articles}}', 'update_user', '{{%user}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_user_sit', '{{%user}}', 'sit_id');
        $this->addForeignKey(
            'FK_user_sit', '{{%user}}', 'sit_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%articles}}');
        $this->dropTable('{{%sit}}');
        $this->dropTable('{{%delevery}}');
        $this->dropTable('{{%priceform}}');
        $this->dropTable('{{%role}}');
    }
}
