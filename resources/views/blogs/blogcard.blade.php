
<div class="news-block col-lg-4 col-12">
    <div class="inner-box">
        <div class="image-box">
            <figure class="image"><a href="Blog.detail?{{ $blog->slug }}"><img src="{{ $blog->image }}" alt=""></a></figure>
        </div>
        <div class="lower-content">
            <ul class="info">
                <li><span>{{ $blog->subtitle }}</span></li>
                <li>{{ $blog->createdAt }}</li>
            </ul>
            <h3><a href="Blog.detail?{{ $blog->slug }}">{{ $blog->title }}</a></h3>
        </div>
    </div>
</div>
