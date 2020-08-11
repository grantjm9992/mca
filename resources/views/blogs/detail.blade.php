<div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row">
                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-detail property-detail">
                        @if (!isset($blog->images))
                        <div class="upper-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ $blog->image }}" alt=""></figure>
                            </div>
                        </div>
                        @else
                        <div class="upper-box">
                            <div class="carousel-outer">
                                <ul class="image-carousel owl-carousel owl-theme">
                                    @foreach ( $blog->images as $row )
                                    <li><a href="{{env('GOOGLE_CLOUD_PUBLIC_ACCESS')}}{{ $row->path }}" class="lightbox-image" title="Image Caption Here"><img style="max-height: 570px;" src="{{env('GOOGLE_CLOUD_PUBLIC_ACCESS')}}{{ $row->path }}" alt=""></a></li>
                                    @endforeach
                                </ul>
                                
                                <ul class="thumbs-carousel owl-carousel owl-theme">
                                    @foreach ( $blog->images as $row )
                                    <li><img style="max-height: 230px;" src="{{env('GOOGLE_CLOUD_PUBLIC_ACCESS')}}{{ $row->path }}" alt=""></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="lower-content">
                            <ul class="info">
                                <li><span>{{ $blog->createdAt }}</li>
                            </ul>
                            <h3>{{ $blog->title }}</h3>
                            <p>{{ $blog->subtitle }}</p>
                            <div class="mt-2">
                                {!! $blog->description !!}
                            </div>
                        </div>

                        <!-- Post Share Option -->
                        <div class="post-share-options clearfix">
                            <div class="pull-left clearfix">
                                <span class="icon la la-tags"></span>
                                <ul class="tags"><!--
                                    <li><a href="#">Apartment,</a>,</li>
                                    <li><a href="#">Condo,</a>,</li>
                                    <li><a href="#">Multi Family,</a></li>
                                    <li><a href="#">Villa</a></li>-->
                                </ul>
                            </div>
                            <div class="pull-right clearfix">
                                <ul class="social-icon clearfix">
                                    <li><a href="#"><i class="la la-facebook"></i></a></li>
                                    <li><a href="#"><i class="la la-twitter"></i></a></li>
                                    <li><a href="#"><i class="la la-google-plus"></i></a></li>
                                    <li><a href="#"><i class="la la-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar default-sidebar">
                        <!-- Recent Properties -->
                        <div class="sidebar-widget recent-properties">
                            <div class="sidebar-title"><h3>Recent Blogs</h3></div>
                            <div class="widget-content">
                                @foreach ( $blogs as $post )
                                <!-- Post -->
                                <article class="post">
                                    <div class="post-thumb">
                                        <a href="Blog.detail?{{ $post->slug }}">
                                            <img src="{{ $post->image }}" alt="">
                                        </a>
                                    </div>
                                    <h3><a href="Blog.detail?{{ $post->slug }}">{{ $post->title }}</a></h3>
                                    <div class="price">{{ $post->createdAt }}</div>
                                </article>
                                @endforeach
                                <div class="mt-2 w-100 text-center">
                                    <a class="theme-btn btn-style-one" href="Blog">View All</a>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>