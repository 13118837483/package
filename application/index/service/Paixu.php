<?php

namespace app\index\service;

use think\Model;

class Paixu
{
    /**
     * 排序
     */
    public function bubble_sort($arr)
    {
        $count = count($arr);
        for ($i=0; $i < $count-1; $i++) { 
           for ($j=$i+1; $j < $count; $j++) { 
            if($arr[$j] < $arr[$i]){
                $tmp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tmp;
            }
           }
        }
        return $arr;
       
    }
}
