<?php

namespace app\index\controller;




class ContentFunction
{

    protected $service = null;
    protected $chinaArray = [];
    protected $smallChinaArray = [];
    protected $string = '';
    public function __construct()
    {
        $this->service = new \app\index\service\ContentFunctionService();
        $this->chinaArray = ['小明','小李','小黄','小王','小陈','小绿','小李','小李'];
        $this->smallChinaArray = ['小李','小黄','小王','小绿','小李','小公','小牧'];
        $this->string = 'asdffasdfhgkjjlkqweruixcvz,mnfasdjlk';
    }

    /**
     * 数组函数测试
     */
    public function arrayFunction()
    {  
        //array_chunk() 函数把一个数组分割为新的数组块
        dump($this->service->arrayChunk($this->chinaArray));
        // array(3) {
        //     [0] => array(2) {
        //       [0] => string(6) "小明"
        //       [1] => string(6) "小李"
        //     }
        //     [1] => array(2) {
        //       [0] => string(6) "小黄"
        //       [1] => string(6) "小王"
        //     }
        //     [2] => array(2) {
        //       [0] => string(6) "小陈"
        //       [1] => string(6) "小绿"
        //     }
        //   }
        // array_count_values() 函数用于统计数组中所有值出现的次数。
        dump($this->service->arrayCountValues($this->chinaArray));
        // array(6) {
        //     ["小明"] => int(1)
        //     ["小李"] => int(3)
        //     ["小黄"] => int(1)
        //     ["小王"] => int(1)
        //     ["小陈"] => int(1)
        //     ["小绿"] => int(1)
        //   }
        // 比较两个数组的值，并返回差集：
        dump(array_diff($this->chinaArray,$this->smallChinaArray));
        // array(2) {
        //     [0] => string(6) "小明"
        //     [4] => string(6) "小陈"
        //   }

        dump(array_keys($this->chinaArray));
        dump($this->chinaArray);
        dump(array_values($this->chinaArray));
        dump(array_merge($this->chinaArray,$this->smallChinaArray));
    
    }
    /**
     * 字符串函数测试 str_replace() strlen() strrpos() strstr() substr() mb_substr()  ucwords()
     */
    public function stringFunction()
    {
        dump(strlen($this->string));
        dump(strstr($this->string,'mnf'));
        dump(str_replace('mnf','fasdfasdfadsfsd',$this->string));
        dump(explode(',',$this->string));
        dump(implode("dfsdfsd",$this->chinaArray));
        dump(substr($this->string,0,10));
        
    }
    /**
     * 文件函数测试
     */
    public function fileFunction()
    {
    }
}
