<div class="col-12 col-md-6 col-lg-4">
    <div class="at-article">
        <figure class="at-articleimg">
            <img src="{{ $blog->image }}" alt="img description">
            <figcaption><a href="Blog.detail?{{ $blog->slug }}" class="at-tag">Featured</a></figcaption>
        </figure>
        <div class="at-article-content">
            <div class="at-featured-tags"><a href="Blog.detail?{{ $blog->slug }}">{{ $blog->subtitle }}</a> </div>
            <div class="at-title">
                <h4>{{ $blog->title }}</h4>
                <span>{{ $blog->createdAt }}</span>
            </div>
            <div class="at-description">
                <p>Consectetur adipisicing elitm sed at esmod tempor incididunt a labore alor...<a href="Blog.detail?{{ $blog->slug }}">[more]</a></p>
            </div>
        </div>
    </div>
</div>