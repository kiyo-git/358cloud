<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ErrorController extends Controller
{
    /**
     * エラーページを呼ぶ関数
     *@param request
     *
     */
    public function show(Request $request){
        $title = $request->title??null;
        $body = $request->body;
        Log::error($body);
        return view('error',compact('title','body'));
    }
}
