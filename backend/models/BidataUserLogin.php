<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bidata_user_login}}".
 *
 * @property string $user_name
 * @property string $day_str
 * @property int $app_id
 * @property string $front
 * @property int $channel_id
 * @property string $channel_name
 * @property int $department
 * @property string $manager_name
 * @property int $pay
 */
class BidataUserLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bidata_user_login}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'channel_id', 'department', 'pay'], 'integer'],
            [['user_name', 'day_str', 'front', 'manager_name'], 'string', 'max' => 25],
            [['channel_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_name' => 'User Name',
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
