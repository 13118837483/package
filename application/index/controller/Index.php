<?php

namespace app\index\controller;

use app\index\model\Product;
use app\index\model\Test;
use think\cache\driver\Redis;
use think\Db;


class Index
{

    protected $arr = [1, 0, 3, 9, 7, 6, 8, 4];
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }

    public function index1()
    {
        return json();
    }

    public function indexTe()
    {
        $data = Test::select();
        $productModel = new Product();
        foreach ($data  as  $v) {
            // halt($v->id);
            $is_exits = Product::where(['user_t_id' => $v->id])->find();
            if ($is_exits) continue;
            $addProductData = [];
            for ($i = 0; $i < 2; $i++) {
                $addProductData[] = [
                    'user_name' => $v->user_name,
                    'password' => $v->password,
                    'user_t_id' => $v->id,
                    'create_time' => date('Y-m-d H:i:s'),
                ];
            }
            $productModel->saveAll($addProductData);

            //    die;
        }
    }

    public function paixuPro()
    {

        $redis = new Redis();
        $redis->select(2);
        $key = 'test';
        $fieldf = 'test_field1';
        $fields = 'test_field2';
        //字符串
        // $redis->set('test','测试');
        // $redis->rm('test');
        // $redis->select(1);
        $redis->hset($key,$fields,'32erwer32');
        dump($redis->hgetall($key));
        dump($redis->hexists($key,$fieldf));

    //     $a = 'd';$b = 'c';
    //     $array = ['1','2'];
    //     $string = 's.df.sd.f';
    //     // halt($a+$b);
    //   echo 1+2+3+"3+3+3";
    // //   halt($s);
    //   $s[1] = '5';
    //   dump(1 == false);
    //   halt('1top' == 0);
    //     dump(explode('.',$string));
    //     halt(implode('',$array));
    //     // $arr = $this->arr;
        // // halt($arr);
        // $a = self::paixuService($arr);
        // halt($a);
    }
    //快速排序
    static function paixuService($data)
    {
        $count = count($data);
        for ($i=0; $i <$count-1 ; $i++) { 
            for ($j=0; $j < $count - $i - 1  ; $j++) { 
              if(
                $data[$j] > $data[$j+1]
              ){
                $t = $data[$j];
                $data[$j] = $data[$j+1];
                $data[$j+1] = $t;

              }
            }
        }
        return $data
;        // if (count($data) < 1) return $data;
        // $zhong = $data[0];
        // $left = [];
        // $rigt = [];
        // foreach ($data as $v) {
        //     if ($v < $zhong) $left[] = $v;
        //     if ($v > $zhong) $rigt[] = $v;
        // }
        // $left = self::paixuService($left);
        // $rigt = self::paixuService($rigt);
        // return array_merge($left, [$zhong], $rigt);
    }
    static function paixuServices($arr)
    {
        $count = count($arr);
        if ($count < 2) {
            return $arr;
        }
        //创建临时数组，以基准值为分界线，大于基准值的放在右侧，小鱼基准值的放在左侧
        $leftArr = $rightArr = array();
        //基准值，一般取数组第一个元素
        $middle = $arr[0];
        //循环数组与基准值比较
        for ($i = 1; $i < $count; $i++) {
            if ($arr[$i] < $middle) {
                $leftArr[] = $arr[$i];
            } else {
                $rightArr[] = $arr[$i];
            }
        }
        //递归，将左右数组排序
        $leftArr = self::paixuServices($leftArr);
        $rightArr = self::paixuServices($rightArr);

        //将排好序的临时数组合并
        return array_merge($leftArr, array($middle), $rightArr);
    }
}
