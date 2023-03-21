<?php

namespace common\models;

/**
 * This is the model class for table "{{%training_detail_tb}}".
 *
 * @property int $Train_Detail_ID
 * @property string $Course_ID
 * @property string $Trainer_ID
 * @property string $Location_ID
 * @property float|null $Course_Cost
 * @property int|null $User_Total
 * @property string|null $Start_Train_Date
 * @property string|null $End_Train_Date
 * @property string|null $User_Create
 * @property string|null $Date_Create
 *
 * @property LocationTb $location
 * @property TrainnerTb $trainer
 */
class TrainingDetailTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%training_detail_tb}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Train_Detail_ID', 'Course_ID', 'Trainer_ID', 'Location_ID'], 'required'],
            [['Train_Detail_ID', 'User_Total'], 'integer'],
            [['Course_Cost'], 'number'],
            [['Start_Train_Date', 'End_Train_Date', 'Date_Create'], 'safe'],
            [['Course_ID'], 'string', 'max' => 9],
            [['Trainer_ID', 'Location_ID'], 'string', 'max' => 8],
            [['User_Create'], 'string', 'max' => 255],
            [['Course_ID', 'Location_ID', 'Train_Detail_ID', 'Trainer_ID'], 'unique', 'targetAttribute' => ['Course_ID', 'Location_ID', 'Train_Detail_ID', 'Trainer_ID']],
            [['Location_ID'], 'exist', 'skipOnError' => true, 'targetClass' => LocationTb::class, 'targetAttribute' => ['Location_ID' => 'Location_ID']],
            [['Trainer_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TrainnerTb::class, 'targetAttribute' => ['Trainer_ID' => 'Trainner_ID']],
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
            'Trainer_ID' => 'Trainer ID',
            'Location_ID' => 'Location ID',
            'Course_Cost' => 'Course Cost',
            'User_Total' => 'User Total',
            'Start_Train_Date' => 'Start Train Date',
            'End_Train_Date' => 'End Train Date',
            'User_Create' => 'User Create',
            'Date_Create' => 'Date Create',
        ];
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(LocationTb::class, ['Location_ID' => 'Location_ID']);
    }

    /**
     * Gets query for [[Trainer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrainer()
    {
        return $this->hasOne(TrainnerTb::class, ['Trainner_ID' => 'Trainer_ID']);
    }
}
