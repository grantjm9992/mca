<div id="modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="Tasks.add" id="taskForm">
            <div class="row">
              <div class="col-12 form-group">
                <label for="title">Title</label>
                <input type="text" name="title" required class="form-control">
              </div>
              <div class="col-12 form-group">
                <label for="user">Assigned to</label>
                <div class="select2-purple">
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" name="assignedTo[]" id="assignedTo" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                        @foreach( $users as $user )
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="form-group col-12">
                <label for="">Type of task</label>
                <select name="id_type" id="id_type" class="form-control" required>
                  @foreach ( $types as $type )
                    <option value="{{ $type->id }}">{{ $type->description }}</option>
                  @endforeach
                </select>
              </div>
              @isset( $_REQUEST["id_property"] )
                <input name="id_property" value="{{ $_REQUEST['id_property'] }}" hidden/>
              @else
              <div class="form-group col-12">
                <label for="">Property</label>
                <div class="select2-purple">
                  <select class="select2" name="id_property" id="id_property" style="width: 100%;">
                    <option value="">None</option>
                      @foreach( $properties as $po )
                        <option value="{{ $po->id }}">{{ $po->title }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              @endisset
              <div class="form-group col-12">
                <label for="">Start</label>
                <input type="text" name="date_start" id="date_startTask" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group col-12">
                <label for="">End</label>
                <input type="text" name="date_end" id="date_endTask" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group col-12">
                <label for="">Is a recurring task?</label>
                <select name="recurring" id="recurring" class="form-control">
                  <option value="">No</option>
                  <option value="1">Yes</option>
                </select>
              </div>
              <div class="col-12 form-group rec" style="display: none;">
                <label for="">Type of recurrance</label>
                <select name="type" id="type" class="form-control">
                  <option disabled>Please select a value</option>
                  <option value="weekly">Weekly</option>
                  <option value="monthly">Monthly</option>
                  <option value="annual">Annual</option>
                </select>
              </div>
              <div class="col-12 form-group weekly rec" style="display: none;">
                <label class="d-block" for="">Days</label>
                <select multiple name="days[]" id="days" class="form-control">
                  <option value="1">Monday</option>
                  <option value="2">Tuesday</option>
                  <option value="3">Wednesday</option>
                  <option value="4">Thursday</option>
                  <option value="5">Friday</option>
                  <option value="6">Saturday</option>
                  <option value="0">Sunday</option>
                </select>
              </div>
              <div class="form-group col-12 rec" style="display: none;" >
                <label for="">Repeat until</label>
                <input type="text" name="series_end" id="series_end" class="form-control">
              </div>
              <div class="form-group col-12">
                <textarea name="description" id="description" cols="30" rows="3" placeholder="Further details..." class="form-control"></textarea>
              </div>
            </div>
            @isset( $_REQUEST["id_reservation"] )
              <input name="id_reservation" value="{{ $_REQUEST['id_reservation'] }}" hidden/>
            @endisset
            <button type="submit" id="sbmt" hidden></button>
          </form>          
      </div>
      <div class="modal-footer">
        <div onclick="submitTaskForm()" class="btn btn-primary">Submit</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function() {
    $('.select2').select2()
    $('#recurring').change( function() {
      if ( $(this).val() == "1" )
      {
        $('.rec').show();
      }
      else
      {
        $(".rec").hide();
        $(".weekly").hide();
      }
    })
    $('#type').change(function() {
      if ( $(this).val() == "weekly" )
      {
        $(".weekly").show();
      }
      else
      {
        $(".weekly").hide();
        $("#days").val("");
      }
    })
    var now = new Date();
    $('#modal').modal("show");
    var to = $('#date_startTask').datetimepicker({
      minDate: now,
      onShow:function( ct ){
        this.setOptions({
          minDate:jQuery('#date_endTask').val()?jQuery('#date_endTask').val():false
        })
      }
    });
    var from = $('#date_endTask').datetimepicker({
      minDate: now,
      onShow:function( ct ){
        this.setOptions({
          minDate:jQuery('#date_startTask').val()?jQuery('#date_startTask').val():false
        })
      }
    });
  });

  function submitTaskForm()
  {
    $("#sbmt").click();
  }
</script>