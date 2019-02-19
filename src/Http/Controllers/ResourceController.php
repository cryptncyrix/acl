<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Controllers;

use cyrixbiz\acl\Http\Requests\Resource\ResourceRequest;
use cyrixbiz\acl\Http\Requests\Resource\ResourceUpdateRequest;
use cyrixbiz\acl\Repositories\Resource\ResourceRepository;

/**
 * Class ResourceController
 * @package cyrixbiz\acl\controller
 */
class ResourceController
{

    /**
     * @var ResourceRepository
     */
    protected $repository;

    /*
    |--------------------------------------------------------------------------
    | Resources Controller
    | Manage the Resources
    |--------------------------------------------------------------------------
    */

    /**
     * ResourceController constructor.
     * @param Container $app
     */

    public function __construct(ResourceRepository $repository)
    {
        $this->repository = $repository;
        $this->action = strtolower(substr(config('acl.model.resources'), strripos(config('acl.model.resources'), '\\') + 1));
    }

    /**
     * resource.index - Display all Resources
     * Use ACL - resource.index
     *
     * @param void
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Acl::roleresource\Overview', ['model' => $this->repository->all(), 'action' => $this->action]);
    }

    /**
     * Create a Resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create()
    {
        return view('Acl::roleresource\Create', ['action' => $this->action]);
    }

    /**
     * Store the Resource to Database
     * @param ResourceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(ResourceRequest $request)
    {

        $this->repository->create($request->validated());
        return redirect()->route('resource.index');
    }

    /**
     * Show the Resource
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show(int $id)
    {
        return view('Acl::roleresource\Show', ['model' => $this->repository->find($id), 'action' => $this->action]);
    }

    /**
     * Edit the Resource
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit(int $id)
    {
        return view('Acl::roleresource\Edit', ['model' => $this->repository->find($id), 'action' => $this->action]);
    }

    /**
     * Update the Resource
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(ResourceUpdateRequest $request)
    {
        $this->repository->update($request->validated(), (int) $request->validated()['id']);
        return redirect()->route('resource.index');


    }

    /**
     * Destroy the Resource
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return redirect()->route('resource.index');
    }


}