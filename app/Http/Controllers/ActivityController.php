<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Repositories\ActivityRepository;
use App\Http\Requests\CreateUserActivityRequest;
use App\Http\Requests\UpdateUserActivityRequest;
use App\Repositories\UserActivityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\UserActivity;

class ActivityController extends AppBaseController
{
    /** @var  ActivityRepository */
    private $activityRepository;
    private $userActivityRepository;

    public function __construct(ActivityRepository $activityRepo, UserActivityRepository $userActivityRepo)
    {
        $this->activityRepository = $activityRepo;
        $this->userActivityRepository = $userActivityRepo;
    }

    /**
     * Display a listing of the Activity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->activityRepository->pushCriteria(new RequestCriteria($request));
        
        $user = $request->user();
        
        $whereUserActivity = array(
            array(
                'persona_id',
                '=',
                $user->Persona->id
            )
        );
        
        $userActivities = $this->userActivityRepository->with('Schedule.Activity')->findWhere($whereUserActivity);
        
        $whereActivity = array(
            array(
                'activity_type_id',
                '=',
                2
            )
        );
        
        $signedIn = 0;
        foreach ($userActivities as $userActivity)
        {
            if($userActivity->Schedule->Activity->activity_type_id == 2){
                $signedIn++;
                $condition = array(
                    'id',
                    '<>',
                    $userActivity->activity_id
                ); 
                array_push($whereActivity, $condition);
            }
        }
        
        if($signedIn >= 3)
        {
            Flash::message('Felicitaciones! Ya has inscrito los talleres. Puedes ver los talleres inscritos en la opcion "Talleres Inscritos" del menú lateral.');
        }
        
        $activities = $this->activityRepository->with('ActivitySchedule')->orderBy('color')->findWhere($whereActivity);
        return view('activities.index')
            ->with('activities', $activities)->with('userActivities', $userActivities)->with('signedIn', $signedIn);
    }

    /**
     * Show the form for creating a new Activity.
     *
     * @return Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created Activity in storage.
     *
     * @param CreateActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateActivityRequest $request)
    {
        $input = $request->all();

        $activity = $this->activityRepository->create($input);

        Flash::success('Activity saved successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Display the specified Activity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activity = $this->activityRepository->findWithoutFail($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        return view('activities.show')->with('activity', $activity);
    }

    /**
     * Show the form for editing the specified Activity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activity = $this->activityRepository->findWithoutFail($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }
        
        $activity->load('ActivitySchedule');
        
        return view('activities.edit')->with('activity', $activity);
    }

    /**
     * Update the specified Activity in storage.
     *
     * @param  int              $id
     * @param UpdateActivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivityRequest $request)
    {
        $activity = $this->activityRepository->findWithoutFail($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        $activity = $this->activityRepository->update($request->all(), $id);

        Flash::success('Activity updated successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Remove the specified Activity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activity = $this->activityRepository->findWithoutFail($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        $this->activityRepository->delete($id);

        Flash::success('Activity deleted successfully.');

        return redirect(route('activities.index'));
    }
}
