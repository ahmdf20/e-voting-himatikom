<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('dashboard', [
            'votes' => Vote::all(),
        ]);
    }

    public function show(Vote $votes)
    {
        return view('dashboard.vote-detail', [
            'vote' => $votes
        ]);
    }
}
