<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user_count}}".
 *
 * @property string $id
 * @property string $time 时间
 * @property string $user_id 用户 id
 * @property string $channel_id 渠道 id
 * @property string $city_id 城市 id
 * @property int $front 前端类型 0=pc 1=wap 2=ios 3=android
 * @property int $type
 * @property string $ip IP地址
 * @property int $app_id
 */
class UserCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_count}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db3');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'user_id', 'channel_id', 'city_id', 'front', 'type', 'ip', 'app_id'], 'required'],
            [['time', 'user_id', 'channel_id', 'city_id'], 'integer'],
            [['front', 'type'], 'string', 'max' => 1],
            [['ip'], 'string', 'max' => 15],
            [['app_id'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'user_id' => 'User ID',
            'channel_id' => 'Channel ID',
            'city_id' => 'City ID',
            'front' => 'Front',
            'type' => 'Type',
            'ip' => 'Ip',
            'app_id' => 'App ID',
        ];
    }
}
