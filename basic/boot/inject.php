<?php
/**
 * \yii::$container 依赖关系注册
 * User: luozf01
 * Date: 2016/4/13 10:40
 */

//仓库类
\yii::$container->set( 'app\repositories\Repository', 'app\repositories\UserRepository' );

\yii::$container->set( 'app\modules\youxi\services\Interfaces\User', 'app\modules\youxi\services\User\UserList' );