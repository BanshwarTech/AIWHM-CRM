<?php

namespace App\Http\Controllers\TeamMember;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function salesDashboard()
    {
        $result['user'] = currentUser();
        return view('team-member.dashboards.sales-dashboard', $result);
    }

    public function supportDashboard()
    {
        $result['user'] = currentUser();
        return view('team-member.dashboards.support-dashboard', $result);
    }

    public function seoDashboard()
    {
        $result['user'] = currentUser();
        return view('team-member.dashboards.seo-dashboard', $result);
    }

    public function developmentDashboard()
    {
        $result['user'] = currentUser();
        return view('team-member.dashboards.development-dashboard', $result);
    }
}
