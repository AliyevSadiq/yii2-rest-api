<?php

use yii\db\Migration;

/**
 * Class m200916_070922_user
 */
class m200916_070922_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200916_070922_user cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
          $this->createTable('user',[
              'id'=>$this->primaryKey(),
              'first_name'=>$this->string(50)->notNull(),
              'surname'=>$this->string(50)->notNull(),
              'password'=>$this->string(100)->notNull(),
              'email'=>$this->string(50)->notNull(),
              'phone'=>$this->integer(),
              'register_date'=>$this->timestamp()->defaultValue(new \yii\db\Expression("NOW()") ),
              'access_token'=>$this->string(100)
          ]);
    }

    public function down()
    {
        $this->dropTable('user');


    }

}
