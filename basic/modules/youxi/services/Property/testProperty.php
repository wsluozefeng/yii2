<?php
/**
 * Created by: luozf01@mysoft.com.cn
 * Date: 2016/4/25 14:24
 */

namespace app\modules\youxi\services\Property;

use yii\base\Object;

class testProperty extends Object{
    protected $_title = 'hello world';

    public function getTitle(){
        return $this->_title;
    }

    public function setTitle( $value ){
        $this->_title = trim($value);
    }
}