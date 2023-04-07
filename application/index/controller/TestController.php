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
     *
     * 对于大流量网站 如何优化
     * 1.负载均衡，流量分流到不同服务器
     * 2.控制大文件下载
     * 3.数据库使用读写分流 一主多从
     * 4.定位慢查询进行优化
     * 5.使用缓存避免频繁访问数据库
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