<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


class ChatController extends Controller
{

    public function index(){
        return Chat::get();
    }

    public function getOne($id = 0){
        return Chat::find($id);
    }

    public function getChatByProductId($product_id = 0){
        return Chat::where("product_id",$product_id)->get();
    }

    public function getChatByUserId($user_id = 0){
        $chat = Chat::where("sender_id",$user_id)->orWhere("receiver_id",$user_id)->orderBy("id","desc")->get();
        
        return $chat;
    }

    public function getChatsByAll($product_id = 0,$receiver_id = 0, $sender_id = 0){
        $chat = Chat::where("product_id",$product_id)->where("sender_id",$sender_id)->where("receiver_id",$receiver_id)->get();

        if(count($chat) == 0){
            $chat = Chat::where("product_id",$product_id)->where("sender_id",$receiver_id)->where("receiver_id",$sender_id)->get();
        }

        return $chat;
    }

    public function getChatByAll($product_id = 0,$receiver_id = 0, $sender_id = 0){
        $chat = Chat::where("product_id",$product_id)->where("sender_id",$sender_id)->where("receiver_id",$receiver_id)->first();

        if(!$chat){
            $chat = Chat::where("product_id",$product_id)->where("sender_id",$receiver_id)->where("receiver_id",$sender_id)->first();
        }

        return $chat;
    }

    public function addChat(Request $request){
        $product_id = $request->product_id;
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;


        $product = Product::find($product_id);
        $sender = User::find($sender_id);
        $receiver = User::find($receiver_id);

        if(!$product || !$sender || !$receiver){
            return response()->json(["error" => "Houve um erro"]);
        }

        if($sender->id == $receiver->id){
            return response()->json(["error" => "Nao pode criar uma conversa consigo mesmo!"]);
        }

        $chat = Chat::where("product_id",$product_id)->where("sender_id",$sender_id)->where("receiver_id", $receiver_id)->first();

        $chat2 = Chat::where("product_id",$product_id)->where("sender_id",$receiver_id)->where("receiver_id", $sender_id)->first();

        if($chat || $chat2){
            return response()->json(["error" => "Chat existe"]);
        }

        $chat = Chat::create([
            "receiver_id" => $receiver_id,
            "sender_id" => $sender_id,
            "product_id" => $product_id
        ]);

        return $chat;
    }

    public function deleteChat($id = 0){
        $chat = Chat::find($id);

        if(!$chat){
            return response()->json(["error" => "Conversa nao existe"]);
        }

        $chat->delete();

        return $chat;
    }
}