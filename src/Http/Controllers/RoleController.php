<?php
namespace cyrixbiz\acl\controller;

use cyrixbiz\acl\traits\bindModel;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package cyrixbiz\acl\controller
 */
class RoleController
{
    use bindModel;

    protected $model, $action;

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

    public function __construct(Container $app)
    {
        $this->model = $this->bindModel(config('acl.model.roles'), $app);
        $this->action = strtolower(substr(config('acl.model.roles'), strripos(config('acl.model.roles'), '\\') + 1));

    }


    /**
     * role.index - Display all Roles
     * Use ACL - role.index
     *
     * @param void
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Acl::roleresource\Overview', ['model' => $this->model->all(), 'action' => $this->action, 'link' => ['resource']]);
    }

    /**
     * Create a Role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create()
    {
        return view('Acl::roleresource\create', ['action' => $this->action]);
    }

    /**
     * Store the Role to Database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles|max:191',
            'default_access' => 'required|boolean',
            'info' => 'required|max:191'
        ]);

        $this->model->create($request->input());

        return redirect()->route('role.index');
    }

    /**
     * Show the Role
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show(int $id)
    {
        return view('Acl::roleresource\Show', ['model' => $this->model->find($id), 'action' => $this->action]);
    }

    /**
     * Edit the Role
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit(int $id)
    {
        return view('Acl::roleresource\Edit', ['model' => $this->model->find($id), 'action' => $this->action]);
    }

    /**
     * Update the Role
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'sometimes|required|unique:roles,id,' . $request->get('id') . '|max:191',
            'default_access' => 'required|boolean',
            'info' => 'required|max:191'
        ]);

        $this->model->where('id', '=', $request->get('id'))->first()->update($request->input());

        return redirect()->route('role.index');


    }

    /**
     * Destroy the Role
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(int $id)
    {
        $this->model->where('id', '=', $id)->delete($id);
        return redirect()->route('role.index');
    }


}