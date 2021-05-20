<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Category\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{

    public function index()
    {
        $resultData['userData'] = Auth::guard('frontend')->user();
        return view('frontend.index')->with($resultData);
    }
}
