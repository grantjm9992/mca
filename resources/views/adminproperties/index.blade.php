<form id="form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Public title</label>
                <input type="text" class="form-control" name="public_title" id="public_title">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Rentals</label>
                <select name="is_rental" id="" class="form-control">
                    <option value="">All</option>
                    <option value="1">Rentals only</option>
                    <option value="0">Non-rentals only</option>
                </select>
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Assigned to</label>
                <select name="id_assigned_to" id="id_assigned_to" class="form-control select2">
                    <option value="">All</option>
                    @foreach ( $staff as $resort )
                        <option value="{{ $resort->id }}">{{ $resort->name }} {{ $resort->surname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Resort</label>
                <select name="id_resort" id="id_resort" class="form-control select2">
                    <option value="">All</option>
                    @foreach ( $resorts as $resort )
                        <option value="{{ $resort->id }}">{{ $resort->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Property Owner</label>
                <select name="id_property_owner" id="id_property_owner" class="form-control select2">
                    <option value="">All</option>
                    @foreach ( $property_owners as $resort )
                        <option value="{{ $resort->id }}">{{ $resort->name }} {{ $resort->surname }}</option>
                    @endforeach
                </select>
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
            url: "AdminProperties.listado",
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
        $('#form select').on("change", function() {
            searchContacts();
        });
        $(".select2").select2();
    })
</script>