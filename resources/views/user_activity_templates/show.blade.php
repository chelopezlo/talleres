@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Activity Template
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('user_activity_templates.show_fields')
                    <a href="{!! route('userActivityTemplates.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
