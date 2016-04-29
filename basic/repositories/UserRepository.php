<?php
/**
 * User: luozf01
 * Date: 2016/4/7 15:46
 */

namespace app\repositories;

use app\entities\User;

class UserRepository extends Repository{

    public function getAllUsers(){
        //return User::find()->all();
        return User::findOne('6');
    }

    public function getUsers( $condition = [] ){
        //$userObj = new User();

        if( empty( $condition ) ){
            return $this->getAllUsers();
        }else{
            return User::find()->where($condition)->all();
        }

    }

    public function test(){
        echo __FILE__;
        echo time();
    }

}