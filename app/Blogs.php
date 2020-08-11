<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $fillable = [
        "title",
        "subtitle",
        "description",
        "slug"
    ];
}
