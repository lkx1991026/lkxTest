<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%channel}}".
 *
 * @property string $id
 * @property string $name 渠道名称
 * @property string $sort 排序
 * @property int $active 有效位  0=无效 1=有效
 * @property string $cid product.id或者info.id
 * @property string $link 渠道链接
 * @property string $qrcode_url 二维码地址
 * @property int $front 前端类型 0=pc 1=wap 2=ios 3=android 4wechat
 * @property int $page 0=首页，1=产品列表页，2=经理列表页，3=资讯列表页，4=产品详情页，5=经理详情页，6=资讯详情页
 * @property int $department 部门
 * @property int $pay 是否收费
 * @property string $user_id 使用者
 */
class Channel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%channel}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sort', 'active', 'front', 'page', 'department', 'pay', 'user_id'], 'required'],
            [['sort', 'cid', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['active', 'front', 'page', 'department', 'pay'], 'string', 'max' => 1],
            [['link', 'qrcode_url'], 'string', 'max' => 128],
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
            'sort' => 'Sort',
            'active' => 'Active',
            'cid' => 'Cid',
            'link' => 'Link',
            'qrcode_url' => 'Qrcode Url',
            'front' => 'Front',
            'page' => 'Page',
            'department' => 'Department',
            'pay' => 'Pay',
            'user_id' => 'User ID',
        ];
    }
}
