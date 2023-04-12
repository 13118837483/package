<?php

namespace app\common\controller;

use think\Controller;
use think\Request;

class Demo extends Controller
{
    protected  $name;

    public function __construct($name = '')
    {
        parent::__construct();
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
}
