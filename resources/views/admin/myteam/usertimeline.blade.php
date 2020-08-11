<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4">
                Timeline for {{ $user->name }} {{ $user->surname }}
            </h4>
            <div class="timeline">
                {!! $events !!}
            </div>
        </div>
    </div>
</div>