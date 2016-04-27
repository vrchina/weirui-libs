<?php
namespace App\Http\Controllers;

class Index extends Controller
{
    public function index()
    {
        return view('index', array('title'=>'谷歌字体库CDN镜像 - 微锐公共库 - libs.weirui.org'));
    }
}
