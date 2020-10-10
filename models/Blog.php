<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string|null $content
 * @property string|null $create_date
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['create_date'], 'safe'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'create_date' => 'Create Date',
        ];
    }


    public static function checkEmpty($id){
        if(!empty($id)){
            $blog_count=static::findOne($id);
            if(!empty($blog_count)){
                return $blog_count;
            }else{
                return 'THIS BLOG NOT FOUND';
            }
        }else{
            return 'ID IS EMPTY';
        }
    }
}
