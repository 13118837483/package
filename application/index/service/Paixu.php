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
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                if ($arr[$j] < $arr[$i]) {
                    $tmp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $tmp;
                }
            }
        }
        return $arr;
    }

    public function new_sort($arr)
    {
        if (count($arr) <= 1) return $arr;
        $count = count($arr);
        $left = [];
        $right = [];
        $zhong = $arr[0];
        for ($i = 1; $i < $count; $i++) {
            if ($arr[$i] < $zhong) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }
        $left = $this->new_sort($left);

        $right = $this->new_sort($right);
        $arr = array_merge($left,[$zhong],$right);
        return $arr;
    }

}
