<?php
namespace app\api\controller;

use think\Controller;


class Time extends Controller {

    public function index() {
        return show(1, 'OK', time());
    }
}