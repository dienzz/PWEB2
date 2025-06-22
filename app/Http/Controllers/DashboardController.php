<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Visitor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect('/login');
        }

        // Calculate statistics
        $activeMembers = Member::whereDate('tgl_akhir', '>=', Carbon::today())->count();
        $visitorsToday = Visitor::whereDate('created_at', Carbon::today())->count();
        $pendingPayments = Payment::where('status', 'pending')->count(); 

        $stats = [
            'active_members' => $activeMembers,
            'visitors_today' => $visitorsToday,
            'pending_payments' => $pendingPayments,
        ];

        return view('dashboard', compact('stats'));
    }
}