<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bidata_stats}}".
 *
 * @property string $day_str
 * @property int $app_id
 * @property string $front
 * @property int $num_pv
 * @property int $num_uv
 * @property int $num_register_user
 * @property int $num_active_user
 * @property int $num_pv_product
 * @property int $num_uv_product
 * @property int $num_apply_product
 * @property int $num_click_director
 * @property int $num_uv_director
 * @property int $num_contact_director
 * @property int $num_click_creditcard
 * @property int $num_uv_creditcard
 * @property int $num_apply_creditcard
 */
class BidataStats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bidata_stats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'num_pv', 'num_uv', 'num_register_user', 'num_active_user', 'num_pv_product', 'num_uv_product', 'num_apply_product', 'num_click_director', 'num_uv_director', 'num_contact_director', 'num_click_creditcard', 'num_uv_creditcard', 'num_apply_creditcard'], 'integer'],
            [['day_str', 'front'], 'string', 'max' => 25],
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
            'num_pv' => 'Num Pv',
            'num_uv' => 'Num Uv',
            'num_register_user' => 'Num Register User',
            'num_active_user' => 'Num Active User',
            'num_pv_product' => 'Num Pv Product',
            'num_uv_product' => 'Num Uv Product',
            'num_apply_product' => 'Num Apply Product',
            'num_click_director' => 'Num Click Director',
            'num_uv_director' => 'Num Uv Director',
            'num_contact_director' => 'Num Contact Director',
            'num_click_creditcard' => 'Num Click Creditcard',
            'num_uv_creditcard' => 'Num Uv Creditcard',
            'num_apply_creditcard' => 'Num Apply Creditcard',
        ];
    }
}
