<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class View extends Model
{
 
    protected $table = "tbl_view";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "product_id"
    ];
}