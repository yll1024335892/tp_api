<?php
namespace app\api\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        echo config("admin.session_user");
    }
}
