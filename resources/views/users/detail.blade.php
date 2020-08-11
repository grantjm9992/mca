<div class="container">
<div class="w-100 px-5 mb-5">
    <ul class="nav nav-pills d-block d-lg-flex">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#general">User information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#documents">Documents</a>
        </li>
        <li class="nav-item">
            <a href="#files" data-toggle="pill" class="nav-link">
                Files
            </a>
        </li>
    </ul>
</div>
<div class="tab-content">
    <div class="tab-pane container-fluid px-5 active" id="general">
        <form action="Users.save" id="form">
            <div class="container">
                <div class="row">
                    @if (isset($_REQUEST["error"]))
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation"></i>  A user already exists with the username or email given. Please try again.
                        </div>
                    </div>
                    @endif
                    <input type="text" name="id" value="{{ $user->id }}" hidden>
                    <div class="col-12 col-lg-12 form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                    </div>
                    <div class="col-12 col-lg-12 form-group">
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" value="{{ $user->surname }}" class="form-control" required>
                    </div>
                    @if ( $user->id != "" )
                    <div class="col-12 col-lg-12 form-group">
                        <label for="user">Username</label>
                        <input type="text" name="user" value="{{ $user->user }}" class="form-control" readonly>
                    </div>
                    @endif
                    <div class="col-12 col-lg-12 form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control" required>
                    </div>
                    <div class="col-12 col-lg-12 form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                    </div>
                    <div class="col-12 col-lg-12 form-group">
                        <label for="phone">Phone 2</label>
                        <input type="text" name="phone_2" value="{{ $user->phone_2 }}" class="form-control">
                    </div>
                    <div class="col-12 col-lg-12 form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            @foreach ( $roles as $role )
                                <option value="{{ $role->code }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-12 form-group">
                        <label for="id_company">Company</label>
                        <select name="id_company" id="id_company" class="form-control" required>
                            @foreach ( $companies as $company )
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($user->id != "" && !is_null($user->id))
                    <div class="col-12 col-lg-12 form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane container-fluid px-5" id="documents">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <div onclick="getDocumentModal()" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add new document
                    </div>            
                </div>
            </div>
            <div class="row" id="document_row">
                @foreach ($documents as $doc)
                    <div class="col-12" document_id="{{ $doc->id }}">
                        <div class="container-fluid bg-white px-5 py-4 my-4">
                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <b>Document type:</b> {{ $doc->document_type }}
                                </div>
                                <div class="col-10 col-md-5">
                                    <b>Document number</b>: {{ $doc->document_number }}
                                </div>
                                <div class="col-2">
                                    <i onclick="deleteDocument({{ $doc->id }})" class="fas fa-times-circle text-red cursor-pointer"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="tab-pane container-fluid px-5" id="files">
        <h3 style="width: 100%; padding-bottom: 8px; border-bottom: 1px solid;">
        Files
        </h3>
        <form maxFiles="1" action="Users.uploadUserFile" class="dropzone" id="my-awesome-dropzone">
            <input type="text" name="id" hidden value="{{ $user->id }}">
            @csrf()
        </form>
        <div class="row">
            @foreach ($files as $file)
                <div class="col-12 col-md-4 d-flex" id_file="{{ $file->id }}">
                    <div class="file-card">
                        <div class="title">
                            {{ $file->title }}
                        </div>
                        <a download target="download" href="{{ $file->absolute_url }}" class="btn btn-primary">
                            <i class="fas fa-download"></i> Download
                        </a>
                        <div onclick="removeFile({{ $file->id }})" class="btn btn-danger mt-2">
                            <i class="fas fa-trash"></i> Delete file
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

</div>

<script>

    // Set values on load
    $(document).ready( function() {
        $('#role').val( "{{ $user->role }}" );
        $('#id_company').val( "{{ $user->id_company }}" );
    })

    function removeFile(id_file)
    {
        $.ajax({
            type: "POST",
            url: "Users.removeUserfile",
            data: {
                id_file: id_file
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                if (data == "OK")
                {
                    $('[id_file="'+id_file+'"]').remove();
                }
            }
        });
    }

    // Get document modal
    function getDocumentModal()
    {
        $.ajax({
            type: "POST",
            url: "Users.addUserDocumentModal",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $('#modal').remove();
                $('body').append(data);
            }
        });
    }

    // Submit document modal form 
    function submitDocumentForm()
    {
        $.ajax({
            type: "POST",
            url: "Users.addUserDocument",
            data: {
                id_user: '{{ $user->id }}',
                document_type: $('#document_type').val(),
                document_number: $('#document_number').val()
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $('#modal').modal('hide');
                $('#modal').remove();
                $('#document_row').append(data);
            }
        });
    }

    function deleteDocument(id_doc)
    {
        $.ajax({
            type: "POST",
            url: "Users.removeUserDocument",
            data: {
                id_doc: id_doc
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                if (data == "OK")
                {
                    $('[document_id="'+id_doc+'"]').remove();
                }
            }
        });
    }

    // Submit form
    function submitForm()
    {
        
        var inputs = $('[required]');
        $(inputs).removeClass('error');
        var valid = true;
        for (var i = 0; i < inputs.length; i++)
        {
            if ($(inputs[i]).val() == "")
            {
                valid = false
                $(inputs[i]).addClass('error');
            }
        }

        if (valid) afterVerification();
    }

    function afterVerification() {
        $.ajax({
            type: "POST",
            url: "Users.checkUserExists",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $("#form").serialize(),
            success: function(data)
            {
                var s = jQuery.parseJSON(data);
                if ( s.success === 1 )
                { 
                    $('#form').submit();
                }
                else
                {
                    var options = Array();
                    options.title = "Error";
                    options.text = s.error;
                    options.icon = "error";
                    sweetAlert( options );
                }
            }
        })
    }
</script>