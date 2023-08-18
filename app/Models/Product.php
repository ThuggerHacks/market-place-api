<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Product extends Model
{
 
    protected $table = "tbl_product";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "title",
        "description",
        "cover_url",
        "location",
        "price",
        "available",
        "category_id"
    ];
}