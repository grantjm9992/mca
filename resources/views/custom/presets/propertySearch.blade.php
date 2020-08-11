
    
		<div class="at-innerbanner-holder at-haslayout at-innerbannersearch">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12">
						<div class="at-innerbanner-search">
							<form class="at-formtheme at-form-advancedsearch" method="post" action="Properties" id="propertySearch">@csrf
                                <input type="hidden" name="page" id="page" value="1">
								<fieldset>
									<div class="form-group">
										<div class="at-select">
											<select name="id_resort">
												<option value="" hidden="">Where You Want To Stay</option>
                                                @foreach ( $resorts as $resort )
                                                @if ( isset($_REQUEST["id_resort"]) && $_REQUEST["id_resort"] == $resort->id ) 
                                                <option selected value="{{ $resort->id }}">{{ $resort->name }}</option>
                                                @else
                                                <option value="{{ $resort->id }}">{{ $resort->name }}</option>
                                                @endif
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="at-select">
											<select name="bedrooms" selected="2">
												<option value="" hidden="">How many bedrooms</option>
                                                @for ($i = 1; $i < 6; $i++)
                                                    @if ( isset($_REQUEST["bedrooms"]) && $_REQUEST["bedrooms"] == $i )
                                                    <option value="{{$i}}" selected>{{$i}}</option>
                                                    @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="at-select">
											<select name="sleeps">
												<option value="" hidden="">How many people</option>
                                                @for ($i = 1; $i < 6; $i++)
                                                    @if ( isset($_REQUEST["sleeps"]) && $_REQUEST["sleeps"] == $i )
                                                    <option value="{{$i}}" selected>{{$i}}</option>
                                                    @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
											</select>
										</div>
									</div>
									<div class="at-btnarea">
                                        <button type="submit" class="at-btn at-btnactive">Search</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>