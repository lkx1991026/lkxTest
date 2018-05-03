<?php
/**
 * Created by   lkx.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 14:50
 */
namespace console\controllers;
use yii\console\Controller;

class HelloController extends Controller{
	public function actionTest(){
		echo 'hello';
	}
}