<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


function json($data,$code = 0,$msg = 'success')
{

    return json_encode(['code' => $code,'data' =>$data,'msg' => $msg]);
}
// function json1($data = [], $code = 0, $msg = '')
//{
//    halt($data);
//    if (empty($msg)) {
//        if ($code == 0) {
//            $msg = 'success';
//        }
//    }
//
//    return ['code' => $code, 'msg' => $msg, 'data' => $data];
//}

function obj_to_arr($data)
{
    halt($data);
    return json_decode(json_encode($data));
}

function jsonData($code = 1, $msg = '', $data = [])
{
    //code 0代表错误，1代表成功
    $codeV = ['error', 'success'];
    return json_encode(['code' => $codeV[$code], 'msg' => $msg, 'data' => $data], JSON_UNESCAPED_UNICODE);
}
function GuzzleHttpClient($method,$url,$data = []){
    $client = new \GuzzleHttp\Client;
//        //2是商城页面
//        $response = $client->post("http://laravel.cn:81/index.php/user",[
//            'body' => [
//                'email' => 'test@gmail.com',
//                'name' => 'Test user',
//                'password' => 'testpassword',
//            ]
//
//        ]);
//        $result = $response->getBody()->getContents();
//        $result = json_decode($result, true);
//        halt($result);
//        $url = "http://laravel.cn:81/index.php/user";
//        $data =  ['json' =>[
//                'email' => 'test@gmail.com',
//                'name' => 'Test user',
//                'password' => 'testpassword',
//            ]];
//        $request = $client->request(
//            'POST',
//            $url,
//           $data
//        );
////        $response = $client->send($request);
//        $content = $request->getBody()->getContents();
//        halt(json_decode($content,true));
    $response = $client->post("http://laravel.cn:81/index.php/user", [
        'json' => [
            'name' => '张三',//参数
        ]
    ]);
    $result = $response->getBody()->getContents();
    $result = json_decode($result, true);
}
