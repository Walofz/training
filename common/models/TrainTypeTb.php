<?php

namespace common\models;

/**
 * This is the model class for table "{{%train_type_tb}}".
 *
 * @property int $Train_Type_ID
 * @property string $Train_Type_Name_EN
 * @property string $Train_Type_Name_TH
 */
class TrainTypeTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%train_type_tb}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Train_Type_ID', 'Train_Type_Name_EN', 'Train_Type_Name_TH'], 'required'],
            [['Train_Type_ID'], 'integer'],
            [['Train_Type_Name_EN', 'Train_Type_Name_TH'], 'string', 'max' => 255],
            [['Train_Type_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Train_Type_ID' => 'Train Type ID',
            'Train_Type_Name_EN' => 'Train Type Name En',
            'Train_Type_Name_TH' => 'Train Type Name Th',
        ];
    }
}
