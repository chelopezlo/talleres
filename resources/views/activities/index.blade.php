@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Talleres</h1>
        <h1 class="pull-right">
           <button class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('activities.create') !!}">Add New</button>
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
                <h4 class="modal-title">Inscripci&oacute;n de taller</h4>
              </div>
              <div class="modal-body" id='modalBody'>
                <p>One fine body…</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
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
jQuery(function() {
    $('#inscripcionTallerModal').on("show.bs.modal", function (e) {
        var taller = $(".widget-user-2[id='" + $(e.relatedTarget).data('activity') + "']");
        var titulo = taller.find(".widget-user-username").html();
        var descripcion = taller.find(".widget-user-desc").html();
        var horario = $(e.relatedTarget).text();
        $("#modalBody").append(titulo);
        $("#modalBody").append(descripcion);
        $("#modalBody").append(horario);
        $("#fav-title").html($(e.relatedTarget).data('title'));
    });
});
</script>
@endsection