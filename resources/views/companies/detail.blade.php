<form action="AdminCompanies.save">
    <div class="container-fluid">
        <div class="row">
            <input type="text" name="id" value="{{ $company->id }}" hidden>
            <div class="col-12 form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $company->name }}" class="form-control">
            </div>
            <div class="col-12 form-group">
                <label for="application_url">Application URL</label>
                <input type="text" name="application_url" value="{{ $company->application_url }}" class="form-control">
            </div>
        </div>
        <button type="submit" id="submit" hidden></button>
    </div>
</form>
@if ( $company->id !== null && $company->id != "" )
<div class="container-fluid">
    <div class="row" style="margin: 10px auto;">
        <h3 style="width: 100%; padding-bottom: 8px; border-bottom: 1px solid;">
            Resorts
            <div class="buttons">
                <div class="btn btn-outline-primary" onclick="manageResorts()">
                    <i class="fas fa-list"></i> Manage resorts
                </div>
            </div>
        </h3>
        <div class="col-12" id="resorts">
            {!! $resortGrid !!}
        </div>
    </div>
</div>
@endif
<script>
    function deleteCompany()
    {
        $.ajax({
            type: "POST",
            url: "AdminCompanies.delete",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {id: "{{ $company->id }}"},
            success: function(data)
            {
                if ( data == "OK" )
                {
                    window.location = "AdminCompanies";
                }
            }
        })
    }

    function manageResorts()
    {
        $('#modal').remove();
        $.ajax({
            type: "POST",
            url: "AdminCompanies.resortsModal",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:
            {
                id: "{{ $company->id }}"
            },
            success: function(data)
            {
                $('body').append(data);
            }
        })
    }

    function updateResorts()
    {
            
        $('#modal').modal("hide");
        $.ajax({
            type: "POST",
            url: "AdminCompanies.updateResorts",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $company->id }}",
                ids: $('#modal_tabla_selectIds').val()
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    var options = Array();
                    options.text = 'Resorts updated successfully';
                    options.title = "Success";
                    options.icon = "success";
                    sweetAlert(options);
                    updateResortTable();
                }
                else
                {
                    sweetAlert('There has been an error', "error");
                }
            }
        });
    }

    
    function updateResortTable()
    {
        $.ajax({
            type: "POST",
            url: "AdminCompanies.resortGrid",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $company->id }}"
            },
            success: function(data)
            {
                $('#resorts').html(data);
            }
        });
    }
</script>