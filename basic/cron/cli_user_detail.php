<?php
/**
 * Created by: luozf01@mysoft.com.cn
 * Date: 2016/4/25 11:27
 */

defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../boot/inject.php');
$config = require(__DIR__ . '/../config/web.php');
$app = new yii\web\Application($config);
$obj = yii::$container->get('app\modules\youxi\services\User\UserDetail');
//print_r($argv);  //cli下的php获取参数
$obj->getUser();