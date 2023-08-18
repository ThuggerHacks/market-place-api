<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Photo extends Model
{
 
    protected $table = "tbl_photo";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "photo_url",
        "product_id"
    ];
}