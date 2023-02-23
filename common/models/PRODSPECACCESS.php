<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "PRODSPECACCESS".
 *
 * @property string $USER_ID
 * @property string|null $USER_NAME
 * @property string|null $USER_POSITION
 * @property string|null $USER_PERMISSION_CODE
 * @property string|null $User_Create
 * @property string|null $Date_Create
 */
class PRODSPECACCESS extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PRODSPECACCESS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USER_ID'], 'required'],
            [['USER_POSITION'], 'string'],
            [['Date_Create'], 'safe'],
            [['USER_ID', 'User_Create'], 'string', 'max' => 50],
            [['USER_NAME'], 'string', 'max' => 100],
            [['USER_PERMISSION_CODE'], 'string', 'max' => 255],
            [['USER_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'USER_ID' => 'User ID',
            'USER_NAME' => 'User Name',
            'USER_POSITION' => 'User Position',
            'USER_PERMISSION_CODE' => 'User Permission Code',
            'User_Create' => 'User Create',
            'Date_Create' => 'Date Create',
        ];
    }
}
