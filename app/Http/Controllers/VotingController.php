<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotingController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('voting.index', [
            'title' => 'E-Voting HIMATIKOM',
            'votes' => Vote::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'event_name' => $request->event_name,
            'voting_date' => now('Asia/Jakarta'),
        ];
        Vote::create($data);
        return response()->json(['message' => 'Berhasil membuat event voting!']);
    }

    public function show(Vote $votes)
    {
        $sub_vote = DB::table('sub_votes')->where('vote_id', '=', $votes->id)->get()->all();
        return view('voting.detail', [
            'vote' => $votes,
            'sub_vote' => $sub_vote
        ]);
    }
}
