<?php

namespace common\models;

/**
 * This is the model class for table "{{%location_tb}}".
 *
 * @property string $Location_ID
 * @property string $Location_Name
 * @property string|null $Location_Description
 * @property string|null $Location_Provice
 * @property string|null $Location_Tel
 * @property string|null $User_Create
 * @property string|null $Date_Create
 *
 * @property TrainingDetailTb[] $trainingDetailTbs
 */
class LocationTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%location_tb}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Location_ID', 'Location_Name'], 'required'],
            [['Date_Create'], 'safe'],
            [['Location_ID'], 'string', 'max' => 8],
            [['Location_Name', 'Location_Description', 'User_Create'], 'string', 'max' => 255],
            [['Location_Provice'], 'string', 'max' => 3],
            [['Location_Tel'], 'string', 'max' => 11],
            [['Location_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Location_ID' => 'Location ID',
            'Location_Name' => 'Location Name',
            'Location_Description' => 'Location Description',
            'Location_Provice' => 'Location Provice',
            'Location_Tel' => 'Location Tel',
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
        return $this->hasMany(TrainingDetailTb::class, ['Location_ID' => 'Location_ID']);
    }
}
