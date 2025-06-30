<?php

namespace App\Http\Controllers\TeamLeader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamLeaderController extends Controller
{
    public function salesDashboard()
    {
        return view('team-leader.sales-dashboard');
    }

    public function supportDashboard()
    {
        return view('team-leader.support-dashboard');
    }

    public function seoDashboard()
    {
        return view('team-leader.seo-dashboard');
    }

    public function developmentDashboard()
    {
        return view('team-member.development-dashboard');
    }
}
