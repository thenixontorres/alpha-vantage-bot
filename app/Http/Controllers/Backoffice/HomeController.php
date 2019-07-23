<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
    	return view('backoffice.index');
    }

    public function resetDB()
    {

    	/*\Artisan::call('route:cache');*/
    	\Artisan::call('dump-autoload');
		\Artisan::call('clear-compiled');
		\Artisan::call('optimize:clear');
		\Artisan::call('migrate:fresh');
		\Artisan::call('db:seed');

		return redirect()->route('backoffice.index');
	}
}
