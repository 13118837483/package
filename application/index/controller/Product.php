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
use Predis\Client;
use think\console\command\make\Controller;

class Product extends Controller
{

   public function index()
   {
      $get = input('get.');
      //    halt($get);
      $data = testModel::where(['id' => ['<', 1000]])->select();
      for ($i = 0; $i < 1000; $i++) {
         $name = $this->getChar(3);
         $passwordName = $this->getChar(2);

         // dump($passwordName);
         testModel::create([
            'user_name' => $name,
            'password' => $passwordName,
            'age' => $i,
         ]);
      }
      return json($data);
   }

   public function getChar($num)  // $num为生成汉字的数量
   {
      $b = '';
      for ($i = 0; $i < $num; $i++) {
         // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
         $a = chr(mt_rand(0xB0, 0xD0)) . chr(mt_rand(0xA1, 0xF0));
         // 转码
         $b .= iconv('GB2312', 'UTF-8', $a);
      }
      if($num != 3) $b = $b . '465165456';
      return $b;
   }
   public function pai()
   {
      $arr = [100,50,1,2,45,8];
      $service = new paixuService();
   
      $data = $service->bubble_sort($arr);
      dump($data);
      $serv = $service->new_sort($arr);
      halt($serv);
   }
}
