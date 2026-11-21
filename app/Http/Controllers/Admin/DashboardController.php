<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Certificate, Message, Project, Skill};

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'projects'     => Project::count(),
            'skills'       => Skill::count(),
            'certificates' => Certificate::count(),
            'unread'       => Message::where('is_read', false)->count(),
            'latest'       => Message::latest()->take(5)->get(),
        ]);
    }
}
