<li class="{{ Request::is('personas*') ? 'active' : '' }}">
    <a href="{!! route('personas.edit', Auth::user()->Persona->id) !!}"><i class="fa fa-edit"></i><span>Mis Datos</span></a>
</li>

<li class="{{ Request::is('userActivities*') ? 'active' : '' }}">
    <a href="{!! route('userActivities.index') !!}"><i class="fa fa-edit"></i><span>Talleres Inscritos</span></a>
</li>

<li class="{{ Request::is('activities*') ? 'active' : '' }}">
    <a href="{!! route('activities.index') !!}"><i class="fa fa-edit"></i><span>Inscribir Talleres</span></a>
</li>