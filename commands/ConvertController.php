<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Bonus;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command sends users money prises to their bank accounts.
 */
class ConvertController extends Controller
{
    /**
     * @param int $count
     * @return int Exit code
     */
    public function actionIndex($count = 5)
    {
        $connection = \Yii::$app->db;

        $records = Bonus::find()->where('amount > 0')->all();
        $recordsToSend = [];
        $i = 0;
        foreach ($records as $record) {

            $recordsToSend[] = ['user_id' => $record->user_id, 'amount' => $record->amount];
            $record->amount = 0;
            $record->save();
            $i++;
            if ($i == $count) {
                $i = 0;
                // send array with data to Bank through API
                //....
                //
                $recordsToSend = [];
            }
        }

        return ExitCode::OK;
    }
}
