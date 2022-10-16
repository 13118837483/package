<?php

namespace app\index\controller;
// USE think\Db;
use app\index\model\Test as testModel;
use app\index\model\Product as ProductModel;
use think\cache\driver\Redis;
// use think\Cache\
use think\console\Command;
use think\console\Input;
use think\console\Output;
use Predis\Client;

class Newss extends Command
{
    // public function index()ee
    // {ertertertre
    //     $data = ProductModel::select();
    //     // ProductModel::create([
    //     //     'name' => '测试数据库名称',sdfsd
    //     //     'round' => '1212'
    //     // ]);
    //     // $data = ProductModel::select();ddd
    //     // foreach($data as &$v){
    //     //     $v = $v->toArray();
    //     // }

    //     // // halt($data);
    //     // return json($data);
    //     // $addArr = [
    //     //     'user_name' => '测试数据库名称',
    //     // ];
    // for ($i=0; $i < 10; $i++) { 
    //     ProductModel::create([
    //         'user_name' => '测试数据库名称',
    //         'name' => '测试数据库名称',
    //         'avc' => '测试数据库名称',
    //         'adsf' => '测试数据库名称',
    //         'wer' => '测试数据库名称',
    //         'rtyrt' => '测试数据库名称',
    //         'ghj' => '测试数据库名称',
    //         'password' => '测试数据库名称',
    //         'ertertr' => '测试数据库名称',
    //         'vcg' => '测试数据库名称',
    //         'zxc' => '测试数据库名称',
    //         'hgf' => '测试数据库名称',
    //         'sdf' => '测试数据库名称',
    //         'werwer' => '测试数据库名称',
    //         'werweeer' => '测试数据库名称',
    //         'weeeeer' => '测试数据库名称',
    //         'werwe' => '测试数据库名称',

    //     ]);
    // }
    // return true;
    //     // $redis = new Redis();
    //     // $redis->set('huaneddg','fdsfsdfsdfswrwerwerwerwerdfsd');
    //     // $data = $redis->get('huaneddg');
    //     // halt($data);
    //     // $model = new testModel();
    //     // halt('dd');
    //     // $data = $model::where(['id' => 1])->find();
    //     // return json($data);
    // }
    protected function configure()
    {
        $this->setName('productTest')->setDescription('Here is the remark ');
    }

    protected function execute(Input $input, Output $output)
    {
        for ($i = 0; $i < 1000000; $i++) {
            dump($i);
            
            ProductModel::create([
                'user_name' => '测试数据库名称',
                'name' => '测试数据库名称',
                'avc' => '测试数据库名称',
                'adsf' => '测试数据库名称',
                'wer' => '测试数据库名称',
                'rtyrt' => '测试数据库名称',
                'ghj' => '测试数据库名称',
                'password' => '测试数据库名称',
                'ertertr' => '测试数据库名称',
                'vcg' => '测试数据库名称',
                'zxc' => '测试数据库名称',
                'hgf' => '测试数据库名称',
                'sdf' => '测试数据库名称',
                'werwer' => '测试数据库名称',
                'werweeer' => '测试数据库名称',
                'weeeeer' => '测试数据库名称',
                'werwe' => '测试数据库名称',

            ]);
        }
    }
}
