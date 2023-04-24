<?php

namespace app\index\controller;
// USE think\Db;
use app\index\model\Test as testModel;
use think\console\command\make\Controller;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

//实例化上传类

class Qiniuyun extends Controller
{

    protected $model = null;

    //七牛云图片上传
    public function save()
    {
        $image = $_FILES['image'];
        $key = rand(0, 100) . date("YmdHis") .$this->randNumber(). $image['name'];//上传的图片名字
//            halt
        $filePath = $_FILES['image']['tmp_name'];//本地图片路径
        $accessKey = config("qiniu")["accessKey"];
        $secretKey = config("qiniu")["secretKey"];
        $auth = new Auth($accessKey, $secretKey);

        $bucket = config("qiniu")["bucket"];
        $domain = config("qiniu")["domain"];
        $token = $auth->uploadToken($bucket);
        // 初始化 UploadManager 对象并进行文件的上传
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            return ["err" => 1, "msg" => $err, "data" => ""];
        } else {

            $imgPath = $domain . '/' . $key;
            $path_data["thumb_url"] = $imgPath;
            // $insert = Db::name('top_bar')->insert($path_data);
            //这里可以将七牛云返回的图片地址写入数据库
            return jsonData(1, '操作成功', $path_data);
        }

    }

    public function randNumber()
    {
        $str = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,s,y,z';
        $str_arr = explode(',', $str);
        $count = count($str_arr);
        $arr = [];
        foreach ($str_arr as $k => $v) {
            $arr = $str_arr[rand(0, $count - 1)];
        }
        $number = $arr . mt_rand(1, 99999);
      return $number;

    }


}
