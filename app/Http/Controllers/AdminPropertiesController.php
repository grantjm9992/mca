<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Http;
use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AdminPropertiesController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        if ( is_object( $this->user ) && $this->user->profile == "WA" ) return $this->skinsAction();
    }

    public function defaultAction() {
        $this->pageTitle = "Properties";
        $this->iconClass = "fa-home";
        $this->botonera = '<a href="AdminProperties.new" class="btn btn-primary"><i class="fas fa-plus"></i> New property</a>';

        $listado = $this->listadoAction();

        $companies = \App\Companies::get();
        $resorts = \App\Resorts::join("companies_resorts", "companies_resorts.id_resort", "=", "resorts.id")->where("companies_resorts.id_company", env("ID_COMPANY"))->get();
        $staff = \App\User::where("id_company", env("ID_COMPANY"))->where("role", "!=", "PO")->orderBy("name", "ASC")->get();
        $property_owners = \App\User::where("role", "PO")->where("id_company", $this->user->id_company)->get();
        
        $this->cont->body = view('adminproperties/index', array(
            "listado" => $listado,
            "user" => $this->user,
            "companies" => $companies,
            "staff" => $staff,
            "resorts" => $resorts,
            "property_owners" => $property_owners
        ));
        return $this->RenderView();
    }
    
    public function listadoAction()
    {
        $this->data = \App\Properties::select("properties.*", "users.name", "users.surname")
                                    ->join("users", "properties.id_property_owner", "=", "users.id")
                                    ->whereRaw( $this->makeWhere() )->get();
        foreach ( $this->data as $row )
        {
            $row->owner = "$row->name $row->surname";
            $row->btn = "<a class='btn btn-primary' href='PropertyCalendar?id=$row->id'>View property calendar</a>";
        }
        $this->campos[] = array(
            "title"=> "Name",
            "name" => "title"
        );
        $this->campos[] = array(
            "title" => "Property owner",
            "name" => "owner"
        );
        $this->campos[] = array(
            "title" => "Actions",
            "name" => "btn",
            "width" => 80
        );
        if ( count($this->data) === 0  ) return view("comun/nodata");
        $this->detailURL = "AdminProperties.detail?id=";
        return $this->createTable();
    }

    public function prettifyData( $data )
    {
        foreach ( $data as $row )
        {
            $row->actions = "<a href='PropertyCalendar?id=$row->id' class='btn btn-primary>View property calendar</a>";
        }

        return $data;
    }

    public function timelineAction() {
        $id = $_REQUEST["id"];
        $property = \App\Properties::where("id", $id)->first();
        $logs = \App\Log::where("id", $id)->first();
    }

    public function newAction()
    {
        $property = new \App\Properties();
        $this->pageTitle = "New property";
        $this->iconClass = "fa-briefcase";
        $this->botonera = view('adminproperties/editbuttons', array("property" => $property));

        $resorts = \App\Resorts::join("companies_resorts", "companies_resorts.id_resort", "=", "resorts.id")->where("companies_resorts.id_company", env('ID_COMPANY'))->get();
        $propertytypes = \App\PropertyTypes::get();
        $sections = \App\InfoSections::where('id_company', $this->user->id_company)->get();
        $images = \App\PropertiesImages::where('id_property', $property->id)->orderBy('order', 'ASC')->get();
        $property_owners = \App\User::where("role", "PO")->where("id_company", $this->user->id_company)->get();
        $staff = \App\User::where("role", "!=", "PO")->where("id_company", $this->user->id_company)->get();

        $this->cont->body = view('adminproperties/new_detail', array(
            "property" => $property,
            "resorts" => $resorts,
            "propertytypes" => $propertytypes,
            "sections" => $sections,
            "images" => $images,
            "property_owners" => $property_owners,
            "staff" => $staff,
            "featuresGrid" => $this->featuresGridAction()
        ));

        return $this->RenderView();
    }

    public function updateOTAAction()
    {
        if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] != "" )
        {
            $property = \App\Properties::where('id', $_REQUEST['id'] )->first();
            $property->update( $_REQUEST );
            \NotificationLogic::logEditProperty( $property);
        }

        return  "OK";
    }

    public function detailAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return \Redirect::to('AdminProperties');
        $property = \App\Properties::where('id', $_REQUEST['id'])->first();
        if ( !is_object( $property ) )  return \Redirect::to('AdminProperties');
        $owner = \App\User::where("id", $property->id_property_owner)->first();
        $property->owner = (is_object($owner) ) ? $owner->name." ".$owner->surname : "";
        $user = \App\User::where("id", $property->id_assigned_to)->first();
        $property->assigned_to = (is_object( $user ) ) ? $user->name." ".$user->surname : "";

        $this->pageTitle = "Manage Property";
        $this->iconClass = "fas fa-home";
        $this->botonera = view('adminproperties/editbuttons', array("property" => $property));
        $this->returnURL = "AdminProperties";

        /**
         * Get all selects
         */

        $resorts = \App\Resorts::join("companies_resorts", "companies_resorts.id_resort", "=", "resorts.id")->where("companies_resorts.id_company", env('ID_COMPANY'))->get();
        $propertytypes = \App\PropertyTypes::get();
        $sections = \App\InfoSections::where('id_company', $property->id_company)->get();
        $images = \App\PropertiesImages::where('id_property', $property->id)->orderBy('order', 'ASC')->get();
        $staff = \App\User::where("role", "!=", "PO")->where("id_company", $this->user->id_company)->get();
        $property_owners = \App\User::where("role", "PO")->where("id_company", $this->user->id_company)->get();

        $this->cont->body = view('adminproperties/new_detail', array(
            "property" => $property,
            "resorts" => $resorts,
            "propertytypes" => $propertytypes,
            "sections" => $sections,
            "images" => $images,
            "featuresGrid" => $this->featuresGridAction(),
            "specialurl" => $this->createURL( $property->id ),
            "property_owners" => $property_owners,
            "staff" => $staff
        ));

        return $this->RenderView();
    }

    public function updateImageOrderAction() 
    {
        $id_property = $_REQUEST["id"];
        $ids = $_REQUEST['ids'];
        $id_array = explode('@#', $ids, -1);
        $i = 1;
        foreach ( $id_array as $id )
        {
            $image = \App\PropertiesImages::where("id", $id)->first();
            $image->order = $i;
            $image->save();
            $i++;
        }
        return "OK";
    }

    protected function createURL( $id, $paid = false )
    {
        $base = url("/");

        $string = "id=".base64_encode( $id );
        if( $paid ) $string .= "&conf=1";

        $string = "?p=".base64_encode( $string );
        return "$base/$string";
    }

    public function saveAction()
    {
        if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] != "" )
        {
            $property = \App\Properties::where('id', $_REQUEST['id'] )->first();
            $property->update( $_REQUEST );
            \NotificationLogic::logEditProperty( $property);
        }
        else
        {
            $property = \App\Properties::create( $_REQUEST );
            $property->id_created_by = $this->user->id;
            $property->id_company = $this->user->id_company;
            $property->save();
            \NotificationLogic::logNewProperty( $property );
        }

        return \Redirect::to('AdminProperties')->send();
    }

    public function deleteAction()
    {
        $property = \App\Properties::where('id', $_REQUEST['id'])->first();
        $resp = $property->isEmpty();
        $error = "";
        if ( $resp === true )
        {
            $images = \App\PropertiesImages::where("id_property", $property->id)->get();
            foreach ( $images as $image )
            {
                if ( \file_exists( $image->path ) ) \unlink ( $image->path );
                $image->delete();
            }
            $features = \App\PropertiesFeatures::where("id_property", $property->id)->get();
            foreach ( $features as $row )
            {
                $row->delete();
            }
            
            \NotificationLogic::logDeleteProperty($property);
            $property->delete(); 
            $success = 1;
        }
        else
        {
            $success = 0;
            $error = $resp;
        }

        return json_encode( array(
            "success" => $success,
            "error" => $error
        ) );
    }

    public function featuresGridAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return view('comun/nodata');
        $PF = \App\PropertiesFeatures::where('id_property', $_REQUEST['id'] )->get();
        $features = array();

        foreach ( $PF as $row )
        {
            $feature = \App\Features::where('id', $row->id_feature)->first();
            $features[] = $feature;
        }

        $this->data = $features;
        $this->campos[] = array(
            "title" => "Title",
            "name" => "title"
        );
        
        if ( count( $this->data ) > 0 ) return $this->createTable();
        return view('comun/nodata');
    }
    

    public function uploadImageAction()
    {
        if (!empty($_FILES)) {
            
            $tempFile = $_FILES['file']['tmp_name'];
            $id = $_REQUEST['id'];
            
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            
            $image = new \App\PropertiesImages();
            $image->id_property = $id;
            $image->save();

            $disk = \Storage::disk('gcs');
            $fileContents = \file_get_contents($tempFile);
            $filename = "$image->id.$ext";
            $image->path = "/properties/$id/$filename";
            $image->updateOrder();
            $image->save();
            $disk->put("/properties/$id/$filename", $fileContents);
        }
        return $image->path;
    }

    public function removeImageAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return "OK";
        $image = \App\PropertiesImages::where('id', $_REQUEST['id'])->first();
        if ( !is_object( $image ) ) return "OK";
        
        $disk = \Storage::disk('gcs');
        $disk->delete("$image->path");
        $image->delete();
        return "OK";
    }


    public function featuresModalAction()
    {
        $this->gridId = "modal_tabla";
        $features = \App\Features::get();
        $AF = \App\PropertiesFeatures::where('id_property', $_REQUEST['id'] )->get();
        
        $idArray = array();
        foreach ( $AF as $row )
        {
            $this->selectIds .= $row->id_feature."@#";
        }
        $arr = array();
        foreach ( $features as $feature )
        {
            $input = "<input style='width: 100%; cursor: pointer;' rowid='$feature->id' type='checkbox' />";
            $arr[] = array(
                "id" => $feature->id,
                "title" => $feature->title,
                "input" => $input
            );
        }
        $this->data = $arr;
        $this->campos = array();
        $this->campos[] = array(
            "name" => "input",
            "title" => "",
            "width" => "50"
        );
        $this->campos[] = array(
            "name" => "title",
            "title" => "Title"
        );

        return view('admin/featuresmodal', array(
            "table" => $this->createTable()
        ));
    }

    
    public function updateFeaturesAction()
    {
        $ids = $_REQUEST['ids'];
        $idArray = ( $ids != "@#" ) ? explode("@#", trim($ids, "@#")) : array();
        $AF = \App\PropertiesFeatures::where('id_property', $_REQUEST['id'])->get();
        foreach ( $AF as $pc )
        {
            $pc->delete();
        }
        foreach ( $idArray as $row )
        {
            $pc = new \App\PropertiesFeatures;
            $pc->id_property = $_REQUEST['id'];
            $pc->id_feature = $row;
            $pc->save();
        }

        return "OK";
    }

    protected function makeWhere()
    {

        $where = " 1 ";
        $where .= " AND properties.id_company = ".$this->user->id_company." ";
        if ( $this->user->role == "PO" )
        {
            $where .= " AND id_property_owner = ".$this->user->id." ";
        }

        if ( isset( $_REQUEST["title"] ) && $_REQUEST["title"] != "" ) $where .= " AND title LIKE '%".$_REQUEST["title"]."%' ";
        if ( isset( $_REQUEST["id_resort"] ) && $_REQUEST["id_resort"] != "" ) $where .= " AND id_resort = ".$_REQUEST["id_resort"];
        if ( isset( $_REQUEST["id_property_owner"] ) && $_REQUEST["id_property_owner"] != "" ) $where .= " AND id_property_owner = ".$_REQUEST["id_property_owner"];
        if ( isset( $_REQUEST["id_assigned_to"] ) && $_REQUEST["id_assigned_to"] != "" ) $where .= " AND id_assigned_to = ".$_REQUEST["id_assigned_to"];
        if ( isset( $_REQUEST["is_rental"] ) && $_REQUEST["is_rental"] != "" ) $where .= " AND is_rental = ".$_REQUEST["is_rental"];
        if ( isset( $_REQUEST["public_title"] ) && $_REQUEST["public_title"] != "" ) $where .= " AND public_title LIKE '%".$_REQUEST["public_title"]."%' ";

        return $where;
    }

    public function cloneAction()
    {
        $id = $_REQUEST["id"];

        $property = \App\Properties::where("id", $id)->first();
        $new_property = $property->replicate();
        $new_property->title = "(clone) $new_property->title";
        $new_property->save();
        if ( !is_dir( "img/properties/$new_property->id/" ) ) mkdir("img/properties/$new_property->id/", 0777);

        $images = \App\PropertiesImages::where("id_property", $id)->get();
        foreach ( $images as $image )
        {
            $newImage = $image->replicate();
            $newImage->id_property = $new_property->id;
            $newImage->path = str_replace("properties/$id/", "properties/$new_property->id/", $newImage->path);
            $newImage->save();
            \copy($image->path, $newImage->path);
        }

        return \Redirect::to("AdminProperties.detail?id=$new_property->id")->send();
    }

    public function syncPropertyWithOTAAction()
    {
        $id_property = $_REQUEST['id_property'];
        $property = \App\Properties::where("id", $id_property)->first();
        $ota = $_REQUEST['ota'];
        $username = $_REQUEST[$ota."_username"];
        $password = $_REQUEST[$ota."_password"];
        $id = $_REQUEST[$ota."_id"];

        $authenticationResponse = Http::post('https://api.sandbox.reservationsteps.ru/v1/api/auth', [
            'username' => env('OTA_API_USERNAME'),
            'password' => env('OTA_API_PASSWORD')
        ]);
        if ($authenticationResponse->ok())
        {
            $response = $authenticationResponse->json();
            $token = $response['token'];
            if ($ota == "booking")
            {
                /**
                 * Waiting for live access
                 */
                return json_encode(
                    array(
                        "status" => "OK"
                    )
                );
                
                
                $ota_settings = Http::post('https://api.sandbox.reservationsteps.ru/v1/api/ota_settings', [
                    'token' => $token,
                    'account_id' => env('OTA_API_ACCOUNT_ID'),
                    'ota_id' => 'booking',
                    'credentials' => [
                        'hotel_id' => 6224910
                    ]
                ]);

                if ($ota_settings->ok())
                {
                    $ota_settings_response = $ota_settings->json();
                    $property->booking_ota_settings_id = $ota_settings_response['ota_settings_id'];
                    $property->save();
                    return json_encode(
                        array(
                            "status" => "OK"
                        )
                    );
                }
                else
                {
                    return json_encode(
                        $ota_settings->json()
                    );
                }
            }
            else
            {
                /**
                 * Waiting for live access
                 */

                return json_encode(
                    array(
                        "status" => "OK",
                        "link" => "https://public-api.sandbox.cm.reservationsteps.ru/v1/api/oauth_connect_redirect?oauth_token=4f9d0862-93c5-4aee-9c23-3887210fd53c"
                    )
                );
                $ota_settings = Http::post('https://api.sandbox.reservationsteps.ru/v1/api/ota_oauth_connect_link', [
                    'token' => $token,
                    'account_id' => env('OTA_API_ACCOUNT_ID'),
                    'ota_id' => 'airbnb',
                    'redirect_url' => url("AdminProperties.detail?id=$property->id")
                ]);
                if ($ota_settings->ok())
                {
                    $ota_settings_response = $ota_settings->json();
                    $link = $ota_settings_response['oauth_connect_link'];
                    return json_encode(
                        array(
                            "status" => "OK",
                            "link" => $link
                        )
                    );
                }
                else
                {
                    return json_encode(array("status" => "KO"));
                }
            }
        }

    }
    
    public function syncOTAAction()
    {
        $authenticationResponse = Http::post('https://api.sandbox.reservationsteps.ru/v1/api/auth', [
            'username' => env('OTA_API_USERNAME'),
            'password' => env('OTA_API_PASSWORD')
        ]);
        if ($authenticationResponse->ok())
        {
            $response = $authenticationResponse->json();
            $token = $response->token;
            $properties = \App\Properties::get();
            foreach($properties as $row)
            {
                if ($row->booking_ota_settings_id !== null && $row->booking_ota_settings_id != "")
                {
                    
                }
            }
        }
    }
}