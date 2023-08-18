<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Message extends Model
{
 
    protected $table = "tbl_message";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "receiver_id",
        "sender_id",
        "message",
        "photo_attach",
        "chat_id"
    ];
}