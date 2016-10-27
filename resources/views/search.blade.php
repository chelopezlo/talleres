@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Buscar Persona
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['action' => 'PersonaController@search']) !!}

                        <!-- Rut Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('rut', 'Rut:') !!}
                            {!! Form::text('rut', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Full Name Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('full_name', 'Nombre:') !!}
                            {!! Form::text('full_name', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <!-- Rut Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('code', 'Código:') !!}
                            {!! Form::text('code', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! url('/home') !!}" class="btn btn-default">Cancel</a>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
