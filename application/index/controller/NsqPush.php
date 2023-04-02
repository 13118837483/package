<?php

namespace app\index\controller;
use NSQClient\Access\Endpoint;
use NSQClient\Contract\Message;
use NSQClient\Queue;
use think\console\command\make\Controller;

class NsqPush extends Controller
{


    public function push()
    {
       
        $topic = 'teseet';
        $endpoint = new \NSQClient\Access\Endpoint('http://127.0.0.1:4161');//
        $message = (new \NSQClient\Message\Message('hello world'))->deferred(5);
        $result = \NSQClient\Queue::publish($endpoint, $topic, $message);
    }
}
