<?php

namespace app\index\controller;

use app\index\model\Product;
use app\index\model\Test;
use think\Controller;
use think\Request;

class TestController extends Controller
{
    protected $mod = null;

    function __construct(Request $request = null)
    {
        parent::__construct($request);
        //
        $this->mod = new Test();

    }
    //面试Md
    /**
     * get跟post区别
     * 1.get传参在url中  post传参在request body  在请求体
     * 2.get传参长度有限制  post没有
     * 3.get在浏览器退回的时候是无害的 post会再次请求
     * 4.get传参在url中所以不能存在敏感信息  post不会
     */


    /**
     * session跟cookie
     * HTTP是无状态的 服务器无法判断用户身份  所以需要用到cookie进行记录
     * 流程： 用户进入浏览器 浏览器进入服务器 服务器发送一个cookie给浏览器  作为用户标识符  当浏览器下次进入服务器时  会把cookie带过去给到服务器 服务器通过cookie识别到用户的信息
     * cookie特点
     * 1.cookie在服务端创建
     * 2.cookie保存在客户端
     * 3.cookie可以被多个浏览器共享
     * 4.cookie应当进行加密 不加密默认是明文形式 所以不加密就不应当存放敏感数据
     *
     * session特点
     * session是存放在服务端的 例如处理用户登录等操作
     * 流程：浏览器第一次请求服务器时  服务器会自动生成一个sessionid 并且存放起来  一般默认是三十分钟 并把sessionid待回给浏览器 再一次请求的时候就会将两次的sessionid进行对来判断用户登录限制
     * session特点
     * 1.sesion是存放在服务器内存中
     * 2.一个用户的浏览器  独享一个session对象
     * 3.服务器能够为不同的浏览器提供不同的session
     * 区别：
     * 1.session保存在服务器内存中 cookie保存在浏览器中
     * 2.cookie中的value是字符串形式  session中的value是对象
     * 3.生命周期不一样：cookie在浏览器关闭时候就消亡
     *
     * 打印客户端ip跟服务端ip
     * $_SERVER["SERVER_ADDR"]
     * $_SERVER["REMOTE_ADDR"]
     *
     * 优化MYSQL方法
     * 1.使用join连接来代替子查询
     * 2.避免使用select*
     * 3.合理使用索引
     * 4.使用内联合union来代替手动创建临时表
     * 5.避免隐式转换导致索引失效
     *
     * 对于大流量网站 如何优化
     * 1.负载均衡，流量分流到不同服务器
     * 2.控制大文件下载
     * 3.数据库使用读写分流 一主多从
     * 4.定位慢查询进行优化
     * 5.使用缓存避免频繁访问数据库
     *
     *
     *
     * MySQL常见的存储引擎InnoDB、MyISAM的区别
     *
     * 1.myisam不支持事务 innodb支持事务
     * 2.myisam储存数据总行数   innodb不存储
     * 3.myisam支持表级锁   innodb支持表锁 行锁
     * 4.MyISAM适合：插入不频繁，查询非常频繁，如果执行大量的SELECT，MyISAM是更好的选择， 没有事务。
     * 5.InnoDB适合：可靠性要求比较高，或者要求事务；表更新和查询都相当的频繁， 大量的INSERT或UPDATE
     * 6.myisam索引树为非聚集索引（叶子节点的存放的是数据的文件地址）  innodb是聚集索引（叶子节点存放的是数据本身）
     *
     *
     * mysql为什么使用B+tree
     * hash：虽然可以快速定位，但是没有顺序，IO复杂度高。
     * 二叉树：树的高度不均匀，不能自平衡，查找效率跟数据有关（树的高度），并且IO代价高。
     * 红黑树：树的高度随着数据量增加而增加，IO代价高。
     * B+TREE始终只有三层 而且是有序的 找寻起来速度较快而且io代价不高
     *
     *
     *PHP中include和require的区别详解
     * include 引入文件的时候，如果碰到错误，会给出提示，并继续运行下边的代码。---wainning错误 --需要用到的时候才需要加载 _once 代表已经加载过得文件就不需要再次加载了
     * require 引入文件的时候，如果碰到错误，会给出提示，并停止运行下边的代码。---error错误 ---一开始就进行加载
     *
     *
     * 事务四大特性（ACID）原子性、一致性、隔离性、持久性
     * 原子性：一个事务中所有操作  要么全部完成  要么全部不完成
     * 一致性：在事务开始之前和事务结束以后，数据库的完整性没有被破坏。这表示写入的资料必须完全符合所有的预设规则，这包含资料的精确度、串联性以及后续数据库可以自发性地完成预定的工作
     * 持久性: 事务处理结束后 对数据的修改是永久性的
     * 隔离性：可以多个事务并行而且互不干扰--四大隔离级别
     *     读未提交 A事务在还没有提交的过程中  读取到B事务未提交的对数据进行修改的诗句
     *     读已提交 A事务在还没有提交的过程中  读取到B事务已经提交了的数据
     *     串行化 ： 每个事务串行执行 --一个一个执行
     *     可重复度：A事务在没有提交的过程中  查询到的数据是一样的（无论B事务是否对这条数据已经修改并且提交）
     *
     * 三范式：
     *  1.数据库表中的所有字段值都是不可分解的原子值
     *  2.在第一的基础上更上一层 每一列都与主键有关系
     *  3.在第一跟第二的基础上 更上一层  每一列都跟主键有直接的关系  而不是间接关系
     *.PHP 中传值与传引用的区别。什么时候传值什么时候传引用？
       按值传递：函数范围内对值的任何改变在函数外部都会被忽略
       按引用传递：函数范围内对值的任何改变在函数外部也能反映出这些修改
     */








    /**
     * @return void
     * 面试测试
     */
    public function testFunciton()
    {
        $b = Request::instance()->session();
        halt($_SERVER);
        $data = $this->mod->with(['product'])->limit(100)->select();
        return json($data);
    }

    public function upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');//image为前端表单的名字
        // 移动到框架应用根目录/public/uploads/ 目录下
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 jpg
                echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getFilename();
            } else {
                // 上传失败获取错误信息
                //echo $file->getError();}}
            }

        }
    }
}