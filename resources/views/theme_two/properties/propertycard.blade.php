
<div class="col-12 col-md-6 col-lg-4 mb-3">
    <div class="at-featured-holder">
        <div class="">
            <figure class="item">
                <a href="Properties.detail?id={{ base64_encode($property->id) }}"><img src="{{ $property->image }}" alt="img description" class="item"></a>
                <figcaption>
                    <div class="at-slider-details"><!--
                        <a href="javascript:void(0);" class="at-tag">Featured</a>
                        <a href="javascript:void(0);" class="at-tag at-rated">Top Rated</a>
                        <span class="at-photolayer"><i class="fas fa-layer-group"></i>04 Photos</span>
                        <a href="javascript:void(0);" class="at-like at-liked">Saved<i class="far fa-heart"></i></a>
                        -->
                    </div>
                </figcaption>
            </figure>
        </div>
        <div class="at-featured-content">
            <div class="at-featured-head">
                <div class="at-featured-tags"><a href="javascript:void(0);">{{ $property->type }}</a> </div>
                <div class="at-featured-title">
                    <h3>{{ $property->public_title }}</h3>
                    <!--
                    <div class="at-userimg at-verifieduser">
                        <img src="images/featured-img/img-04.jpg" alt="img description">
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
                    <li><span><i><img src="theme_two/images/featured-img/icons/img-01.jpg" alt="img description"></i> {{ $property->sleeps }} Guests</span></li>
                    <li><span><i><img src="theme_two/images/featured-img/icons/img-02.jpg" alt="img description"></i> {{ $property->bedrooms }} Bedrooms</span></li>
                    <li><span><i><img src="theme_two/images/featured-img/icons/img-03.jpg" alt="img description"></i> {{ $property->beds }} Beds</span></li>
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