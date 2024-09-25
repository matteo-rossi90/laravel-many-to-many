<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index(){
        $count_projects = Project::count();
        return view('admin.dashboard', compact('count_projects'));
    }
}
