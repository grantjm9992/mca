
		<!-- Inner Banner Start -->
		<div class="at-haslayout at-blogbannerholder" style="background-image: url({{ $blog->image }});">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-12">
						<div class="at-blogbannercontent">
							<div class="at-title">
								<div class="at-username">
									<a href="javascript:void(0);">{{ $blog->subtitle }}</a>
									<h2>{{ $blog->title }}</h2>
								</div>
								<ul class="at-userreport">
									<li><span>{{ $blog->createdAt }}</span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Home Slider End -->
		<!-- Main Start -->
		<main id="at-main" class="at-main at-haslayout">
			<!-- Two Columns Start -->
			<div class="at-haslayout at-main-section">
				<div class="container">
					<div class="row">
						<div id="at-twocolumns" class="at-twocolumns at-haslayout">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-4 float-right">
								<aside id="at-sidebar" class="at-sidebar float-left mt-md-0">
									<div class="at-sideholder">
										<a href="javascript:void(0);" id="at-closesidebar" class="at-closesidebar"><i class="ti-close"></i></a>
										<div class="at-sidescrollbar">
											<div class="at-widgets-holder">
												<div class="at-widgets-title">
													<h2>Other blogs</h2>
												</div>
												<div class="at-widgets-content">
													<ul class="at-toprated">
                                                        @foreach ($blogs as $post)
														<li class="at-toprated-content">
															<figure><img src="{{ $post->image }}" alt="img description"></figure>
															<div class="at-topratedlisting">
																<div class="at-featured-tags"><a href="Blog?{{ $post->slug }}"></a> </div>
																<div class="at-topratedtitle">
																	<h3><a href="Blog?{{ $post->slug }}">{{ $post->title }}</a><span><em>{{ $post->createdAt }}</em></span></h3>
																</div>
															</div>
                                                        </li>
                                                        @endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
								</aside>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 float-left">
								<div class="at-blogsingle">
									<div class="at-gridlist-option at-option-mt">
										<a href="javascript:void(0);" id="at-btnopenclose" class="at-btnopenclose"><i class="ti-settings"></i></a>
									</div>
									<div class="at-blogsingle-description">
										<div class="at-description">
                                            {!! $blog->description !!}
                                        </div>
                                    </div>
                                    <!--
									<div class="at-tagsshare-holder">
										<ul class="at-widgettag">
											<li><a href="javascript:void(0);">Classified</a></li>
											<li><a href="javascript:void(0);">DIY</a></li>
											<li><a href="javascript:void(0);">Vacations</a></li>
											<li><a href="javascript:void(0);">Travel</a></li>
											<li><a href="javascript:void(0);">Tourism</a></li>
										</ul>
										<div class="at-tagsshare">
											<a href="javascript:void(0);">Share:<i id="at-shareooption" class="fa fa-share"></i> </a>
											<ul class="at-socialicons">
												<li class="at-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
												<li class="at-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
												<li class="at-youtube"><a href="javascript:void(0);"><i class="fab fa-youtube"></i></a></li>
												<li class="at-instagram"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
											</ul>
										</div>
                                    </div>
                                    -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Two Columns End -->
		</main>
		<!-- Main End -->