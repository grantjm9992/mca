
		<!-- Inner Banner Start -->
		<div class="at-haslayout at-innerbannerholder">
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-12">
						<div class="at-innerbannercontent">
							<div class="at-title"><h2>Read our latest blogs</h2></div>
							<ol class="at-breadcrumb">
								<li><a href="/">Main</a></li>
								<li>Blogs</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Home Slider End -->
		<main id="at-main" class="at-main at-haslayout">
			<!-- Two Columns Start -->
			<div class="at-haslayout at-main-section">
				<div class="container">
					<div class="row">
						<div id="at-twocolumns" class="at-twocolumns at-haslayout">
                    <div class="at-blog-grid at-haslayout">
                        <div class="filter-list row" id="blogs">
                            {!! $blogHTML !!}
                        </div>
                    </div>
                </div>
            </div>
        </main>
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