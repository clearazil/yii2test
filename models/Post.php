<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    public function behaviors()
    {
        return [
         TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            [['title', 'message'], 'required'],
        ];
    }
}