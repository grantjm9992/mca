
			<!-- Articles Start -->
			<section class="at-haslayout at-main-section">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-12 col-md-12 push-md-0 col-lg-10 push-lg-1 col-xl-8 push-xl-2">
							<div class="at-sectionhead">
								<div class="at-sectiontitle">
									<h2>Travel like a Local</h2>
									<span> Learn about the area surrounding the Corvera resort on our Blog page</span>
								</div>
								<div class="at-description">
									<p>There is so much to do in and around the Corvera resort. Whether you are looking to try out some of the many golf courses in the region or hoping to explore the Vibrant city of Murcia, there is truly something for everyone.</p>
								</div>
							</div>
						</div>
						<div class="at-articles">
                            @foreach ($blogs as $blog)
							<div class="col-12 col-md-6 col-lg-4 float-left">
								<div class="at-article">
									<figure class="at-articleimg">
										<img src="{{ $blog->image }}" alt="img description">
										<figcaption><a href="Blog?{{ $blog->slug }}" class="at-tag">Featured</a></figcaption>
									</figure>
									<div class="at-article-content">
										<div class="at-featured-tags"><a href="Blog?{{ $blog->slug }}">{{ $blog->subtitle }}</a> </div>
										<div class="at-title">
											<h4>{{ $blog->title }}</h4>
											<span>{{ $blog->createdAt }}</span>
										</div>
										<div class="at-description">
											<p>{{ $blog->desc }}<a href="Blog?{{ $blog->slug }}">[more]</a></p>
										</div>
									</div>
								</div>
                            </div>
                            @endforeach
						</div>
					</div>
				</div>
			</section>
			<!-- Articles End -->