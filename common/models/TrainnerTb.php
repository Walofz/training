<?php

namespace common\models;

/**
 * This is the model class for table "{{%trainner_tb}}".
 *
 * @property string $Trainner_ID
 * @property string $Trainner_Name
 * @property string|null $Trainner_Descrition
 * @property string|null $Trainner_From
 * @property string|null $User_Create
 * @property string|null $Date_Create
 *
 * @property TrainingDetailTb[] $trainingDetailTbs
 */
class TrainnerTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%trainner_tb}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Trainner_ID', 'Trainner_Name'], 'required'],
            [['Date_Create'], 'safe'],
            [['Trainner_ID'], 'string', 'max' => 8],
            [['Trainner_Name', 'Trainner_Descrition', 'Trainner_From', 'User_Create'], 'string', 'max' => 255],
            [['Trainner_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Trainner_ID' => 'Trainner ID',
            'Trainner_Name' => 'Trainner Name',
            'Trainner_Descrition' => 'Trainner Descrition',
            'Trainner_From' => 'Trainner From',
            'User_Create' => 'User Create',
            'Date_Create' => 'Date Create',
        ];
    }

    /**
     * Gets query for [[TrainingDetailTbs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingDetailTbs()
    {
        return $this->hasMany(TrainingDetailTb::class, ['Trainer_ID' => 'Trainner_ID']);
    }
}
