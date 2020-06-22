<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;

use App\User;
use App\Statut;
use Spatie\Permission\Models\Role;
use DB;

use App\Traits\UserTrait;

class UserController extends Controller
{
    use UserTrait;

    function __construct()
    {
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'name', 'email'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $users = User::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('users.index', compact('users', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $user = $this->getDefaultObject(new User());

        return view('users.create')
          ->with('roles', $roles)
          ->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $input = $this->formatRequestInput($request);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'User'] ));

        return redirect()->action('UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $selectedroles = $user->roles->pluck('name','id')->all();
        $view_attributes = User::view_attributes_edit($user);

        return view('users.edit')
          ->with('user', $user)
          ->with('selectedroles', $selectedroles)
          ->with('view_attributes', $view_attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        $input = $this->formatRequestInput($request);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();

        $user->assignRole($request->input('roles'));

        //messages
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'User'] ));

        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'User'] ));

        return redirect()->action('UserController@index');
    }
}
