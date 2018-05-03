<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%area}}".
 *
 * @property string $id 区域ID
 * @property string $name 名称
 * @property string $description 描述
 * @property int $deleted 是否删除 1是0否
 * @property int $pId
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%area}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'string', 'max' => 255],
            [['deleted'], 'string', 'max' => 1],
            [['pId'], 'string', 'max' => 4],
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
            'pId' => 'P ID',
        ];
    }
}
