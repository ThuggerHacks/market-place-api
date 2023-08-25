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
        return Product::orderBy("id","desc")->get();
    }

    public function getOne($id = 0)
    {
        return Product::find($id);
    }

    public function getProductByCategoryName($name = "Tudo"){
        $categoryId = Category::where("category_name",$name)->first();

        if($name == "Tudo"){
            return Product::orderBy("id","desc")->get();
        }

        if(!$categoryId){
            return response()->json(["error" => "Houve um erro!"]);
        }

        $product = Product::where("category_id",$categoryId->id)->get();


        return $product;

    }

    public function getProductByTitle($title = ""){
        return Product::where("title","LIKE","%".$title."%")->orderBy("id","desc")->get();
    }

    public function getByUserId($user_id = 0){
        $product = response()->json(Product::where("user_id",$user_id)->orderBy("id","desc")->get());
        return $product;
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
        $price = $request->price == 0.0 ?$product->price:$request->price;
        $category_id = $request->category_id == 0?$product->category_id:$request->category_id;
        $available = $request->available == 0 ? $product->available:$request->available;

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
            "cover_url" => $cover_url,
            "available" => $available == 3?0:$available
        ]);

        error_log($product);

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