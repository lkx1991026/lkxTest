<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%xxxxx}}".
 *
 * @property string $id
 * @property string $ mobile
 */
class Xxxxx extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%xxxxx}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile'], 'required'],
            [['mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            ' mobile' => 'Mobile',
        ];
    }
}
