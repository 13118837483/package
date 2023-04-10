<?php

namespace app\index\model;

use think\Model;

class Spu extends Model
{
    public function Sku()
    {
        return $this->hasMany('Sku');
    }
}
