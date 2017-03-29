<?php
/**
 * Created by PhpStorm.
 * User: Victor_PC
 * Date: 28.03.2017
 * Time: 3:16
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;

class Statistics extends Model
{
    /**
     * Получить суммарное количество звонков в разрезе менеджеров
     * @return array
     */
    public function getTotalCallsAllUsers()
    {
        $sql = <<<SQL
            SELECT `user_id`, SUM(`count_calls`) AS `count_calls`
            FROM `statistics`
            GROUP BY `user_id`
SQL;
        
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * Получить описания всех бонусов из таблицы bonuses
     * @return array
     */
    public function getAllBonusesDescriptions()
    {
        $sql = 'SELECT * FROM `bonuses`';
        return Yii::$app->db->createCommand($sql)->queryAll();
    }


    /**
     * Получить результирующий отчет по зп
     * @return array
     */
    public function getSalaryReport()
    {
        $allCallsByUsers     = $this->getTotalCallsAllUsers();
        $bonusesDescriptions = $this->getAllBonusesDescriptions();

        $result = [];
        // Сравниваем показатели каждого менеджера со всеми бонусами
        foreach ($allCallsByUsers as $callsByUser) {
            $applyBonus = null;
            foreach ($bonusesDescriptions as $currentBonus) {
                // Проверяем условия начисления бонуса.
                $condition = str_replace('val', $callsByUser['count_calls'],$currentBonus['condition']);
                if (eval("return $condition;")) {
                    $applyBonus = $currentBonus['bonus'];
                    $applyBonusId = $currentBonus['id'];
                }
            }
            $managerModel = Users::findOne((int)$callsByUser['user_id']);
            $managerArray = $managerModel->toArray();
            if ($applyBonus) {
                $managerArray['salary'] += $applyBonus;
                // Сохраняем обновленную зп
                $managerModel->salary = $managerArray['salary'];
                // И ссылку на бонус
                $managerModel->bonus_id = $applyBonusId;
                $managerModel->save();
            }
            $result[] = $managerArray;
        }
        return $result;
    }
}
