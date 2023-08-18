<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class User extends Model
{
 
    protected $table = "tbl_user";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "name",
        "email",
        "phone",
        "password",
        "location",
        "profile"
    ];
}