<?php

namespace common\models;

/**
 * This is the model class for table "{{%USRP_Training_view}}".
 *
 * @property int $Train_Detail_ID
 * @property string $Course_ID
 * @property string $Course_Name
 * @property string $Trainer_ID
 * @property string $Trainner_Name
 * @property string $Location_ID
 * @property string $Location_Name
 * @property float|null $Course_Cost
 * @property string|null $Document_ID
 * @property string|null $Start_Train_Date
 * @property string|null $End_Train_Date
 */
class TrainingView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%USRP_Training_view}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Train_Detail_ID', 'Course_ID', 'Course_Name', 'Trainer_ID', 'Trainner_Name', 'Location_ID', 'Location_Name'], 'required'],
            [['Train_Detail_ID'], 'integer'],
            [['Course_Cost'], 'number'],
            [['Start_Train_Date', 'End_Train_Date'], 'safe'],
            [['Course_ID', 'Document_ID'], 'string', 'max' => 9],
            [['Course_Name', 'Trainner_Name', 'Location_Name'], 'string', 'max' => 255],
            [['Trainer_ID', 'Location_ID'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Train_Detail_ID' => 'Train Detail ID',
            'Course_ID' => 'Course ID',
            'Course_Name' => 'Course Name',
            'Trainer_ID' => 'Trainer ID',
            'Trainner_Name' => 'Trainner Name',
            'Location_ID' => 'Location ID',
            'Location_Name' => 'Location Name',
            'Course_Cost' => 'Course Cost',
            'Document_ID' => 'Document ID',
            'Start_Train_Date' => 'Start Train Date',
            'End_Train_Date' => 'End Train Date',
        ];
    }
}
