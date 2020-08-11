<div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header {{ $user->bg }}">
            <h3 class="widget-user-username">{{ $user->name }} {{ $user->surname }}</h3>
            <h5 class="widget-user-desc">{{ $user->role }}</h5>
        </div>
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="{{ $user->image }}" alt="User Avatar">
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ $user->pending }}</h5>
                        <span class="description-text">Tasks pending</span>
                    </div>
                <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ $user->completed }}</h5>
                        <span class="description-text">Tasks completed</span>
                    </div>
                <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">{{ $user->properties }}</h5>
                        <span class="description-text">Properties</span>
                    </div>
                <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
        <!-- /.row -->
        </div>
        <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="MyTeam.userTimeline?id_user={{ $user->id }}" class="nav-link text-center text-dark">
                        View user timeline
                    </a>
                </li>
            </ul>
        </div>
    </div>
<!-- /.widget-user -->
</div>