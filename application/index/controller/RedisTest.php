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
                $key = 'key';
               $redis = new Redis();
               $redis->lPush($key,'wrwerwerwerwewer');
               $total = $redis->lLen($key);
               dump($redis->lPop($key));
               halt($total);
        //        $data = $redis->get('ddd');
        //        halt($data);
        }
        public function sub()
        {
        }
}
