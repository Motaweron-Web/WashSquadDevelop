<?php


if (!function_exists('setting')) {
    function setting() {
        return \App\Setting::orderBy('id', 'desc')->first();
    }
}

if (!function_exists('admin')) {
    function admin() {
        return auth()->guard('admin');
    }


}
if (!function_exists('user')) {
    function user() {
        return auth()->guard('user');
    }
}

if (!function_exists('aurl')) {
    function aurl($url = null) {
        return url('admin/'.$url);
    }
}


