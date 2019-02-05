<?php
namespace cyrixbiz\acl\controller;

use cyrixbiz\acl\traits\bindModel;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

/**
 * Class ResourceController
 * @package cyrixbiz\acl\controller
 */
class ResourceController
{
    use bindModel;

    protected $model;

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

    public function __construct(Container $app)
    {
        $this->model = $this->bindModel(config('acl.model.resources'), $app);
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
        return view('Acl::roleresource\Overview', ['model' => $this->model->all(), 'action' => $this->action]);
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:resources|max:191',
            'default_access' => 'required|boolean',
            'info' => 'required|max:191'
        ]);

        $this->model->create($request->input());

        return redirect()->route('resource.index');
    }

    /**
     * Show the Resource
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show(int $id)
    {
        return view('Acl::roleresource\Show', ['model' => $this->model->find($id), 'action' => $this->action]);
    }

    /**
     * Edit the Resource
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit(int $id)
    {
        return view('Acl::roleresource\Edit', ['model' => $this->model->find($id), 'action' => $this->action]);
    }

    /**
     * Update the Resource
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        $request->validate([
            'id'    => 'required|integer',
            'name' => 'sometimes|required|unique:resources,id,' . $request->get('id') . '|max:191',
            'default_access' => 'required|boolean',
            'info' => 'required|max:191'
        ]);

        $this->model->where('id', '=', $request->get('id'))->first()->update($request->input());

        return redirect()->route('resource.index');


    }

    /**
     * Destroy the Resource
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(int $id)
    {
        $this->model->where('id', '=', $id)->delete($id);
        return redirect()->route('resource.index');
    }


}