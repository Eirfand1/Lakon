<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFeed;

class DashboardController extends Controller
{
    public function index()
    {
        $dataFeed = new DataFeed();

        return view('pages.admin.dashboard.dashboard', compact('dataFeed'));
    }

}
