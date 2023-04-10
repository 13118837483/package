<?php

namespace app\index\controller;

use think\Controller;

class AdminBase extends Controller
{

    protected $request = null;

    protected function _initialize()
    {
        $this->request = \think\Request::instance();
    }
}
