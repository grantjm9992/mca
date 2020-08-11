
<div class="col-12" document_id="{{ $document->id }}">
    <div class="container-fluid bg-white px-5 py-4 my-4">
        <div class="row">
            <div class="col-12 col-md-5">
                <b>Document type:</b> {{ $document->document_type }}
            </div>
            <div class="col-10 col-md-5">
                <b>Document number:</b> {{ $document->document_number }}
            </div>
            <div class="col-2">
                <i onclick="deleteDocument({{ $document->id }})" class="fas fa-times-circle text-red cursor-pointer"></i>
            </div>
        </div>
    </div>
</div>