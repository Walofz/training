<?php

namespace common\models;

/**
 * This is the model class for table "{{%provice_tb}}".
 *
 * @property string $Provice_ID
 * @property string $Provice_Name_TH
 * @property string $Provice_Name_EN
 */
class ProviceTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%provice_tb}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Provice_ID', 'Provice_Name_TH', 'Provice_Name_EN'], 'required'],
            [['Provice_ID'], 'string', 'max' => 3],
            [['Provice_Name_TH', 'Provice_Name_EN'], 'string', 'max' => 255],
            [['Provice_ID'], 'unique'],
            [['Provice_ID', 'Provice_Name_EN', 'Provice_Name_TH'], 'unique', 'targetAttribute' => ['Provice_ID', 'Provice_Name_EN', 'Provice_Name_TH']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Provice_ID' => 'Provice ID',
            'Provice_Name_TH' => 'Provice Name Th',
            'Provice_Name_EN' => 'Provice Name En',
        ];
    }
}
