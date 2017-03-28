<?php

namespace app\controllers;

use app\models\History;
use Yii;
use app\models\Statistics;
use yii\web\Controller;

class SalaryController extends Controller
{
    /**
     * Страница рассчета ЗП
     * @return string
     */
    public function actionIndex()
    {
        $statistics = new Statistics();
        $salaryReport = $statistics->getSalaryReport();
        return $this->render('index', ['salaryReport' => $salaryReport]);
    }


    /**
     * Страница с историей начисления бонусов
     * @return string
     */
    public function actionHistory()
    {
        return $this->render('history', ['history' => History::find()->all()]);
    }
}
