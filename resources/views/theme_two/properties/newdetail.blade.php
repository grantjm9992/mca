
		<!-- Inner Banner Start -->
		<div class="at-haslayout at-propertybannerholder">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-12">
						<div class="at-propertybannercontent">
							<div class="at-propertyholder">
								<div class="at-title">
									<div class="at-tags">
										<a href="javascript:void(0);" class="at-tag">Featured</a>
									</div>
									<div class="at-username">
										<a href="javascript:void(0);">{{ $property->type }}</a>
										<h2>{{ $property->public_title }}</h2>
										<address><i class="fa fa-location-arrow"></i>{{ $property->resort }}</address>
									</div>
								</div>
                            </div>
                            <!--
							<div class="at-rightarea">
								<div class="at-singlerate">
									<span><em>$640</em>/night</span>
								</div>
								<div class="at-featurerating">
									<span class="at-stars"><span></span></span><em>14236 review</em>
								</div>
								<ul class="at-featureabout">
									<li><a href="javascript:void(0);" class="at-like at-liked"><i class="far fa-heart"></i>Saved</a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-bug"></i>Report Property</a></li>
								</ul>
                            </div>
                            -->
						</div>
					</div>
				</div>
			</div>
			<div id="propertydetail-carousel" class="owl-carousel">
                @foreach ($images as $image)
                <div style="width: 100%; background-image: url({{ $image->abs_path }}); height: 80vh; background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                @endforeach
			</div>
		</div>
		<!-- Home Slider End -->
		<!-- Main Start -->
		<main id="at-main" class="at-main at-haslayout">
			<!-- Two Columns Start -->
			<div class="at-haslayout at-main-section at-propertysingle-mt">
				<div class="container">
					<div class="row">
						<div id="at-twocolumns" class="at-twocolumns at-haslayout">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-4 float-right">
								<aside id="at-sidebar" class="at-sidebar float-left mt-md-0">
									<div class="at-sideholder">
										<a href="javascript:void(0);" id="at-closesidebar" class="at-closesidebar"><i class="ti-close"></i></a>
										<div class="at-sidescrollbar">
											<div class="at-widgets-holder at-textfee-holder">
                                                <!--
												<div class="at-widgets-title at-title-textfee" id="headingone" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone" role="heading">
													<h2>$2528<span>/for 03 nights</span></h2>
												</div>
												<div class="at-widgets-content collapse show" id="collapseone" aria-labelledby="headingone">
													<ul class="at-taxesfees">
														<li><span>$640 x 3 nights <em>$1920<i class="far fa-question-circle toltip-content" data-tipso="Plus Member"></i></em></span></li>
														<li><span>Car Rental <em>$222<i class="far fa-question-circle toltip-content" data-tipso="Plus Member"></i></em></span></li>
														<li><span>Fresh Groceries <em>$16<i class="far fa-question-circle toltip-content" data-tipso="Plus Member"></i></em></span></li>
														<li><span>Medical Representative <em>$50<i class="far fa-question-circle toltip-content" data-tipso="Plus Member"></i></em></span></li>
														<li class="at-textfee"><span>Taxes &amp; Fees<i class="far fa-question-circle toltip-content" data-tipso="Plus Member"></i><em>$320</em></span></li>
														<li class="at-toteltextfee"><span>Total<em>$2528</em></span></li>
													</ul>
                                                </div>
                                                -->
												<div class="at-booking-holder">
													<form class="at-formtheme at-formbanner">
														<fieldset class="at-datetime">
															<legend class="at-formtitle">When To Check In?</legend>
															<div class="form-group">
																<div class="at-selectdate-holder">
																	<div class="at-select">
																		<label>Check-In:</label>
																		<input type="text" id="at-startdate" class="form-control" placeholder="date">
																	</div>
																	<div class="at-select">
																		<label>Check-Out:</label>
																		<input type="text" id="at-enddate" class="form-control" placeholder="date">
																	</div>
																	<a href="javascript:void(0);" class="at-calendarbtn"><i class="ti-calendar"></i></a>
																</div>
															</div>
														</fieldset>
														<fieldset class="at-guestsform">
															<legend class="at-formtitle">Guests</legend>
															<div class="form-group">
																<ul class="at-guestsinfo">
																	<li>
																		<div class="at-gueststitle">
																			<span>Guests</span>
																		</div>
																		<div class="at-guests-radioholder">
																			
																			<div class="at-dropdown">
																				<span><em class="selected-search-type">01 </em><i class="ti-angle-down"></i></span>
																			</div>
																			<div class="at-radioholder">
																				<span class="at-radio">
																					<input id="at-adults1" data-title="01" type="radio" name="adults" value="adults" checked="">
																					<label for="at-adults1">01</label>
																				</span>
																				<span class="at-radio">
																					<input id="at-adults2" data-title="02" type="radio" name="adults" value="adults2">
																					<label for="at-adults2">02</label>
																				</span>
																				<span class="at-radio">
																					<input id="at-adults3" data-title="03" type="radio" name="adults" value="adults3">
																					<label for="at-adults3">03</label>
																				</span>
																				<span class="at-radio">
																					<input id="at-adults4" data-title="04" type="radio" name="adults" value="adults4">
																					<label for="at-adults4">04</label>
																				</span>
																				<span class="at-radio">
																					<input id="at-adults5" data-title="05" type="radio" name="adults" value="adults5">
																					<label for="at-adults5">05</label>
																				</span>
																				<span class="at-radio">
																					<input id="at-adults6" data-title="06" type="radio" name="adults" value="adults6">
																					<label for="at-adults6">06</label>
																				</span>
																			</div>
																		</div>
																	</li>
																</ul>
															</div>
														</fieldset>
														<fieldset>
															<div class="at-btnarea">
																<a href="javascript:void(0)" class="at-btn at-btnactive">Enquire Now</a>
															</div>
														</fieldset>
													</form>
												</div>
											</div>
											<div class="at-widgets-holder">
												<div class="at-widgets-title">
													<h2>Share Property</h2>
												</div>
												<div class="at-widgets-content at-widgets-mt at-sharingicons">
													<ul class="at-socialicons at-socialiconsbg">
														<li class="at-facebook">
															<a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
														</li>
														<li class="at-twitter">
															<a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
														</li>
														<li class="at-facebook-messenger">
															<a href="javascript:void(0);"><i class="fab fa-facebook-messenger"></i></a>
														</li>
														<li class="at-linkedin">
															<a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
														</li>
														<li class="at-whatsapp">
															<a href="javascript:void(0);"><i class="fab fa-whatsapp"></i></a>
														</li>
														<li class="at-viber">
															<a href="javascript:void(0);"><i class="fab fa-viber"></i></a>
														</li>
														<li class="at-googleplus">
															<a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i></a>
														</li>
														<li class="at-instagram">
															<a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
														</li>
														<li class="at-code">
															<a href="javascript:void(0);"><i class="fa fa-code"></i></a>
														</li>
														<li class="at-share">
															<a href="javascript:void(0);"><i class="fa fa-clone"></i></a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</aside>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 float-left">
								<div class="at-gridlist-option at-option-mt">
									<a href="javascript:void(0);" id="at-btnopenclose" class="at-btnopenclose"><i class="ti-settings"></i></a>
								</div>
								<div class="at-propertylinkdetails at-haslayout">
									<ul class="at-propertylink">
										<li><a href="#at-about">About</a></li>
										<li><a href="#at-amenetiesproperty">Ameneties Others</a></li>
										<li><a href="#at-locationsproperty">Nearby</a></li>
										<li><a href="#at-availability">Availability</a></li>
										<li><a href="#at-termspolicy-holder">Terms &amp; Rules</a></li>
									</ul>
									<div id="at-about" class="at-propertydetails at-aboutproperty">
										<div class="at-propertytitle">
											<h3>About Property</h3>
										</div>
										<div class="at-description">
                                            {!! $property->description !!}
										</div>
									</div>
									<div class="at-propertydetails at-detailsproperty">
										<div class="at-propertytitle">
											<h3>Property Details</h3>
										</div>
										<ul class="at-detailslisting">
											<li><h4>Accomodation</h4><span>{{ $property->sleeps }} Guests</span></li>
											<li><h4>Bedrooms</h4><span>{{ $property->bedrooms }}</span></li>
											<li><h4>Bathrooms</h4><span>{{$property->bath }}</span></li>
											<li><h4>Type</h4><span>{{ $property->type }}</span></li>
											<li><h4>Check-In Start @</h4><span>11:00 am</span></li>
										</ul>
									</div>
									<div id="at-amenetiesproperty" class="at-propertydetails at-amenetiesproperty">
										<div class="at-propertytitle">
											<h3>Ameneties</h3>
										</div>
										<ul id="at-amenetieslisting" class="at-amenetieslisting">
                                            @foreach ($features as $row )
											<li>
												<div class="at-amenetiesicon">
													<i class="{{ $row->icon }}"></i>
												</div>
												<div class="at-amenetiescontent">
													<span>{{ $row->title }}</span>
												</div>
                                            </li>
                                            @endforeach
										</ul>
									</div>
                                    @if (!is_null($nearby))
									<div id="at-locationsproperty" class="at-propertydetails at-locationsproperty">
										<div class="at-propertytitle">
											<h3>Nearby Locations</h3>
										</div>
										<div class="at-description">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempoer incididunt ut labore et dolore magna aliqua ut enim ad minim veniam, quis nrud exercitation ullamco.</p>
										</div>
										<div id="at-nearbylocations-holder" class="at-nearbylocations-holder">
                                        @foreach ( $nearby as $row )
											<div class="at-nearbylocations">
												<div class="at-title">
													<h4><i class="{{$row->iconClass}}"></i>{{$row->type}}</h4>
												</div>
												<ul class="at-locationsinfo">
                                                    @foreach ( $row->examples as $example )
													<li>
                                                        <span>{{ $example->name }} <em>(0.02 mi)</em></span>
                                                        @if ($example->link != "")
                                                        <span> <a target="_blank" href="{{ $example->link }}">Visit website</a></span>
                                                        @endif
                                                    </li>
                                                    @endforeach
												</ul>
											</div>
                                        @endforeach
										</div>
                                    </div>
                                    @endif
									<div id="at-availability" class="at-propertydetails at-availability">
										<div class="at-propertytitle">
											<h3>Availability</h3>
										</div>
										<div class="at-description">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempoer incididunt ut labore et dolore magna aliqua ut enim ad minim veniam, quis nrud exercitation ullamco.</p>
										</div>
										<div class="at-availability-holder">
											<div id="at-calendar-slider" class="at-calendar-slider owl-carousel">
												<div class="at-calendar-two item">
													<div id="at-calendar1" class="at-calendar at-disabled"></div>
												</div>
												<div class="at-calendar-two item">
													<div id="at-calendar2" class="at-calendar at-disabled"></div>
												</div>
												<div class="at-calendar-two item">
													<div id="at-calendar3" class="at-calendar at-disabled"></div>
												</div>
											</div>
											<div class="at-availability-status">
												<span class="at-available">Available</span>
												<span class="at-occupied">Occupied</span>
												<span class="at-closed">Closed</span>
											</div>
										</div>
									</div>
									<div id="at-termspolicy-holder" class="at-termspolicy-holder at-haslayout">
										<div class="at-termspolicy">
											<figure class="at-termspolicy-img">
												<img src="theme_two/images/property-single/team-img.jpg" alt="img description">
											</figure>
											<div class="at-termspolicy-content">
												<div class="at-title">
													<h3>Terms &amp; Policy</h3>
												</div>
												<div class="at-description">
													<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore etdolore magna aliqua enim adminim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat aute irure dolor in reprehenderit ina voluptate velit esse cillum fugiat nulla pariatur.</p>
												</div>
												<div class="at-btnarea">
													<a href="javascript:void(0);" class="at-btn at-btnactive">Read All Policies</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Two Columns End -->
		</main>
		<!-- Main End -->