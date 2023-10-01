<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('voting.index', [
            'title' => 'E-Voting HIMATIKOM',
            'candidates' => Candidates::all()
        ]);
    }

    public function candidates()
    {
        //
    }
}
