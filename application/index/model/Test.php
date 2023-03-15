<?php

namespace app\index\model;

use think\Model;

class Test extends Model
{
  protected $table = 'user_t';


  public function product()
  {
    return $this->hasMany('Product', 'user_t_id', 'id');
  }
}
