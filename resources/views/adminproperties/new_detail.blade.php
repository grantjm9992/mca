<div class="w-100 px-5 mb-5">
<ul class="nav nav-pills d-block d-lg-flex">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="pill" href="#general">General Information</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#ota_access">OTA access</a>
  </li>
  <li class="nav-item">
    <a href="#features" data-toggle="pill" class="nav-link">
        Features
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#images">Images</a>
  </li>
</ul>

</div>
<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane container-fluid px-5 active" id="general">
        <form action="AdminProperties.save" id="generalTab">
            <input type="text" name="id" value="{{ $property->id }}" hidden>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Public title</label>
                        <input type="text" class="form-control" name="public_title" value="{{ $property->public_title }}">
                    </div>
                    <div class="col-12 col-lg-6 form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" value="{{ $property->title }}" class="form-control" required>
                    </div>
                    <div class="col-12 col-lg-6 form-group">
                        <label for="">Resort</label>
                        <select name="id_resort" id="id_resort" class="form-control" required>
                            @foreach ( $resorts as $resort )
                                <option value="{{ $resort->id }}">{{ $resort->name }}</option>
                            @endforeach
                        </select>
                        <script>
                            $(document).ready(function() {
                                $('#id_resort').val("{{$property->id_resort}}");
                            });
                        </script>
                    </div>
                    <div class="form-group col-12 col-lg-4">
                        <label for="notify_email">Is rental property</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                @if ( (int)$property->is_rental === 1 )
                                <script>
                                    $(document).ready( function() {
                                        $('#notify_email').click();
                                    })
                                </script>
                                @endif
                                <input class="form-check-input" type="checkbox" value="1" name="is_rental" id="notify_email">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Property type</label>
                        <select name="id_property_type" id="id_property_type" class="form-control" required>
                            @foreach ( $propertytypes as $type )
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Information section</label>
                        <select name="id_info_section" id="id_info_section" class="form-control">
                            @foreach ( $sections as $section )
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="col-6 col-lg-3 form-group">
                        <label for="">Sleeps</label>
                        <input type="number" name="sleeps" value="{{ $property->sleeps }}" class="form-control">
                    </div>
                    <div class="col-6 col-lg-3 form-group">
                        <label for="">Beds</label>
                        <input type="number" name="bed" value="{{ $property->bed }}" class="form-control">
                    </div>
                    <div class="col-6 col-lg-3 form-group">
                        <label for="">Bedrooms</label>
                        <input type="number" name="bedrooms" value="{{ $property->bedrooms }}" class="form-control">
                    </div>
                    <div class="col-6 col-lg-3 form-group">
                        <label for="">Bathrooms</label>
                        <input type="number" name="bath" value="{{ $property->bath }}" class="form-control">
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Location</label>
                        <input type="text" name="location" value="{{ $property->location }}" class="form-control" placeholder="Town, Country">
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Property owner</label>
                        <select class="form-control select2" name="id_property_owner" id="id_property_owner" style="width: 100%;" required>
                            <option selected="selected" value="">All</option>
                            @foreach( $property_owners as $po )
                            <option value="{{ $po->id }}">{{ $po->name }} {{ $po->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Assigned to</label>
                        <select class="form-control select2" name="id_assigned_to" id="id_assigned_to" style="width: 100%;" required>
                            <option selected="selected" value="">All</option>
                            @foreach( $staff as $po )
                            <option value="{{ $po->id }}">{{ $po->name }} {{ $po->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{!! $property->description !!}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane container-fluid px-5 fade" id="ota_access">
        <form id="otaSettingsInfo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div onclick="syncOTA('airbnb')" class="btn btn-primary">
                        <i class="fab fa-airbnb"></i> Sync with AirBnb
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">AirBnb Username</label>
                        <input type="text" class="form-control" name="airbnb_username" value="{{ $property->airbnb_username }}">
                    </div>
                    <div class="col-12 form-group">
                        <label for="">AirBnb password</label>
                        <input type="password" class="form-control" name="airbnb_password" value="{{ $property->airbnb_password }}">
                    </div>
                    <div class="col-12 form-group">
                        <label for="">AirBnb ID</label>
                        <input type="text" class="form-control" name="airbnb_id" value="{{ $property->airbnb_id }}">
                    </div>
                    @if ($property->airbnb_ota_settings_id != "" )
                        <div id="airbnb_success" class="alert alert-success"><i class="fab fa-airbnb"></i> Successfully synced with AirBnb</div>
                    @else
                        <div id="airbnb_success" style="display: none;" class="alert alert-success"><i class="fab fa-airbnb"></i> Successfully synced with AirBnb</div>
                    @endif
                    <div class="col-12 mt-3">
                        <div onclick="syncOTA('booking')" class="btn btn-primary">
                        <i class="fab fa-booking"></i> Sync with Booking
                        </div>
                    </div>
                    <div class="col-12 form-group mt-5">
                        <label for="">Booking Username</label>
                        <input type="text" class="form-control" name="booking_username" value="{{ $property->booking_username }}">
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Booking password</label>
                        <input type="password" class="form-control" name="booking_password" value="{{ $property->booking_password }}">
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Booking ID</label>
                        <input type="text" class="form-control" name="booking_id" value="{{ $property->booking_id }}">
                    </div>
                    @if ($property->airbnb_ota_settings_id != "" )
                        <div id="booking_success" class="alert alert-success"><i class="fab fa-booking"></i> Successfully synced with Booking</div>
                    @else
                        <div id="booking_success" style="display: none;" class="alert alert-success"><i class="fab fa-booking"></i> Successfully synced with Booking</div>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane container-fluid px-5 fade" id="features">
        <div class="container-fluid mb-3">
            <div class="row" style="margin: 10px auto;">
                <h3 style="width: 100%; padding-bottom: 8px; border-bottom: 1px solid;">
                    Features
                    <div class="buttons">
                        <div class="btn btn-outline-primary" onclick="manageFeatures()">
                            <i class="fas fa-list"></i> Manage features
                        </div>
                    </div>
                </h3>
                <div class="col-12" id="features">
                    {!! $featuresGrid !!}
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane container-fluid px-5 fade" id="images">
    
    <h3 style="width: 100%; padding-bottom: 8px; border-bottom: 1px solid;">
        Images
        </h3>
        <form maxFiles="1" action="AdminProperties.uploadImage" class="dropzone" id="my-awesome-dropzone">
            <input type="text" name="id" hidden value="{{ $property->id }}">
            @csrf()
        </form>
        <div style="width: 100%; margin-top: 10px;" id="sortable">
        @foreach ( $images as $image )
            <div imageId="{{ $image->id }}" style="display: inline-block; margin-right: 15px; border-radius: 4px; box-shadow: 0 0 6px 0 rgba(0,0,0,0.4); position: relative; width: 150px; height: 130px; background: url({{env('GOOGLE_CLOUD_PUBLIC_ACCESS')}}{{ $image->path }}); background-size: cover; background-repeat: no-repeat; background-position: center;">
                <i style="font-size: 20px; color: red; position: absolute; top: 4px; right: 4px; cursor: pointer;" onclick="deleteImage({{ $image->id }})" class="fas fa-times-circle"></i>
            </div>
        @endforeach
        </div>
    </div>
</div>

<script>
    function submitForm()
    {
        var otaSettingsInfo = $('#otaSettingsInfo').serialize();
        $.ajax({
            type: "POST",
            url: "AdminProperties.updateOTA?id={{ $property->id }}",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: otaSettingsInfo,
            success: function(data)
            {
                var required = $('[required]');
                var valid = true;
                for (var i = 0; i < required.length; i++)
                {
                    if ($(required[i]).val() == "")
                    {
                        $(required[i]).addClass('error');
                        valid = false;
                    }
                }
                if (valid) $('#generalTab').submit();
            }
        })
        /*
        if ($('#generalTab').validate()) {
            var otaSettingsInfo = $('#otaSettingsInfo').html();
            $('#generalTab').append(otaSettingsInfo);
            $('#generalTab').submit();
        } else {
            var required = $('#generalTab input[required]');
            $(required).removeClass();
            $.each(required, (i, e) => {
                $(e).addClass('error');
            });
        }*/
    }

    function syncOTA(ota)
    {
        var otaSettingsInfo = $('#otaSettingsInfo').serialize();
        $.ajax({
            type: "POST",
            url: "AdminProperties.syncPropertyWithOTA?id_property={{ $property->id }}&ota="+ota,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: otaSettingsInfo,
            success: function(data)
            {
                var response = JSON.parse(data);
                if (ota == 'airbnb')
                {
                    if (response.status == 'OK')
                    {
                        window.location = response.link;
                    }
                }
                else
                {
                    $('#booking_success').hide();
                    if (response.status == 'OK')
                    {
                        $('#booking_success').show();
                    }
                }
            }
        })
    }

    function manageFeatures()
    {
        $('#modal').remove();
        $.ajax({
            type: "POST",
            url: "AdminProperties.featuresModal",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:
            {
                id: "{{ $property->id }}"
            },
            success: function(data)
            {
                $('body').append(data);
            }
        })
    }
    

    $(document).ready( function() {
        $('#sortable').sortable({
            update: function() {
                updateOrder();
            }
        });
        $('#description').summernote({
            height: 250
        });
        var html = `{!! $property->description !!}`;
        $('#description').summernote('code', html);
    })

    function updateOrder()
    {        
        var elements = $('[imageId]');
        var ids = "";
        for ( var i = 0; i < elements.length; i++ ) {
            ids += $(elements[i]).attr('imageId')+"@#";
        }
        $.ajax({
            type: "POST",
            url: "AdminProperties.updateImageOrder",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: '{{ $property->id }}',
                ids: ids
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    md.showNotification("top", "center", "Order updated correctly");
                }
            }
        })
    }

    
    function updateFeatures()
    {
            
        $('#modal').modal("hide");
        $.ajax({
            type: "POST",
            url: "AdminProperties.updateFeatures",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $property->id }}",
                ids: $('#modal_tabla_selectIds').val()
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    var options = Array();
                    options.text = 'Features updated successfully';
                    options.title = "Success";
                    options.icon = "success";
                    sweetAlert(options);
                    updateFeatureTable();
                }
                else
                {
                    sweetAlert('There has been an error', "error");
                }
            }
        });
    }

    
    function updateFeatureTable()
    {
        $.ajax({
            type: "POST",
            url: "AdminProperties.featuresGrid",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $property->id }}"
            },
            success: function(data)
            {
                $('#features').html(data);
            }
        });
    }

    

    function deleteImage(id)
    {
        $.ajax({
            type: "POST",
            url: "AdminProperties.removeImage",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:
            {
                id: id
            },
            success: function(data)
            {
                $('[imageId="'+id+'"]').remove();
            }
        })
    }


    $(document).ready( function() {
        $('#id_property_owner').val('{{ $property->id_property_owner }}');
        $('#id_assigned_to').val('{{ $property->id_assigned_to }}');
        $('.select2').select2();
    });

    function copyLink()
    {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($("#encoded").val()).select();
        document.execCommand("copy");
        $temp.remove();
        md.showNotification("top", "center", "Copied to clipboard");
    }


    function addPropertyTask()
    {
        $.ajax({
            type: "POST",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "Tasks.addModal",
            data:
            {
                id_property: "{{ $property->id }}"
            },
            success: function( data ) 
            {
                $('#modal').remove();
                $('body').append(data);
                $('#modal').show();
            }
        })
    }

    
function deleteModel()
{
	var options = Array();
	options.icon = "warning";
	options.text = "Are you sure that you want to delete this property? This can't be undone";
	options.title = "Warning";
	options.type = "confirm";
	options.thenFunction = confirmDelete;
	sweetAlert( options );
}

function confirmDelete()
{
	$.ajax({
		type: "POST",
		url: "AdminProperties.delete",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data:
		{
			id: "{{ $property->id }}"
		},
		success: function(data)
		{
			var s = jQuery.parseJSON( data );
			if ( s.success === 1 )
			{
				window.location.href = "AdminProperties";
			}
			else
			{
				var options = Array();
				options.icon = "error";
				options.text = s.error;
				options.title = "Error";
				sweetAlert( options );
			}
		}
	})
}

</script>