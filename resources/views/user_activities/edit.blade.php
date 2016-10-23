@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Activity
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userActivity, ['route' => ['userActivities.update', $userActivity->id], 'method' => 'patch']) !!}

                        @include('user_activities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection