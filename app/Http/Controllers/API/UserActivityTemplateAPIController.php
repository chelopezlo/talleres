<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserActivityTemplateAPIRequest;
use App\Http\Requests\API\UpdateUserActivityTemplateAPIRequest;
use App\Models\UserActivityTemplate;
use App\Repositories\UserActivityTemplateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class UserActivityTemplateController
 * @package App\Http\Controllers\API
 */

class UserActivityTemplateAPIController extends AppBaseController
{
    /** @var  UserActivityTemplateRepository */
    private $userActivityTemplateRepository;

    public function __construct(UserActivityTemplateRepository $userActivityTemplateRepo)
    {
        $this->userActivityTemplateRepository = $userActivityTemplateRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/userActivityTemplates",
     *      summary="Get a listing of the UserActivityTemplates.",
     *      tags={"UserActivityTemplate"},
     *      description="Get all UserActivityTemplates",
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
     *                  @SWG\Items(ref="#/definitions/UserActivityTemplate")
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
        $this->userActivityTemplateRepository->pushCriteria(new RequestCriteria($request));
        $this->userActivityTemplateRepository->pushCriteria(new LimitOffsetCriteria($request));
        $userActivityTemplates = $this->userActivityTemplateRepository->all();

        return $this->sendResponse($userActivityTemplates->toArray(), 'User Activity Templates retrieved successfully');
    }

    /**
     * @param CreateUserActivityTemplateAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/userActivityTemplates",
     *      summary="Store a newly created UserActivityTemplate in storage",
     *      tags={"UserActivityTemplate"},
     *      description="Store UserActivityTemplate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserActivityTemplate that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserActivityTemplate")
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
     *                  ref="#/definitions/UserActivityTemplate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserActivityTemplateAPIRequest $request)
    {
        $input = $request->all();

        $userActivityTemplates = $this->userActivityTemplateRepository->create($input);

        return $this->sendResponse($userActivityTemplates->toArray(), 'User Activity Template saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/userActivityTemplates/{id}",
     *      summary="Display the specified UserActivityTemplate",
     *      tags={"UserActivityTemplate"},
     *      description="Get UserActivityTemplate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserActivityTemplate",
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
     *                  ref="#/definitions/UserActivityTemplate"
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
        /** @var UserActivityTemplate $userActivityTemplate */
        $userActivityTemplate = $this->userActivityTemplateRepository->find($id);

        if (empty($userActivityTemplate)) {
            return $this->sendError('User Activity Template not found');
        }

        return $this->sendResponse($userActivityTemplate->toArray(), 'User Activity Template retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserActivityTemplateAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/userActivityTemplates/{id}",
     *      summary="Update the specified UserActivityTemplate in storage",
     *      tags={"UserActivityTemplate"},
     *      description="Update UserActivityTemplate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserActivityTemplate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserActivityTemplate that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserActivityTemplate")
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
     *                  ref="#/definitions/UserActivityTemplate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserActivityTemplateAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserActivityTemplate $userActivityTemplate */
        $userActivityTemplate = $this->userActivityTemplateRepository->find($id);

        if (empty($userActivityTemplate)) {
            return $this->sendError('User Activity Template not found');
        }

        $userActivityTemplate = $this->userActivityTemplateRepository->update($input, $id);

        return $this->sendResponse($userActivityTemplate->toArray(), 'UserActivityTemplate updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/userActivityTemplates/{id}",
     *      summary="Remove the specified UserActivityTemplate from storage",
     *      tags={"UserActivityTemplate"},
     *      description="Delete UserActivityTemplate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserActivityTemplate",
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
        /** @var UserActivityTemplate $userActivityTemplate */
        $userActivityTemplate = $this->userActivityTemplateRepository->find($id);

        if (empty($userActivityTemplate)) {
            return $this->sendError('User Activity Template not found');
        }

        $userActivityTemplate->delete();

        return $this->sendResponse($id, 'User Activity Template deleted successfully');
    }
}
