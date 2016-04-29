<?php
/**
 * Created by: luozf01@mysoft.com.cn
 * Date: 2016/4/25 10:28
 */

namespace app\modules\youxi\services\User;

use app\modules\youxi\services\Interfaces\User;
use yii\db\Connection;

class UserList implements User{
    protected $db;

    public function __construct( Connection $db, $config = [] ){
        $this->db = $db;
    }

    public function getUser(){
        var_dump( $this->db->dsn );
        echo __FILE__;
    }

}