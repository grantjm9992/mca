<form action="AdminBlogs.save" id="form" method="POST">
    <div class="container-fluid">
        <div class="row">
            @csrf()
            <input type="text" name="id" value="{{ $blog->id }}" hidden>
            <div class="col-12 form-group">
                <label for="">Public title</label>
                <input type="text" class="form-control" name="title" value="{{ $blog->title }}">
            </div>
            <div class="col-12 form-group">
                <label for="">Subtitle</label>
                <input type="text" class="form-control" name="subtitle" value="{{ $blog->subtitle }}">
            </div>
            <div class="col-12 form-group">
                <label for="">Slug</label>
                <input type="text" class="form-control" name="slug" value="{{ $blog->slug }}">
            </div>
            <div class="col-12 form-group">
                <label for="">Content</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{!! $blog->description !!}</textarea>
            </div>
        </div>
    </div>
</form>
@if ($blog->id != "" )
<div class="container-fluid">
    <h3 style="width: 100%; padding-bottom: 8px; border-bottom: 1px solid;">
    Images
    </h3>
    <form maxFiles="1" action="AdminBlogs.uploadImage" class="dropzone" id="my-awesome-dropzone">
        <input type="text" name="id" hidden value="{{ $blog->id }}">
        @csrf()
    </form>
    <div style="width: 100%; margin-top: 10px;" id="sortable">
    @foreach ( $images as $image )
        <div imageId="{{ $image->id }}" style="display: inline-block; margin-right: 15px; border-radius: 4px; box-shadow: 0 0 6px 0 rgba(0,0,0,0.4); position: relative; width: 150px; height: 130px; background: url({{env('GOOGLE_CLOUD_PUBLIC_ACCESS')}}{{ $image->path }}); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <i style="font-size: 20px; color: red; position: absolute; top: 4px; right: 4px; cursor: pointer;" onclick="deleteImage({{ $image->id }})" class="fas fa-times-circle"></i>
        </div>
    @endforeach
</div>
@endif


<script>
    function submitForm()
    {
        $('#form').submit();
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
        var html = `{!! $blog->description !!}`;
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
            url: "AdminBlogs.updateImageOrder",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: '{{ $blog->id }}',
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
    

    function deleteImage(id)
    {
        $.ajax({
            type: "POST",
            url: "AdminBlogs.removeImage",
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

    
    function deleteBlog()
    {
        var options = Array();
        options.icon = "warning";
        options.text = "Are you sure that you want to delete this blog? This can't be undone";
        options.title = "Warning";
        options.type = "confirm";
        options.thenFunction = confirmDelete;
        sweetAlert( options );
    }

    function confirmDelete()
    {
        $.ajax({
            type: "POST",
            url: "AdminBlogs.delete",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:
            {
                id: "{{ $blog->id }}"
            },
            success: function(data)
            {
                var s = jQuery.parseJSON( data );
                if ( s.success === 1 )
                {
                    window.location.href = "AdminBlogs";
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