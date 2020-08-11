
		<!-- Header Start -->
		<header id="at-header" class="at-header at-haslayout">
			<div class="at-topbarholder">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="at-topbar">
								<div class="at-topcominfo">
									<a href="tel:(+1)2345678900" class="at-callnum"><em>Call Us:</em> (+1) 2345 67 89 00</a>
									<ul class="at-socialicons">
										<li class="at-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
										<li class="at-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
										<li class="at-youtube"><a href="javascript:void(0);"><i class="fab fa-youtube"></i></a></li>
										<li class="at-instagram"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
									</ul>
								</div>
								<div class="at-loginarea float-right">
									<a href="javascript:void(0);" class="at-loginoption" data-toggle="modal" data-target="#loginpopup">Customer Login</a>
									<div class="at-detailsbtn-topbar">
										<a href="javascript:void(0);" class="at-btn at-btnactive">Rent a Property</a>
										<em>OR</em>
										<a href="javascript:void(0);" class="at-btn at-btnactive at-btntwo" data-toggle="modal" data-target="#findproperty">Find a Property</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="at-navigationarea">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<strong class="at-logo"><a href="index.html"><img src="theme_two/images/thisone.png" alt="company logo here"></a></strong>
							<div class="at-rightarea">
								<nav id="at-nav" class="at-nav navbar-expand-lg">
									<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
										<i class="lnr lnr-menu"></i>
									</button>
									<div class="collapse navbar-collapse at-navigation" id="navbarNav">
										<ul class="navbar-nav">
											<li class="nav-item">
												<a href="{{ url('/') }}">Home</a>
											</li>
											<li class="menu-item-has-children page_item_has_children at-navactive">
												<a href="javascript:void(0);">Services</a>
												<ul class="sub-menu">
													<li>
														<a href="{{ url('PropertyManagement') }}">Property Management</a>
													</li>
													<li>
														<a href="{{ url('PropertyRentals') }}">Expert Rental Services</a>
													</li>
													<li>
														<a href="{{ url('PropertyMaintenence') }}">Property Maintanence</a>
													</li>
												</ul>
											</li>
											<li class="nav-item">
												<a href="{{ url('/Properties') }}">Properties</a>
											</li>
											<li class="nav-item">
												<a href="{{ url('/About') }}">About</a>
											</li>
											<li class="nav-item">
												<a href="{{ url('Contact') }}">Contact us</a>
											</li>
										</ul>
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- Header End -->
