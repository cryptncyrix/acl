<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Controllers;

use cyrixbiz\acl\Http\Requests\Role\RoleRequest;
use cyrixbiz\acl\Http\Requests\Role\RoleUpdateRequest;
use cyrixbiz\acl\Repositories\Role\RoleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class RoleController
 * @package cyrixbiz\acl\controller
 */
class RoleController
{

    protected $repository, $action;

    /*
    |--------------------------------------------------------------------------
    | Role Controller
    | Manage the Roles
    |--------------------------------------------------------------------------
    */

    /**
     * RoleController constructor.
     * @param Container $app
     */

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
        $this->action = strtolower(substr(config('acl.model.roles'), strripos(config('acl.model.roles'), '\\') + 1));

    }


    /**
     * role.index - Display all Roles
     * Use ACL - role.index
     *
     * @param void
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() : View
    {
        return view('AclView::roleresource\Overview', ['repository' => $this->repository->all(), 'action' => $this->action, 'link' => ['resource']]);
    }

    /**
     * Create a Role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create() : View
    {
        return view('AclView::roleresource\create', ['action' => $this->action]);
    }

    /**
     * Store the Role to Database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(RoleRequest $request) : RedirectResponse
    {

        $this->repository->create($request->validated());
        return redirect()->route('role.index');
    }

    /**
     * Show the Role
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show(int $id) : View
    {
        return view('AclView::roleresource\Show', ['repository' => $this->repository->find($id), 'action' => $this->action]);
    }

    /**
     * Edit the Role
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit(int $id) : View
    {
        return view('AclView::roleresource\Edit', ['repository' => $this->repository->find($id), 'action' => $this->action]);
    }

    /**
     * Update the Role
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(RoleUpdateRequest $request)  : RedirectResponse
    {
        $this->repository->update($request->validated(), (int) $request->validated()['id']);
        return redirect()->route('role.index');


    }

    /**
     * Destroy the Role
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(int $id) : RedirectResponse
    {
        if($id != config('acl.acl.blockedRole'))
        {
            return redirect()->route('role.index')->with('error', 'You can\' delete this Role. This Role is a System-Role.');

        }
        $this->repository->delete($id, []);
        return redirect()->route('role.index');
    }


}