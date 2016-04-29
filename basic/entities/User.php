<?php
/**
 * User: luozf01
 * Date: 2016/4/7 16:21
 */

namespace app\entities;

use yii\db\ActiveRecord;

class User extends ActiveRecord{

    //AR 用一个 yii\db\Connection 对象与数据库交换数据。 默认的，它使用 db 组件作为其连接对象
    /**
     * 必须实现该方法
     * @return string 返回该AR类关联的数据表名
     */
    public static function tableName(){
        return 'yii_user';
    }

    /*public static function getDb(){
        //todo 如果需要使用其他的db连接，可以重写ActiveRecord的getDb方法
        return \yii::$app->get('db2');
    }*/

}