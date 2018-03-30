<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bidata_product_stats}}".
 *
 * @property string $day_str
 * @property int $product_id
 * @property double $day_earnings
 * @property int $apply_num
 * @property double $one_apply_earning
 */
class BidataProductStats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bidata_product_stats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'apply_num'], 'integer'],
            [['day_earnings', 'one_apply_earning'], 'number'],
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
            'product_id' => 'Product ID',
            'day_earnings' => 'Day Earnings',
            'apply_num' => 'Apply Num',
            'one_apply_earning' => 'One Apply Earning',
        ];
    }
}
