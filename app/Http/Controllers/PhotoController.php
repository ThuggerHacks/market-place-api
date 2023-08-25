<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Storage;
use Illuminate\Http\Request;


class PhotoController extends Controller
{

    public function getByProductId($product_id = 0)
    {
        return Photo::where("product_id",$product_id)->get();
    }

    public function addPhotoOnProduct(Request $request){

        $url = $request-> url;
        $product_id = $request->product_id;

        $photo = Photo::create([
            "photo_url" => $url,
            "product_id" => $product_id
        ]);

        return $photo;

    }

    public function deleteOne($id = 0) {
        $photo = Photo::find($id);

        if(!$photo){
            return response()->json(["error" => "Photo nao existe"]);
        }

        return $photo->delete();
    }

    public function uploadPhoto(Request $request)
    {
        try{
            $file = $request->file;
            error_log($request->file);

            $file = $file->store("/public/photos");

            $url = $_SERVER['APP_URL'].":".$_SERVER['SERVER_PORT']."/storage".explode("public",$file)[1];
        
            return response()->json(["url" => $url,"file" => "hello"]);
        }catch(\Exception $e){
            error_log($request);
            return response()->json(["error" => $e]);
        }
    }
}