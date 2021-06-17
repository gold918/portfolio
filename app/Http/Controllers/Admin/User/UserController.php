<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\User\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['role' => function ($query) {
            $query->select('id', 'title');
        }])->get();
        if(view()->exists('admin.user.index')) {
            return view('admin.user.index', ['users' => $users]);
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('id')->pluck('title');
        if(view()->exists('admin.user.create')) {
            return view('admin.user.create', compact('roles'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'photo' => 'image',
            'password' => ['required', 'string', 'min:8'],
        ]);

        if($request->has(['name', 'email', 'role', 'password'])) {
            $user->name = $request->name;
            $user->uploadImage($request->file('photo'), 'img/users', 'photo');
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = Str::random(10);
            $role = Role::where('title', $request->role)->first();
            $user->role()->associate($role);
            $user->save();
            return redirect()->route('admin.user');
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $userRole = $user->role->title;
        $roles = Role::orderBy('id')->pluck('title');
        if(view()->exists('admin.user.update')) {
            return view('admin.user.update', compact('user', 'userRole', 'roles'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $rules = [
            'photo' => 'image',
            'email' => 'email',
        ];

        if(isset($user->email) && $request->exists('email') && $request->email !== $user->email) {
            $rules['email'] = 'email|unique:users';
        }
        if(!empty($request->password)) {
            $rules['password'] = ['string', 'min:8'];
        }
        $request->validate($rules);

        $user->updateField($request, 'name');
        $user->uploadImage($request->file('photo'), 'img/users', 'photo');
        $user->updateField($request, 'email');
        $user->updateField($request, 'email');
        if(isset($request->password)) {
            $user->password = bcrypt($request->password);
        }
        if($request->exists('role') && strpos($request->role, $user->role->title) === false ) {
            $role = Role::where('title', $request->role)->first();
            $user->role()->associate($role);
        }
        $user->save();
        return redirect()->route('admin.user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id);
            $user->delete();
            $user->removeImage('img/users', 'photo');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
