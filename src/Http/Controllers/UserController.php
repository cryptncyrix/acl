<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Controllers;

use cyrixbiz\acl\Http\Requests\User\UserRequest;
use cyrixbiz\acl\Http\Requests\User\UserUpdateRequest;
use cyrixbiz\acl\Repositories\User\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Class UserController
 * @package cyrixbiz\acl\controller
 */
class UserController
{
    protected $repository;

    /*
    |--------------------------------------------------------------------------
    | User Controller
    | Manage the Users
    |--------------------------------------------------------------------------
    */

    /**
     * UserController constructor.
     * @param Container $app
     */

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->action = strtolower(substr(config('acl.model.users'), strripos(config('acl.model.users'), '\\') + 1));
    }


    /**
     * user.index - Display all Resources
     * Use ACL - user.index
     *
     * @param void
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() : View
    {
        return view('AclView::user\Overview', ['repository' => $this->repository->all(), 'action' => $this->action, 'link' => ['role', 'resource']]);
    }

    /**
     * Create a Resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create() : View
    {
        return view('AclView::user\Create', ['action' => $this->action]);
    }

    /**
     * Store the User to Database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(UserRequest $request) : RedirectResponse
    {

        $this->repository->create($request->validated());

        return redirect()->route('user.index');
    }

    /**
     * Show the User
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show(int $id) : View
    {
        return view('AclView::user\Show', ['repository' => $this->repository->find($id), 'action' => $this->action]);
    }

    /**
     * Edit the Resource
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit(int $id) : View
    {
        return view('AclView::user\Edit', ['repository' => $this->repository->find($id), 'action' => $this->action]);
    }

    /**
     * Update the User
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(UserUpdateRequest $request) : RedirectResponse
    {
        $this->repository->update($request->validated(), (int) $request->validated()['id']);

        return redirect()->route('user.index');


    }

    /**
     * Destroy the User
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(int $id) : RedirectResponse
    {
        if($id == config('acl.acl.superAdmin'))
        {
            return redirect()->route('user.index')->with('error', __('AclLang::exceptions.superAdmin'));
        }
        $this->repository->delete($id);
        return redirect()->route('user.index');
    }


}