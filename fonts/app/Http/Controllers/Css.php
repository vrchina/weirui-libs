<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Css extends Controller
{
    public function show(Request $request)
    {
        $originCssRootUri = env('ORIGIN_CSS_ROOT_URI');
        $originCssUri = str_replace($request->root(), $originCssRootUri, $request->fullUrl());
        $key = md5(str_replace($request->root(), '', $request->fullUrl()));
        if (\Cache::has($key)) {
            $content = \Cache::get($key);
        } else {
            $originContent = file_get_contents($originCssUri);
            $originFontRootUri = env('ORIGIN_FONT_ROOT_URI');
            $cdnFontRootUri = env('CDN_FONT_ROOT_URI');
            $content = str_replace($originFontRootUri, $cdnFontRootUri, $originContent);
            \Cache::put('css', $content, 1440);
        }
        return response($content)->header('Content-Type', 'text/css')->header('Cache-Control', 'public, max-age=86400');
    }
}
