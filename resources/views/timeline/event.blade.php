
<div>
    @if ((int)$event->id_type === 1 || $event->id_type === null)
    <i class="fas fa-clock bg-blue"></i>
    @elseif ((int)$event->id_type === 2)
    <i class="fas fa-pencil bg-orange"></i>
    @elseif ((int)$event->id_type === 3)
    <i class="fas fa-check bg-green"></i>
    @elseif ((int)$event->id_type === 4)
    <i class="fas fa-minus bg-red"></i>
    @endif
    <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> {{ $event->date }}</span>
        <h3 class="timeline-header">
            {!! $event->text !!}
        </h3>

        @if ( $event->detail != "" )
            <div class="timeline-body">
                {!! $event->detai !!}
            </div>
            <div class="timeline-footer">
            </div>
        @endif
    </div>
</div>