<?php

namespace app\command\controller;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use NSQClient\Access\Endpoint;
use NSQClient\Contract\Message;
use NSQClient\Queue;
use think\console\command\make\Controller;
// namespace app\index\controller;
// use NSQClient\Access\Endpoint;
// use NSQClient\Contract\Message;
// use NSQClient\Queue;
// use think\console\command\make\Controller;

/**
 * 测试NSQ消费
 */
class Nsq extends Command
{
    protected function configure()
    {
        $this->setName('nsqTest')->setDescription('Here is the remark ');
    }

    protected function execute(Input $input, Output $output)
    {
        $topic = 'test';
        $channel = 'my_channel';
        $endpoint = new \NSQClient\Access\Endpoint('http://127.0.0.1:4161');
        \NSQClient\Queue::subscribe($endpoint, $topic, $channel, function (\NSQClient\Contract\Message $message) {
            dump($message->payload());
            $message->done();
        });
    }
}
