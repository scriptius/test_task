<?php

namespace app\controllers;

use Yii;
//use yii\filters\AccessControl;
use app\models\Statistics;
use yii\web\Controller;
//use yii\filters\VerbFilter;
//use app\models\Statistics;
//use app\models\ContactForm;

class SalaryController extends Controller
{
    /**
     * Страница рассчета ЗП
     * @return string
     */
    public function actionIndex()
    {
        $statistics = new Statistics();
//        $statisticsDataProvider = $statistics->getDataProvider();
        $salaryReport = $statistics->getSalaryReport();
        return $this->render('index', ['salaryReport' => $salaryReport]);
    }


    /**
     * Страница с историей начисления бонусов
     * @return string
     */
    public function actionHistory()
    {
        return $this->render('history');
    }
}
