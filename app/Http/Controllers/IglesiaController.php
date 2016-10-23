<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIglesiaRequest;
use App\Http\Requests\UpdateIglesiaRequest;
use App\Repositories\IglesiaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IglesiaController extends AppBaseController
{
    /** @var  IglesiaRepository */
    private $iglesiaRepository;

    public function __construct(IglesiaRepository $iglesiaRepo)
    {
        $this->iglesiaRepository = $iglesiaRepo;
    }

    /**
     * Display a listing of the Iglesia.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->iglesiaRepository->pushCriteria(new RequestCriteria($request));
        $iglesias = $this->iglesiaRepository->all();

        return view('iglesias.index')
            ->with('iglesias', $iglesias);
    }

    /**
     * Show the form for creating a new Iglesia.
     *
     * @return Response
     */
    public function create()
    {
        return view('iglesias.create');
    }

    /**
     * Store a newly created Iglesia in storage.
     *
     * @param CreateIglesiaRequest $request
     *
     * @return Response
     */
    public function store(CreateIglesiaRequest $request)
    {
        $input = $request->all();

        $iglesia = $this->iglesiaRepository->create($input);

        Flash::success('Iglesia saved successfully.');

        return redirect(route('iglesias.index'));
    }

    /**
     * Display the specified Iglesia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $iglesia = $this->iglesiaRepository->findWithoutFail($id);

        if (empty($iglesia)) {
            Flash::error('Iglesia not found');

            return redirect(route('iglesias.index'));
        }

        return view('iglesias.show')->with('iglesia', $iglesia);
    }

    /**
     * Show the form for editing the specified Iglesia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $iglesia = $this->iglesiaRepository->findWithoutFail($id);

        if (empty($iglesia)) {
            Flash::error('Iglesia not found');

            return redirect(route('iglesias.index'));
        }

        return view('iglesias.edit')->with('iglesia', $iglesia);
    }

    /**
     * Update the specified Iglesia in storage.
     *
     * @param  int              $id
     * @param UpdateIglesiaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIglesiaRequest $request)
    {
        $iglesia = $this->iglesiaRepository->findWithoutFail($id);

        if (empty($iglesia)) {
            Flash::error('Iglesia not found');

            return redirect(route('iglesias.index'));
        }

        $iglesia = $this->iglesiaRepository->update($request->all(), $id);

        Flash::success('Iglesia updated successfully.');

        return redirect(route('iglesias.index'));
    }

    /**
     * Remove the specified Iglesia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iglesia = $this->iglesiaRepository->findWithoutFail($id);

        if (empty($iglesia)) {
            Flash::error('Iglesia not found');

            return redirect(route('iglesias.index'));
        }

        $this->iglesiaRepository->delete($id);

        Flash::success('Iglesia deleted successfully.');

        return redirect(route('iglesias.index'));
    }
}
