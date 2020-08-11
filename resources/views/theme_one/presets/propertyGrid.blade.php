
    <section class="property-section">
        <div class="auto-container">
            <div class="sec-title">
                <span class="title">FIND THE PERFECT PROPERTY</span>
                <h2>HOLIDAY RENTALS</h2>
            </div>

            <div class="row">

                @foreach ( $properties as $row )
                <!-- Property Block -->
                <div class="property-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image-box">
                            @if (count($row->images) > 0 )
                            <div class="single-item-carousel owl-carousel owl-theme">
                                    @foreach( $row->images as $image )
                                        <figure class="image"><img src="{{env('GOOGLE_CLOUD_PUBLIC_ACCESS')}}{{ $image->path }}" alt=""></figure>
                                    @endforeach
                            </div>
                            @else
                                <figure class="image"><img src="img/no-image.png" alt=""></figure>
                            @endif
                            <span class="featured">FEATURED</span><!--
                            <ul class="info clearfix">
                                <li><a href="properties.html"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                <li><a href="agent-detail.html"><i class="la la-user-secret"></i>Ghaly Morca</a></li>
                            </ul>-->
                        </div>
                        <div class="lower-content"><!--
                            <ul class="tags">
                                <li><a href="Properties.detail?id={{ base64_encode($row->id) }}">Apartment</a>,</li>
                                <li><a href="Properties.detail?id={{ base64_encode($row->id) }}">Bar</a>,</li>
                                <li><a href="Properties.detail?id={{ base64_encode($row->id) }}">House</a>,</li>
                            </ul>-->
                            <h3><a href="Properties.detail?id={{ base64_encode($row->id) }}">{{ $row->public_title }}</a></h3>
                            <div class="lucation"><i class="la la-map-marker"></i> {{ $row->resort }} </div>
                            <ul class="property-info clearfix">
                                <li><i class="flaticon-dimension"></i> {{$row->type}}</li>
                                <li><i class="flaticon-bed"></i> {{ $row->bedrooms }} Bedrooms</li>
                                <li><i class="flaticon-car"></i> {{ $row->sleeps }} Sleep(s)</li>
                                <li><i class="flaticon-bathtub"></i> {{ $row->bath }} Bathroom(s)</li>
                            </ul>
                            <div class="property-price clearfix">
                                <div class="read-more"><a href="Properties.detail?id={{ base64_encode( $row->id ) }}" class="theme-btn">More Detail</a></div>
                                <!--<div class="price">$ 13,65,000</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach                
            </div>

            <div class="load-more-btn text-center">
                <a href="Properties" class="theme-btn btn-style-two">See all properties</a>
            </div>
        </div>
    </section>
    <!--End Property Section -->