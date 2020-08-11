<div id="modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
              <label for="">Document type</label>
              <select name="document_type" id="document_type" class="form-control">
                @foreach ($documentTypes as $type)
                  <option value="{{ $type->title }}">{{ $type->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="">Document number</label>
              <input type="text" id="document_number" name="document_number" class="form-control">
            </div>
      </div>
      <div class="modal-footer">
        <div onclick="submitDocumentForm()" class="btn btn-primary">Submit</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function() {
    $('.select2').select2();
    $('#modal').modal("show");
  });

</script>