<?php
/**
 * Created by lkx.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 14:50
 */
namespace console\controllers;
use yii\console\Controller;

class HelloController extends Controller{
	public function actionTest(){
		$win=0;
		$fail=0;
		$count=100000;
		$a=5;

		for($i=0;$i<=$count;$i++){
			$b=rand(0,100);
			if($b<$a){
				$win++;
			}else{
				$fail++;
			}
		}
		echo '总抽奖次数'.$count.'->中奖:'.$win.';未中奖:'.$fail.';概率设置'.$a.'%;测试中奖概率:'.($win/$count*100).'%';
	}
}