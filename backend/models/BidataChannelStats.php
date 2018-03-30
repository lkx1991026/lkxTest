<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bidata_channel_stats}}".
 *
 * @property string $day_str
 * @property int $app_id
 * @property string $front
 * @property int $channel_id
 * @property string $channel_name
 * @property int $department
 * @property string $manager_name
 * @property int $pay
 * @property double $num_uv_channel
 * @property double $num_newuv_channel
 * @property double $num_channel_register
 * @property double $num_channel_apply
 * @property double $channel_new_register_apply
 * @property int $channel_all_register_apply
 * @property int $num_pv_channel
 */
class BidataChannelStats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bidata_channel_stats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'channel_id', 'department', 'pay', 'channel_all_register_apply', 'num_pv_channel'], 'integer'],
            [['num_uv_channel', 'num_newuv_channel', 'num_channel_register', 'num_channel_apply', 'channel_new_register_apply'], 'number'],
            [['day_str', 'front', 'channel_name', 'manager_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'day_str' => 'Day Str',
            'app_id' => 'App ID',
            'front' => 'Front',
            'channel_id' => 'Channel ID',
            'channel_name' => 'Channel Name',
            'department' => 'Department',
            'manager_name' => 'Manager Name',
            'pay' => 'Pay',
            'num_uv_channel' => 'Num Uv Channel',
            'num_newuv_channel' => 'Num Newuv Channel',
            'num_channel_register' => 'Num Channel Register',
            'num_channel_apply' => 'Num Channel Apply',
            'channel_new_register_apply' => 'Channel New Register Apply',
            'channel_all_register_apply' => 'Channel All Register Apply',
            'num_pv_channel' => 'Num Pv Channel',
        ];
    }
}
