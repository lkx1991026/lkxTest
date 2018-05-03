<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%department}}".
 *
 * @property string $id
 * @property int $area_id 区域ID
 * @property string $name 部门名称
 * @property string $description 部门描述
 * @property string $create_time 创建时间
 * @property int $deleted 是否删除 0/是 1/否
 * @property int $p_id 父级id
 * @property string $parent_ids
 * @property string $icon 树结构图标
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id', 'p_id'], 'integer'],
            [['create_time'], 'safe'],
            [['name', 'description', 'deleted', 'parent_ids', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_id' => 'Area ID',
            'name' => 'Name',
            'description' => 'Description',
            'create_time' => 'Create Time',
            'deleted' => 'Deleted',
            'p_id' => 'P ID',
            'parent_ids' => 'Parent Ids',
            'icon' => 'Icon',
        ];
    }
}
