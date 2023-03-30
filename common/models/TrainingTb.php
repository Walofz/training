<?php

namespace common\models;

/**
 * This is the model class for table "{{%training_tb}}".
 *
 * @property string $Employee_ID
 * @property int $Train_Detail_ID
 */
class TrainingTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%training_tb}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Employee_ID', 'Train_Detail_ID'], 'required'],
            [['Train_Detail_ID'], 'integer'],
            [['Employee_ID'], 'string', 'max' => 13],
            [['Employee_ID', 'Train_Detail_ID'], 'unique', 'targetAttribute' => ['Employee_ID', 'Train_Detail_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Employee_ID' => 'Employee ID',
            'Train_Detail_ID' => 'Train Detail ID',
        ];
    }
}
