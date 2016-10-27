<?php $cont = 0; ?>    
@foreach($userActivities as $userActivity)
<?php 
    if(($cont % 3) == 0)
        echo '</div><div class="row">';
    $cont++;
?>
    <div class="col-md-4">
      <!-- Widget: user widget style 1 -->
      <div id='{{$userActivity->Schedule->Activity->id}}' class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-{{$userActivity->Schedule->Activity->color}}">
          <div class="widget-user-image">
            {!! Html::image($userActivity->Schedule->Activity->icon, $userActivity->Schedule->Activity->name, array('class' => 'img-circle')) !!}
          </div>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username">{{$userActivity->Schedule->Activity->name}}</h3>
          <h5 class="widget-user-desc">{{$userActivity->Schedule->Activity->description}}</h5>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li>
                <a>
                    {{ $userActivity->Schedule->from }} 
                    <span class="pull-right badge bg-blue">{{ $userActivity->Schedule->signed_up }}</span>
                </a>
            </li>
            <li>
                <a  data-toggle="modal" 
                    href="#inscripcionTallerModal" 
                    data-id='{{$userActivity->id}}' 
                    data-schedule='{{$userActivity->id}}' 
                    data-activity='{{$userActivity->Schedule->Activity->id}}' 
                    data-ppl='{{$userActivity->Persona->id}}'
                    data-role='schedule'>
                        Salir del taller
                </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
@endforeach
</div>