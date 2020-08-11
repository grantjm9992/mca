<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class UsersController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
    }
    
    public function defaultAction() {
        $this->botonera = '<a href="Users.new" class="btn btn-primary"><i class="fas fa-plus"></i> New user</a>';
        $this->pageTitle = "Users";
        $this->iconClass = "fa-users";

        $listado = $this->listadoAction();

        $this->cont->body = view('users/index', array(
            "listado" => $listado
        ));
        return $this->RenderView();
    }

    public function listadoAction()
    {
        $where = " 1 ";
        if (isset($_REQUEST["name"]) && $_REQUEST["name"] != "" ) $where .= " AND (name LIKE '%".$_REQUEST["name"]."%' or surname LIKE '%".$_REQUEST["name"]."%' ) ";
        if (isset($_REQUEST["email"]) && $_REQUEST["email"] != "" ) $where .= " AND email LIKE '%".$_REQUEST["email"]."%' ";
        if (isset($_REQUEST["phone"]) && $_REQUEST["phone"] != "" ) $where .= " AND phone LIKE '%".$_REQUEST["phone"]."%' ";
        if ( $this->user->role != "SA" ) $where .= " AND role != 'SA' AND role != 'AA' ";
        if ( (int)$this->user->id_company !== -1 ) $where .= " AND id_company = ".$this->user->id_company;
        $this->data = \App\User::whereRaw( $where )->get();
        foreach ( $this->data as $row )
        {
            $row->fullname = $row->name." ".$row->surname;
            $company = \App\Companies::where('id', $row->id_company)->first();
            $row->cc = ( is_object( $company ) ) ? $company->name : "";
        }

        $this->campos[] = array(
            "title" => "Name",
            "name" => "fullname"
        );
        $this->campos[] = array(
            "title" => "User",
            "name" => "user"
        );
        $this->campos[] = array(
            "title" => "Company",
            "name" => "cc"
        );
        $this->campos[] = array(
            "title" => "Role",
            "name" => "role",
            "width" => "75"
        );

        $this->detailURL = "Users.detail?id=";

        return $this->createTable();
    }

    public function detailAction()
    {

        if ( !isset( $_REQUEST['id'] ) ) return \Redirect::to('Users')->send();
        $user = \App\User::where('id', $_REQUEST['id'])->first();
        if ( !is_object( $user ) ) return \Redirect::to('Users')->send();
        $this->pageTitle = "Edit user";
        $this->iconClass = "fa-user-edit";
        $this->botonera = view('users/botonera', array(
            "user" => $this->user,
            "thisUser" => $user
        ));
    
        $whereRaw = ($this->user->role != "SA" ) ? "RANK > 3" : "1";
        $roles = \App\Roles::whereRaw($whereRaw)->get();
        $companies = \App\Companies::get();
        $documents = \App\UserDocuments::where("id_user", $user->id)->get();
        $documentTypes = \App\DocumentTypes::get();
        $files = \App\UserFiles::where("id_user", $user->id)->get();
        foreach ($files as $file)
        {
            $file->absolute_url = env('GOOGLE_CLOUD_PUBLIC_ACCESS').$file->path;
        }
        
        $this->cont->body = view('users/detail', array(
            "user" => $user,
            "roles" => $roles,
            "companies" => $companies,
            "files" => $files,
            "documentTypes" => $documentTypes,
            "documents" => $documents
        ));

        return $this->RenderView();
    }

    public function addUserDocumentModalAction()
    {
        $documentTypes = \App\DocumentTypes::get();
        return view("modal/add_user_document", array(
            "documentTypes" => $documentTypes
        ));
    }

    public function addUserDocumentAction()
    {
        $document = \App\UserDocuments::create($_REQUEST);
        return view("users/document_template", array(
            "document" => $document
        ));
    }

    public function removeUserDocumentAction()
    {
        $id_doc = $_REQUEST["id_doc"];
        $document = \App\UserDocuments::where("id", $id_doc)->first();
        if (is_object($document)) $document->delete();
        return "OK";
    }

    public function uploadUserFileAction()
    {
        if (!empty($_FILES)) {
            
            $tempFile = $_FILES['file']['tmp_name'];
            $id = $_REQUEST['id'];
            
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            
            $file = new \App\UserFiles();
            $file->id_user = $id;
            $file->save();

            $disk = \Storage::disk('gcs');
            $fileContents = \file_get_contents($tempFile);
            $filename = "$file->id.$ext";
            $file->path = "/users/$id/$filename";
            $file->title = $path;
            $file->save();
            $disk->put("/users/$id/$filename", $fileContents);
        }
        return $file->path;
    }

    public function removeUserfileAction()
    {
        if ( !isset( $_REQUEST['id_file'] ) || $_REQUEST['id_file'] == "" ) return "OK";
        $image = \App\UserFiles::where('id', $_REQUEST['id_file'])->first();
        if ( !is_object( $image ) ) return "OK";
        
        $disk = \Storage::disk('gcs');
        $disk->delete("$image->path");
        $image->delete();
        return "OK";
    }

    private function ownerEdit($user)
    {
        $whereRaw = ($this->user->role != "SA" ) ? "RANK > 3" : "1";
        $roles = \App\Roles::whereRaw($whereRaw)->get();
        $companies = \App\Companies::get();
        $documents = \App\UserDocuments::where("id_user", $user->id)->get();
        $documentTypes = \App\DocumentTypes::get();
        $files = \App\UserFiles::where("id_user", $user->id)->get();
        
        $this->cont->body = view('users/detail', array(
            "user" => $user,
            "roles" => $roles,
            "companies" => $companies,
            "files" => $files,
            "documentTypes" => $documentTypes,
            "documents" => $documents
        ));
    }

    private function userEdit($user)
    {
        $whereRaw = ($this->user->role != "SA" ) ? "RANK > 3" : "1";
        $roles = \App\Roles::whereRaw($whereRaw)->get();
        $companies = \App\Companies::get();
        $this->cont->body = view('users/detail', array(
            "user" => $user,
            "roles" => $roles,
            "companies" => $companies,
            "documents" => $documents
        ));
    }

    public function newAction()
    {
        $this->pageTitle = "New user";
        $this->iconClass = "fa-user-plus";
        $this->botonera = view('users/newbotonera');
        $user = new \App\User();
        $whereRaw = ($this->user->role != "SA" ) ? "RANK > 3" : "1";
        $roles = \App\Roles::whereRaw($whereRaw)->get();
        $companies = \App\Companies::get();
        $this->cont->body = view('users/detail', array(
            "user" => $user,
            "roles" => $roles,
            "companies" => $companies
        ));
        return $this->RenderView();
    }

    public function checkUserExistsAction()
    {
        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != "" )
        {
            $testUser = \App\User::where("user", $_REQUEST["user"])->where("id", "!=", $_REQUEST["id"])->first();
            $testUserEmail = \App\User::where("email", $_REQUEST["email"])->where("id", "!=", $_REQUEST["id"])->first();
        }
        else
        {
            $testUser = \App\User::where("user", $_REQUEST["user"])->first();
            $testUserEmail = \App\User::where("email", $_REQUEST["email"])->first();
        }
        
        if (\is_object($testUser))
        {
            die (json_encode(
                array(
                    "success" => 0,
                    "error" => "Username already exists"
                )
            ));
        }
        
        if (\is_object($testUserEmail))
        {
            die (json_encode(
                array(
                    "success" => 0,
                    "error" => "User with the email provided already exists"
                )
            ));
        }

        die(
            json_encode(
                array(
                    "success" => 1
                )
            )
        );
    }
    
    public function saveAction()
    {
        if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] != "" ) {
            $user = \App\User::where('id', $_REQUEST['id'])->first();
            $user->update( $_REQUEST );
        } else {
            $user =  \App\User::create($_REQUEST);
            $user->access_token = uniqid();
            $user->save();
            $link = url("Login.reset?t=".\base64_encode($user->access_token));
            \Mail::to($user->email)->send( new \App\Mail\newAccount( $user, $link ) );
        }
        if ( isset( $_REQUEST["password"] ) && $_REQUEST["password"] != "" ) $user->password = md5($_REQUEST["password"]);
        $user->save();
        return \Redirect::to('Users')->send();
    }


    public function getMentionAction()
    {
        $user = $_REQUEST["title"];
        $where = "";
        if ( isset ( $_REQUEST["role"] ) && $_REQUEST["role"] != "" ) $where .= " AND role='".$_REQUEST["role"]."' ";
        if ( isset ( $_REQUEST["assignproperty"] ) && $_REQUEST["assignproperty"] != "" ) $where .= " AND role IN ('M', 'AA') ";
        if ( isset ( $_REQUEST["mycompany"] ) && $_REQUEST["mycompany"] != "" && $this->user->id_company !== -1 ) $where .= " AND  id_company = ".$this->user->id_company;
        $contacts = \App\User::whereRaw(" (name LIKE '%$user%' OR surname LIKE '%$user%') $where ")->get();
        
        $return = array();
        foreach ( $contacts as $contact )
        {
            $fullname = strtoupper( $contact->name." ".$contact->surname );
            $fullname = str_replace(strtoupper($user), strtoupper("<b>$user</b>"), $fullname);

            $con = array();
            $con["id"] = $contact->id;
            $con["title"] = $fullname;
            array_push($return, $con);
        }
        die(json_encode($return));
    }

    public function updateForNotificationsAction()
    {
        $id = $_REQUEST["id"];
        $user = \App\User::where("id", $id)->first();
        $user->notify_email = $_REQUEST["notify_email"];
        $user->email = $_REQUEST["email"];
        $user->save();
    }
}