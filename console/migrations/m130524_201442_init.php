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
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'model' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'sit_id' =>$this->integer()->notNull(),
            'update_user' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%sit}}', [
            'id' => $this->primaryKey(),
            'sit' => $this->string()->notNull(),
            'owner' => $this->string()->notNull(),
            'adress' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

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
        $this->dropTable('{{%Articles}}');
        $this->dropTable('{{%sit}}');
    }
}
