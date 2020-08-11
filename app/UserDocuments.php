<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocuments extends Model
{
    protected $table = "user_documents";
    
    protected $fillable = [
        "id_user",
        "document_type",
        "document_number"              
    ];

    public static function boot()
    {
        parent::boot();
    }
}
