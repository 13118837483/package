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

class Product extends Controller
{

   public function index()
   {
    $a = -3;
    $b = 4;
    echo $b|$a;
      
   function aa($a = 2,$b = 3,$c)
      {
         static $count = 1;
         // $count = 1;
         $count = $count +20;
         // return $count ++;

      }  
   // aa(1);
   // echo $count;
      }

      public function aa()
      {
         static $count = 0;
         return $count ++;

      }  

   public function getChar($num)  // $num为生成汉字的数量
   {
     
      // $b = '';
      // for ($i = 0; $i < $num; $i++) {
      //    // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
      //    $a = chr(mt_rand(0xB0, 0xD0)) . chr(mt_rand(0xA1, 0xF0));
      //    // 转码
      //    $b .= iconv('GB2312', 'UTF-8', $a);
      // }
      // if($num != 3) $b = $b
      // use  . '465165456';
      // return $b;
   }
   public function pai()
   {
//       $client = new ddd();
// $client->set('foo', 'bar');
// $value = $client->get('foo');
// $topic = 'test';
// $endpoint = new \NSQClient\Access\Endpoint('http://127.0.0.1:4161');
// $message = (new \NSQClient\Message\Message('hello world'))->deferred(5);
// $result = \NSQClient\Queue::publish($endpoint, $topic, $message);
$topic = 'test';
$channel = 'my_channel';
$endpoint = new \NSQClient\Access\Endpoint('http://127.0.0.1:4161');
\NSQClient\Queue::subscribe($endpoint, $topic, $channel, function (\NSQClient\Contract\Message $message) {
    dump($message->payload);
    // make done
   //  $message->done();
    // make retry immediately
    // $message->retry();
    // make retry delayed in 10 seconds
    // $message->delay(10);
});
   }
}
