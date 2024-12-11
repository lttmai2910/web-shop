<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Inertia\Inertia;


class DashboardController extends Controller 
{
    public function count()
    {
        $employeeCount = User::where('role', '0')->count();
        $managerCount = User::where('role', '1')->count();

        return Inertia::render('Dashboard', [
            'employeeCount' => $employeeCount,
            'managerCount' => $managerCount,
        ]);
    }
}