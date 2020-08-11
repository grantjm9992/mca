<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AdminBlogsController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        if ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) $this->user = \UserLogic::getUser();
    }
    

    public function defaultAction() {
        $this->pageTitle = "Blogs";
        $this->iconClass = "fa-blog";
        $this->botonera = '<a href="AdminBlogs.new" class="btn btn-primary"><i class="fas fa-plus"></i> New Blog</a>';

        $listado = $this->listadoAction();

        $this->cont->body = view('adminblogs/index', array(
            "listado" => $listado
        ));
        return $this->RenderView();
    }
    
    public function listadoAction()
    {
        $this->data = \App\Blogs::orderBy('title', 'ASC')->where("id_company", env("ID_COMPANY"))->get();
        $this->campos[] = array(
            "title"=> "Title",
            "name" => "title"
        );
        $this->campos[] = array(
            "title" => "Created",
            "name" => "created_at"
        );
        $this->detailURL = "AdminBlogs.detail?id=";
        return $this->createTable();
    }

    public function newAction()
    {
        $blog = new \App\Blogs();
        $this->pageTitle = "New Blog";
        $this->iconClass = "fa-blog";
        $this->botonera = view('adminblogs/editbotonera');

        $this->cont->body = view('adminblogs/detail', array(
            "blog" => $blog,
            "images" => []
        ));

        return $this->RenderView();
    }

    public function detailAction()
    {
        if ( !isset( $_REQUEST['id'] ) ) return \Redirect::to('AdminBlogs')->send();
        $id = $_REQUEST['id'];
        $blog = \App\Blogs::where('id', $id)->first();
        $this->pageTitle = "Edit Blog";
        $this->iconClass = "fa-blog";
        $this->botonera = view('adminblogs/editbotonera');
        if ( !is_object( $blog ) ) return \Redirect::to('AdminBlogs')->send();
        $images = \App\BlogsImages::where("id_blog", $blog->id)->orderBy("order", "ASC")->get();
        
        $this->cont->body = view('adminblogs/detail', array(
            "blog" => $blog,
            "images" => $images
        ));

        return $this->RenderView();
    }

    public function saveAction()
    {
        if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] != "" )
        {
            $Blogs = \App\Blogs::where('id', $_REQUEST['id'])->first();
            $Blogs->update($_REQUEST);
        }
        else
        {
            $Blogs = \App\Blogs::create($_REQUEST);
            $Blogs->id_company = env("ID_COMPANY");
            $Blogs->save();
        }

        return \Redirect::to('AdminBlogs')->send();
    }

    public function deleteAction()
    {
        $Blogs = \App\Blogs::where('id', $_REQUEST['id'])->first();
        $images = \App\BlogsImages::where("id_blog", $Blogs->id)->get();
        $disk = \Storage::disk('gcs');
        foreach ( $images as $image )
        {
            $disk->delete("$image->path");
            $image->delete();
        }
        
        $Blogs->delete();
        return json_encode(
            array(
                "success" => 1
            )
        );
    }
    

    public function updateImageOrderAction() 
    {
        $ids = $_REQUEST['ids'];
        $id_array = explode('@#', $ids, -1);
        $i = 1;
        foreach ( $id_array as $id )
        {
            $image = \App\BlogsImages::where("id", $id)->first();
            $image->order = $i;
            $image->save();
            $i++;
        }
        return "OK";
    }

    public function uploadImageAction()
    {
        if (!empty($_FILES)) {
            
            $tempFile = $_FILES['file']['tmp_name'];
            $id = $_REQUEST['id'];
            
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            
            $image = new \App\BlogsImages();
            $image->id_blog = $id;
            $image->save();

            $disk = \Storage::disk('gcs');
            $fileContents = \file_get_contents($tempFile);
            $filename = "$image->id.$ext";
            $image->path = "/blogs/$id/$filename";
            $image->updateOrder();
            $image->save();
            $disk->put("/blogs/$id/$filename", $fileContents);
        }
        return $image->path;
    }

    public function removeImageAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return "OK";
        $image = \App\BlogsImages::where('id', $_REQUEST['id'])->first();
        if ( !is_object( $image ) ) return "OK";
        
        $disk = \Storage::disk('gcs');
        $disk->delete("$image->path");
        $image->delete();
        return "OK";
    }
}