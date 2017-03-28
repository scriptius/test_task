<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property string $id
 * @property string $old_salary
 * @property string $new_salary
 * @property string $bonus_id
 * @property string $date
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'old_salary', 'new_salary', 'bonus_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_salary' => 'store in copecks, at a conclusion we divide on 100',
            'new_salary' => 'store in copecks, at a conclusion we divide on 100',
            'bonus_id' => 'Bonus ID',
            'date' => 'Date',
        ];
    }
}
