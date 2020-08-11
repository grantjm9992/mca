<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class BlogController extends BaseController
{

    public function __construct() {
        
        parent::__construct();
    }
    
    public function defaultAction() {
        
        $blogs = $this->getBlogGridAction();
        
        $this->cont->body = view("blogs/index", array(
            "blogHTML" => $blogs
        ));

        return $this->RenderView();
    }

    public function detailAction()
    {
        $slug = $_SERVER["QUERY_STRING"];
        $blog = \App\Blogs::where("slug", $slug)->first();
        $date = new \DateTime($blog->created_at);
        $blog->createdAt = $date->format("d F Y");
        if (!\is_object($blog)) \Redirect::to("Blog")->send();
        $images = \App\BlogsImages::where("id_blog", $blog->id)->orderBy("order", "ASC")->get();
        if (count($images) < 2)
        {
            $image = $images[0];
            $blog->image = (is_object($image)) ? env("GOOGLE_CLOUD_PUBLIC_ACCESS").$image->path : "images/resource/news-1.jpg";
        }
        else
        {
            $blog->images = $images;
        }

        $blogs = \App\Blogs::whereRaw("id != $blog->id")->where("id_company", env("ID_COMPANY"))->orderBy("created_at", "DESC")->take(4)->get();
        foreach ($blogs as $post)
        {
            $date = new \DateTime($post->created_at);
            $post->createdAt = $date->format("d F Y");
            $image = \App\BlogsImages::where("id_blog", $post->id)->orderBy("order", "ASC")->first();
            $post->image = (is_object($image)) ? env("GOOGLE_CLOUD_PUBLIC_ACCESS").$image->path : "images/resource/news-1.jpg";
        }

        $this->cont->body = view("blogs/detail", array(
            "blog" => $blog,
            "blogs" => $blogs
        ));
        
        return $this->RenderView();
    }

    public function getBlogGridAction()
    {
        $page = (isset($_REQUEST["page"])) ? (int)$_REQUEST["page"] : 1;

        $limit = 3;

        $skip = ($page - 1) * $limit;

        $blogs = \App\Blogs::skip($skip)->take($limit)->where("id_company", env("ID_COMPANY"))->orderBy("created_at", "DESC")->get();

        $blogHTML = "";

        foreach ($blogs as $blog)
        {
            $date = new \DateTime($blog->created_at);
            $blog->createdAt = $date->format("d F Y");
            $image = \App\BlogsImages::where("id_blog", $blog->id)->orderBy("order", "ASC")->first();
            $blog->image = (is_object($image)) ? env("GOOGLE_CLOUD_PUBLIC_ACCESS").$image->path : "images/resource/news-1.jpg";
            $blogHTML .= view("blogs/blogcard", array(
                "blog" => $blog
            ));
        }

        if (count($blogs) === $limit)
        {
            $blogHTML .= view("blogs/nextpage", array(
                "page" => ( $page + 1 )
            ));
        }

        return $blogHTML;
    }

}