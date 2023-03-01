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


function json($data){
//   halt($data);
return json_encode($data,JSON_UNESCAPED_UNICODE);
}

function obj_to_arr($data){
    halt($data);
    return json_decode(json_encode($data));
}
function jsonData($code = 1, $msg = '', $data = [])
{
    //code 0代表错误，1代表成功
    $codeV = ['error','success'];
    return json_encode(['code' => $codeV[$code],'msg'=>$msg,'data'=>$data],JSON_UNESCAPED_UNICODE);
}