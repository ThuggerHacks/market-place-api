<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageValidator;
use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;


class MessageController extends Controller
{

    public function index(MessageValidator $request){

        $receiver_id = $request->receiver_id; 
        $sender_id = $request->sender_id; 
        $message = $request->message; 
        $photo_attach = $request->photo_attach; 
        $chat_id = $request->chat_id;    
        
        $user1 = User::find($sender_id);
        $user2 = User::find($receiver_id);
        $chat = Chat::find($chat_id);
        if(!$user1 || !$user2 || !$chat){
            return response()->json(["error" => "Houve um erro"]);
        }

        if($user1->id == $user2->id){
            return response()->json(["error" => "Nao pode conversar consigo mesmo"]);
        }

        $message = Message::create([
            "receiver_id" => $receiver_id ,
            "sender_id" => $sender_id ,
            "message" => $message ,
            "photo_attach" => $photo_attach ,
            "chat_id" => $chat_id
        ]);
    
        return $message;
    }

    public function getByChatId($chat_id = 0){
        $messages = Message::where("chat_id",$chat_id)->get();
        return $messages;
    }

    public function getOne($id = 0){
        $messages = Message::find($id);
        return $messages;
    }

    public function deleteOne($id = 0) {
        $message = Message::find($id);

        if(!$message){
            return response()->json(["error" => "Houve um erro"]);
        }

        $message->delete();

        return $message;
    }

}