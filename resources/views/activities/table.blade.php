<div class="row">
<?php $cont = 0; ?>    
@foreach($activities as $activity)
<?php 
    if(($cont % 3) == 0)
        echo '</div><div class="row">';
    $cont++;
?>
    <div class="col-md-4">
      <!-- Widget: user widget style 1 -->
      <div id='{{$activity->id}}' class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-{{$activity->color}}">
          <div class="widget-user-image">
            {!! Html::image($activity->icon, $activity->name, array('class' => 'img-circle')) !!}
          </div>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username">{{$activity->name}}</h3>
          <h5 class="widget-user-desc">{{$activity->description}}</h5>
        </div>
        <div class="box-footer no-padding">
            <?php $total = 0; ?>
          <ul class="nav nav-stacked">
            @foreach ( $activity->ActivitySchedule as $schedule )
                <?php if($schedule->signed_up < $activity->quota){ ?>
                <li>
                    <a  data-toggle="modal" 
                        data-target="#inscripcionTallerModal" 
                        data-schedule='{{$schedule->id}}' 
                        data-activity='{{$activity->id}}' 
                        data-ppl='{{Auth::user()->Persona->id}}'>
                            {{ $schedule->from }} 
                            <span class="pull-right badge bg-blue">{{ $schedule->signed_up }}</span>
                    </a>
                </li>
                <?php } ?>
                <?php $total += $schedule->signed_up; ?>
            @endforeach                
            <li><a>Total inscritos <span class="pull-right badge bg-red">{{$total}}</span></a></li>
          </ul>
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
@endforeach
</div>