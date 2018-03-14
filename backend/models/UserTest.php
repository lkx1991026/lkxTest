<?php

namespace backend\models;

use function foo\func;
use Yii;

/**
 * This is the model class for table "{{%user_test}}".
 *
 * @property string $id
 * @property string $username
 * @property string $nickname
 * @property string $password_hash
 */
class UserTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_test}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['username', 'nickname', 'password_hash'], 'required'],
            [['username'], 'required','when'=>function($model){return $model->nickname=='abc';},'whenClient'=>"function (attribute, value) {
    		return $('#nickname').val() == 'abc';
			}"],
            [['username', 'nickname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'nickname' => 'Nickname',
            'password_hash' => 'Password Hash',
        ];
    }
}
