<?php
namespace cyrixbiz\acl\controller;

use cyrixbiz\acl\traits\bindModel;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package cyrixbiz\acl\controller
 */
class UserController
{
    use bindModel;

    protected $model;

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

    public function __construct(Container $app)
    {
        $this->model = $this->bindModel(config('acl.model.users'), $app);
        $this->action = strtolower(substr(config('acl.model.users'), strripos(config('acl.model.users'), '\\') + 1));
    }


    /**
     * user.index - Display all Resources
     * Use ACL - user.index
     *
     * @param void
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Acl::user\Overview', ['model' => $this->model->all(), 'action' => $this->action, 'link' => ['role', 'resource']]);
    }

    /**
     * Create a Resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create()
    {
        return view('Acl::user\Create', ['action' => $this->action]);
    }

    /**
     * Store the User to Database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:users|max:191',
            'email' => 'required|string|email|unique:users|max:191',
            'password' => 'required|min:8',
            'info' => 'required|max:191'
        ]);

        $this->model->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'info' => $request->get('info')
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Show the User
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show(int $id)
    {
        return view('Acl::user\Show', ['model' => $this->model->find($id), 'action' => $this->action]);
    }

    /**
     * Edit the Resource
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit(int $id)
    {
        return view('Acl::user\Edit', ['model' => $this->model->find($id), 'action' => $this->action]);
    }

    /**
     * Update the User
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|unique:users,id,' . $request->get('id') . '|max:191',
            'email' => 'required|string|email|unique:users,id,' . $request->get('id') . '|max:191',
            'password' => 'max:191',
            'info' => 'required|max:191'
        ]);


        if(isset($validate['password']))
        {
            $validate['password'] = Hash::make($validate['password']);
        }
        else
        {
            unset($validate['password']);
        }

        $this->model->where('id', '=', $request->get('id'))->first()->update($validate);

        return redirect()->route('user.index');


    }

    /**
     * Destroy the User
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(int $id)
    {
        if($id == config('acl.acl.superAdmin'))
        {
            return redirect()->route('user.index')->with('error', 'You can\' delete this Person');
        }
        $this->model->where('id', '=', $id)->delete($id);
        return redirect()->route('user.index');
    }


}