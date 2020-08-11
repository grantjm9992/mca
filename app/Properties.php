<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $fillable = [
        'is_rental',
        'id_resort',
        'id_company',
        'id_created_by',
        'id_area', 
        "id_assigned_to",
        "id_property_owner",
        "id_property_type",
        "title",
        "description",
        "price",
        "sleeps",
        "bedrooms",
        "bed",
        "bath",
        "location",
        "id_info_section",
        "public_title",
        "airbnb_username",
        "airbnb_password",
        "booking_username",
        "booking_password",
        "airbnb_ota_settings_id",
        "booking_ota_settings_id",
        "airbnb_id",
        "booking_id"
    ];


    
        public static function boot() {
            parent::boot();
    
            self::retrieved(function($model){
                $image = \App\PropertiesImages::where("id_property", $model->id)->orderBy("order", "ASC")->first();
                $model->image = ( \is_object( $image ) ) ? env("GOOGLE_CLOUD_PUBLIC_ACCESS").$image->path : "img/no-image.png";
                $resort = \App\Resorts::where("id", $model->id_resort )->first();
                $model->resort = ( \is_object( $resort ) ) ? $resort->name : ""; 
                $type = \App\PropertyTypes::where("id", $model->id_property_type )->first();
                $model->type = ( \is_object( $type ) ) ? $type->title : ""; 
            });
    
            self::updating(function($model){
                unset($model->image);
                unset($model->resort);
                unset($model->type);
            });
            self::creating(function($model){
                unset($model->image);
                unset($model->resort);
                unset($model->type);
            });
    
        }
    public function isEmpty()
    {
        $response = true;
        $reservations = \App\Rentals::where("id_property", $this->id)->get();
        if ( count( $reservations) > 0 ) $response = "You cannot delete a property which has reservations associated with it";
        

        return $response;
    }

    public function getImages()
    {
        
    }
}
