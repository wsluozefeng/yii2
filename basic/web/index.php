<?php
// comment out the following two lines when deployed to production

//todo 定义全局常量，Yii 支持以下三个常量：
/**
 * YII_DEBUG：标识应用是否运行在调试模式。当在调试模式下，应用会保留更多日志信息，如果抛出异常，会显示详细的错误调用堆栈。因此，调试模式主要适合在开发阶段使用，YII_DEBUG 默认值为 false。
 * YII_ENV：标识应用运行的环境，YII_ENV 默认值为 'prod'，表示应用运行在线上产品环境。
 * YII_ENABLE_ERROR_HANDLER：标识是否启用 Yii 提供的错误处理，默认为 true。
 */
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');  //标识应用运行的环境，YII_ENV 默认值为 'prod'，表示应用运行在线上产品环境。

//todo 注册 Composer 自动加载器 这个是第三方的autoloader
require(__DIR__ . '/../vendor/autoload.php');

//todo 包含 Yii 类文件, 这个里面有Yii的Autoloader，放在最后面，确保其插入的autoloader会放在最前面
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

//todo
require(__DIR__ . '/../boot/inject.php');

//todo // 加载应用主体的配置
$config = require(__DIR__ . '/../config/web.php');

//todo // 创建、配置、运行一个应用主体（  yii\web\Application 是web的应用主体 ）
(new yii\web\Application($config))->run();
