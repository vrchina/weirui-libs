<?php
namespace App\Http\Controllers;

class Index extends Controller
{
    public function index()
    {
        return view('index', array('title'=>'Google Fonts 国内镜像加速支持SSL（HTTPS） - 微锐'));
    }
}
