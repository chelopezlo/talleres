<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserActivityTemplateRequest;
use App\Http\Requests\UpdateUserActivityTemplateRequest;
use App\Repositories\UserActivityTemplateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserActivityTemplateController extends AppBaseController
{
    /** @var  UserActivityTemplateRepository */
    private $userActivityTemplateRepository;

    public function __construct(UserActivityTemplateRepository $userActivityTemplateRepo)
    {
        $this->userActivityTemplateRepository = $userActivityTemplateRepo;
    }

    /**
     * Display a listing of the UserActivityTemplate.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userActivityTemplateRepository->pushCriteria(new RequestCriteria($request));
        $userActivityTemplates = $this->userActivityTemplateRepository->all();

        return view('user_activity_templates.index')
            ->with('userActivityTemplates', $userActivityTemplates);
    }

    /**
     * Show the form for creating a new UserActivityTemplate.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_activity_templates.create');
    }

    /**
     * Store a newly created UserActivityTemplate in storage.
     *
     * @param CreateUserActivityTemplateRequest $request
     *
     * @return Response
     */
    public function store(CreateUserActivityTemplateRequest $request)
    {
        $input = $request->all();

        $userActivityTemplate = $this->userActivityTemplateRepository->create($input);

        Flash::success('User Activity Template saved successfully.');

        return redirect(route('userActivityTemplates.index'));
    }

    /**
     * Display the specified UserActivityTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userActivityTemplate = $this->userActivityTemplateRepository->findWithoutFail($id);

        if (empty($userActivityTemplate)) {
            Flash::error('User Activity Template not found');

            return redirect(route('userActivityTemplates.index'));
        }

        return view('user_activity_templates.show')->with('userActivityTemplate', $userActivityTemplate);
    }

    /**
     * Show the form for editing the specified UserActivityTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userActivityTemplate = $this->userActivityTemplateRepository->findWithoutFail($id);

        if (empty($userActivityTemplate)) {
            Flash::error('User Activity Template not found');

            return redirect(route('userActivityTemplates.index'));
        }

        return view('user_activity_templates.edit')->with('userActivityTemplate', $userActivityTemplate);
    }

    /**
     * Update the specified UserActivityTemplate in storage.
     *
     * @param  int              $id
     * @param UpdateUserActivityTemplateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserActivityTemplateRequest $request)
    {
        $userActivityTemplate = $this->userActivityTemplateRepository->findWithoutFail($id);

        if (empty($userActivityTemplate)) {
            Flash::error('User Activity Template not found');

            return redirect(route('userActivityTemplates.index'));
        }

        $userActivityTemplate = $this->userActivityTemplateRepository->update($request->all(), $id);

        Flash::success('User Activity Template updated successfully.');

        return redirect(route('userActivityTemplates.index'));
    }

    /**
     * Remove the specified UserActivityTemplate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userActivityTemplate = $this->userActivityTemplateRepository->findWithoutFail($id);

        if (empty($userActivityTemplate)) {
            Flash::error('User Activity Template not found');

            return redirect(route('userActivityTemplates.index'));
        }

        $this->userActivityTemplateRepository->delete($id);

        Flash::success('User Activity Template deleted successfully.');

        return redirect(route('userActivityTemplates.index'));
    }
}
