<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivityScheduleRequest;
use App\Http\Requests\UpdateActivityScheduleRequest;
use App\Repositories\ActivityScheduleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ActivityScheduleController extends AppBaseController
{
    /** @var  ActivityScheduleRepository */
    private $activityScheduleRepository;

    public function __construct(ActivityScheduleRepository $activityScheduleRepo)
    {
        $this->activityScheduleRepository = $activityScheduleRepo;
    }

    /**
     * Display a listing of the ActivitySchedule.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->activityScheduleRepository->pushCriteria(new RequestCriteria($request));
        $activitySchedules = $this->activityScheduleRepository->all();

        return view('activity_schedules.index')
            ->with('activitySchedules', $activitySchedules);
    }

    /**
     * Show the form for creating a new ActivitySchedule.
     *
     * @return Response
     */
    public function create()
    {
        return view('activity_schedules.create');
    }

    /**
     * Store a newly created ActivitySchedule in storage.
     *
     * @param CreateActivityScheduleRequest $request
     *
     * @return Response
     */
    public function store(CreateActivityScheduleRequest $request)
    {
        $input = $request->all();

        $activitySchedule = $this->activityScheduleRepository->create($input);

        Flash::success('Activity Schedule saved successfully.');

        return redirect(route('activitySchedules.index'));
    }

    /**
     * Display the specified ActivitySchedule.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activitySchedule = $this->activityScheduleRepository->findWithoutFail($id);

        if (empty($activitySchedule)) {
            Flash::error('Activity Schedule not found');

            return redirect(route('activitySchedules.index'));
        }

        return view('activity_schedules.show')->with('activitySchedule', $activitySchedule);
    }

    /**
     * Show the form for editing the specified ActivitySchedule.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activitySchedule = $this->activityScheduleRepository->findWithoutFail($id);

        if (empty($activitySchedule)) {
            Flash::error('Activity Schedule not found');

            return redirect(route('activitySchedules.index'));
        }

        return view('activity_schedules.edit')->with('activitySchedule', $activitySchedule);
    }

    /**
     * Update the specified ActivitySchedule in storage.
     *
     * @param  int              $id
     * @param UpdateActivityScheduleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivityScheduleRequest $request)
    {
        $activitySchedule = $this->activityScheduleRepository->findWithoutFail($id);

        if (empty($activitySchedule)) {
            Flash::error('Activity Schedule not found');

            return redirect(route('activitySchedules.index'));
        }

        $activitySchedule = $this->activityScheduleRepository->update($request->all(), $id);

        Flash::success('Activity Schedule updated successfully.');

        return redirect(route('activitySchedules.index'));
    }

    /**
     * Remove the specified ActivitySchedule from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activitySchedule = $this->activityScheduleRepository->findWithoutFail($id);

        if (empty($activitySchedule)) {
            Flash::error('Activity Schedule not found');

            return redirect(route('activitySchedules.index'));
        }

        $this->activityScheduleRepository->delete($id);

        Flash::success('Activity Schedule deleted successfully.');

        return redirect(route('activitySchedules.index'));
    }
}
