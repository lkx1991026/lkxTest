<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bidata_channel_apply}}".
 *
 * @property string $id
 * @property string $user_name
 * @property int $product_id
 * @property string $day_str
 * @property int $app_id
 * @property string $front
 * @property int $channel_id
 * @property string $channel_name
 * @property int $department
 * @property string $manager_name
 * @property int $pay
 */
class BidataChannelApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bidata_channel_apply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'app_id', 'channel_id', 'department', 'pay'], 'integer'],
            [['user_name', 'day_str', 'front'], 'string', 'max' => 25],
            [['channel_name', 'manager_name'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'product_id' => 'Product ID',
            'day_str' => 'Day Str',
            'app_id' => 'App ID',
            'front' => 'Front',
            'channel_id' => 'Channel ID',
            'channel_name' => 'Channel Name',
            'department' => 'Department',
            'manager_name' => 'Manager Name',
            'pay' => 'Pay',
        ];
    }
}
