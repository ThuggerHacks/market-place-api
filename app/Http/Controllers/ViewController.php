<?php

namespace App\Http\Controllers;
use App\Models\View;
use Illuminate\Http\Request;


class ViewController extends Controller
{

    public function index()
    {
        return View::get();
    }

    public function getByProductId($product_id = 0){
        return View::where("product_id",$product_id)->get();
    }

    public function addView(Request $request){
        $view = View::create([
            "user_id" => $request->user_id,
            "product_id" => $request->product_id
        ]);

        return $view;
    }
  
}