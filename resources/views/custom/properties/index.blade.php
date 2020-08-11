
		<!-- Inner Banner Start -->
		<div class="at-haslayout at-innerbannerholder">
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-12">
						<div class="at-innerbannercontent">
							<div class="at-title"><h2>Available properties</h2></div>
							<ol class="at-breadcrumb">
								<li><a href="/">Main</a></li>
								<li>Search Result</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Inner Banner End -->
		<!-- Inner Banner Start -->
		{!! $search !!}
		<!-- Home Slider End -->
		<!-- Main Start -->
		<main id="at-main" class="at-main at-haslayout">
			<!-- Two Columns Start -->
			<div class="at-haslayout at-main-section">
				<div class="container">
					<div class="row">
						<div id="at-twocolumns" class="at-twocolumns at-haslayout">
							<div class="col-xs-12 col-sm-12 col-md-12 ">
							<!-- Properties List Start 
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
								</div>-->
								<div class=" at-haslayout">
									<div class="row text-center" id="properties">
                                        {!! $properties !!}									
									</div>
									<!--
									<nav class="at-pagination">
										<ul>
											<li class="at-prevpage"><a href="javascrip:void(0);"><i class="ti-angle-left"></i></a></li>
											<li class="at-active"><a href="javascrip:void(0);">1</a></li>
											<li><a href="javascrip:void(0);">2</a></li>
											<li><a href="javascrip:void(0);">3</a></li>
											<li><a href="javascrip:void(0);">4</a></li>
											<li><a href="javascrip:void(0);">...</a></li>
											<li><a href="javascrip:void(0);">50</a></li>
											<li class="at-nextpage"><a href="javascrip:void(0);"><i class="ti-angle-right"></i></a></li>
										</ul>
									</nav>
									-->
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
		<script>
			function nextPage() {
				var page = parseInt($("#page").val());
				page += 1;
				$("#page").val(page);
				$.ajax({
					type: "POST",
					url: "Properties.getListings",
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					data: $("#propertySearch").serialize(),
					success: function(data)
					{
						$('#nextButton').remove();
						$('#properties').append(data);
					}
				})
			}
		</script>