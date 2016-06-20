<?php
/**
 * User: luozf01
 * Date: 2016/4/12 15:45
 */

namespace app\modules\youxi\controllers;

use app\modules\youxi\services\User\UserDetail;
use app\modules\youxi\services\Event\Event;
use app\modules\youxi\services\Property\testProperty;
use yii\web\Controller;

class TestController extends Controller{
    private $userDetail;

    /**
     * 构造方法注入di
     * @param string $id                必须有
     * @param \yii\base\Module $module  必须有
     * @param UserDetail $userDetail    依赖关系
     * @param array $config
     */
    public function __construct($id, $module, UserDetail $userDetail, $config = [] ){
        $this->userDetail = $userDetail;
        parent::__construct($id, $module, $config);
    }

    public function actionTest(){
        //$userRep = \yii::createObject( 'app\repositories\Repository' );   //todo createObject方法是通过调用$container的get方法实现
        $userRep = \yii::$container->get( 'app\repositories\Repository' );  //todo 通过$container容器直接获取类的实例
        $userRep->test();
    }

    public function actionTest2(){
        \yii::$container->set( 'yii\db\Connection', \yii::$app->getDb() );  //依赖关系注册
        $listObj = \yii::$container->get('app\modules\youxi\services\User\UserList');

        $listObj->getUser();
    }

    public function actionTest3(){
        $this->userDetail->getUser();
    }

    /**
     * yii\base\Object 对象非公用属性的调用
     */
    public function actionTest4(){
        $m = new testProperty();
        echo $m->title;
        $m->title = 'is me';
        echo $m->title;
    }

    public function actionEvent(){

        //为同一个事件Event::EVENT_ONE 绑定多个handle处理事件，默认是谁先绑谁先触发，可以使用第四个参数来改变，如果第四个参数设置成false，则该handle是第一个触发
        \yii::$container->on( Event::EVENT_ONE, [new Event(), 'doEcho'], ['abc','123'] ); //对象非静态方法事件绑定, 第三个参数是给handle的参数
        \yii::$container->on( Event::EVENT_ONE, ['app\modules\youxi\services\Event\Event', 'doStaticEcho'], null, false );  //对象静态方法事件绑定, 还有全局和匿名函数方式绑定,

        \yii::$container->trigger(Event::EVENT_ONE);  //触发事件
    }

    public function actionGo(){
        return $this->render('go');
    }

    public function actionMongodb()
    {
        \Yii::$app->cache->monSetDb('ajia')->monSetCollection('my_collection');
        $document = array(
            "title" => "MongoDB",
            "description" => "database",
            "likes" => 100,
            "url" => "http://www.runoob.com/mongodb/",
            "by", "菜鸟教程"
        );
        $tmp = \Yii::$app->cache->add('',$document);
        var_dump($tmp);
        exit();
    }
}