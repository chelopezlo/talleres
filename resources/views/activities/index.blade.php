@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Talleres</h1>
        <h1 class="pull-right">
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">                
                @include('activities.table')
            </div>
        </div>
    </div>

    <div class="modal modal-primary" id='inscripcionTallerModal'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Est&aacute;s a punto de inscribir el taller...</h4>
          </div>
          <div class="modal-body" id='modalBody'>
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-primary">
                    <h3 class="widget-user-username" id="ModalTitle"></h3>
                    <h5 class="widget-user-desc" id="ModalDesc"></h5>
                    <h5 class="widget-user-desc" id="ModalSchedule"></h5>
                </div>                  
                <input type="hidden" id="hdnActivityScheduleId" />
                <input type="hidden" id="hdnPersonaId" />
                <input type="hidden" id="hdnActivityId" />
                <input type="hidden" id="hdnScheduleFrom" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-outline" id="btnGuardar">Inscribir</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('scripts')
<script>
var signedIn = {{ $signedIn }};
jQuery(function() {
    $('#inscripcionTallerModal').on("show.bs.modal", function (e) {
        var activityId = $(e.relatedTarget).data('activity');
        var activityScheduleId = $(e.relatedTarget).data('schedule');
        var activityScheduleFrom = $(e.relatedTarget).data('schedule-from');
        var personaId = $(e.relatedTarget).data('ppl');
        var taller = $(".widget-user-2[id='" + activityId + "']");
        var titulo = taller.find(".widget-user-username").html();
        var descripcion = taller.find(".widget-user-desc").html();
        var horario = $(e.relatedTarget).text();
        
        $("#ModalTitle").html(titulo);
        $("#ModalDesc").html(descripcion);
        $("#ModalSchedule").html(horario);
        
        $("#hdnActivityScheduleId").val(activityScheduleId);
        $("#hdnPersonaId").val(personaId);
        $("#hdnActivityId").val(activityId);
        $("#hdnScheduleFrom").val(activityScheduleFrom);
        
    });
    
    $('#btnGuardar').on('click', function(){
        var url = "http://inscripcion.esencia2016.cl/api/v1/user_activities";           
        $.ajax({                    
            url: url,
            data: {persona_id:$("#hdnPersonaId").val(), activity_id:$("#hdnActivityId").val(), activity_schedule_id:$("#hdnActivityScheduleId").val()},
            method: "POST",
            contentType: "application/x-www-form-urlencoded",
            dataType: 'json',
            success: function (data, status, jqXHR) {
                $("#" + $("#hdnActivityId").val() + " a[data-role='schedule']").remove();
                $("a[data-schedule-from='" + $("#hdnScheduleFrom").val() + "']").remove();
                $('#inscripcionTallerModal').modal("hide");
                signedIn++;
                if(signedIn >= 3)
                {
                    window.location.reload(true);
                }
            },
            error: function (jqXHR, status) {
                alert(jqXHR.statusText);
            }
        });
    });
});
</script>
@endsection