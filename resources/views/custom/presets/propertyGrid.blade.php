
		<!-- Inner Banner Start
		<div class="at-innerbanner-holder at-haslayout at-innerbannersearch">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12">
						<div class="at-innerbanner-search">
							<form class="at-formtheme at-form-advancedsearch">
								<fieldset>
									<div class="form-group">
										<div class="at-select">
											<select>
												<option value="" hidden="">Where You Want To Stay</option>
												<option value="twitter">China</option>
												<option value="linkedin">France</option>
												<option value="rss">Germany</option>
												<option value="vimeo">Italy</option>
												<option value="tumblr">Japan</option>
											</select>
										</div>
									</div>
									<div class="form-group at-checkin-holder at-datecheck">
										<input type="text" id="at-startdate" class="form-control" placeholder="in">
									</div>
									<div class="form-group at-checkout-holder at-datecheck">
										<input type="text" id="at-enddate" class="form-control" placeholder="out">
									</div>
									<div class="at-btnarea">
										<a href="javascript:void(0);" class="at-btn at-btnactive">Search Now</a>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		 Inner Banner End -->
		<!-- Main Start -->
		<main id="at-main" class="at-main at-haslayout">
			<!-- Two Columns Start -->
			<div class="at-haslayout at-main-section">
				<div class="container">
					<div class="row">
						<div id="at-twocolumns" class="at-twocolumns at-haslayout">
							<div class="col-xs-12">
							<!-- Properties List Start -->
								<div class="at-showresult-holder">
									<div class="at-resulttitle">
										<span>12,560 matches found for: <strong>“House” In “Manchester”</strong></span>
									</div>
									<div class="at-rightarea">
										<div class="at-select">
											<select>
												<option value="Sort By:" hidden>Sort By:</option>
												<option value="Sort By:">Sort By Date</option>
												<option value="Sort By:">Sort By Featured</option>
											</select>
										</div>
										<div class="at-gridlist-option">
											<a href="javascript:void(0);" class="at-linkactive"><i class="ti-layout-grid2"></i></a>
											<a href="javascript:void(0);"><i class="ti-view-list"></i></a>
											<a href="javascript:void(0);"><i class="ti-location-pin"></i></a>
											<a href="javascript:void(0);" id="at-btnopenclose" class="at-btnopenclose"><i class="ti-settings"></i></a>
										</div>
									</div>
								</div>
								<div class="at-properties-grid at-haslayout">
									<div class="row">
                						@foreach ( $properties as $property )
										<div class="col-12 col-md-6 col-xl-4">
											<div class="at-featured-holder">
												<div class="at-featuredslider owl-carousel">
                            					@if (count($property->images) > 0 )
                                    			@foreach( $property->images as $image )
													<figure class="item">
														<a href="javascript:void(0);"><img src="{{env('GOOGLE_CLOUD_PUBLIC_ACCESS')}}{{ $image->path }}" alt="img description" class="item"></a>
														<figcaption>
															<div class="at-slider-details">
																<a href="javascript:void(0);" class="at-tag">Featured</a>
																<a href="javascript:void(0);" class="at-tag at-rated">Top Rated</a>
															</div>
														</figcaption>
													</figure>
												@endforeach
												@else
												<figure class="item">
													<a href="javascript:void(0);"><img src="theme_two/images/featured-img/img-01.jpg" alt="img description" class="item"></a>
													<figcaption>
														<div class="at-slider-details">
															<a href="javascript:void(0);" class="at-tag">Featured</a>
															<a href="javascript:void(0);" class="at-tag at-rated">Top Rated</a>
															<span class="at-photolayer"><i class="fas fa-layer-group"></i>04 Photos</span>
															<a href="javascript:void(0);" class="at-like at-liked">Saved<i class="far fa-heart"></i></a>
														</div>
													</figcaption>
												</figure>												
												@endif
												</div>
												<div class="at-featured-content">
													<div class="at-featured-head">
														<div class="at-featured-tags"><a href="javascript:void(0);">{{ $property->type }}</a> </div>
														<div class="at-featured-title">
															<h3>{{$property->public_title }} <!--<span>$240 <em>/ night</em></span>--></h3>
															<!--
															<div class="at-userimg at-verifieduser">
																<img src="theme_two/images/featured-img/img-04.jpg" alt="img description">
																<i class="fa fa-shield-alt"></i>
															</div>
															-->
														</div>
														<!--
														<div class="at-featurerating">
															<span class="at-stars"><span></span></span><em>14236 review</em>
														</div>
														-->
														<ul class="at-room-featured">
															<li><span><i><img src="theme_two/images/featured-img/icons/img-01.jpg" alt="img description"></i> {{ $property->beds }} Beds</span></li>
															<li><span><i><img src="theme_two/images/featured-img/icons/img-02.jpg" alt="img description"></i> {{ $property->bedrooms }} Bedrooms</span></li>
															<li><span><i><img src="theme_two/images/featured-img/icons/img-03.jpg" alt="img description"></i> {{ $property->sleeps }} Guests </span></li>
															<li><span><i><img src="theme_two/images/featured-img/icons/img-04.jpg" alt="img description"></i> 02 Bedrooms</span></li>
														</ul>
													</div>
													<div class="at-featured-footer">
														<address>{{ $property->resort }}</address>
														<div class="at-share-holder">
															<a href="javascript:void(0);"><i class="ti-more-alt"></i></a>
															<div class="at-share-option">
																<span>Share:</span>
																<ul class="at-socialicons">
																	<li class="at-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
																	<li class="at-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
																	<li class="at-youtube"><a href="javascript:void(0);"><i class="fab fa-youtube"></i></a></li>
																	<li class="at-instagram"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endforeach
									</div>
								</div>
							<!-- Properties List End -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Two Columns End -->
		</main>
		<!-- Main End -->