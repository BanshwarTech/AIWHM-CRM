<?php

namespace App\Http\Controllers\TeamLeader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamLeaderController extends Controller
{
    public function salesDashboard()
    {
        $result['user'] = currentUser();
        return view('team-leader.dashboards.sales-dashboard', $result);
    }

    public function supportDashboard()
    {
        $result['user'] = currentUser();
        return view('team-leader.dashboards.support-dashboard', $result);
    }

    public function seoDashboard()
    {
        $result['user'] = currentUser();
        return view('team-leader.dashboards.seo-dashboard', $result);
    }

    public function developmentDashboard()
    {
        $result['user'] = currentUser();
        return view('team-member.dashboards.development-dashboard', $result);
    }
}
