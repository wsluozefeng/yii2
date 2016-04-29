<?php
/**
 * User: luozf01
 * Date: 2016/4/1 14:05
 */

namespace app\controllers;

use yii\web\Controller;    //todo web的控制器必须继承该类，最终才能继承yii\base\Controller
//use app\models\ContactForm;  //todo 如果不引入，直接通过类名访问，则需要从跟路径起算命名空间 line28
//use yii\db\Query;
use app\entities\User;
use app\repositories\UserRepository;

class HelloController extends Controller{

    //URL访问：http://www.yii.com/index.php?r=hello&name=123
    public function actionIndex( $name = '' ){
        //$this->layout = 'me';  //todo 指定其他的布局 默认是main

        //todo 操作的内容最终需要返回给请求的客户端，需要return， 另外视图的文件存在路径是： views/控制器名（去掉Controller，且小写）/视图名.php (也就是 @app/views/ControllerID/ 下面)
        //如果控制器为PostCommentController，则需要在/views/post-comment/之下
        return $this->render( 'hello_view', [ 'name'=>$name ] );
        //echo "param name is {$name}";
    }

    //URL访问：http://www.yii.com/index.php?r=hello/list
    public function actionList(){

        //$m = new ContactForm;  //实例化模型
        $m = new \app\models\ContactForm;  //实例化模型

        //todo 对象形式访问模型属性
        $m->name = 'ajia';
        echo $m->name;

        //todo 数组形式访问模型属性
        $m['email'] = 'youxi@163.com';
        echo $m['email'];

        //todo 迭代器遍历模型，由于yii\base\Model支持 ArrayAccess 数组访问 和 ArrayIterator 数组迭代器
        foreach( $m as $theName => $theValue ){
            echo "param {$theName} value is {$theValue} <br>";
        }

        echo time();
    }

    public function actionDbOperate(){

        //todo 不依赖配置，独立生成db连接句柄 之一
        /*$connection2 = new \yii\db\Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii',
            'username' => 'root',
            'password' => ''
        ]);
        $connection2->open();*/  //连接
        //var_dump($connection->dsn);

        //todo 不依赖配置，独立生成db连接句柄 之二
        /*$config = [
            'class'    => '\yii\db\Connection',
            'dsn'      => 'mysql:host=localhost;dbname=yii',
            'username' => 'root',
            'password' => ''
        ];
        $c = \Yii::createObject( $config );  //获取 \yii、\YII都可以
        $c->open();
        $sa = $c->getSchema();
        $tables = $sa->getTableNames();
        var_dump($tables);exit;*/

        //$connection = \Yii::$app->db;
        $connection = \Yii::$app->getDb();

        //todo 只执行sql语句（insert，update，delete），返回受影响函数
        /*$sql     = "insert into user VALUE (null, 'ajia', 18)";
        //$sql     = "update user set name='youxi' where id = 2";
        $command = $connection->createCommand( $sql );
        $rel     = $command->execute();
        echo $command->getRawSql();exit;*/

        $command = $connection->createCommand(); //todo 启用同一个command对象 才能获取语句
        //$rel = $command->insert( 'user', [ 'name'=>'youxi', 'age'=>rand(1,999) ] )->execute();  //单条记录添加
        /*
        $rel = $command->batchInsert( 'user', ['name','age'], [
            ['xiaotou', rand(1,999)], ['zinai', rand(1,999)]
        ] )->execute();   //多条记录添加
        $theSql = $command->getRawSql();*/


        /*
        $rel    = $command->update( 'user', ['age'=>199], 'id in (3,4)' )->execute();  //更新记录
        $theSql = $command->getRawSql();

        //$rel = $connection->createCommand()->delete( 'user', 'id in (1,2)' )->execute();  //删除记录*/
        //var_dump($theSql);

        /*$sql     = 'show create table user';
        $command = $connection->createCommand( $sql );  //todo 通过yii\db\Command 执行sql
        $data    = $command->queryOne();
        //echo $command->getRawSql();*/  //todo 获取原始的sql语句，getSql()则是获取通过param参数加工过的sql语句

        //echo $connection->getLastInsertID();  //todo 在createCommand（）之后执行"插入数据"操作后，可通过$connection来获取最后一个插入的id


        $s = $connection->getSchema();
        //$r = new \ReflectionClass($s);
        //\Reflection::export($r);
        //echo $r->getFileName();exit;

        print_r($s->getTableNames());
        //var_dump($s);

        //print_r($data);

    }

    /**
     * 查询构建器
     * @throws \yii\db\Exception
     */
    public function actionQuery(){
        /*$command = ( new \yii\db\Query() )->createCommand();  //todo 等效于 \yii::$app->getDb()->createCommand() 或者 \yii::$app->db->createCommand()， createCommand() 能接收一个数据库连接对象 来切换数据库，同时此createCommand方法将由“查询构建器”变回常规的db查询，使用queryOne、queryAll等函数
        $query = $command->insert( 'user', [ 'name'=>'iii', 'age'=>rand(1,999) ] )->execute();
        echo $command->getRawSql();*/

        $data = ( new \yii\db\Query() )->select(['id', 'name'])
            ->from('user')
            //->where( 'id in( 5,6 ) and name like "%aji%"' )  //字符串形式
            ->where([ 'id'=>[5,6] ])  //哈希形式
            ->andWhere(['like', 'name', 'ajia'])  //操作符号形式
            ->all();
        print_r($data);

    }

    /**
     * AR
     */
    public function actionAr(){

        \yii::info('----------6666-------');
        /*$userObj       = new User();
        $userObj->name = 'dalao';
        $userObj->age  = 100;
        $rel           = $userObj->save();*/

        /*$rel = $userObj->getDb()->createCommand()->insert( 'ajia', ['order_no' => '856233454'] )->execute();
        var_dump($rel);*/

        $data = User::findOne('1');
        //$data = User::findBySql('select * from user where id = 6')->all();
        print_r($data);
        exit;

        $userReObj = new UserRepository();
        $data      = $userReObj->getAllUsers();

        var_dump($data);

    }

    /**
     * 日志
     */
    public function actionLog(){
        /*$l = \yii::getLogger();
        var_dump($l);exit;*/

        /*$tmp = \yii::$app->log->targets['info_log'];  //todo 返回的是logger对象
        var_dump($tmp);exit;*/

        $a = \yii::trace('----------trace-------');
        var_dump($a);
        exit;
    }

    public function actionEcharts(){
        return $this->render('echarts');
    }
}