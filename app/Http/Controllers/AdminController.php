<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function AdminDashboard() {

        $this->authorize('access', AdminController::class);

        $data = User::with(['birds' => function($item) {
            $item->with('comments');
        }])->get()->each(function($item) {
            $total_comment = 0;
            foreach ($item->birds as $bi) {
                $total_comment += count($bi->comments);
            }
            $item->total_comment = $total_comment;
        });
        // dd($data);

        view()->share([
            'data' => $data
        ]);
        return view('admin.admin_dashboard');
    }

    public function AdminBirdy() {

        $this->authorize('access', AdminController::class);

        return view('admin.admin_birdy');
    }
}
