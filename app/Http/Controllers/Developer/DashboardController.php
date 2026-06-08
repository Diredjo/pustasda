<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\AppSetting;

class DashboardController extends Controller
{
    public function index()
    {
        $trending = Competition::where('is_trending', true)->where('is_active', true)->take(4)->get();
        $terbaru = Competition::where('is_active', true)->latest()->take(4)->get();
        $nasional = Competition::where('level', 'nasional')->where('is_active', true)->take(4)->get();
        $deadlineSoon = Competition::where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->whereDate('deadline', '<=', now()->addDays(7))
            ->take(4)->get();

        return view('developer.dashboard', compact(
            'trending',
            'terbaru',
            'nasional',
            'deadlineSoon'
        ));
    }
}