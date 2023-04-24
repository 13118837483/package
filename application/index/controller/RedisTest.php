<?php

namespace app\index\controller;
// USE think\Db;
use app\index\model\Test as testModel;
use app\index\model\Product as ProductModel;
use app\index\service\Paixu as paixuService;
use think\cache\driver\Redis;

// use think\Cache\
use think\console\Command;
use think\console\Input;
use think\console\Output;
use Predis\Client as ddd;
use NSQClient\Access\Endpoint;

// use NSQClient\Message\Message;
use NSQClient\Contract\Message;
use NSQClient\Queue;
use think\console\command\make\Controller;

class RedisTest extends Controller
{
    //队列测试

    public function push()
    {
        $key = 'push_testss';
        $redis = new Redis();
        for ($i = 0; $i < 100; $i++) {
            $value = json_encode(['number' => rand(0, 100)]);
            if($i > 50) $key = 'sdfsdfsd';
            $redis->lPush($key, $value);
        }

    }

    public function sub()
    {
    }
}
