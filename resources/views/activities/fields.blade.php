    <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <i class="fa fa-flag-o"></i>
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{$activity->name}}</h3>
              <h5 class="widget-user-desc">{{$activity->description}}</h5>
            </div>
            <div class="box-footer no-padding">
                <?php $total = 0; ?>
              <ul class="nav nav-stacked">
                @foreach ( $activity->ActivitySchedule as $schedule )
                    <li><a href="#">{{ $schedule->from }} <span class="pull-right badge bg-blue">{{ $schedule->signed_up }}</span></a></li>
                    <?php $total += $schedule->signed_up?>
                @endforeach                
                <li><a href="#">Total inscritos <span class="pull-right badge bg-red">{{$total}}</span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
      </div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color', 'Color:') !!}
    {!! Form::text('color', null, ['class' => 'form-control']) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::text('icon', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Selectable Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_selectable', 'Is Selectable:') !!}
    <label class="radio-inline">
        {!! Form::radio('is_selectable', "1", null) !!} 1
    </label>
    <label class="radio-inline">
        {!! Form::radio('is_selectable', "0", null) !!} 0
    </label>
</div>

<!-- Is Selectable Field -->
<div class="form-group col-sm-12">
    {!! Form::select('schedule', $activity->ActivitySchedule) !!}   
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('activities.index') !!}" class="btn btn-default">Cancel</a>
</div>
