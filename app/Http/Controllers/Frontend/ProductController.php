<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function view()
    {
        return view('frontend.product');
    }

    public function details()
    {
        return view('frontend.product-details');
    }
}
