<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogsImages extends Model
{
    public function updateOrder($i = null) {
        if (is_null($i)) {
            $id = $_REQUEST['id'];
            $features = self::where("id_blog", $id)->get();
            $i = count($features);
        }
        $this->order = $i;
        $this->save();
    }
}
