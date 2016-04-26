<?php
namespace App\Http\Controllers;

class Index extends Controller
{
    public function index()
    {
        return view('index', array('title'=>'谷歌字体库 - 微锐前端公共库CDN镜像'));
    }
}
