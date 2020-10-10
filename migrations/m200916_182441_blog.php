<?php

use yii\db\Migration;

/**
 * Class m200916_182441_blog
 */
class m200916_182441_blog extends Migration
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
        echo "m200916_182441_blog cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $this->createTable('blog',[
           'id'=>$this->primaryKey(),
           'title'=>$this->string(50)->notNull(),
           'content'=>$this->text(),
           'create_date'=>$this->timestamp()->defaultValue(new \yii\db\Expression('NOW()'))

        ]);


    }

    public function down()
    {
        $this->dropTable('blog');
    }

}
