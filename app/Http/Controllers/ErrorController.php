<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function pageNotFound(Request $request){
        try {
            return view("error.404");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function permissionDenied(Request $request){
        try {
            return view("error.access-denied");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
