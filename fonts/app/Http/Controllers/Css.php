<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Css extends Controller
{
    public function show(Request $request)
    {
        $key = md5(str_replace($request->root(), '', $request->fullUrl()) . $request->header('User-Agent'));
        if (\Cache::has($key)) {
            $content = \Cache::get($key);
        } else {
            $originCssRootUri = env('ORIGIN_CSS_ROOT_URI');
            $originCssUri = str_replace($request->root() . '/', $originCssRootUri, $request->fullUrl());
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $originCssUri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($ch, CURLOPT_USERAGENT, $request->header('User-Agent'));
            $originContent = curl_exec($ch);
            curl_close($ch);
            $originFontRootUri = env('ORIGIN_FONT_ROOT_URI');
            $cdnFontRootUri = env('CDN_FONT_ROOT_URI');
            $content = str_replace($originFontRootUri, $cdnFontRootUri, $originContent);
            \Cache::put('css', $content, 1440);
        }
        return response($content)->header('Content-Type', 'text/css')->header('Cache-Control', 'public, max-age=86400');
    }
}
