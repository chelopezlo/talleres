<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInscripcionAPIRequest;
use App\Http\Requests\API\UpdateInscripcionAPIRequest;
use App\Models\Inscripcion;
use App\Repositories\InscripcionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InscripcionController
 * @package App\Http\Controllers\API
 */

class InscripcionAPIController extends AppBaseController
{
    /** @var  InscripcionRepository */
    private $inscripcionRepository;

    public function __construct(InscripcionRepository $inscripcionRepo)
    {
        $this->inscripcionRepository = $inscripcionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/inscripcions",
     *      summary="Get a listing of the Inscripcions.",
     *      tags={"Inscripcion"},
     *      description="Get all Inscripcions",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Inscripcion")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->inscripcionRepository->pushCriteria(new RequestCriteria($request));
        $this->inscripcionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $inscripcions = $this->inscripcionRepository->all();

        return $this->sendResponse($inscripcions->toArray(), 'Inscripcions retrieved successfully');
    }

    /**
     * @param CreateInscripcionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/inscripcions",
     *      summary="Store a newly created Inscripcion in storage",
     *      tags={"Inscripcion"},
     *      description="Store Inscripcion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Inscripcion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Inscripcion")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Inscripcion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInscripcionAPIRequest $request)
    {
        $input = $request->all();

        $inscripcions = $this->inscripcionRepository->create($input);

        return $this->sendResponse($inscripcions->toArray(), 'Inscripcion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/inscripcions/{id}",
     *      summary="Display the specified Inscripcion",
     *      tags={"Inscripcion"},
     *      description="Get Inscripcion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inscripcion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Inscripcion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Inscripcion $inscripcion */
        $inscripcion = $this->inscripcionRepository->find($id);

        if (empty($inscripcion)) {
            return $this->sendError('Inscripcion not found');
        }

        return $this->sendResponse($inscripcion->toArray(), 'Inscripcion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInscripcionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/inscripcions/{id}",
     *      summary="Update the specified Inscripcion in storage",
     *      tags={"Inscripcion"},
     *      description="Update Inscripcion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inscripcion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Inscripcion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Inscripcion")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Inscripcion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInscripcionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Inscripcion $inscripcion */
        $inscripcion = $this->inscripcionRepository->find($id);

        if (empty($inscripcion)) {
            return $this->sendError('Inscripcion not found');
        }

        $inscripcion = $this->inscripcionRepository->update($input, $id);

        return $this->sendResponse($inscripcion->toArray(), 'Inscripcion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/inscripcions/{id}",
     *      summary="Remove the specified Inscripcion from storage",
     *      tags={"Inscripcion"},
     *      description="Delete Inscripcion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inscripcion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Inscripcion $inscripcion */
        $inscripcion = $this->inscripcionRepository->find($id);

        if (empty($inscripcion)) {
            return $this->sendError('Inscripcion not found');
        }

        $inscripcion->delete();

        return $this->sendResponse($id, 'Inscripcion deleted successfully');
    }
}
