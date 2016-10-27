<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserActivityRequest;
use App\Http\Requests\UpdateUserActivityRequest;
use App\Repositories\UserActivityRepository;
use App\Models\ActivitySchedule;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserActivityController extends AppBaseController
{
    /** @var  UserActivityRepository */
    private $userActivityRepository;

    public function __construct(UserActivityRepository $userActivityRepo)
    {
        $this->userActivityRepository = $userActivityRepo;
    }

    /**
     * Display a listing of the UserActivity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userActivityRepository->pushCriteria(new RequestCriteria($request));
        
        $user = $request->user();
        
        $userActivities = $this->userActivityRepository->with('Schedule.Activity')->with('Persona')->findByField('persona_id', $user->Persona->id)->sortByDesc('from');

        return view('user_activities.index')
            ->with('userActivities', $userActivities);
    }

    /**
     * Show the form for creating a new UserActivity.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_activities.create');
    }

    /**
     * Store a newly created UserActivity in storage.
     *
     * @param CreateUserActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateUserActivityRequest $request)
    {
        $input = $request->all();

        $userActivity = $this->userActivityRepository->create($input);             

        Flash::success('User Activity saved successfully.');

        return redirect(route('userActivities.index'));
    }

    /**
     * Display the specified UserActivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userActivity = $this->userActivityRepository->findWithoutFail($id);

        if (empty($userActivity)) {
            Flash::error('User Activity not found');

            return redirect(route('userActivities.index'));
        }

        return view('user_activities.show')->with('userActivity', $userActivity);
    }

    /**
     * Show the form for editing the specified UserActivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userActivity = $this->userActivityRepository->findWithoutFail($id);

        if (empty($userActivity)) {
            Flash::error('User Activity not found');

            return redirect(route('userActivities.index'));
        }

        return view('user_activities.edit')->with('userActivity', $userActivity);
    }

    /**
     * Update the specified UserActivity in storage.
     *
     * @param  int              $id
     * @param UpdateUserActivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserActivityRequest $request)
    {
        $userActivity = $this->userActivityRepository->findWithoutFail($id);

        if (empty($userActivity)) {
            Flash::error('User Activity not found');

            return redirect(route('userActivities.index'));
        }

        $userActivity = $this->userActivityRepository->update($request->all(), $id);

        Flash::success('User Activity updated successfully.');

        return redirect(route('userActivities.index'));
    }

    /**
     * Remove the specified UserActivity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userActivity = $this->userActivityRepository->findWithoutFail($id);

        if (empty($userActivity)) {
            Flash::error('User Activity not found');

            return redirect(route('userActivities.index'));
        }

        $this->userActivityRepository->delete($id);

        Flash::success('User Activity deleted successfully.');

        return redirect(route('userActivities.index'));
    }
}
