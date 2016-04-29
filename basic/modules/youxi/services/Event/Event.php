<?php
/**
 * Created by: luozf01@mysoft.com.cn
 * Date: 2016/4/25 16:00
 */

namespace app\modules\youxi\services\Event;

use yii\base\Component;

class Event extends Component{

    const EVENT_ONE = 'abc';  //同一个事件名称，可以帮到多个handle

    /**
     * @param object $event 事件对象(yii\base\Event)  //必须有，才是一个事件handle
     */
    public function doEcho( $event ){
        print_r( $event->data );
        echo "<br>";
        echo __METHOD__;
        echo "<br>";
    }

    public static function doStaticEcho( $event ){
        echo __METHOD__;
        echo "<br>";
        $event->handled = true;  //是否终止事件

    }

}