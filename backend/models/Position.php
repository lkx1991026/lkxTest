<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%position}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property int $deleted
 * @property int $area_id 区域ID
 * @property int $department_id 部门ID
 * @property string $icon 树结构图标
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id', 'department_id'], 'integer'],
            [['name', 'description', 'deleted', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'deleted' => 'Deleted',
            'area_id' => 'Area ID',
            'department_id' => 'Department ID',
            'icon' => 'Icon',
        ];
    }
}
