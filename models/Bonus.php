<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Integer;
use yii\db\ActiveRecord;

class Bonus extends ActiveRecord
{

    public static function tableName()
    {
        return 'user_bonuses';
    }

}