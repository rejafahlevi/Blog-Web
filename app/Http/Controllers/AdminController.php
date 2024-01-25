<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function AdminDashboard() {

        $this->authorize('access', AdminController::class);

        return view('admin.admin_dashboard');
    }

    public function AdminBirdy() {

        $this->authorize('access', AdminController::class);

        return view('admin.admin_birdy');
    }
}
