<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wxx_city}}".
 *
 * @property string $id 行政区划代码
 * @property int $p_id 上级代码
 * @property int $type 0国 1省 2市 3县
 * @property string $name 城市名称
 * @property string $full_name 城市全称
 * @property string $index
 * @property string $short_index
 * @property string $full_index
 * @property int $capital 省会
 */
class WxxCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxx_city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_id', 'type'], 'required'],
            [['p_id'], 'integer'],
            [['type'], 'string', 'max' => 4],
            [['name', 'full_name'], 'string', 'max' => 128],
            [['index', 'capital'], 'string', 'max' => 1],
            [['short_index'], 'string', 'max' => 10],
            [['full_index'], 'string', 'max' => 32],
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
            'type' => 'Type',
            'name' => 'Name',
            'full_name' => 'Full Name',
            'index' => 'Index',
            'short_index' => 'Short Index',
            'full_index' => 'Full Index',
            'capital' => 'Capital',
        ];
    }
	static public function rule($cate , $lefthtml = '— ' , $pid=0 , $lvl=0, $leftpin=0 ){
		$arr=array();
		foreach ($cate as $v){
			if($v['pid']==$pid){
				$v['lvl']=$lvl + 1;
				$v['leftpin']=$leftpin + 0;//左边距
				$v['lefthtml']=str_repeat($lefthtml,$lvl);
				$arr[]=$v;
				$arr= array_merge($arr,self::rule($cate,$lefthtml,$v['id'],$lvl+1 , $leftpin+20));
			}
		}
		return $arr;
	}
}
