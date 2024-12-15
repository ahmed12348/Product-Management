<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon; // Using Carbon to handle date manipulations
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:dashboard_1|dashboard_2|dashboard_3'], ['only' => ['index']]);
    }


    public function index()
    {
        return view('dashboard.index');
    }

}
