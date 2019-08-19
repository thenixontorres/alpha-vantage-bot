<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateKeyRequest;
use App\Http\Requests\Admin\UpdateKeyRequest;
use App\Models\Key;

class KeyController extends Controller
{

    public function index()
    {	
     	$keys = Key::orderBy('created_at', 'ASC')->get();

        return view('admin.keys.index')
            ->with('keys', $keys);
    }

    public function store(CreateKeyRequest $request)
    {
    	$key = new Key();

    	$input = $request->validated();

    	$active = Key::where('is_active', true)->first();

    	if (empty($active)) 
    	{
    		$input['is_active'] = true;
    	}

    	$key->fill($input);

    	$key->save();

        toast('Llave registrada con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function update(Key $key, UpdateKeyRequest $request)
    {
        $old_active = Key::where('is_active', true)->first();

        if (!empty($old_active)) 
        {
            $old_active->is_active = false;
            $old_active->update();
        }

        $key->is_active = true;
        $key->update();

        toast('Llave activada con exito', 'success' ,'top-right');

        return redirect()->back();  
    }

    public function destroy(Key $key)
    {
    	if ($key->is_active) 
    	{
	    	$new_active = Key::where('is_active', false)->first();

	    	if (!empty($new_active)) 
	    	{
	    		$new_active->is_active = true;
	    		$new_active->update();
	    	}
    	}

    	$key->delete();

    	toast('Llave borrada con exito', 'success' ,'top-right');

        return redirect()->back();

    }
}
