<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Repositories\PersonaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\User;

class PersonaController extends AppBaseController
{
    /** @var  PersonaRepository */
    private $personaRepository;

    public function __construct(PersonaRepository $personaRepo)
    {
        $this->personaRepository = $personaRepo;
    }

    /**
     * Display a listing of the Persona.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $this->personaRepository->pushCriteria(new RequestCriteria($request));
        $personas = $this->personaRepository->findByField('users_id', $user->id);

        return view('personas.index')
            ->with('personas', $personas);
    }
    
     /**
     * Display a listing of the Persona.
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        $this->personaRepository->pushCriteria(new RequestCriteria($request));
        $personas = $this->personaRepository->with('Activity')->findByField('code', $code)->first();

        return view('personas.index')
            ->with('personas', $personas);
    }
    
        /**
     * Show the form for creating a new Persona.
     *
     * @return Response
     */
    public function searchForm()
    {
        return view('search');
    }

    /**
     * Show the form for creating a new Persona.
     *
     * @return Response
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Store a newly created Persona in storage.
     *
     * @param CreatePersonaRequest $request
     *
     * @return Response
     */
    public function store(CreatePersonaRequest $request)
    {
        $input = $request->all();

        app('App\Http\Controllers\PrintReportContoller')->getPrintReport();
        
        $user = Illuminate\Foundation\Auth\User::create([
            'name' => $input['full_name'],
            'email' => $input['email'],
            'password' => bcrypt($input['rut']),
        ]);
        
        
        //$input['user_id'] = 1;//$user['id'];
        $persona = $this->personaRepository->create($input);

        Flash::success('Persona saved successfully.');

        return redirect(route('personas.index'));
    }

    /**
     * Display the specified Persona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $personas = $this->personaRepository->all();

        if (empty($personas)) {
            Flash::error('Persona not found');

            return redirect(route('personas.index'));
        }
        
        foreach ($personas as $persona)
        {
            $user = User::where('rut', $persona->rut)->first();
            if(empty($user))
            {
                $user = new User;
                $user->name = $persona->full_name;
                $user->email = $persona->email;
                $user->rut = $persona->rut;
                $user->password = bcrypt($persona->rut);
                $user->save();
                
                $persona->users_id = $user->id;
                $persona->save();
            }
        }
        
        

        return view('personas.show')->with('personas', $personas);
    }

    /**
     * Show the form for editing the specified Persona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $persona = $this->personaRepository->findWithoutFail($id);

        if (empty($persona)) {
            Flash::error('Persona no encontrada');

            return redirect(route('personas.index'));
        }

        return view('personas.edit')->with('persona', $persona);
    }

    /**
     * Update the specified Persona in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersonaRequest $request)
    {
        $persona = $this->personaRepository->findWithoutFail($id);

        if (empty($persona)) {
            Flash::error('Persona not found');

            return redirect(route('personas.index'));
        }

        $persona = $this->personaRepository->update($request->all(), $id);

        Flash::message('Datos guardados con éxito.');

        return redirect()->action('PersonaController@edit', ['id'=> $id]);
    }

    /**
     * Remove the specified Persona from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $persona = $this->personaRepository->findWithoutFail($id);

        if (empty($persona)) {
            Flash::error('Persona not found');

            return redirect(route('personas.index'));
        }

        $this->personaRepository->delete($id);

        Flash::success('Persona deleted successfully.');

        return redirect(route('personas.index'));
    }
}
