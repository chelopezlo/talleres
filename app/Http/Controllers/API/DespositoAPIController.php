<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDespositoAPIRequest;
use App\Http\Requests\API\UpdateDespositoAPIRequest;
use App\Models\Desposito;
use App\Repositories\DespositoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DespositoController
 * @package App\Http\Controllers\API
 */

class DespositoAPIController extends AppBaseController
{
    /** @var  DespositoRepository */
    private $despositoRepository;

    public function __construct(DespositoRepository $despositoRepo)
    {
        $this->despositoRepository = $despositoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/despositos",
     *      summary="Get a listing of the Despositos.",
     *      tags={"Desposito"},
     *      description="Get all Despositos",
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
     *                  @SWG\Items(ref="#/definitions/Desposito")
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
        $this->despositoRepository->pushCriteria(new RequestCriteria($request));
        $this->despositoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $despositos = $this->despositoRepository->all();

        return $this->sendResponse($despositos->toArray(), 'Despositos retrieved successfully');
    }

    /**
     * @param CreateDespositoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/despositos",
     *      summary="Store a newly created Desposito in storage",
     *      tags={"Desposito"},
     *      description="Store Desposito",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Desposito that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Desposito")
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
     *                  ref="#/definitions/Desposito"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDespositoAPIRequest $request)
    {
        $input = $request->all();

        $despositos = $this->despositoRepository->create($input);

        return $this->sendResponse($despositos->toArray(), 'Desposito saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/despositos/{id}",
     *      summary="Display the specified Desposito",
     *      tags={"Desposito"},
     *      description="Get Desposito",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Desposito",
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
     *                  ref="#/definitions/Desposito"
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
        /** @var Desposito $desposito */
        $desposito = $this->despositoRepository->find($id);

        if (empty($desposito)) {
            return $this->sendError('Desposito not found');
        }

        return $this->sendResponse($desposito->toArray(), 'Desposito retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDespositoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/despositos/{id}",
     *      summary="Update the specified Desposito in storage",
     *      tags={"Desposito"},
     *      description="Update Desposito",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Desposito",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Desposito that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Desposito")
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
     *                  ref="#/definitions/Desposito"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDespositoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Desposito $desposito */
        $desposito = $this->despositoRepository->find($id);

        if (empty($desposito)) {
            return $this->sendError('Desposito not found');
        }

        $desposito = $this->despositoRepository->update($input, $id);

        return $this->sendResponse($desposito->toArray(), 'Desposito updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/despositos/{id}",
     *      summary="Remove the specified Desposito from storage",
     *      tags={"Desposito"},
     *      description="Delete Desposito",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Desposito",
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
        /** @var Desposito $desposito */
        $desposito = $this->despositoRepository->find($id);

        if (empty($desposito)) {
            return $this->sendError('Desposito not found');
        }

        $desposito->delete();

        return $this->sendResponse($id, 'Desposito deleted successfully');
    }
}
