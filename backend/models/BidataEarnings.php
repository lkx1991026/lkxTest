<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bidata_earnings}}".
 *
 * @property string $day_str
 * @property int $num_uv
 * @property int $num_register_user
 * @property int $num_active_user
 * @property int $num_pv_product
 * @property int $num_uv_product
 * @property int $num_apply_product
 * @property double $platform_day_earnings
 * @property double $each_uv_earnings
 * @property double $each_apply_earnings
 */
class BidataEarnings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bidata_earnings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_uv', 'num_register_user', 'num_active_user', 'num_pv_product', 'num_uv_product', 'num_apply_product'], 'integer'],
            [['platform_day_earnings', 'each_uv_earnings', 'each_apply_earnings'], 'number'],
            [['day_str'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'day_str' => 'Day Str',
            'num_uv' => 'Num Uv',
            'num_register_user' => 'Num Register User',
            'num_active_user' => 'Num Active User',
            'num_pv_product' => 'Num Pv Product',
            'num_uv_product' => 'Num Uv Product',
            'num_apply_product' => 'Num Apply Product',
            'platform_day_earnings' => 'Platform Day Earnings',
            'each_uv_earnings' => 'Each Uv Earnings',
            'each_apply_earnings' => 'Each Apply Earnings',
        ];
    }
}
