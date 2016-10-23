<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDespositoRequest;
use App\Http\Requests\UpdateDespositoRequest;
use App\Repositories\DespositoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DespositoController extends AppBaseController
{
    /** @var  DespositoRepository */
    private $despositoRepository;

    public function __construct(DespositoRepository $despositoRepo)
    {
        $this->despositoRepository = $despositoRepo;
    }

    /**
     * Display a listing of the Desposito.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->despositoRepository->pushCriteria(new RequestCriteria($request));
        $despositos = $this->despositoRepository->all();

        return view('despositos.index')
            ->with('despositos', $despositos);
    }

    /**
     * Show the form for creating a new Desposito.
     *
     * @return Response
     */
    public function create()
    {
        return view('despositos.create');
    }

    /**
     * Store a newly created Desposito in storage.
     *
     * @param CreateDespositoRequest $request
     *
     * @return Response
     */
    public function store(CreateDespositoRequest $request)
    {
        $input = $request->all();

        $desposito = $this->despositoRepository->create($input);

        Flash::success('Desposito saved successfully.');

        return redirect(route('despositos.index'));
    }

    /**
     * Display the specified Desposito.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $desposito = $this->despositoRepository->findWithoutFail($id);

        if (empty($desposito)) {
            Flash::error('Desposito not found');

            return redirect(route('despositos.index'));
        }

        return view('despositos.show')->with('desposito', $desposito);
    }

    /**
     * Show the form for editing the specified Desposito.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $desposito = $this->despositoRepository->findWithoutFail($id);

        if (empty($desposito)) {
            Flash::error('Desposito not found');

            return redirect(route('despositos.index'));
        }

        return view('despositos.edit')->with('desposito', $desposito);
    }

    /**
     * Update the specified Desposito in storage.
     *
     * @param  int              $id
     * @param UpdateDespositoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDespositoRequest $request)
    {
        $desposito = $this->despositoRepository->findWithoutFail($id);

        if (empty($desposito)) {
            Flash::error('Desposito not found');

            return redirect(route('despositos.index'));
        }

        $desposito = $this->despositoRepository->update($request->all(), $id);

        Flash::success('Desposito updated successfully.');

        return redirect(route('despositos.index'));
    }

    /**
     * Remove the specified Desposito from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $desposito = $this->despositoRepository->findWithoutFail($id);

        if (empty($desposito)) {
            Flash::error('Desposito not found');

            return redirect(route('despositos.index'));
        }

        $this->despositoRepository->delete($id);

        Flash::success('Desposito deleted successfully.');

        return redirect(route('despositos.index'));
    }
}
