<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductValidator;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {
        return Product::get();
    }

    public function getOne($id = 0)
    {
        return Product::find($id);
    }

    public function getByUserId($user_id = 0){
        return response()->json(Product::where("user_id",$user_id)->get());
    }

    public function addProduct(ProductValidator $request)
    {
        $user_id = $request->user_id;
        $title = $request->title;
        $description = $request->description;
        $cover_url = $request->cover_url;
        $location = $request->location;
        $price = $request->price;
        $category_id = $request->category_id;

        $category = Category::find($category_id);
        $user = User::find($user_id);

        if (!$user || !$category) {
            return response()->json(["error" => "Nao foi possivel fazer este poste"]);
        }


        $product = Product::create([
            "user_id" => $user_id,
            "title" => $title,
            "description" => $description,
            "location" => $location,
            "price" => $price,
            "category_id" => $category_id,
            "cover_url" => $cover_url
        ]);



        return response()->json($product);

    }

    public function updateProduct(Request $request, $id = 0)
    {

        $product = Product::find($id);

        if (!$product) {
            return response()->json(["error" => "Produto nao existe"]);
        }

        $user_id = $product->user_id;
        $title = trim($request->title) == ""?$product->title:$request->title;
        $description = trim($request->description) == ""?$product->description:$request->description;
        $cover_url = trim($request->cover_url) == ""?$product->cover_url:$request->cover_url;
        $location = trim($request->location) == ""?$product->location:$request->location;
        $price = trim($request->price) == ""?$product->price:$request->price;
        $category_id = trim($request->category_id) == ""?$product->category_id:$request->category_id;

        $category = Category::find($category_id);
        $user = User::find($user_id);

        if (!$user || !$category) {
            return response()->json(["error" => "Nao foi possivel fazer este poste"]);
        }


        $product->update([
            "title" => $title,
            "description" => $description,
            "location" => $location,
            "price" => $price,
            "category_id" => $category_id,
            "cover_url" => $cover_url
        ]);



        return response()->json($product);
    }

    public function deleteOne($id = 0) {
        $product = Product::find($id);

        if(!$product){
            return response()->json(["error" => "Produto nao existe"]);
        }

        $product->delete();

        return $product;
    }
}