<?php
/**
 * Created by: luozf01@mysoft.com.cn
 * Date: 2016/4/25 10:49
 */

namespace app\modules\youxi\services\User;

use app\modules\youxi\services\Interfaces\User;

class UserDetail implements User{
    private $userList;

    /**
     * 构造方法注入di
     * @param UserList $userList
     */
    /*public function __construct( UserList $userList ){
        $this->userList = $userList;
    }*/

    //todo 需要提前注册好依赖关系，接口类和抽象类作为依赖关系的情况
    public function __construct( User $user ){
        $this->userList = $user;
    }

    public function getUser(){
        //echo __FILE__;
        $this->userList->getUser();
    }
}