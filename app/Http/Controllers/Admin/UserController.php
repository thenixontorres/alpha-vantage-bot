<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function index($type = 'all')
    {
        $users = User::orderBy('created_at', 'desc')->get();
                
        return view('admin.users.index')
            ->with('users', $users);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $input = $request->validated();

        $this->userRepository->create($input);

        toast('Usuario registrado con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function edit(User $user)
    {

        return view('admin.users.edit')
            ->with('user', $user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->validated();

        if (!empty($input['password'])) 
        {
            $input['password'] = bcrypt($input['password']);
        }else{
            unset($input['password']);
        }
        
        $user->fill($input);

        $user->update();

        toast('Usuario actualizado con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        toast('Usuario borrado con exito', 'success' ,'top-right');

        return redirect()->back();
    }
}
