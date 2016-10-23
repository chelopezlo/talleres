<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivityScheduleAPIRequest;
use App\Http\Requests\API\UpdateActivityScheduleAPIRequest;
use App\Models\ActivitySchedule;
use App\Repositories\ActivityScheduleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ActivityScheduleController
 * @package App\Http\Controllers\API
 */

class ActivityScheduleAPIController extends AppBaseController
{
    /** @var  ActivityScheduleRepository */
    private $activityScheduleRepository;

    public function __construct(ActivityScheduleRepository $activityScheduleRepo)
    {
        $this->activityScheduleRepository = $activityScheduleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/activitySchedules",
     *      summary="Get a listing of the ActivitySchedules.",
     *      tags={"ActivitySchedule"},
     *      description="Get all ActivitySchedules",
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
     *                  @SWG\Items(ref="#/definitions/ActivitySchedule")
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
        $this->activityScheduleRepository->pushCriteria(new RequestCriteria($request));
        $this->activityScheduleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $activitySchedules = $this->activityScheduleRepository->all();

        return $this->sendResponse($activitySchedules->toArray(), 'Activity Schedules retrieved successfully');
    }

    /**
     * @param CreateActivityScheduleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/activitySchedules",
     *      summary="Store a newly created ActivitySchedule in storage",
     *      tags={"ActivitySchedule"},
     *      description="Store ActivitySchedule",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ActivitySchedule that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActivitySchedule")
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
     *                  ref="#/definitions/ActivitySchedule"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateActivityScheduleAPIRequest $request)
    {
        $input = $request->all();

        $activitySchedules = $this->activityScheduleRepository->create($input);

        return $this->sendResponse($activitySchedules->toArray(), 'Activity Schedule saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/activitySchedules/{id}",
     *      summary="Display the specified ActivitySchedule",
     *      tags={"ActivitySchedule"},
     *      description="Get ActivitySchedule",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivitySchedule",
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
     *                  ref="#/definitions/ActivitySchedule"
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
        /** @var ActivitySchedule $activitySchedule */
        $activitySchedule = $this->activityScheduleRepository->find($id);

        if (empty($activitySchedule)) {
            return $this->sendError('Activity Schedule not found');
        }

        return $this->sendResponse($activitySchedule->toArray(), 'Activity Schedule retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateActivityScheduleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/activitySchedules/{id}",
     *      summary="Update the specified ActivitySchedule in storage",
     *      tags={"ActivitySchedule"},
     *      description="Update ActivitySchedule",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivitySchedule",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ActivitySchedule that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActivitySchedule")
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
     *                  ref="#/definitions/ActivitySchedule"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateActivityScheduleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivitySchedule $activitySchedule */
        $activitySchedule = $this->activityScheduleRepository->find($id);

        if (empty($activitySchedule)) {
            return $this->sendError('Activity Schedule not found');
        }

        $activitySchedule = $this->activityScheduleRepository->update($input, $id);

        return $this->sendResponse($activitySchedule->toArray(), 'ActivitySchedule updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/activitySchedules/{id}",
     *      summary="Remove the specified ActivitySchedule from storage",
     *      tags={"ActivitySchedule"},
     *      description="Delete ActivitySchedule",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivitySchedule",
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
        /** @var ActivitySchedule $activitySchedule */
        $activitySchedule = $this->activityScheduleRepository->find($id);

        if (empty($activitySchedule)) {
            return $this->sendError('Activity Schedule not found');
        }

        $activitySchedule->delete();

        return $this->sendResponse($id, 'Activity Schedule deleted successfully');
    }
}
