<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // You can add stats here later
        return view('admin.dashboard');
    }
}