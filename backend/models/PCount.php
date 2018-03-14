<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%p_count}}".
 *
 * @property int $id
 * @property int $p_id 产品id
 * @property int $user_id 用户id
 * @property int $user_type 用户类型
 * @property int $time 查看时间
 * @property int $channel_id 来源渠道
 * @property int $front 前端类型 0=pc 1=wap 2=ios 3=android
 * @property string $ip ip地址
 * @property string $city_id 城市id
 * @property string $info_id 通过资讯详情页跳转过来的id
 * @property string $product_source
 * @property string $guide_id 新手指南ID 从指南详情条跳转过来啊
 * @property string $card_id
 * @property string $subject_id 专题ID 从专题条跳转过来
 * @property int $app_id
 */
class PCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%p_count}}';
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
            [['p_id', 'user_id', 'user_type', 'time', 'channel_id', 'front', 'ip', 'city_id', 'info_id', 'product_source', 'app_id'], 'required'],
            [['p_id', 'user_id', 'time', 'channel_id', 'city_id', 'info_id', 'product_source', 'guide_id', 'card_id', 'subject_id'], 'integer'],
            [['user_type', 'front'], 'string', 'max' => 1],
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
            'p_id' => 'P ID',
            'user_id' => 'User ID',
            'user_type' => 'User Type',
            'time' => 'Time',
            'channel_id' => 'Channel ID',
            'front' => 'Front',
            'ip' => 'Ip',
            'city_id' => 'City ID',
            'info_id' => 'Info ID',
            'product_source' => 'Product Source',
            'guide_id' => 'Guide ID',
            'card_id' => 'Card ID',
            'subject_id' => 'Subject ID',
            'app_id' => 'App ID',
        ];
    }
}
