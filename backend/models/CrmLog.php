<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%crm_log}}".
 *
 * @property string $id
 * @property string $manager_name
 * @property string $manager_id
 * @property int $op_type 操作类型 (1.添加,2更新,3删除)
 * @property string $op_content 具体的操作内容
 * @property string $ip
 * @property int $created_at
 * @property string $route 访问路由
 */
class CrmLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%crm_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manager_id', 'op_type', 'op_content', 'ip', 'created_at', 'route'], 'required'],
            [['manager_id', 'created_at'], 'integer'],
            [['op_content'], 'string'],
            [['manager_name'], 'string', 'max' => 50],
            [['op_type'], 'string', 'max' => 4],
            [['ip'], 'string', 'max' => 15],
            [['route'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manager_name' => 'Manager Name',
            'manager_id' => 'Manager ID',
            'op_type' => 'Op Type',
            'op_content' => 'Op Content',
            'ip' => 'Ip',
            'created_at' => 'Created At',
            'route' => 'Route',
        ];
    }
}
