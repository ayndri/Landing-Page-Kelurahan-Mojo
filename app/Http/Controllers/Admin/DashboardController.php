<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RwProfile;
use App\Models\Plant;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'plant_count' => Plant::count(),
            'umkm_count' => Umkm::count(),
        ];

        if ($user->isSuperAdmin()) {
            $stats['user_count'] = User::count();
            $stats['rw_count'] = RwProfile::count();
        }

        return view('admin.dashboard', compact('stats'));
    }
}
