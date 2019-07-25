<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Backoffice\UpdateUserRequest;
use Auth;

class UserController extends Controller
{
    public function index()
    {	
    	return view('backoffice.users.index');
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

    	Auth::user()->fill($input);
    	Auth::user()->update();

        toast('Perfil actualizado', 'success' ,'top-right');

        return redirect()->back();
    }
}
