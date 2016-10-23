<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivityTypeAPIRequest;
use App\Http\Requests\API\UpdateActivityTypeAPIRequest;
use App\Models\ActivityType;
use App\Repositories\ActivityTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ActivityTypeController
 * @package App\Http\Controllers\API
 */

class ActivityTypeAPIController extends AppBaseController
{
    /** @var  ActivityTypeRepository */
    private $activityTypeRepository;

    public function __construct(ActivityTypeRepository $activityTypeRepo)
    {
        $this->activityTypeRepository = $activityTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/activityTypes",
     *      summary="Get a listing of the ActivityTypes.",
     *      tags={"ActivityType"},
     *      description="Get all ActivityTypes",
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
     *                  @SWG\Items(ref="#/definitions/ActivityType")
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
        $this->activityTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->activityTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $activityTypes = $this->activityTypeRepository->all();

        return $this->sendResponse($activityTypes->toArray(), 'Activity Types retrieved successfully');
    }

    /**
     * @param CreateActivityTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/activityTypes",
     *      summary="Store a newly created ActivityType in storage",
     *      tags={"ActivityType"},
     *      description="Store ActivityType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ActivityType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActivityType")
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
     *                  ref="#/definitions/ActivityType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateActivityTypeAPIRequest $request)
    {
        $input = $request->all();

        $activityTypes = $this->activityTypeRepository->create($input);

        return $this->sendResponse($activityTypes->toArray(), 'Activity Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/activityTypes/{id}",
     *      summary="Display the specified ActivityType",
     *      tags={"ActivityType"},
     *      description="Get ActivityType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivityType",
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
     *                  ref="#/definitions/ActivityType"
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
        /** @var ActivityType $activityType */
        $activityType = $this->activityTypeRepository->find($id);

        if (empty($activityType)) {
            return $this->sendError('Activity Type not found');
        }

        return $this->sendResponse($activityType->toArray(), 'Activity Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateActivityTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/activityTypes/{id}",
     *      summary="Update the specified ActivityType in storage",
     *      tags={"ActivityType"},
     *      description="Update ActivityType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivityType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ActivityType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActivityType")
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
     *                  ref="#/definitions/ActivityType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateActivityTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivityType $activityType */
        $activityType = $this->activityTypeRepository->find($id);

        if (empty($activityType)) {
            return $this->sendError('Activity Type not found');
        }

        $activityType = $this->activityTypeRepository->update($input, $id);

        return $this->sendResponse($activityType->toArray(), 'ActivityType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/activityTypes/{id}",
     *      summary="Remove the specified ActivityType from storage",
     *      tags={"ActivityType"},
     *      description="Delete ActivityType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivityType",
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
        /** @var ActivityType $activityType */
        $activityType = $this->activityTypeRepository->find($id);

        if (empty($activityType)) {
            return $this->sendError('Activity Type not found');
        }

        $activityType->delete();

        return $this->sendResponse($id, 'Activity Type deleted successfully');
    }
}
