<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property int $document_id
 * @property string $document_code
 * @property string $document_name
 * @property string|null $document_name_short
 * @property string|null $document_detail
 * @property int|null $document_status_id
 * @property int|null $document_type_id
 * @property int|null $document_part_id
 * @property int|null $document_department_id
 * @property int|null $document_document_menu_id
 * @property int|null $document_document_kaizen_id
 * @property int|null $document_document_kaizen_group
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property DocumentDar[] $documentDars
 * @property DocumentOccupyHistory[] $documentOccupyHistories
 * @property DocumentStatus $documentStatus
 * @property DocumentType $documentType
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%document}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbpg');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_code', 'document_name'], 'required'],
            [['document_code', 'document_name', 'document_name_short', 'document_detail'], 'string'],
            [['document_status_id', 'document_type_id', 'document_part_id', 'document_department_id', 'document_document_menu_id', 'document_document_kaizen_id', 'document_document_kaizen_group', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['document_status_id', 'document_type_id', 'document_part_id', 'document_department_id', 'document_document_menu_id', 'document_document_kaizen_id', 'document_document_kaizen_group', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['document_code'], 'unique'],
            [['document_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentStatus::class, 'targetAttribute' => ['document_status_id' => 'document_status_id']],
            [['document_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::class, 'targetAttribute' => ['document_type_id' => 'document_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'document_id' => 'Document ID',
            'document_code' => 'Document Code',
            'document_name' => 'Document Name',
            'document_name_short' => 'Document Name Short',
            'document_detail' => 'Document Detail',
            'document_status_id' => 'Document Status ID',
            'document_type_id' => 'Document Type ID',
            'document_part_id' => 'Document Part ID',
            'document_department_id' => 'Document Department ID',
            'document_document_menu_id' => 'Document Document Menu ID',
            'document_document_kaizen_id' => 'Document Document Kaizen ID',
            'document_document_kaizen_group' => 'Document Document Kaizen Group',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[DocumentDars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentDars()
    {
        return $this->hasMany(DocumentDar::class, ['document_id' => 'document_id']);
    }

    /**
     * Gets query for [[DocumentOccupyHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentOccupyHistories()
    {
        return $this->hasMany(DocumentOccupyHistory::class, ['document_id' => 'document_id']);
    }

    /**
     * Gets query for [[DocumentStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentStatus()
    {
        return $this->hasOne(DocumentStatus::class, ['document_status_id' => 'document_status_id']);
    }

    /**
     * Gets query for [[DocumentType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::class, ['document_type_id' => 'document_type_id']);
    }
}
