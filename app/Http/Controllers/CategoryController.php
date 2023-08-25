<?php

namespace App\Http\Controllers;

use App\Models\Category;


class CategoryController extends Controller
{
    public function index($name = ""){
        return Category::where("category_name",$name)->first();
    }

    public function getCategory(){
        return Category::get();
    }
}