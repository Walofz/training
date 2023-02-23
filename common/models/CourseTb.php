<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_tb".
 *
 * @property string $Course_ID
 * @property string|null $Document_ID
 * @property string $Course_Name
 * @property string|null $Course_Description
 * @property float $Course_Cost
 * @property string|null $User_Create
 * @property string|null $Date_Create
 * @property int $Course_Type
 */
class CourseTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_tb';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Course_ID', 'Course_Name', 'Course_Cost', 'Course_Type'], 'required'],
            [['Course_Cost'], 'number'],
            [['Date_Create'], 'safe'],
            [['Course_Type'], 'integer'],
            [['Course_ID'], 'string', 'max' => 8],
            [['Document_ID'], 'string', 'max' => 9],
            [['Course_Name', 'Course_Description', 'User_Create'], 'string', 'max' => 255],
            [['Course_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Course_ID' => 'Course ID',
            'Document_ID' => 'Document ID',
            'Course_Name' => 'Course Name',
            'Course_Description' => 'Course Description',
            'Course_Cost' => 'Course Cost',
            'User_Create' => 'User Create',
            'Date_Create' => 'Date Create',
            'Course_Type' => 'Course Type',
        ];
    }
}
