<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIglesiaAPIRequest;
use App\Http\Requests\API\UpdateIglesiaAPIRequest;
use App\Models\Iglesia;
use App\Repositories\IglesiaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class IglesiaController
 * @package App\Http\Controllers\API
 */

class IglesiaAPIController extends AppBaseController
{
    /** @var  IglesiaRepository */
    private $iglesiaRepository;

    public function __construct(IglesiaRepository $iglesiaRepo)
    {
        $this->iglesiaRepository = $iglesiaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/iglesias",
     *      summary="Get a listing of the Iglesias.",
     *      tags={"Iglesia"},
     *      description="Get all Iglesias",
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
     *                  @SWG\Items(ref="#/definitions/Iglesia")
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
        $this->iglesiaRepository->pushCriteria(new RequestCriteria($request));
        $this->iglesiaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $iglesias = $this->iglesiaRepository->all();

        return $this->sendResponse($iglesias->toArray(), 'Iglesias retrieved successfully');
    }

    /**
     * @param CreateIglesiaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/iglesias",
     *      summary="Store a newly created Iglesia in storage",
     *      tags={"Iglesia"},
     *      description="Store Iglesia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Iglesia that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Iglesia")
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
     *                  ref="#/definitions/Iglesia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateIglesiaAPIRequest $request)
    {
        $input = $request->all();

        $iglesias = $this->iglesiaRepository->create($input);

        return $this->sendResponse($iglesias->toArray(), 'Iglesia saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/iglesias/{id}",
     *      summary="Display the specified Iglesia",
     *      tags={"Iglesia"},
     *      description="Get Iglesia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Iglesia",
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
     *                  ref="#/definitions/Iglesia"
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
        /** @var Iglesia $iglesia */
        $iglesia = $this->iglesiaRepository->find($id);

        if (empty($iglesia)) {
            return $this->sendError('Iglesia not found');
        }

        return $this->sendResponse($iglesia->toArray(), 'Iglesia retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateIglesiaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/iglesias/{id}",
     *      summary="Update the specified Iglesia in storage",
     *      tags={"Iglesia"},
     *      description="Update Iglesia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Iglesia",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Iglesia that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Iglesia")
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
     *                  ref="#/definitions/Iglesia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateIglesiaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Iglesia $iglesia */
        $iglesia = $this->iglesiaRepository->find($id);

        if (empty($iglesia)) {
            return $this->sendError('Iglesia not found');
        }

        $iglesia = $this->iglesiaRepository->update($input, $id);

        return $this->sendResponse($iglesia->toArray(), 'Iglesia updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/iglesias/{id}",
     *      summary="Remove the specified Iglesia from storage",
     *      tags={"Iglesia"},
     *      description="Delete Iglesia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Iglesia",
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
        /** @var Iglesia $iglesia */
        $iglesia = $this->iglesiaRepository->find($id);

        if (empty($iglesia)) {
            return $this->sendError('Iglesia not found');
        }

        $iglesia->delete();

        return $this->sendResponse($id, 'Iglesia deleted successfully');
    }
}
