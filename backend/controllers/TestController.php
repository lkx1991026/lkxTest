<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/26
 * Time: 11:16
 */
namespace backend\controllers;

use yii\web\Controller;

class TestController extends Controller
{
	public function actionIndex(){
		return $this->render('index');
	}
}