<?php

namespace app\command\controller;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use NSQClient\Access\Endpoint;
use NSQClient\Contract\Message;
use NSQClient\Queue;
use think\console\command\make\Controller;
use think\cache\driver\Redis;

// namespace app\index\controller;
// use NSQClient\Access\Endpoint;
// use NSQClient\Contract\Message;
// use NSQClient\Queue;
// use think\console\command\make\Controller;

/**
 * redis消费
 */
class RedisTest extends Command
{
    protected function configure()
    {
        $this->setName('redisSub')->setDescription('Here is the remark ');
    }

    protected function execute(Input $input, Output $output)
    {

        while (true) {
            $key = 'push_test';
            $redis = new Redis();
            $data = $redis->brPop([$key,'push_testss','sdfsdfsd'], 0);
            dump($data);
        }

    }

    public function sub()
    {


    }
}
