<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Strategy;
use App\Models\Asset;

class HomeController extends Controller
{
    public function index()
    {

        $count_strategies = Strategy::where('status', 'on')->count();

        $count_stock = Asset::where('status', 'on')->where('type','stock_market')->count();

        $count_physical = Asset::where('status', 'on')->where('type','physical')->count();

        $count_digital = Asset::where('status', 'on')->where('type','digital')->count();

    	return view('backoffice.index')
            ->with('count_strategies', $count_strategies)
            ->with('count_stock', $count_stock)
            ->with('count_physical', $count_physical)
            ->with('count_digital', $count_digital);

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
