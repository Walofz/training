<?php

namespace common\models;

/**
 * This is the model class for table "{{%qry_EmpInfo_emp_all}}".
 *
 * @property string $PRS_NO
 * @property string $PRI_START_D
 * @property int $EMP_KEY
 * @property string $EMP_INTL
 * @property string $EMP_NAME
 * @property string $EMP_SURNME
 * @property string|null $EMP_E_NAME
 * @property int|null $EMP_GENDER
 * @property string|null $EMP_I_CARD
 * @property string|null $EMP_I_EXPIRE
 * @property string|null $EMP_EMAIL
 * @property string|null $PRS_E_CARD
 * @property string $JBT_THAIDESC
 * @property string|null $PRS_LOAN_C
 * @property int $PRI_STATUS
 * @property int $PRI_SAL_TY
 * @property string|null $EMP_BIRTH
 * @property float $PRI_SALARY
 * @property string|null $Dept
 * @property string $Sec
 * @property string $DEPT_CODE_Dept
 * @property string|null $DEPT_CODE_Sec
 * @property string|null $DeptName
 * @property string $SecName
 * @property string|null $PRS_SC_HSTAL
 * @property string|null $EMP_TEL
 */
class QryEmpInfoEmpAll extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%qry_EmpInfo_emp_all}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PRS_NO', 'PRI_START_D', 'EMP_KEY', 'EMP_INTL', 'EMP_NAME', 'EMP_SURNME', 'JBT_THAIDESC', 'PRI_STATUS', 'PRI_SAL_TY', 'PRI_SALARY', 'Sec', 'DEPT_CODE_Dept', 'SecName'], 'required'],
            [['PRI_START_D', 'EMP_I_EXPIRE', 'EMP_BIRTH'], 'safe'],
            [['EMP_KEY', 'EMP_GENDER', 'PRI_STATUS', 'PRI_SAL_TY'], 'integer'],
            [['PRI_SALARY'], 'number'],
            [['PRS_NO'], 'string', 'max' => 16],
            [['EMP_INTL', 'PRS_E_CARD'], 'string', 'max' => 20],
            [['EMP_NAME', 'EMP_SURNME'], 'string', 'max' => 40],
            [['EMP_E_NAME', 'EMP_EMAIL', 'JBT_THAIDESC', 'Dept', 'Sec', 'DeptName', 'SecName', 'PRS_SC_HSTAL'], 'string', 'max' => 60],
            [['EMP_I_CARD'], 'string', 'max' => 13],
            [['PRS_LOAN_C'], 'string', 'max' => 12],
            [['DEPT_CODE_Dept', 'DEPT_CODE_Sec'], 'string', 'max' => 10],
            [['EMP_TEL'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PRS_NO' => 'Prs No',
            'PRI_START_D' => 'Pri Start D',
            'EMP_KEY' => 'Emp Key',
            'EMP_INTL' => 'Emp Intl',
            'EMP_NAME' => 'Emp Name',
            'EMP_SURNME' => 'Emp Surnme',
            'EMP_E_NAME' => 'Emp E Name',
            'EMP_GENDER' => 'Emp Gender',
            'EMP_I_CARD' => 'Emp I Card',
            'EMP_I_EXPIRE' => 'Emp I Expire',
            'EMP_EMAIL' => 'Emp Email',
            'PRS_E_CARD' => 'Prs E Card',
            'JBT_THAIDESC' => 'Jbt Thaidesc',
            'PRS_LOAN_C' => 'Prs Loan C',
            'PRI_STATUS' => 'Pri Status',
            'PRI_SAL_TY' => 'Pri Sal Ty',
            'EMP_BIRTH' => 'Emp Birth',
            'PRI_SALARY' => 'Pri Salary',
            'Dept' => 'Dept',
            'Sec' => 'Sec',
            'DEPT_CODE_Dept' => 'Dept Code Dept',
            'DEPT_CODE_Sec' => 'Dept Code Sec',
            'DeptName' => 'Dept Name',
            'SecName' => 'Sec Name',
            'PRS_SC_HSTAL' => 'Prs Sc Hstal',
            'EMP_TEL' => 'Emp Tel',
        ];
    }
}
