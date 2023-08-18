<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Chat extends Model
{
 
    protected $table = "tbl_chat";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "receiver_id",
        "sender_id",
        "product_id"
    ];
}