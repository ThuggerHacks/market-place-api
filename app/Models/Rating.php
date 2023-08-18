<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Rating extends Model
{
 
    protected $table = "tbl_user_rating";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "rater_id",
        "rating_comments",
        "rating_number"
    ];
}