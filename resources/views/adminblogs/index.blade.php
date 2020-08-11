<form id="form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div id="properties" class="col-12">
                {!! $listado !!}
            </div>        
        </div>
    </div>
</form>

<script>


function searchContacts()
    {
        $.ajax({
            type: "POST",
            url: "AdminBlogs.listado",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $("#form").serialize(),
            success: function(data)
            {
                $('#properties').html(data);
            }
        })
    }

    $(document).ready ( function() {
        $('#form input').on("keyup", function() {
            searchContacts();
        });
    })
</script>