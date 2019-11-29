<?php

namespace app\models;

use yii\db\ActiveRecord;

class Money extends ActiveRecord
{


    public static function tableName()
    {
        return 'user_money';
    }

}