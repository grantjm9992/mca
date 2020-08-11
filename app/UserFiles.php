<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFiles extends Model
{
    protected $table = "user_files";
    
    protected $fillable = [
        "id_user",
        "path"       
    ];

    public static function boot()
    {
        parent::boot();
    }
}
