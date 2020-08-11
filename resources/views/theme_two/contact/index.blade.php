
		<!-- Inner Banner Start -->
		<div class="at-haslayout at-innerbannerholder">
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-12">
						<div class="at-innerbannercontent">
							<div class="at-title"><h2>Contact Us</h2></div>
							<ol class="at-breadcrumb">
								<li><a href="/">Main</a></li>
								<li>Contact</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Home Slider End -->
		<!-- Main Start -->
		<main id="at-main" class="at-main at-haslayout">
			<!-- Contact Form Start -->
			<section class="at-haslayout at-main-section">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-12 col-md-12 push-md-0 col-lg-10 push-lg-1 col-xl-8 push-xl-2">
							<div class="at-sectionhead">
								<div class="at-sectiontitle">
									<h2>Get In Touch With Us</h2>
								</div>
								<div class="at-description">
									<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisiut aliquip</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-12 push-md-0 col-lg-12 col-xl-10 push-xl-1">
							<form class="at-formtheme at-formcontactus" action="Home.register">
								<fieldset>
									<div class="form-group form-group-half">
										<input type="text" name="name" class="form-control" placeholder="First Name">
									</div>
									<div class="form-group form-group-half">
										<input type="text" name="surname" class="form-control" placeholder="Last Name">
									</div>
									<div class="form-group form-group-half">
										<input type="email" name="email" class="form-control" placeholder="Your Email">
									</div>
									<div class="form-group form-group-half">
										<input type="text" name="subject" class="form-control" placeholder="Subject">
									</div>
									<div class="form-group">
										<textarea class="form-control" name="message" placeholder="Message" required></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="at-btn">Send Now</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</section>
			<!-- Contact Form End -->
			<div class="at-haslayout">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="at-contactus-details">
								<figure class="at-contactbg">
									<img src="theme_two/images/contactus/bg-img.png" alt="img description">
								</figure>
								<div class="at-contactinfo">
									<img src="theme_two/images/contactus/img-01.jpg" alt="img description">
									<span>Talk To Us</span>
									<h3>{{ $company->phone }}</h3>
								</div>
								<div class="at-contactinfo">
									<img src="theme_two/images/contactus/img-02.jpg" alt="img description">
									<span>Send Us Email</span>
									<h3>{{ $company->email }}</h3>
								</div>
								<div class="at-contactinfo">
									<img src="theme_two/images/contactus/img-03.jpg" alt="img description">
									<span>Our Open Location</span>
									<h3>{{ $company->address }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Map Start -->
			<div class="at-haslayout at-contactmap-holder">
				<div id="at-locationmap" class="at-locationmap"></div>
			</div>
			<!-- Map Start -->
		</main>
		<!-- Main End -->