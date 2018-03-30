<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bidata_user_device}}".
 *
 * @property int $user_id
 * @property string $user_name
 * @property string $day_str
 * @property string $device_token
 * @property string $device_ip
 * @property string $registration_id
 * @property string $sim_carrier
 */
class BidataUserDevice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bidata_user_device}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['user_name', 'day_str'], 'string', 'max' => 25],
            [['device_token', 'device_ip', 'registration_id', 'sim_carrier'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'day_str' => 'Day Str',
            'device_token' => 'Device Token',
            'device_ip' => 'Device Ip',
            'registration_id' => 'Registration ID',
            'sim_carrier' => 'Sim Carrier',
        ];
    }
}
