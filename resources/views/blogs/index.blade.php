<section class="property-filter-section">
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="sec-title">
                <span class="title">LATEST CONDADO DE ALHAMA NEWS</span>
                <h2>CONDADO DE ALHAMA BLOG</h2>
            </div>
            <div class="row clearfix">
                <!--Content Side-->
                <div class="content-side col-lg-12">
                    <div class="blog-grid-view">
                        <div class="filter-list row" id="blogs">
                            {!! $blogHTML !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function loadNextPage(i)
    {
        $.ajax({
            type: "POST",
            url: "Blog.getBlogGrid",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                page: i
            },
            success: function(data)
            {
                $('#nextButton').remove();
                $('#blogs').append(data);
            }
        })
    }
</script>