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
use think\Db;
use NSQClient\Queue;
use think\console\command\make\Controller;
use think\Validate;

class Product extends Controller
{

    protected $model = null;
    public function __construct()
    {
        $this->model = new testModel();
    }

    //    public function index()
    //    {
    //     $a = -3;
    //     $b = 4;
    //     echo $b|$a;

    //    function aa($a = 2,$b = 3,$c)
    //       {
    //          static $count = 1;
    //          // $count = 1;
    //          $count = $count +20;
    //          // return $count ++;

    //       }  
    //    // aa(1);
    //    // echo $count;
    //       }

    //       public function aa()
    //       {
    //          static $count = 0;
    //          return $count ++;

    //       }  

    //    public function getChar($num)  // $num为生成汉字的数量
    //    {

    //       // $b = '';
    //       // for ($i = 0; $i < $num; $i++) {
    //       //    // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
    //       //    $a = chr(mt_rand(0xB0, 0xD0)) . chr(mt_rand(0xA1, 0xF0));
    //       //    // 转码
    //       //    $b .= iconv('GB2312', 'UTF-8', $a);
    //       // }
    //       // if($num != 3) $b = $b
    //       // use  . '465165456';
    //       // return $b;
    //    }
    //    public function pai()
    //    {
    // //       $client = new ddd();
    // // $client->set('foo', 'bar');
    // // $value = $client->get('foo');
    // // $topic = 'test';
    // // $endpoint = new \NSQClient\Access\Endpoint('http://127.0.0.1:4161');
    // // $message = (new \NSQClient\Message\Message('hello world'))->deferred(5);
    // // $result = \NSQClient\Queue::publish($endpoint, $topic, $message);
    // $topic = 'test';
    // $channel = 'my_channel';
    // $endpoint = new \NSQClient\Access\Endpoint('http://127.0.0.1:4161');
    // \NSQClient\Queue::subscribe($endpoint, $topic, $channel, function (\NSQClient\Contract\Message $message) {
    //     dump($message->payload);
    //     // make done
    //    //  $message->done();
    //     // make retry immediately
    //     // $message->retry();
    //     // make retry delayed in 10 seconds
    //     // $message->delay(10);
    // });
    //    }
    //新增数据
    public function save()
    {
        $data = input('post.');
        $validate = new Validate([
            'user_name'  => 'require',
            'user_password' => 'require',
            'age' => 'require',
            'product' => 'require'
        ], [
            'user_name.require'  => '名称不能为空',
            'user_password.require' => '密码不能为空',
            'age.require' => '年龄不能为空',
            'product.require' => '副表数据不能为空'
        ]);
        if (!$validate->check($data)) {
            return jsonData(0, '400', $validate->getError());
        }
        Db::startTrans();
        try {
            $saveUser = $this->model::create([
                'user_name' => $data['user_name'],
                'user_password' => $data['user_password'],
                'age' => $data['age'],
                'create_times' => date('Y-m-d H:i:s')
            ]);
            // halt($saveUser);
            // halt($saveUser->id);
            if (!$saveUser->id) {
                Db::rollback();
                return jsonData(0, '400', '主表插入错误');
            }
            foreach ($data['product'] as &$v) {
                $v['user_t_id'] = $saveUser->id;
                $v['create_times'] = date('Y-m-d H:i:s');
            }
            model('Product')->saveAll($data['product']);
            Db::commit();
            return jsonData(1, '操作成功');
        } catch (\Exception $e) {
            Db::rollback();
            return jsonData(0, '400', '新增失败');
        }
    }
    public function update()
    {
        halt('up');
    }
    public function index()
    {
        $get = input('get.');
        $where = [];
        // halt($get['user_name']);
        $page = !empty($get['page']) ? $get['page'] : 1;
        $pageSize = !empty($get['pageSize']) ? $get['pageSize'] : 20;
      
        $this->model->join('product','user_t.id = product.user_t_id','left')
        ->group('user_t.id')->order('user_t.id','desc')
        ->page($page,$pageSize);
        
        if($get['user_t_id'] != '') $this->model->where('user_t_id',$get['user_t_id']);
        $user_id = $this->model->column('user_t.id');
        // die(Db::getLastSql());
        $data = [];
        if($user_id){
            $data = $this->model::whereIn('id',$user_id)->with(['product'])->paginate($pageSize);
        }
        return json($data);

    }
    public function read($id)
    {
        $data = $this->model::where(['id' => $id])->with(['product'])->find();
        return json($data);
    }
    public function delete()
    {
        
    }
}
